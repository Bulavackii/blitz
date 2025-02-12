@extends('layouts.layout')

@section('title', 'Твоя статистика')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 85vh;">
    <h2 class="text-center mb-4">Твоя игровая статистика</h2>

    <!-- Основные показатели -->
    <div class="row text-center w-100 d-flex justify-content-center">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <i class="fa-solid fa-trophy fa-3x text-warning mb-2"></i>
                <h5>Рейтинг</h5>
                <p class="h4 font-weight-bold">1200</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <i class="fa-solid fa-medal fa-3x text-success mb-2"></i>
                <h5>Побед</h5>
                <p class="h4 font-weight-bold">45</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <i class="fa-solid fa-skull fa-3x text-danger mb-2"></i>
                <h5>Поражений</h5>
                <p class="h4 font-weight-bold">12</p>
            </div>
        </div>
    </div>

    <!-- История матчей -->
    <div class="mt-5 w-100 d-flex flex-column align-items-center">
        <h4 class="mb-3 text-center">Последние матчи</h4>
        <div class="table-responsive" style="max-width: 800px;">
            <table class="table table-striped text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Дата</th>
                        <th>Противник</th>
                        <th>Результат</th>
                        <th>Очки</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>10.02.2024</td>
                        <td>Игрок123</td>
                        <td><span class="badge bg-success">Победа</span></td>
                        <td>+25</td>
                    </tr>
                    <tr>
                        <td>09.02.2024</td>
                        <td>ShadowSlayer</td>
                        <td><span class="badge bg-danger">Поражение</span></td>
                        <td>-12</td>
                    </tr>
                    <tr>
                        <td>08.02.2024</td>
                        <td>NightWolf</td>
                        <td><span class="badge bg-success">Победа</span></td>
                        <td>+30</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
