<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Support\Facades\DB;
use NextDeveloper\Commons\Database\Models\FailedJobs;

class FailedJobsService
{
    public const DEFAULT_LIMIT     = 20;
    public const MAX_LIMIT         = 100;
    public const TRACE_FRAME_LIMIT = 15;
    public const MAX_STRING_LENGTH = 500;
    public const MAX_ARRAY_ITEMS   = 20;
    public const MAX_DEPTH         = 3;

    /**
     * Reads up to $limit failed_jobs rows (oldest failed_at first), deletes
     * exactly those rows, and returns them formatted for LLM consumption.
     * Select + delete run in one transaction with a row lock so concurrent
     * calls can't both "pop" the same rows.
     */
    public static function popBatch(int $limit): array
    {
        $limit = max(1, min(self::MAX_LIMIT, $limit ?: self::DEFAULT_LIMIT));

        return DB::transaction(function () use ($limit) {
            $rows = FailedJobs::orderBy('failed_at', 'asc')
                ->orderBy('id', 'asc')
                ->limit($limit)
                ->lockForUpdate()
                ->get();

            if ($rows->isEmpty()) {
                return [];
            }

            $formatted = $rows->map(fn (FailedJobs $row) => self::formatJob($row))->all();

            FailedJobs::whereIn('id', $rows->pluck('id')->all())->delete();

            return $formatted;
        });
    }

    private static function formatJob(FailedJobs $row): array
    {
        $payload = json_decode($row->payload, true) ?? [];
        $exceptionInfo = self::parseException((string) $row->exception);

        return [
            'id'         => $row->id,
            'uuid'       => $row->uuid,
            'job_class'  => self::resolveJobClass($payload),
            'queue'      => $row->queue,
            'connection' => $row->connection,
            'failed_at'  => optional($row->failed_at)->toIso8601String(),
            'exception'  => [
                'class'   => $exceptionInfo['class'],
                'message' => $exceptionInfo['message'] !== null
                    ? self::truncateValue($exceptionInfo['message'])
                    : null,
                'file'    => $exceptionInfo['file'],
                'line'    => $exceptionInfo['line'],
            ],
            'trace_excerpt'     => $exceptionInfo['trace_excerpt'],
            'trace_frame_count' => $exceptionInfo['trace_frame_count'],
            'payload'           => self::resolveJobArgs($payload),
        ];
    }

    private static function resolveJobClass(array $payload): string
    {
        if (!empty($payload['data']['commandName']) && is_string($payload['data']['commandName'])) {
            return $payload['data']['commandName'];
        }
        if (!empty($payload['displayName']) && is_string($payload['displayName'])) {
            return $payload['displayName'];
        }
        if (!empty($payload['job']) && is_string($payload['job'])) {
            return explode('@', $payload['job'])[0];
        }
        return 'unknown';
    }

    private static function resolveJobArgs(array $payload)
    {
        // Normal ShouldQueue jobs/commands: payload.data.command is a serialize()'d PHP object.
        if (isset($payload['data']['command']) && is_string($payload['data']['command'])) {
            return self::extractCommandArgs($payload['data']['command']);
        }

        // Rare string-dispatch path (Queue::push('Class@method', $data)): payload.data IS the args array.
        if (isset($payload['data']) && is_array($payload['data'])) {
            return self::truncateValue($payload['data']);
        }

        return null;
    }

    private static function extractCommandArgs(string $serialized)
    {
        if (!str_starts_with($serialized, 'O:')) {
            // Most likely ShouldBeEncrypted or an unrecognized format — can't generically decode.
            return '(command payload is encrypted or in an unrecognized format; cannot decode)';
        }

        try {
            // allowed_classes: false — returns __PHP_Incomplete_Class stand-ins with all property
            // values intact, but never autoloads the real class or invokes __wakeup()/__unserialize().
            // Defense in depth against object-injection via stored payload strings.
            $object = @unserialize($serialized, ['allowed_classes' => false]);
        } catch (\Throwable $e) {
            return '(failed to unserialize command payload: ' . $e->getMessage() . ')';
        }

        if (!is_object($object)) {
            return '(failed to unserialize command payload)';
        }

        $props = [];
        foreach ((array) $object as $key => $value) {
            if ($key === '__PHP_Incomplete_Class_Name') {
                $props['__declared_class__'] = $value;
                continue;
            }
            // Strip PHP's null-byte visibility prefix on protected/private props from an array cast.
            $cleanKey = preg_replace('/^\x00.*?\x00/', '', $key);
            $props[$cleanKey] = self::truncateValue($value);
        }

        return $props;
    }

