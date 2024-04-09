<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request){//}: RedirectResponse{
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            // return redirect()->intended('/users/create');
            return response([
                'redirect' => '/users/create',
            ]);
        }

        return response([
            'errors' => ['email' => 'Credentials do not match records'],
            'redirect' => '/login',
        ], 401);

        // return back()->withErrors([
        //     'email' => 'Credentials do not match records',
        // ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}
