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
$message =[
    'name.required' => 'Vui lòng nhập họ tên.',
    'name.string' => 'Họ tên phải là một chuỗi ký tự.',
    'name.max' => 'Họ tên không được vượt quá 255 ký tự.',
    
    'email.required' => 'Vui lòng nhập email.',
    'email.string' => 'Email phải là một chuỗi ký tự.',
    'email.email' => 'Định dạng email không hợp lệ.',
    'email.max' => 'Email không được vượt quá 255 ký tự.',
    'email.unique' => 'Email này đã được sử dụng.',
    
    'phone.max' => 'Số điện thoại phải đủ 10 số',
    'phone.min' => 'Số điện thoại phải đủ 10 số',


    'password.required' => 'Vui lòng nhập mật khẩu.',
    'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
    'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
    'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
];

        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => [ 'min:10', 'max:10'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],$message);
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
