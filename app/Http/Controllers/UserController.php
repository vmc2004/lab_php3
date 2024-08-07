<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  
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
    public function create(){
        return view('admin.User.Create');
    }
    public function store(Request $request){
        $data = $request->except('avatar');
        $data['avatar'] = "";
        if($request->hasFile('avatar')){
            $data['avatar'] = $request->file('avatar')->store('avatar');
        }
        User::query()->create([
            'username' => $data['username'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $data['avatar'],
        ]);

        return redirect()->route('admin.user.index')->with('message', 'Thêm người dùng mới thành công');
    }
    public function editAdmin($id){
        $user = User::query()->findOrFail($id);
        return view('admin.User.Edit', compact('user'));
    }
    public function updateAdmin(Request $request, string $id){
        $user= User::query()->findOrFail($id);
        $data = $request->except('avatar');
        if($request->hasFile('avatar')){
            $data['avatar'] = Storage::put('avatar', $request->avatar);
        }
        $user->update($data);
        return back()->with('message', 'Cập nhật thành công');
    }

  
}
