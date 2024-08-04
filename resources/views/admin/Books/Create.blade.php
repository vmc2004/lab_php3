@extends('admin.index')

@section('content')
<h2>Thêm mới sách</h2>
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
            <label for="exampleFormControlInput1" class="form-label">Tiêu đề sách</label>
            <input type="text" name="title" class="form-control border" id="exampleFormControlInput1" placeholder="Tiêu đề sách">
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Bìa sách</label>
            <input type="file" name="thumbnail" class="form-control border" id="exampleFormControlInput1" placeholder="Ảnh bìa sách">
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tác giả</label>
            <input type="text" name="author"  class="form-control border" id="exampleFormControlInput1" placeholder="Tác giả">
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nhà xuất bản</label>
            <input type="text" name="publisher" class="form-control border" id="exampleFormControlInput1" placeholder="Nhà xuất bản">
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Ngày xuất bản</label>
            <input type="date" name="Publication" class="form-control border" id="exampleFormControlInput1" placeholder="Ngày xuất bản">
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Giá bán</label>
            <input type="number" name="Price" step="0.1" class="form-control border" id="exampleFormControlInput1" placeholder="Giá bán">
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Số lượng</label>
            <input type="number" name="Quantity" class="form-control border" id="exampleFormControlInput1" placeholder="Số lượng">
          </div>
        
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Danh mục</label>
            <Select name="category_id" class="form-control border">
                @foreach ($categories as  $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </Select>
          </div>
          <button type="submit" class="btn btn-danger">Thêm vào danh sách</button>
          @csrf
    </form>
</div>
@endsection