<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login</title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('asset/css/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('asset/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <!-- <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> -->
    <!-- Animate.css -->
    <!-- <link href="../vendors/animate.css/animate.min.css" rel="stylesheet"> -->

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('asset/css/build/css/custom.css?v=20231211') }}" rel="stylesheet">
    <link href="{{ URL::asset('asset/css/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('asset/js/sweetalert2/sweetalert2.all.min.js') }}"></script>

</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">

                    <form action="{{ route('backend-login')}}" method="POST">
                        @csrf
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" name="username"
                            value="{{old('username')}}"/>
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" name="password" />
                        </div>
                        <div>
                            <input type="checkbox" id="remember" name="remember" value="1" /> <label
                                for="remember">Remember me</label>
                            <button type="submit" class="btn btn-default submit">Log in</button>
                            <input type="hidden" name="form-sub" value="1">
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                        </div>
                        <div>
                            <p>@2023 all Rights Reserved. </p>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

@if($errors->has('login-error'))
<script>
Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "{{$errors->first('login-error')}}",
});
</script>
@endif

@if($errors->has('username'))
<script>
Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "{{$errors->first('username')}}",
});
</script>
@endif

@if($errors->has('password'))
<script>
Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "{{$errors->first('password')}}",
});
</script>
@endif

@if($errors->has('role'))
<script>
Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "{{$errors->first('role')}}",
});
</script>
@endif
</html>
