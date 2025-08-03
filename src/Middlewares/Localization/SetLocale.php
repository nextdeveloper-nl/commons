<?php

namespace NextDeveloper\Commons\Middlewares\Localization;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        $locale = App::getLocale();

        if(session()->has('locale'))
            $locale = session()->get('locale');

        if($request->headers->get('accept-language') != $locale)
            $locale = $request->headers->get('accept-language');

        //  If we dont have user logged in, we continue with default locale
        //  When token based authentication not working this creates an exception. We need to find a way without using
        //  Authentication
//        if(UserHelper::me()) {
//            // @todo: User'ın locale'ı buraya gelecek
//            // $locale = User->locale
//        }

        //  We set the locale to the locale we found
        app()->setLocale($locale);

        return $next($request);
    }
}