    private static function parseException(string $exceptionText): array
    {
        // `exception` column is Throwable::__toString() format (written by
        // Illuminate\Queue\Failed\DatabaseUuidFailedJobProvider::log()):
        //   "{Class}: {message} in {file}:{line}\nStack trace:\n#0 ...\n#N {main}"
        $lines = explode("\n", $exceptionText);
        $header = $lines[0] ?? '';

        $class = null; $message = null; $file = null; $line = null;

        if (($colonPos = strpos($header, ': ')) !== false) {
            $class = substr($header, 0, $colonPos);
            $rest = substr($header, $colonPos + 2);

            if (($inPos = strrpos($rest, ' in ')) !== false) {
                $message = substr($rest, 0, $inPos);
                $fileLine = substr($rest, $inPos + 4);

                if (($lastColon = strrpos($fileLine, ':')) !== false) {
                    $file = substr($fileLine, 0, $lastColon);
                    $line = (int) substr($fileLine, $lastColon + 1);
                }
            } else {
                $message = $rest;
            }
        } else {
            $message = $header;
        }

        $traceStart = null;
        foreach ($lines as $i => $l) {
            if (trim($l) === 'Stack trace:') { $traceStart = $i + 1; break; }
        }

        $traceLines = [];
        if ($traceStart !== null) {
            $traceLines = array_values(array_filter(
                array_slice($lines, $traceStart),
                fn ($l) => trim($l) !== ''
            ));
        }

        $frameCount = count($traceLines);
        $excerpt = array_slice($traceLines, 0, self::TRACE_FRAME_LIMIT);

        if ($frameCount > self::TRACE_FRAME_LIMIT) {
            $excerpt[] = sprintf('... (%d more frames omitted)', $frameCount - self::TRACE_FRAME_LIMIT);
        }

        return [
            'class' => $class, 'message' => $message, 'file' => $file, 'line' => $line,
            'trace_excerpt' => $excerpt, 'trace_frame_count' => $frameCount,
        ];
    }

    private static function truncateValue($value, int $depth = 0)
    {
        if ($depth > self::MAX_DEPTH) {
            return '(truncated: max depth reached)';
        }

        if (is_string($value)) {
            return strlen($value) > self::MAX_STRING_LENGTH
                ? substr($value, 0, self::MAX_STRING_LENGTH) . sprintf('... (truncated, %d bytes total)', strlen($value))
                : $value;
        }

        if (is_array($value)) {
            $out = []; $i = 0;
            foreach ($value as $k => $v) {
                if ($i++ >= self::MAX_ARRAY_ITEMS) { $out['__truncated__'] = 'more items omitted'; break; }
                $out[$k] = self::truncateValue($v, $depth + 1);
            }
            return $out;
        }

        if (is_object($value)) {
            // Never access properties via -> here: unserialize(..., ['allowed_classes' => false])
            // turns every nested object (e.g. Illuminate\Contracts\Database\ModelIdentifier, used
            // whenever a job property holds an Eloquent model) into a __PHP_Incomplete_Class stand-in,
            // and PHP raises "tried to access a property on an incomplete object" on any -> access,
            // which this app escalates to a fatal ErrorException. An (array) cast reads the same data
            // without touching the object's magic accessors.
            $className = get_class($value);
            $props = (array) $value;
            $repr = ['__class__' => $className];

            foreach ($props as $key => $v) {
                $cleanKey = preg_replace('/^\x00.*?\x00/', '', (string) $key);

                if ($cleanKey === '__PHP_Incomplete_Class_Name') {
                    $repr['__class__'] = $v;
                    continue;
                }

                if (in_array($cleanKey, ['id', 'uuid'], true) && (is_scalar($v) || is_null($v))) {
                    $repr[$cleanKey] = $v;
                }
            }

            return $repr;
        }

        return $value;
    }
}
