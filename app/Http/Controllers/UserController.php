<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function login(){
        return view('user.sigin');
    }
    
    public function sigin(Request $request){

        // $request->validate(
        //     [
        //         'name'=>
        //     ]
        // );
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
    public function profile(string $id){
        $user = User::query()->findOrFail($id);
        return view('user.profile', compact('user'));
    }
    public function update(Request $request, string $id){
        $user= User::query()->findOrFail($id);
        $data = $request->except('avatar');
        if($request->hasFile('avatar')){
            $data['avatar'] = Storage::put('avatar', $request->avatar);
        }
        $user->update($data);
        return back()->with('message', 'Cập nhật thành công');
    }

    public function index(){
        $users = User::paginate(9);
        return view('admin.User.list', compact('users'));
    }
    public  function hidden(string $id){
        $user = User::findOrFail($id);
        $user->active = 0;
        $user->save();

        return redirect()->route('admin.user.index')->with('status', 'User activated successfully!');
    }
    public  function unhidden(string $id){
        $user = User::findOrFail($id);
        $user->active = 1;
        $user->save();

        return redirect()->route('admin.user.index')->with('status', 'User activated successfully!');
    }
    public function change(string $id){
        $user = User::query()->findOrFail($id);
        return view('user.reset',compact('user'));
    }
    public function updatePassword(Request $request){
        if(Hash::check($request->password, Auth::user()->password)){
            $user = auth()->user();
            $user->password = Hash::make($request->newPassword);
            $user->save();
            Auth::logout();
            return redirect()->route('login');

        }
    }
    public function show($id){
        $user = User::query()->findOrFail($id);
        return view('admin.User.Show', compact('user'));
    }
    public function destroy($id){
        $user = User::query()->findOrFail($id);

        $user->delete();
        return redirect()->route('admin.user.index')->with('message', 'Xóa thành công');
    }
   
}
