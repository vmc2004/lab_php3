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
    <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Họ Và Tên</label>
            <input type="text" name="fullname" class="form-control border" id="exampleFormControlInput1" >
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="text" name="email"  class="form-control border" id="exampleFormControlInput1" disabled>
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tên đăng nhập</label>
            <input type="text" name="username" class="form-control border" id="exampleFormControlInput1">
          </div>
        
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Ảnh đại diện</label>
            <input type="file" name="avatar" class="form-control border" id="exampleFormControlInput1">
            
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Vai trò</label>
            <select name="role" id="">
              <option value="">---</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>

          
          <button type="submit" class="btn btn-danger">Thêm vào danh sách</button>
          @csrf
    </form>
</div>
@endsection