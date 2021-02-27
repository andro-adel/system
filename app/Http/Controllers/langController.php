<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class langController extends Controller
{
    public function switch_language()
    {
        $lang = request('lang');
        if (!in_array($lang, ['ar', 'en'])) {
            return response()->json("pelase enter a valid languages", 400);
        } else {
            App::setLocale($lang);
            Session::put('lang', $lang);
            return redirect()->back();
        }
    }
}
