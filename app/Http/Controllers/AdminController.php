<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MaiNotify;

class AdminController extends Controller
{
    public function showLoginForm() {
        return view('pages.admins.login');
    }

    public function showRegisterForm() {
        return view('pages.admins.register');
    }

    public function login(Request $request)
    {
        $validation = $request->validate([
            'email' => ['required', 'max:255'],
            'password' => ['required'],
        ]);


        $admin = [
            "email" => $request->email,
            "password" => $request->password
        ];
        if (!Auth::guard('admins')->attempt($admin)) {
            return redirect()->route("home-page")->with('msg', 'Login admin fail');
        }else{
            return redirect()->route('list-user')->with('msg', 'Login admin successful');
        }
    }

    public function register(Request $request)
    {
        $validation = $request->validate([
            'role' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'max:255'],
            'password' => ['required'],
        ]);

        $admin = [
            "role" => $request->role,
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ];

        $isSuccess = Admin::create($admin);

        if (empty($isSuccess)) {
            echo "Register fail";
        } else {
            echo "Register success";
            Mail::to($admin['email'])->send(new MaiNotify($admin));
        }

        return redirect()->route('login-admin-form')->with('msg', 'Register admin successful');
    }

    public function displayListUser(){
        return view('pages.admins.listUser');
    }

    public function logout(Request $request){
        Auth::guard('admins')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
