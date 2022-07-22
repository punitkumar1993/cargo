<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return View
     */
    public function showLoginForm()
    {
        abort(404);
    }

    public function showLoginFormNew()
    {
        return view('auth.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return RedirectResponse
     */
    public function login()
    {

        $this->validate(request(), [
            'username'             => 'required|string',
            'password'             => 'required|string|min:6',
            // 'g-recaptcha-response' => 'required|captcha'
        ], $messages = [
            // 'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            // 'g-recaptcha-response.captcha'  => 'Captcha error! try again later or contact site admin.'
        ]);

        $fieldType = filter_var(request('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $login = [
            $fieldType => request('username'),
            'password' => request('password')
        ];
        
        if (auth()->attempt($login)) {
            return redirect()->intended('jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/dashboard');
        } else {
            return redirect()->route('login')->withErrors('Username or Email And Password Are Wrong');
        }

        return redirect()->route('login');
    }
}
