@extends('layouts.new')



@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .login-container {
                max-width: 400px;
                margin: 50px auto;
            }

            .login-card {
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
            }

            .login-card .card-title {
                margin-bottom: 20px;
            }

            .login-card .form-control {
                border-radius: 5px;
            }

            .login-card .btn {
                border-radius: 5px;
                font-weight: bold;
            }

            .login-card .forgot-password {
                text-align: right;
            }

            .login-card .forgot-password a {
                color: #007bff;
            }

            .login-card .forgot-password a:hover {
                text-decoration: underline;
            }
        </style>
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Laravel App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('demo') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('demo') }}">Demo</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="login-container">
            <div class="card login-card" id="loginCard">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('error'))
                <div class="alert alert-success">
                    {{ Session::get('error') }}
                </div>
            @endif


                <div class="card-body">
                    <h5 class="card-title text-center">Login</h5>
                    <form method="POST" action="{{ route('loginConfirm') }}">
                        @csrf
                        <div class="form-group">
                            <label for="loginEmail">Email address</label>
                            <input name="email" type="email" class="form-control" id="loginEmail"
                                placeholder="Enter your email">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <input name="password" type="password" class="form-control" id="loginPassword"
                                placeholder="Password">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="submit" value="Login" class="btn btn-primary btn-block" />
                        <div class="forgot-password mt-3">
                            <a href="#">Forgot your password?</a>
                        </div>
                    </form>
                    <p class="text-center mt-3">Don't have an account? <span class="toggle-btn"
                            onclick="toggleForm()">Register</span></p>
                </div>
            </div>
            <div class="card registration-card d-none" id="registrationCard">
                <div class="card-body">
                    <h5 class="card-title text-center">Register</h5>
                    <form method="POST" action="{{ route('registerConfirm') }}">

                        @csrf
                        <div class="form-group">
                            <label for="registerName">Full Name</label>
                            <input type="text" name="name" class="form-control" id="registerName"
                                placeholder="Enter your full name">
                        </div>
                        <div class="form-group">
                            <label for="registerEmail">Email address</label>
                            <input type="email" name="email" class="form-control" id="registerEmail"
                                placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="registerPassword">Password</label>
                            <input type="password" name="password" class="form-control" id="registerPassword"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="registerConfirmPassword">Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control" id="registerConfirmPassword"
                                placeholder="Confirm your password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                        <p class="text-center mt-3">Already have an account? <span class="toggle-btn"
                                onclick="toggleForm()">Login</span></p>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            function toggleForm() {
                var loginCard = document.getElementById('loginCard');
                var registrationCard = document.getElementById('registrationCard');
                if (loginCard.classList.contains('d-none')) {
                    loginCard.classList.remove('d-none');
                    registrationCard.classList.add('d-none');
                } else {
                    loginCard.classList.add('d-none');
                    registrationCard.classList.remove('d-none');
                }
            }
        </script>
    </body>

    </html>
@endsection
