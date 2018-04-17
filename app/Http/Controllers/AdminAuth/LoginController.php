<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use User;
use Admin;
use Auth;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';

    /* Suwr dung bang*/
     protected function guard()
    {
        return Auth::guard('admin');
    }

    // protected $username = 'username';
    /*TRANG CHUYEN DEN*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
      /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    // public function login()
    // {

    //     if (Auth::attempt(['email' => $email, 'password' => $password])) {
    //         // Authentication passed...
    //         return redirect()->intended('dashboard');
    //     }
    // }

      public function showLoginForm(){
        return view('admin.login');
      }
}


