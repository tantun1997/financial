<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function usermanagement()
    {
        return view('administrator.usermanagement');
    }
    public function deptmanagement()
    {
        return view('administrator.deptmanagement');
    }
}
