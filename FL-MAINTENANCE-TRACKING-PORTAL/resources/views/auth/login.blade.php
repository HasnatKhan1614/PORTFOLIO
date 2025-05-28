<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ env('ASSET_URL') }}/dashboard/images/favicon.ico">

    <title>Etikto Admin - Log in </title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ env('ASSET_URL') }}/dashboard/css/vendors_css.css">

    <!-- Style-->
    <link rel="stylesheet" href="{{ env('ASSET_URL') }}/dashboard/css/style.css">
    <link rel="stylesheet" href="{{ env('ASSET_URL') }}/dashboard/css/skin_color.css">

</head>

<body class="hold-transition theme-primary bg-img"
    style="background-image: url({{ env('ASSET_URL') }}/dashboard/images/auth-bg/bg-1.jpg)">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">

            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded10 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                <h2 class="text-primary">Let's Get Started</h2>
                                <p class="mb-0">Sign in to continue to WebkitX.</p>
                            </div>
                            <div class="p-40">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                            <input type="text" name="username"
                                                class="form-control ps-15 bg-transparent" placeholder="Username"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                            <input type="password" name="password"
                                                class="form-control ps-15 bg-transparent" placeholder="Password"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-danger mt-10">SIGN IN</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                        <div class="text-center">
                            <p class="mt-20 text-white">- Sign With -</p>
                            <p class="gap-items-2 mb-20">
                                <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i
                                        class="fa fa-facebook"></i></a>
                                <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i
                                        class="fa fa-twitter"></i></a>
                                <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i
                                        class="fa fa-instagram"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Vendor JS -->
    <script src="{{ env('ASSET_URL') }}/dashboard/js/vendors.min.js"></script>
    <script src="{{ env('ASSET_URL') }}/dashboard/js/pages/chat-popup.js"></script>
    <script src="{{ env('ASSET_URL') }}/dashboard/assets/icons/feather-icons/feather.min.js"></script>

</body>

</html>
