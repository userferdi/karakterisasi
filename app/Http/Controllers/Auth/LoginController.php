<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
    public function login(Request $request)
    {
        //Error messages
        $messages = [
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.exists' => "Email doesn't exists",
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters'
        ];

        // validate the form data
        $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8'
            ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // attempt to log
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password ], $request->remember)) {
                // if successful -> redirect forward
                return redirect()->intended(route('home'));
            }

            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('email', 'password', 'remember'))->withErrors([
                'password' => 'Wrong password',
            ]);
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
