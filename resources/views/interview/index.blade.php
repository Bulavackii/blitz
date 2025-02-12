@extends('layouts.layout')

@section('title', 'Собеседование')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 85vh;">
    <div class="card shadow-lg p-5 text-center" style="max-width: 500px;">
        <h3 class="mb-3">Добро пожаловать на страницу собеседования!</h3>
        <p class="mb-4">Заполните заявку на вступление в клан, и если она будет одобрена, с вами свяжутся для прохождения собеседования.</p>
        <a href="{{ route('apply.show') }}" class="btn btn-danger btn-lg">Подать заявку</a>
    </div>
</div>
@endsection
