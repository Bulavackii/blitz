<nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/images/logo.jpg" alt="Логотип">
            <img src="/images/logo2.jpg" alt="Логотип">
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
