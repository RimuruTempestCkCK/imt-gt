<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale');

        if (! in_array($locale, ['id', 'en'], true)) {
            $locale = config('app.locale');

            if (Schema::hasTable('settings')) {
                $settingLocale = Setting::query()->where('key', 'app_locale')->value('value');

                if (in_array($settingLocale, ['id', 'en'], true)) {
                    $locale = $settingLocale;
                }
            }
        }

        App::setLocale($locale);

        return $next($request);
    }
}
