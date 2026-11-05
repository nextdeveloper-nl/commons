<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Http\Request;

/**
 * The address of the customer behind our own reverse proxy / load balancer / Cloudflare.
 *
 * $request->ip() returns the address that connected to PHP. Behind a proxy that is the proxy's internal address, and
 * Laravel only reads X-Forwarded-For when the proxy is listed as trusted (the application's TrustProxies middleware has
 * no trusted proxies), so every command in the history showed the server's own IP.
 *
 * Headers are only believed when the connection really comes from inside our infrastructure (a private, loopback or
 * otherwise reserved address). A request that reaches PHP directly from the internet keeps its real peer address, so a
 * client cannot forge its address by sending the headers itself.
 *
 * Order: CF-Connecting-IP / True-Client-IP / X-Real-IP (set by the edge, not appended), then X-Forwarded-For read from
 * the right and skipping our own private hops, which is the address the first of our proxies saw.
 */
class ClientIpHelper
{
    private const EDGE_HEADERS = ['CF-Connecting-IP', 'True-Client-IP', 'X-Real-IP'];

    public static function resolve(Request $request): ?string
    {
        $peer = $request->server->get('REMOTE_ADDR');

        // Direct connection from a public address: nothing in front of us, the headers are the client's own claims.
        if (! $peer || self::isPublic($peer)) {
            return $peer ?: $request->ip();
        }

        foreach (self::EDGE_HEADERS as $header) {
            $value = trim((string) $request->headers->get($header));

            if ($value !== '' && filter_var($value, FILTER_VALIDATE_IP)) {
                return $value;
            }
        }

        $forwarded = array_reverse(array_map('trim', explode(',', (string) $request->headers->get('X-Forwarded-For'))));

        foreach ($forwarded as $address) {
            if ($address !== '' && filter_var($address, FILTER_VALIDATE_IP) && self::isPublic($address)) {
                return $address;
            }
        }

        // Only private hops were found (internal call, health check, local development)
        return $peer;
    }

    /** True for an address that is not private, loopback, link local or otherwise reserved. */
    private static function isPublic(string $address): bool
    {
        return (bool) filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    }
}
