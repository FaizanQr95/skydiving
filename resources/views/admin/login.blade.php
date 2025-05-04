{{--@extends('layouts.admin')--}}

{{--@section('content')--}}
{{--    <div class="login-container">--}}
{{--        <div class="login-left">--}}
{{--            <h2 style="text-align: center">Welcome Back</h2>--}}
{{--            <form method="POST" action="{{ route('admin.login.submit') }}">--}}
{{--                @csrf--}}
{{--                <input type="email" name="email" placeholder="Email Address" required>--}}
{{--                <input type="password" name="password" placeholder="Password" required>--}}
{{--                <div class="forgot">--}}
{{--                    <a href="#">Forgot Password?</a>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn-login">Login</button>--}}
{{--            </form>--}}
{{--            <div class="divider">or</div>--}}
{{--            <button class="btn-google">Login with Google</button>--}}
{{--            <button class="btn-facebook">Login with Facebook</button>--}}
{{--        </div>--}}
{{--        <div class="login-right">--}}
{{--            <h1>Skydiving</h1>--}}
{{--            <h3>Gear Rental and Sales</h3>--}}
{{--            <p class="phone">720-352-2151</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Admin Login</title>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">--}}

{{--    <style>--}}
{{--        body {--}}
{{--            margin: 0;--}}
{{--            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;--}}
{{--        }--}}
{{--        .container {--}}
{{--            display: flex;--}}
{{--            height: 100vh;--}}
{{--        }--}}
{{--        .left-side {--}}
{{--            width: 50%;--}}
{{--            background-color: #111111;--}}
{{--            color: white;--}}
{{--            display: flex;--}}
{{--            justify-content: center;--}}
{{--            align-items: center;--}}
{{--        }--}}
{{--        .login-box {--}}
{{--            width: 80%;--}}
{{--            max-width: 350px;--}}
{{--        }--}}
{{--        .login-box h2 {--}}
{{--            text-align: center;--}}
{{--            margin-bottom: 30px;--}}
{{--        }--}}
{{--        .login-box input {--}}
{{--            width: 100%;--}}
{{--            padding: 12px;--}}
{{--            margin-bottom: 15px;--}}
{{--            border-radius: 6px;--}}
{{--            border: none;--}}
{{--        }--}}
{{--        .login-box .btn-login {--}}
{{--            width: 100%;--}}
{{--            background-color: #00e341;--}}
{{--            color: black;--}}
{{--            border: none;--}}
{{--            padding: 12px;--}}
{{--            border-radius: 6px;--}}
{{--            font-weight: bold;--}}
{{--            cursor: pointer;--}}
{{--            margin-bottom: 20px;--}}
{{--        }--}}
{{--        .login-box .forgot {--}}
{{--            color: #aaa;--}}
{{--            font-size: 12px;--}}
{{--            float: right;--}}
{{--            margin-top: -10px;--}}
{{--            margin-bottom: 20px;--}}
{{--        }--}}
{{--        .or {--}}
{{--            text-align: center;--}}
{{--            color: #ccc;--}}
{{--            margin: 20px 0;--}}
{{--        }--}}
{{--        .btn-social {--}}
{{--            width: 100%;--}}
{{--            margin-bottom: 10px;--}}
{{--            padding: 12px;--}}
{{--            border-radius: 6px;--}}
{{--            border: none;--}}
{{--            color: white;--}}
{{--            font-weight: bold;--}}
{{--            cursor: pointer;--}}
{{--        }--}}
{{--        .google-btn {--}}
{{--            background-color: #fff;--}}
{{--            color: #333;--}}
{{--            border: 1px solid #ccc;--}}
{{--        }--}}
{{--        .facebook-btn {--}}
{{--            background-color: #3b5998;--}}
{{--        }--}}
{{--        .right-side {--}}
{{--            width: 50%;--}}
{{--            background: linear-gradient(to bottom right, #006600, #00cc00);--}}
{{--            color: white;--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            justify-content: center;--}}
{{--            align-items: center;--}}
{{--            font-family: 'Georgia', serif;--}}
{{--        }--}}
{{--        .right-side h1 {--}}
{{--            font-size: 120px;--}}
{{--            font-weight: bold;--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}
{{--        .right-side h2 {--}}
{{--            font-size: 60px;--}}
{{--            font-weight: 500;--}}
{{--            margin: 0;--}}
{{--        }--}}
{{--        .right-side h3 {--}}
{{--            font-size: 80px;--}}
{{--            color: #ffeb3b;--}}
{{--            margin-top: 20px;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="container">--}}
{{--    <div class="left-side">--}}
{{--        <div class="login-box">--}}
{{--            <h2>Welcome Back</h2>--}}
{{--            <form method="POST" action="{{ route('admin.login.submit') }}">--}}
{{--                @csrf--}}
{{--                <input type="email" name="email" placeholder="Email Address" required>--}}
{{--                <input type="password" name="password" placeholder="Password" required>--}}
{{--                <div class="forgot"><a href="#" style="color: #aaa;">Forgot Password?</a></div>--}}
{{--                <button class="btn-login" type="submit">Login</button>--}}
{{--                <div class="or">or</div>--}}
{{--                <button style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; max-width: 300px; padding: 12px 20px; background-color: #f5f5f5; color: #000; border: none; border-radius: 12px; font-size: 16px; font-family: sans-serif; cursor: pointer;">--}}
{{--                    <i class="fab fa-google" style="font-size: 18px; color: #DB4437;"></i>--}}
{{--                    Login with Google--}}
{{--                </button>--}}

{{--                <br><br>--}}

{{--                <!-- Facebook Button -->--}}
{{--                <button style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; max-width: 300px; padding: 12px 20px; background-color: #4267B2; color: white; border: none; border-radius: 12px; font-size: 16px; font-family: sans-serif; cursor: pointer;">--}}
{{--                    <i class="fab fa-facebook-f" style="font-size: 18px;"></i>--}}
{{--                    Login with Facebook--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="right-side">--}}
{{--        <h1>Skydiving</h1>--}}
{{--        <h2>Gear Rental and Sales</h2>--}}
{{--        <h3>720-352-2151</h3>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            height: 100vh;
        }

        .left-side,
        .right-side {
            width: 50%;
            height: 100vh;
            box-sizing: border-box;
        }

        .left-side {
            background-color: #111111;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-box {
            width: 100%;
            max-width: 350px;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: none;
            box-sizing: border-box;
        }

        .login-box .btn-login,
        .social-button {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            box-sizing: border-box;
        }

        .btn-login {
            background-color: #00e341;
            color: black;
            margin-bottom: 20px;
        }

        .forgot {
            color: #aaa;
            font-size: 12px;
            float: right;
            margin-top: -10px;
            margin-bottom: 20px;
        }

        .or {
            text-align: center;
            color: #ccc;
            margin: 20px 0;
        }

        .google-btn {
            background-color: #f5f5f5;
            color: #000;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .facebook-btn {
            background-color: #4267B2;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .right-side {
            background: linear-gradient(to bottom right, #006600, #00cc00);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Georgia', serif;
            text-align: center;
            padding: 20px;
        }

        .right-side h1 {
            font-size: 80px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .right-side h2 {
            font-size: 36px;
            font-weight: 500;
            margin: 0;
        }

        .right-side h3 {
            font-size: 40px;
            color: #ffeb3b;
            margin-top: 20px;
        }
        .error {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .left-side,
            .right-side {
                width: 100%;
                height: auto;
                padding: 40px 20px;
            }

            .right-side h1 {
                font-size: 48px;
            }

            .right-side h2 {
                font-size: 24px;
            }

            .right-side h3 {
                font-size: 28px;
            }
        }
    </style>
    <style>
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
<div id="loader" style="position: fixed; width: 100%; height: 100%; background: #00C851; z-index: 9999; display: flex; align-items: center; justify-content: center;">
    <div style="
        position: relative;
        width: 60px;
        height: 60px;
        border: 6px solid #f3f3f3;
        border-top: 6px solid #000;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
        color: #000;
    ">
        SkyDiving
    </div>
</div>
<div class="container">
    <div class="left-side">
        <div class="login-box">
            <h2>Welcome Back</h2>
            <form method="POST" action="{{ route('admin.login.submit') }}" id="loginValidate">
                @csrf
                <input type="email" name="email" placeholder="Email Address" required>
                <div class="password-container" style="position: relative;">
                    <input type="password" name="password" id="password" placeholder="Password" required style="padding-right: 30px;">
                    <i id="toggle-password" class="fa fa-eye" style="position: absolute; right: 10px; top: 35%; transform: translateY(-50%); cursor: pointer; color: green;"></i>
                </div>
                @if($errors->has('email'))
                    <div style="color: red; margin-bottom: 10px;">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <br>
                <div class="forgot"><a href="#" style="color: #aaa;">Forgot Password?</a></div>
                <button class="btn-login" type="submit">Login</button>
            </form>
        </div>
    </div>
    <div class="right-side">
        <h1>Skydiving</h1>
        <h2>Gear Rental and Sales</h2>
        <h3>720-352-2151</h3>
    </div>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    document.getElementById('toggle-password').addEventListener('click', function () {
        var passwordField = document.getElementById('password');
        var passwordFieldType = passwordField.type;
        var icon = this;

        // Toggle between 'password' and 'text'
        if (passwordFieldType === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
<script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('loader');
        loader.style.display = 'none';
    });
</script>
<!-- Add this before </body>, after jQuery is loaded -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        $('#loginValidate').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Password must be at least 8 characters long"
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.css('color', 'red');
                error.insertAfter(element);
            }
        });
    });
</script>

