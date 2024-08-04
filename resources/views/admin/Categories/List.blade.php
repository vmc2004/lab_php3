@extends('admin.index')


@section('content')
<h2 class="text-center">Danh sách sách</h2>
@if(session('message'))
    <div class="alert alert-success text-white">
        {{ session('message') }}
    </div>
@endif
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">Tên danh mục </th>
        <th scope="col"><a href="{{route('admin.category.create')}}" class="text-white btn btn-success  ">Thêm danh mục</a>
        </th>
      </tr>
    </thead>
    <tbody>
     @foreach ($categories as $key=>$category )
     <tr>
        <td>{{$key +1}}</td>
        <td>{{$category->name}}</td>
        <td class="d-flex">
<a href="{{route('admin.category.edit', $category->id)}}" class="text-white btn btn-warning  me-1">Sửa</a>
<form action=" {{route('admin.category.destroy', $category->id)}}" method="post">
@csrf
@method('DELETE')
<button type="submit" class=" btn btn-danger" onclick="confirm('Bạn có muốn xóa không ?')">Xóa</button>
</form>            
        </td>
      </tr>
     @endforeach
    
    </tbody>
  </table>
  <div class="text-center ">
    {{$categories->links()}}
  </div>
@endsection