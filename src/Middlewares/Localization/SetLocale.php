<?php

namespace NextDeveloper\Commons\Middlewares\Localization;

use Illuminate\Http\Request;
use NextDeveloper\IAM\Helpers\UserHelper;
use Closure;

class SetLocale
{
    /**
     * This function checks the locale of the user and add it to the application
     *
     * @param $request
     * @param Closure $next
     * @param string $lang
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->getLocale();

        //  If we dont have user logged in, we continue with default locale
        if(UserHelper::me()) {
            return $next($request);
        }

        //  If we dont get the locale from browser we continue with the default locale
        if(!$locale) {
            return $next($request);
        }

        //  We set the locale to browser locale
        app()->setLocale($request->getLocale());

        return $next($request);
    }
}