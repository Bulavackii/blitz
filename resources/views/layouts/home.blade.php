@extends('layouts.layout')

@section('title', 'Главная - Клан WOT Blitz Kak-Tak To')

@section('content')
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
                <a href="/news" class="icon-box">
                    <i class="fa-solid fa-newspaper fa-3x mb-3"></i>
                    <h5>Актуальные новости</h5>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/chat" class="icon-box">
                    <i class="fa-solid fa-comments fa-3x mb-3"></i>
                    <h5>Общение</h5>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/calls" class="icon-box">
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
                    <a href="/apply" class="step-link">
                        <i class="fa-solid fa-user-plus fa-2x"></i>
                        <h5>Шаг 1</h5>
                        <p>Заполните заявку.</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/interview" class="step-link">
                        <i class="fa-solid fa-comments fa-2x"></i>
                        <h5>Шаг 2</h5>
                        <p>Пройдите собеседование.</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/battle" class="step-link">
                        <i class="fa-solid fa-trophy fa-2x"></i>
                        <h5>Шаг 3</h5>
                        <p>Битва!</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
