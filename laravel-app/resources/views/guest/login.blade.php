<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Timea Boros">
    <meta name="description" content="Welcome page of my MoviEasy app">
    <title>Login</title>

    <!-- Fonts -->
{{--    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">--}}

{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    @vite('resources/js/app.js')
</head>
<body>
    <header>
        @include('navbar')
        @if(session('status'))
            <dialog>{{ session('status') }}</dialog>
        @endif

        @if(session('error'))
            <dialog>{{ session('error') }}</dialog>
        @endif
    </header>
    <main>
        <article>
            <h1>Login</h1>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <fieldset>
                    <legend>Login form</legend>
                    <p>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Your name" value="{{ old('name') }}" required>
                        @error('email')
                        <span>{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Your password" required>
                        @error('password')
                        <span>{{ $message }}</span>
                        @enderror
                    </p>
                </fieldset>
                <a href="{{ route('welcome') }}">Back</a>
                <a href="#" id="login-button">Login</a>
            </form>
        </article>
    </main>
    <footer>
        <p>
            <span>Copyright &copy; <time id="year"></time></span>
            <span>MoviEasy</span>
        </p>
    </footer>
</body>
</html>
