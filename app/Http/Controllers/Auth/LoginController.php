<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;


    // protected $redirectTo = RouteServiceProvider::HOME;

    use AuthTrait;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function loginForm($type){

        return view('auth.login',compact('type')); //  استفدنا منها ايضا في صفحة الدخول بحيث يكتب تسجيل دخول طالب او معلم مثلا
    }


    public function login(Request $request){

        // chekGuard($request))
        // redirect($request);
        // تم انشائها في تريت

        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
           return $this->redirect($request);


           // return dd ($request);
        }

    }

    public function logout(Request $request,$type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }



}
