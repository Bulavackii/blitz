@extends('layouts.layout')

@section('title', 'Личный кабинет')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-danger text-white text-center">
                    <h3>Личный кабинет</h3>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <!-- Аватар -->
                        <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="avatar-wrapper mb-3">
                                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('/images/default-avatar.jpg') }}"
                                     class="rounded-circle" width="120" height="120" alt="Аватар">
                                <input type="file" name="avatar" class="form-control mt-2">
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Обновить аватар</button>
                            </div>
                        </form>

                        <h5 class="text-success">Добро пожаловать, {{ auth()->user()->name }}!</h5>
                    </div>

                    <hr>

                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Должность:</th>
                                <td>{{ auth()->user()->position ?? 'Не указано' }}</td>
                            </tr>
                            <tr>
                                <th>Ник:</th>
                                <td>{{ auth()->user()->nickname ?? 'Не указан' }}</td>
                            </tr>
                            <tr>
                                <th>Возраст:</th>
                                <td>{{ auth()->user()->age ?? 'Не указан' }} лет</td>
                            </tr>
                            <tr>
                                <th>Дней в клане:</th>
                                <td>{{ auth()->user()->days_in_clan ?? 0 }}</td>
                            </tr>
                            <tr>
                                <th>% побед:</th>
                                <td>{{ auth()->user()->win_rate ?? 0 }}%</td>
                            </tr>
                            <tr>
                                <th>Советы:</th>
                                <td>{{ auth()->user()->tips ?? 'Нет рекомендаций' }}</td>
                            </tr>
                            <tr>
                                <th>Ключ приглашения:</th>
                                <td>
                                    @if(auth()->user()->invite_key_active)
                                        <span class="badge badge-success">Активен</span>
                                    @else
                                        <span class="badge badge-danger">Не активен</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center mt-3">
                        <a href="/" class="btn btn-primary">На главную</a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-warning">Редактировать профиль</a>
                        <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить аккаунт</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
