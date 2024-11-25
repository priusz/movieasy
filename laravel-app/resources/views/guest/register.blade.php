<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Timea Boros">
    <meta name="description" content="Registration page of my MoviEasy app">
    <title>Registration</title>

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
            <h1>Registration</h1>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <fieldset>
                    <legend>Registration form</legend>
                    <p>
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" placeholder="Your name" value="{{ old('name') }}" required>
                        @error('name')
                        <span>{{ $message }}</span>
                        @enderror
                    </p>
                    <p>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Your email" value="{{ old('email') }}" required>
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
                    <p>
                        <label for="password_confirmation">Confirm password:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" required>
                        @error('password_confirmation')
                        <span>{{ $message }}</span>
                        @enderror
                    </p>
                </fieldset>
                <a href="{{ route('welcome') }}">Back</a>
                <a href="#" id="register-button">Submit</a>
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
