<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Timea Boros">
    <meta name="description" content="Welcome page of my MoviEasy app">
    <title>MoviEasy</title>

    <!-- Fonts -->
    {{--    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">--}}
    {{--    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">--}}

    {{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    @vite('resources/js/app.js')
</head>
<body>
    <header>
        @include('navbar')
        <dialog></dialog>
    </header>
    <main>
        <h1>MoviEasy</h1>
        <p>... for movie and series lovers</p>
    </main>
    <footer>
        <p>
            <span>Copyright &copy; <time id="year"></time></span>
            <span>MoviEasy</span>
        </p>
    </footer>
</body>
</html>
