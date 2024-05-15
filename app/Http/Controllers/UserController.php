<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MaiNotify;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'max:255'],
            'password' => ['required'],
        ]);


        $user = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ];

        if (!Auth::attempt($user)) {
            return redirect()->route("login");
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
            "password" => $request->password
        ];

        $isSuccess = User::create($user);

        if(empty($isSuccess)){
            echo "Đăng ký thất bại";
        }else{
            echo "Đăng ký thành công";
            Mail::to($user['email'])->send(new MaiNotify($user));
        }

        return back()->with('msg', 'Register successful');
    }
}
