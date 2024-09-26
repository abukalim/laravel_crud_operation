<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your Laravel App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .navbar {
            background-color: #343a40 !important;
        }
        .jumbotron {
            background-color: #007bff;
            color: white;
        }
        .jumbotron h1, .jumbotron p {
            color: white;
        }
        .footer {
            background-color: #343a40;
            color: #f8f9fa;
            padding: 10px 0;

            bottom: 0;
            width: 100%;
        }
        .footer span {
            color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        @yield('content')
    </div>
    <footer class="footer text-center">
        <div class="container">
            <span>&copy; {{ date('Y') }} Your Company. All rights reserved.</span>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

