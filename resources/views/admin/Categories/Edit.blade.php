@extends('admin.index')

@section('content')
<h2 class="text-center">Cập nhật sách</h2>
@if(session('message'))
    <div class="alert alert-success text-white">
        {{ session('message') }}
    </div>
@endif
<div class="container">
    <form action="{{route('admin.category.update', $category->id)}}" method="post" >
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$category->id}}">
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
          <input type="text" name="name" class="form-control border" id="exampleFormControlInput1" placeholder="Tiêu đề sách" value="{{$category->name}}">
        </div>
      
          <button type="submit" class="btn btn-danger">Cập nhật</button>
          @csrf
    </form>
</div>
@endsection