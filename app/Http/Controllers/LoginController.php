<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::user() != null) {
            Auth::logout();
        }
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $remember = $request->has('remember') ?: false;
        if (Auth::attempt($request->only('user_code', 'password'), $remember)) {
            $user = Auth::user();
            if ($user->activated_at) {
                if ($request->has('previous')) {
                    if (!in_array($request->previous, [url(''), url('login')])) {
                        return redirect()->intended($request->previous);
                    }
                }
                return redirect()->intended(route('dashboard.index'));
            } else {
                Auth::logout();
                return redirect()->route('login')
                    ->onlyInput('user_code')
                    ->withWarningMessage('You can not login now.<br /> You are not activated. Please contact your system administrator.');
            }
        }
        return redirect()->route('login')
            ->onlyInput('user_code')
            ->withWarningMessage('Invalid username or password.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.show');
    }
}
