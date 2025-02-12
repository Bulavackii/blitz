@extends('layouts.layout')

@section('title', 'Новости')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Новости клана</h1>

        @foreach ($news as $item)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                    </h4>
                    <p class="card-text">{{ Str::limit($item->content, 150) }}</p>
                    <p class="text-muted small">Автор: {{ $item->user->name }} | {{ $item->formatted_created_at }}</p>

                    @if($item->image)
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Новость" class="img-fluid rounded">
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center">
            {{ $news->links() }}
        </div>
    </div>
@endsection
