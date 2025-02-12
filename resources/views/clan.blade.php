@extends('layouts.layout')

@section('title', 'Состав клана')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 85vh;">
    <h2 class="text-center mb-4">Состав клана</h2>

    <!-- Лидеры и офицеры клана -->
    <div class="row text-center w-100 d-flex justify-content-center">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <i class="fa-solid fa-crown fa-3x text-warning mb-2"></i>
                <h5>Лидер</h5>
                <p class="h4 font-weight-bold">DarkKnight</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <i class="fa-solid fa-shield-halved fa-3x text-primary mb-2"></i>
                <h5>Офицеры</h5>
                <p class="h4 font-weight-bold">ShadowSlayer, WolfHunter</p>
            </div>
        </div>
    </div>

    <!-- Таблица участников -->
    <div class="mt-5 w-100 d-flex flex-column align-items-center">
        <h4 class="mb-3 text-center">Участники клана</h4>
        <div class="table-responsive" style="max-width: 800px;">
            <table class="table table-striped text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Игрок</th>
                        <th>Ранг</th>
                        <th>Статус</th>
                        <th>Дата вступления</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NightWolf</td>
                        <td>Офицер</td>
                        <td><span class="badge bg-success">В сети</span></td>
                        <td>12.01.2023</td>
                    </tr>
                    <tr>
                        <td>GhostRider</td>
                        <td>Член</td>
                        <td><span class="badge bg-danger">Оффлайн</span></td>
                        <td>05.06.2023</td>
                    </tr>
                    <tr>
                        <td>ShadowNinja</td>
                        <td>Член</td>
                        <td><span class="badge bg-warning">AFK</span></td>
                        <td>28.08.2023</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
