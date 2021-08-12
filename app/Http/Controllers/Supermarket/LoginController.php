<?php

namespace App\Http\Controllers\Supermarket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        $data['page_title'] = 'Supermarket Personnel Only';
        return view('merchant.auth.login', $data);
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials['is_active'] = '1';

        if (Auth::attempt($credentials) && Auth::user()->roles()->first()->slug = 'merchant') {
            $request->session()->regenerate();

            return redirect()->intended('supermarket/dashboard');
        }

        $this->revoke($request);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->revoke($request);

        return redirect('/');
    }

    protected function revoke($request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
