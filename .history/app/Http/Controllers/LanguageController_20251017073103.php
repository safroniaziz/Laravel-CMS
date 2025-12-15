<?php

namespace App\Http\Controllers;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch($code)
    {
        LanguageHelper::setLanguage($code);
        
        return redirect()->back();
    }
}

