@extends('admin.index')

@section('content')
<h2>Chi tiết người dùng</h2>
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
    <form >
        @csrf
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
            <img src="{{asset('/Storage/' .$user->avatar)}}" alt="" width="100px">
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="text" name="email"  class="form-control border" id="exampleFormControlInput1" value="{{$user->email}}">
          </div>
        
          
          <button type="submit" class="btn btn-danger">Thêm vào danh sách</button>
          @csrf
    </form>
</div>
@endsection