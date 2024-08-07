@extends('admin.index')

@section('content')
<h2>Thêm mới danh mục</h2>
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="container">
    <form action="{{route('admin.category.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control border" id="exampleFormControlInput1" placeholder="Tiêu đề sách">
            @error('name')
            <span class="text-danger"> {{$message}}</span>
        @enderror
          </div>
        
       
          <button type="submit" class="btn btn-danger">Thêm mới danh mục</button>
          @csrf
    </form>
</div>
@endsection