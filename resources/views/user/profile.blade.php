@extends('index')

@section('content')
        
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Trang cá nhân</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="/">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Trang cá nhân</p>
                
                @isset($cate)
                <p class="m-0 px-2">-</p>
                <p class="m-0"> {{$cate->name}} </p>
                @endisset
                
            </div>
        </div>
    </div>
</div>
</div>
</div>
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
@auth
    <!-- Page Header End -->
<main class="main" style="min-height:100vh;">
    <div class="">
        <div class="profile">
            <div class="profile-main">
                <div class="options">
                    <h2 class="option-heading">Cài Đặt</h2>
                    <ul class="option-sidebar">
                        <li class="active">
                            <i class="fa-solid fa-user"></i>
                            <a href="">Cài đặt tài khoản</a>
                        </li>
                      
                        <li>
                            <i class="fa-solid fa-shield-halved"></i>
                            <a href="{{ route('change.password', Auth::user()->id) }}">Đổi mật khẩu</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-bell"></i>
                            <a href="">Cài đặt thông báo</a>
                        </li>
                    </ul>
                </div>
                <div class="profile-info">
                    <h2 class="profile-heading">Thông tin cá nhân</h2>

<form action="{{route('update.profile', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="info-list">
        <div class="info-item">
            <h2 class="info-heading">Họ và tên</h2>
            <input type="text" name="fullname" value="{{Auth::user()->fullname}}" />
        </div>

        <div class="info-item">
            <h2 class="info-heading">Avatar</h2>
            <input name="avatar" type="file" name="avatar" />
            <img src="{{asset('/Storage/' .$user->avatar)}}" alt="avatar user" />
        </div>

        <div class="info-item">
            <h2 class="info-heading">Email</h2>
            <input name="email" type="email" value="{{Auth::user()->email}}" />
        </div>
        <button type="submit" name="btn-save" class="btn btn-profile btn-success">Lưu thông tin</button>
    </div>
</form>
@endauth
                </div>
            </div>
        </div>
    </div>
</main>
@endsection