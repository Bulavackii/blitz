@extends('layouts.app')

@section('title', 'Чат')

@section('content')
    <h1>Чат клана</h1>

    <div id="chat-box">
        @foreach ($messages as $message)
            <p><strong>{{ $message->user->name }}:</strong> {{ $message->content }}</p>
        @endforeach
    </div>

    <form id="chat-form">
        @csrf
        <input type="text" id="message-input" required placeholder="Введите сообщение...">
        <button type="submit">Отправить</button>
    </form>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "eu",
            encrypted: true
        });

        var channel = pusher.subscribe('chat');
        channel.bind('NewChatMessage', function(data) {
            let chatBox = document.getElementById('chat-box');
            let message = document.createElement('p');
            message.innerHTML = `<strong>${data.message.user.name}:</strong> ${data.message.content}`;
            chatBox.appendChild(message);
        });

        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let message = document.getElementById('message-input').value;

            fetch("{{ route('chat.send') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({ content: message })
            });

            document.getElementById('message-input').value = '';
        });
    </script>
@endsection
