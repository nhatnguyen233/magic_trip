<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function index($language)
    {
        if ($language) {
            \Session::put('language', $language);
        }
        return redirect()->back();
    }
}
