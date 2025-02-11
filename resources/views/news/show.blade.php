@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <h1>{{ $news->title }}</h1>
    <p>{{ $news->content }}</p>

    @if($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="Изображение новости">
    @endif

    <p>Автор: {{ $news->user->name }}</p>
    <p>Опубликовано: {{ $news->created_at->format('d.m.Y H:i') }}</p>
@endsection
