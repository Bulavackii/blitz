@extends('layouts.layout')

@section('title', 'Личный кабинет')

@section('content')
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6"> <!-- Уменьшил ширину карточки -->
                <div class="card shadow-lg" style="max-height: 70vh; overflow-y: auto;"> <!-- Ограничил высоту и добавил прокрутку только внутри -->
                    <div class="card-header bg-warning text-white text-center py-2">
                        <h4 class="mb-0">Личный кабинет</h4> <!-- Уменьшил заголовок -->
                    </div>
                    <div class="card-body p-3"> <!-- Уменьшил отступы -->
                        <div class="text-center">
                            <!-- Аватар -->
                            <form action="{{ route('profile.updateAvatar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="avatar-wrapper mb-2">
                                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : '/images/default-avatar.jpg' }}"
                                         class="rounded-circle" width="120" height="120" alt="Аватар"> <!-- Уменьшил размер аватара -->
                                </div>
                            </form>

                            @if ($errors->has('avatar'))
                                <div class="alert alert-danger mt-1 p-1">
                                    <small>{{ $errors->first('avatar') }}</small>
                                </div>
                            @endif

                            <h6 class="text-success mt-2">Добро пожаловать, {{ auth()->user()->name }}!</h6> <!-- Уменьшил текст -->
                        </div>

                        <hr class="my-2"> <!-- Уменьшил отступы у разделителя -->

                        <table class="table table-sm table-striped"> <!-- Сделал таблицу компактной -->
                            <tbody>
                                <tr><th>Должность:</th><td>{{ auth()->user()->position ?? 'Не указано' }}</td></tr>
                                <tr><th>Ник:</th><td>{{ auth()->user()->nickname ?? 'Не указан' }}</td></tr>
                                <tr><th>Возраст:</th><td>{{ auth()->user()->age ?? 'Не указан' }} лет</td></tr>
                                <tr><th>Дней в клане:</th><td>{{ auth()->user()->days_in_clan ?? 0 }}</td></tr>
                                <tr><th>% побед:</th><td>{{ auth()->user()->win_rate ?? 0 }}%</td></tr>
                                <tr><th>Советы:</th><td>{{ auth()->user()->tips ?? 'Нет рекомендаций' }}</td></tr>
                                <tr>
                                    <th>Приглашение:</th>
                                    <td>
                                        @if(auth()->user()->invite_key_active)
                                            <span class="badge bg-success">Активен</span>
                                        @else
                                            <span class="badge bg-danger">Не активен</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="text-center mt-2">
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-warning">Править</a>
                            <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
