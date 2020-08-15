<?php

namespace App\Http\Controllers;

use Redirect;
use App\Language;

class LanguageController extends Controller
{
    public function switchLanguage($locale)
    {
        setcookie('language', $locale, time() + (86400 * 365), "/");

        /*$language = Language::firstOrNew(['id' => 1]);
        $language->code = $locale;
        $language->save();*/
        return Redirect::back();
    }
}
