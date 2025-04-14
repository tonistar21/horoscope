<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Зірковий Гороскоп</title>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="stars"></div>
    <nav>
        <div class="container">
            <a href="/" class="text-2xl">Зірковий Гороскоп</a>
            <button class="burger">☰</button>
            <ul>
                <li><a href="/">Головна</a></li>
                <li><a href="{{ route('horoscope.daily') }}">Щоденний гороскоп</a></li>
                <li><a href="#">Блог</a></li>
                <li><a href="#">Спільність</a></li>
            </ul>
        </div>
    </nav>
    <main class="container pt-24">
        @yield('content')
    </main>
    <footer>
        <div class="container">© 2025 Зірковий Гороскоп</div>
    </footer>
</body>
</html>
