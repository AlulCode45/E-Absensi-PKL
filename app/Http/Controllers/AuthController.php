<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\StudentsModel;
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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = AdminModel::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                Auth::login($user);
                return redirect()->to('/dashboard');
            } else {
                return back()->with('error', 'Username / password wrong !');
            }
        } else {
            return back()->with('error', 'Username / password wrong !');
        }
    }
    function Logout()
    {
        Auth::logout();
        return redirect()->to('/')->with('success', 'You are logged out');
    }
    function Register()
    {
        return view('Register');
    }
    function RegisterAction(Request $request)
    {
        $request->validate([
            'nisn' => 'required|numeric|unique:students,nisn',
            'name' => 'required|string',
            'school' => 'required|numeric',
            'devisi' => 'required|numeric'
        ]);

        $data = [
            'name' => $request->name,
            'nisn' => $request->nisn,
            'school_id' => $request->school,
            'devisi_id' => $request->devisi
        ];
        $save = StudentsModel::create($data);
        if ($save) {
            return back()->with('success', 'Sukses Register Data!');
        } else {
            return back()->with('error', 'Gagal Register Data!');
        }
    }
}