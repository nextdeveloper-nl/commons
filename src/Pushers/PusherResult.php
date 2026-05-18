<?php

namespace NextDeveloper\Commons\Pushers;

class PusherResult
{
    public function __construct(
        public bool $success,
        public ?int $responseCode = null,
        public ?string $responseBody = null,
    ) {}

    public static function ok(int $code, string $body): self
    {
        return new self(true, $code, $body);
    }

    public static function fail(?int $code, string $body): self
    {
        return new self(false, $code, $body);
    }
}
