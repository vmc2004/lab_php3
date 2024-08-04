<!DOCTYPE html>
<html lang="en">

<head>
    <title>Elite Able - Change password</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="{{ asset('log/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
      <script src="{{ asset('log/libs/respond.js/1.4.2/respond.min.js') }}"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Elite Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templates, sass admin templates, html admin templates, responsive, bootstrap admin templates free download, premium bootstrap admin templates, Elite Able, Elite Able bootstrap admin template">
    <meta name="author" content="Codedthemes" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('log/images/favicon.png') }}" type="image/x-icon">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('log/plugins/animation/css/animate.min.css') }}">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('log/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('log/css/style.css') }}">

</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content container">
            <div class="card">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="card-body">
                            <img src="{{ asset('log/images/logo-dark.png') }}" alt="" class="img-fluid mb-4">
                            <h4 class="mb-4 f-w-400">Change your password</h4>
                          <form action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group mb-2">
                                <input type="password" name="password" class="form-control" placeholder="Current Password">
                            </div>
                            <div class="input-group mb-2">
                                <input type="password" name="newPassword" class="form-control" placeholder="New Password">
                            </div>
                            <div class="input-group mb-4">
                                <input type="password" name="confirmPassword" class="form-control" placeholder="Re-Type New Password">
                            </div>
                            <button class="btn btn-primary mb-4">Change password</button>
                        </div>
                    </div>
                          </form>
                    <div class="col-md-6 d-none d-md-block">
                        <img src="{{ asset('log/images/auth-bg.jpg') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="footer mt-5">
                <p class="text-center">Made with <i class="fas fa-heart"></i> by <a href="https://codedthemes.com/" target="_blank">Codedthemes</a></p>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="{{ asset('log/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('log/js/popper.min.js') }}"></script>
    <script src="{{ asset('log/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>
