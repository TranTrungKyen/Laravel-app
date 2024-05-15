<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MaiNotify;

class AdminController extends Controller
{
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

        if (!Auth::attempt($admin)) {
            return redirect()->route("home-page")->with('msg', 'Login admin successful');
        }
    }

    public function register(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'max:255'],
            'password' => ['required'],
        ]);

        $admin = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ];

        $isSuccess = Admin::create($admin);

        if (empty($isSuccess)) {
            echo "Đăng ký thất bại";
        } else {
            echo "Đăng ký thành công";
            Mail::to($admin['email'])->send(new MaiNotify($admin));
        }

        return back()->with('msg', 'Register admin successful');
    }
}
