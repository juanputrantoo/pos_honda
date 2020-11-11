<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $username = 'username';

    public function formLogin(){
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('auth/login');
    }

    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];

        Auth::attempt($data);

        if(Auth::check()){
            User::where('id', Auth::user()->id)->update([
                'last_login' => date('Y-m-d H:i:s')
            ]);
            return redirect()->route('home');
        }else{
            return redirect()->route('login')->with('error', 'Email atau Password Salah...');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    
}
