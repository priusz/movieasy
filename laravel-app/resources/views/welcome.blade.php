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
            display: flex;
            gap: 10px;
        }

        .button {
            background-color: #e7e5eb;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 900;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 12px;
            color: #1d1b21 ;
            transition: background-color 0.3s;
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.4);
        }

        .button:hover {
            background-color: #d0d0d0;
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
                opacity: 0.8;
            }
            to {
                opacity: 0.9;
            }
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="top-right">
        <a href="{{ route('login') }}" class="button">Login</a>
        <a href="{{ route('register') }}" class="button">Register</a>
    </div>

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
