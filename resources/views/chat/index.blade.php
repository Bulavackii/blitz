@extends('layouts.layout')

@section('title', 'Чат')

@section('content')
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="container">
            <h1 class="text-center my-4">Чат клана</h1>

            <div class="row">
                <!-- Чат -->
                <div class="col-md-8">
                    <div id="chat-box" class="border rounded p-3 mb-3 bg-light" style="height: 400px; overflow-y: auto;">
                        @foreach ($messages as $message)
                            <div class="mb-2 d-flex align-items-center">
                                <img src="{{ asset('storage/' . ($message->user->avatar ?? 'default-avatar.png')) }}"
     alt="avatar" class="rounded-circle me-2" width="30" height="30">

                                <strong>{{ $message->user->name }}:</strong> {!! $message->content !!}
                            </div>
                        @endforeach
                    </div>

                    @auth
                        <form id="chat-form">
                            @csrf
                            <div class="input-group mb-2">
                                <input type="text" id="message-input" class="form-control" required placeholder="Введите сообщение...">
                                <button type="button" class="btn btn-outline-secondary" id="emoji-button">😀</button>
                                <button type="button" class="btn btn-outline-secondary" id="gif-button">🎞️</button>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </div>
                            <div id="gif-container" class="d-none border p-2 bg-white"></div>
                        </form>
                    @else
                        <p class="text-center text-muted">
                            Вы должны <a href="{{ route('login') }}">войти</a>, чтобы отправлять сообщения.
                        </p>
                    @endauth
                </div>

                <!-- Онлайн пользователи -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Онлайн пользователи</div>
                        <div class="card-body">
                            <ul id="online-users" class="list-group">
                                @foreach ($onlineUsers as $user)
                                    <li class="list-group-item d-flex align-items-center">
                                        <img src="{{ asset('storage/' . ($message->user->avatar ?? 'default-avatar.png')) }}"
     alt="avatar" class="rounded-circle me-2" width="30" height="30">


                                        <span>{{ $user->name }}</span>
                                        <span class="ms-auto online-status {{ $user->is_online ? 'bg-success' : 'bg-secondary' }}"></span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .online-status {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
    </style>

    <!-- Подключение Pusher -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var chatBox = document.getElementById("chat-box");
            chatBox.scrollTop = chatBox.scrollHeight;

            var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                cluster: "eu",
                encrypted: true
            });

            var channel = pusher.subscribe('chat');
            channel.bind('NewChatMessage', function (data) {
                console.log(data); // Проверяем, какие данные приходят

                let messageElement = document.createElement('div');
                messageElement.classList.add("mb-2", "d-flex", "align-items-center");
                messageElement.innerHTML = `
                    <img src="${data.avatar}" class="rounded-circle me-2" width="30" height="30">
                    <strong>${data.username}:</strong> ${data.content}`;
                chatBox.appendChild(messageElement);
                chatBox.scrollTop = chatBox.scrollHeight;
            });

            channel.bind('UserStatusUpdated', function (data) {
                let onlineUsersList = document.getElementById('online-users');
                onlineUsersList.innerHTML = "";
                data.users.forEach(user => {
                    let userElement = document.createElement("li");
                    userElement.classList.add("list-group-item", "d-flex", "align-items-center");

                    let img = document.createElement("img");
                    img.src = user.avatar ?? "/default-avatar.png";
                    img.classList.add("rounded-circle", "me-2");
                    img.width = 40;
                    img.height = 40;

                    let nameSpan = document.createElement("span");
                    nameSpan.innerText = user.name;

                    let statusSpan = document.createElement("span");
                    statusSpan.classList.add("ms-auto", "online-status");
                    statusSpan.classList.add(user.is_online ? "bg-success" : "bg-secondary");

                    userElement.appendChild(img);
                    userElement.appendChild(nameSpan);
                    userElement.appendChild(statusSpan);

                    onlineUsersList.appendChild(userElement);
                });
            });
        });
    </script>
@endsection
