<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MaiNotify;

class UserController extends Controller
{
    public function showLoginForm() {
        return view('pages.users.login');
    }

    public function showRegisterForm() {
        return view('pages.users.register');
    }

    public function login(Request $request)
    {
        $validation = $request->validate([
            'email' => ['required', 'max:255'],
            'password' => ['required'],
        ]);


        $user = [
            "email" => $request->email,
            "password" => $request->password, 
        ];

        if (!Auth::attempt($user)) {
            return redirect()->route("home-page")->with('msg', 'Login user fail');
        }else{
            return redirect()->route("home-page")->with('msg', 'Login user successful');
        }
        
    }

    public function register(Request $request)
    {

        $validation = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'max:255'],
            'password' => ['required'],
        ]);

        $user = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ];

        $isSuccess = User::create($user);

        if(empty($isSuccess)){
            echo "Register fail";
        }else{
            echo "Register success";
            Mail::to($user['email'])->send(new MaiNotify($user));
        }

        return redirect()->route('login-form')->with('msg', 'Register user successful');
    }

    public function logout(Request $request){
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
