<?php

namespace NextDeveloper\Commons\Http\Controllers\Media;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use NextDeveloper\Commons\Database\Models\Media;
use NextDeveloper\Commons\Http\Controllers\AbstractController;

/**
 * Serves the file of a media row through a signed, expiring link.
 *
 * A file kept on a filesystem disk has no public address, and a browser cannot send a bearer
 * token with an <img> request. MediaTransformer hands out a link to this endpoint instead
 * (commons.media.signed_url_minutes); the signature is the authorisation, so the route sits
 * under /public and needs no token.
 */
class MediaFileController extends AbstractController
{
    public function show(Request $request, string $uuid)
    {
        //  Relative: the signature covers the path and query only, so a proxy that changes the
        //  scheme or host in front of the application does not invalidate the link.
        if (!$request->hasValidRelativeSignature()) {
            return $this->errorForbidden('This link is not valid or has expired.');
        }

        $media = Media::withoutGlobalScopes()
            ->where('uuid', $uuid)
            ->whereNull('deleted_at')
            ->first();

        $path = $media ? ($media->custom_properties['path'] ?? $media->custom_properties['id'] ?? null) : null;

        if (!$path || !$media->disk || !config('filesystems.disks.' . $media->disk)) {
            return $this->errorNotFound('This file is not available.');
        }

        if (!Storage::disk($media->disk)->exists($path)) {
            return $this->errorNotFound('This file is not available.');
        }

        return Storage::disk($media->disk)->response($path, $media->file_name, [
            'Cache-Control' => 'private, max-age=300',
        ]);
    }
}
