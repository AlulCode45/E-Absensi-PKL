<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function Login()
    {
        return view('Login');
    }
    function LoginAction(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = AdminModel::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                Auth::login($user);
                return redirect()->to('/dashboard');
            }
        } else {
            return back()->with('error', 'Email is not found');
        }
    }
    function Logout()
    {
        Auth::logout();
        return redirect()->to('/')->with('success', 'You are logged out');
    }
}