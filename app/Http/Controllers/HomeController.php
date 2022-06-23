<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $fileContents = file_get_contents(base_path('readme.md')) ?: '';

        return view('pages.home.home', ['markdown' => Str::of($fileContents)->markdown()]);
    }

    public function cookies(): View
    {
        return view('pages.cookies.cookies');
    }
}
