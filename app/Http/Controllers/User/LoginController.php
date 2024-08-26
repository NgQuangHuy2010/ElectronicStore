<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    public function Login(){
        return view('auth.login');
    }
    public function Register(Request $request){


        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'max:15'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'password' => Hash::make($validatedData['password']),
            ]);
             // sự kiện gửi xác thực email
             Mail::to($user->email)->send(new EmailVerification($user));
            return redirect()->route('User.Login')->with('status', 'Đăng ký thành công! Vui lòng kiểm tra email của bạn để xác minh tài khoản.');
            
        }

        return view('auth.register');
    }
}
