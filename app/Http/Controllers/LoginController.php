<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(Request $req)
    {
        $creds = 
        [
            'email' => 'admintest@gmail.com',
            'password' => $req->password
        ];

        if(Auth::attempt($creds))
        {
            return redirect('/companies');
        }else{
            
            return redirect()->back()->withErrors([
                "error" => "invalid input "
            ]);

        }
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->regenerateToken();
        $req->session()->invalidate();
        return redirect('/login');
    }
}
