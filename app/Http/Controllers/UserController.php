<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(){
        return view('user.sigin');
    }
    
    public function sigin(Request $request){
        // Xác thực người dùng
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công, chuyển hướng đến route 'search'
            // dd($request->all());
            return redirect()->route('index');
        }
       
        // Đăng nhập thất bại, chuyển hướng về lại trang đăng nhập với thông báo lỗi
        return redirect()->route('user.sigin')
            ->withErrors(['email' => 'Thông tin đăng nhập không đúng'])
            ->withInput();
    }
    
    public function sigup(){
        return view('user.sigup');
    }
    public function register(Request $request){
       $request->merge(['password' => Hash::make($request->password)]);
       User::create($request->all());
       return redirect()->route('user.sigin')->with('success', 'Tạo tài khoản thành công');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('')->route('index');
    }
   
}
