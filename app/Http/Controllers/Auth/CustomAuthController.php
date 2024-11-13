<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    // register
    public function createRegister(){
        return view('auth.register');
    }
    public function register(RegisterRequest $request){
        // dd($request);die();
        // kiểm tra thành công add vào database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->input('new-password')), // Mã hóa mật khẩu trước khi lưu
            'is_admin' => 1,//phân quyền 0:admin, 1: người dùng
        ]);


        return redirect('/login')->with('success', 'Đăng Kí Thành Công.');
    }

    // login
    public function createLogin(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $request->authenticate();

        // Tạo lại session ID để bảo vệ người dùng khỏi session giả mạo
        $request->session()->regenerate();

        // Kiểm tra xem người dùng có phải là admin không
        if (!Auth::user()->is_admin) {
            // Nếu là admin, chuyển hướng đến trang admin
            return redirect()->route('admin.dashboard')->with('success', 'Đăng Nhập Thành Công.'); 
        }

        // Nếu không phải admin, chuyển hướng về trang chủ
        return redirect()->route('home');
    }
}
