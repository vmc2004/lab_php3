@extends('admin.index')


@section('content')
<h2 class="text-center">Danh sách sách</h2>
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Tên </th>
        <th scope="col">Tên đăng nhập</th>
        <th scope="col">Ảnh đại diện</th>
        <th scope="col">Email</th>
        <th scope="col">Vai trò</th>
        <th scope="col">
          <button class="btn btn-success">
            <a href="{{route('admin.user.create')}}" class="text-center text-white">Thêm người dùng</a>
          </button>
        </th>
       
        </th>
      </tr>
    </thead>
    <tbody>
@foreach ($users as $user )
<tr>
    <td>{{$user->id}}</td>
    <td>{{$user->fullname}}</td>
    <td>{{$user->username}}</td>
    <td><img src="{{asset('/Storage/' .$user->avatar)}}" alt="" width="50px"></td>
    <td>{{$user->email}}</td>
    <td>{{$user->role}}</td>
    <td class="d-flex">
       @if ($user->role == 'admin')
         
       @else
      @if ($user->active == 1)
      <form action="{{route('admin.user.hidden',$user->id)}}" method="post">
        @csrf
        @method('PUT')
        <button class="btn btn-warning me-2" onclick="return confirm('Bạn có chắc chắn dừng kích hoạt tài khoản này không ?')">
          Ngừng kích hoạt
        </button>
      </form>
      @else
      <form action="{{route('admin.user.unhidden', $user->id)}}" method="post">
        @csrf
        @method('PUT')
        <button class="btn btn-success me-2" onclick="return confirm('Bạn có chắc chắn kích hoạt tài khoản này không ?')">
         Kích hoạt
        </button>
      </form>
      @endif
        
  
       @endif
       <button class="btn btn-danger "><a href="{{route('admin.user.show', $user->id)}}" class="text-decoration-none text-white">Xem</a></button>
    </td>
</tr>
@endforeach
    </tbody>
  </table>
  <div class="text-center ">
    {{$users->links()}}
  </div>
@endsection