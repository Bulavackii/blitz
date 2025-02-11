<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Клан WOT Blitz Kak-Tak To')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logo.jpg" alt="Логотип">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/clan"><i class="fa-solid fa-users"></i> Состав клана</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/stats"><i class="fa-solid fa-chart-line"></i> Твоя статистика</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i class="fa-solid fa-user-plus"></i> Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-right-to-bracket"></i> Войти</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>

    <footer class="footer">
        <div class="container">
            <p class="copy">&copy; 2025 Клан WOT Blitz Kak-Tak To. Все права защищены.</p>
            <div class="social-icons">
                <a href="#" class="fa-brands fa-youtube"></a>
                <a href="#" class="fa-brands fa-vk"></a>
                <a href="#" class="fa-brands fa-telegram"></a>
                <a href="#" class="fa-brands fa-whatsapp"></a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
