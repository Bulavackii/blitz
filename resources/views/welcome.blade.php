<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Клан WOT Blitz Kak-Tak To</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1100px;
        }

        .content {
            flex: 1;
        }

        .navbar {
            background: linear-gradient(135deg, #ffffff 50%, #ff4646 50%);
            padding: 15px 0;
            border-bottom: 2px solid #ff4646;
        }

        .navbar-brand img {
            height: 50px;
        }

        .nav-link {
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: 20%;
            color: rgb(255, 255, 255) !important;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #5b4abd !important;
            transform: scale(1.2);
        }

        .btn-custom-red {
            background-color: #b8b6b6;
            color: #ffffff;
            transition: 0.3s;
        }

        .btn-custom-red:hover {
            background-color: #ff4646;
        }

        .background-section {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            text-align: center;
            padding: 80px 0;
            margin-top: 20px;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
        }

        .info-section {
            padding: 40px 0;
            background: #ffffff;
            text-align: center;
        }

        .icon-box, .step-link {
            text-decoration: none;
            color: black;
            transition: transform 0.3s;
            display: block;
            padding: 20px;
            border-radius: 10px;
        }

        .icon-box:hover, .step-link:hover {
            transform: scale(1.05);
            text-decoration: none;
        }

        .footer {
            background: linear-gradient(135deg, #ff4646 50%, #ffffff 50%);
            color: rgb(255, 255, 255);
            padding: 20px 0;
            text-align: center;
            border-top: 2px solid #ff4646;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
            margin-left: 50%;
        }

        .social-icons a {
            font-size: 30px;
            transition: 0.3s;
            text-decoration: none;
        }

        .social-icons a:hover {
            transform: scale(1.2);
        }

        .fa-youtube { color: #FF0000; }
        .fa-vk { color: #0077FF; }
        .fa-telegram { color: #0088CC; }
        .fa-whatsapp { color: #25D366; }

        .copy {
            margin-right: 50%;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logo.jpg" alt="Логотип">
                <img src="/images/logo2.jpg" alt="Логотип">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/clan.html"><i class="fa-solid fa-users"></i> Состав клана</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/stats.html"><i class="fa-solid fa-chart-line"></i> Твоя статистика</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fa-solid fa-user-plus"></i> Регать
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-right-to-bracket"></i> Войти
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container mt-3 mb-3 d-flex justify-content-center align-items-center" style="min-height: 35vh;">
            <div class="col-md-8">
                <div class="card text-center shadow-lg border-0 p-3">
                    <div class="card-body">
                        <i class="fa-solid fa-newspaper fa-4x text-danger mb-2"></i>
                        <h3 class="card-title">Нет новостей пока что...</h3>
                        <p class="card-text text-muted">
                            Следите за обновлениями. Здесь будут появляться важные объявления и события клана.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <hr style="border: 1px solid red;">


        <div class="info-section">
            <div class="container">
                <h2>Почему стоит вступить в наш клан?</h2>
                <p>Дружное сообщество, турниры и поддержка!</p>
                <br>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <a href="/news.html" class="icon-box">
                            <i class="fa-solid fa-newspaper fa-3x mb-3"></i>
                            <h5>Актуальные новости</h5>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/chat.html" class="icon-box">
                            <i class="fa-solid fa-comments fa-3x mb-3"></i>
                            <h5>Общение</h5>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/calls.html" class="icon-box">
                            <i class="fa-solid fa-headset fa-3x mb-3"></i>
                            <h5>Голосовая связь</h5>
                        </a>
                    </div>
                </div>
                <hr style="border: 1px solid red;">
                <div class="mt-5">
                    <h3>Как вступить в клан?</h3>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/apply.html" class="step-link">
                                <i class="fa-solid fa-user-plus fa-2x"></i>
                                <h5>Шаг 1</h5>
                                <p>Заполните заявку.</p>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/interview.html" class="step-link">
                                <i class="fa-solid fa-comments fa-2x"></i>
                                <h5>Шаг 2</h5>
                                <p>Пройдите собеседование.</p>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/battle.html" class="step-link">
                                <i class="fa-solid fa-trophy fa-2x"></i>
                                <h5>Шаг 3</h5>
                                <p>Битва!</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</body>
</html>
