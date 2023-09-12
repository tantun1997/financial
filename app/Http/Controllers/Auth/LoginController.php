<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'RouteServiceProvider::HOME';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');


        // ตรวจสอบข้อมูลผู้ใช้งานในฐานข้อมูล
        $user = User::where('username', $username)->first();

        if ($user && $password === $user->password) {
            auth()->loginUsingId($user->id);

            return redirect()->route('home');
        } else {
            // รหัสผ่านไม่ถูกต้อง
            return redirect()->route('login')->with('error', 'ชื่อผู้ใช้งาน หรือรหัสผ่านผิด');
        }
    }
}
