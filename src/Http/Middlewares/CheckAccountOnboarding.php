<?php

namespace NextDeveloper\Commons\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use NextDeveloper\Commons\Services\AddressesService;
use NextDeveloper\IAM\Helpers\UserHelper;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountOnboarding
{
    /**
     * Base account info — country, phone and an invoice address — is required by
     * every product module. For any non-GET request we block the service until
     * the current account has completed this onboarding.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->getMethod() !== 'GET') {
            $iamAccount = UserHelper::currentAccount();

            if ($iamAccount && (! $iamAccount->common_country_id || ! $iamAccount->phone_number
                || ! AddressesService::accountHasInvoiceAddress($iamAccount->id))) {
                return response()->json([
                    'errors' => [
                        'status' => 403,
                        'message' => 'Complete your account setup first.',
                        'details' => 'Set your country, phone number and invoice address before using this service.',
                    ],
                ], 403);
            }
        }

        return $next($request);
    }
}
