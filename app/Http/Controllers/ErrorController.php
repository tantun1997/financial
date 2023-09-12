<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function page400()
    {
        return view('error.400');
    }
    public function page401()
    {
        return view('error.401');
    }
    public function page403()
    {
        return view('error.403');
    }
    public function page404()
    {
        return view('error.404');
    }
    public function page405()
    {
        return view('error.405');
    }
    public function page500()
    {
        return view('error.500');
    }

}
