@extends('layouts.app')

@section('title', 'Новости')

@section('content')
    <h1>Новости клана</h1>

    @foreach ($news as $item)
        <div class="news-item">
            <h2><a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></h2>
            <p>{{ Str::limit($item->content, 100) }}</p>
            @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="Новость">
            @endif
        </div>
    @endforeach
@endsection
