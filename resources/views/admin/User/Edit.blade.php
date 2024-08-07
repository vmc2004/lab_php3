@extends('admin.index')

@section('content')
<h2>Chi tiết người dùng</h2>
<div>
  @if(session('message'))
  <div class="alert alert-success">
      {{ session('message') }}
  </div>
@endif
</div>
@if ($errors->any())
  <div class="alert alert-danger mt-3">
    <ul>
      @foreach ($errors->all() as  $error)
        <li>{{$errors}}</li>
      @endforeach
    </ul>
  </div>
@endif
<div class="container">
    <form action="{{route('admin.user.update', $user->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Họ Và Tên</label>
            <input type="text" name="fullname" class="form-control border" id="exampleFormControlInput1" value="{{$user->fullname}}">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tên đăng nhập</label>
            <input type="text" name="username" class="form-control border" id="exampleFormControlInput1" value="{{$user->username}}">
          </div>

        
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Ảnh đại diện</label>
            <input type="file" name="avatar" class="form-control border">
            <img src="{{asset('/Storage/' .$user->avatar)}}" alt="" width="100px">
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="text" name="email"  class="form-control border" id="exampleFormControlInput1" value="{{$user->email}}">
          </div>
        
       
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Vai trò</label>
            <select name="role" id="" @if ($user->id == Auth::user()->id)
              disabled
            @endif>
              <option value="">Lựa chọn</option>
              <option value="admin" @if ($user->role == 'admin')
                selected
                
              @endif>Admin</option>
              <option value="user" @if ($user->role == 'user')
                selected
                
              @endif>User</option>
            </select>
          </div>
        <button class="btn btn-primary" type="submit">Submit</button>
          @csrf
    </form>
    <button class="btn btn-success"><a href="" class="text-white">Danh sách</a></button>
    @auth
      @if ($user->id == Auth::user()->id)
        
      @else
      <form action="{{route('admin.user.destroy' , $user->id)}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa người này không ?')">Xóa người dùng</button>
      </form>
      @endif
    @endauth

</div>
@endsection