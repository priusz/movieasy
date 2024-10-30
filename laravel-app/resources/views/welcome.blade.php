<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MoviEasy</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #f5f5f5;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('/images/welcome-background.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.3;
            z-index: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-family: 'Poppins', sans-serif;
            font-size: 180px;
            font-weight: 800;
            color: #333;
            animation: fadeIn 2s ease-in-out infinite alternate;
        }

        .subtitle {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            font-weight: 600;
            color: #555;
            margin-top: -20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0.9;
            }
            to {
                opacity: 0.9;
            }
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title">
            MoviEasy
        </div>
        <div class="subtitle">
            ... for movie and series lovers
        </div>
    </div>
</div>
</body>
</html>
