<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    protected function authenticated(Request $request, $user)
    {
        $type = $user->toArray()['type'];
        $username = $user->toArray()['username'];
        $id = $user->toArray()['id'];
        $request->session()->put('type', $type);
        $request->session()->put('username', $username);
        $request->session()->put('id', $id);
        if ( $type == 'admin' ) {
            return redirect()->route('admin_home');
        }

        return redirect()->route('user_home');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
