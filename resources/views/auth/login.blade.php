<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>حضور غیاب نمایشگاه</title>

    <!-- begin::global styles -->
    <link rel="stylesheet" href="assets/vendors/bundle.css" type="text/css">
    <!-- end::global styles -->

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="assets/css/app.css" type="text/css">
    <!-- end::custom styles -->

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="\assets\icon\ZPG-logo.png">
    <!-- end::favicon -->

    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5"/>
    <!-- end::theme color -->

</head>
<body class="bg-white h-100-vh p-t-0">

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<div class="container h-100-vh">
    <div class="row align-items-center h-100-vh">
        <div class="col-lg-6 d-none d-lg-block p-t-b-25">
            <img class="img-fluid" src="assets/media/svg/register.svg" alt="...">
        </div>


        <div class="col-lg-4 offset-lg-1 p-t-25 p-b-10">
            <div class="card">
                <div class="card-body" style="background-color: #dcfff0">
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    <img src="\assets\icon\ZPG-logo.png">

                    <h3>ورود</h3>
                    <p>ورود به سامانه حضور غیاب نمایشگاه</p>
                    <form action="/login" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <input name="national_code" type="text" class="form-control form-control-lg" autofocus placeholder="نام کاربری">
                            @if ($errors->has('national_code'))
                                <span class="text-danger">{{ $errors->first('national_code') }}</span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <input name="password" type="password" class="form-control form-control-lg" placeholder="رمز عبور">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block btn-uppercase mb-4">ورود</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<!-- begin::global scripts -->
<script src="assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
<script src="assets/js/app.js"></script>
<!-- end::custom scripts -->


</html>
