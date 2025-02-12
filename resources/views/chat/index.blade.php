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
                            <div class="mb-2">
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
                                    <li class="list-group-item">{{ $user->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Подключение Pusher -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- Подключение Emoji Picker -->
    <script type="module">
        import 'https://cdn.jsdelivr.net/npm/@joeattardi/emoji-picker-element@latest';
    </script>

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
                let messageElement = document.createElement('div');
                messageElement.innerHTML = `<strong>${data.username}:</strong> ${data.content}`;
                chatBox.appendChild(messageElement);
                chatBox.scrollTop = chatBox.scrollHeight;
            });

            document.getElementById("chat-form").addEventListener("submit", function (e) {
                e.preventDefault();
                let message = document.getElementById("message-input").value;

                fetch("{{ route('chat.send') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ content: message })
                }).then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        let messageElement = document.createElement('div');
                        messageElement.innerHTML = `<strong>{{ auth()->user()->name }}:</strong> ${data.content}`;
                        chatBox.appendChild(messageElement);
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }
                });

                document.getElementById("message-input").value = '';
            });

            // ========== Эмодзи Picker ==========
            const emojiButton = document.getElementById('emoji-button');
            emojiButton.addEventListener('click', () => {
                const picker = document.createElement('emoji-picker');
                picker.style.position = 'absolute';
                picker.style.bottom = '60px';
                picker.style.right = '20px';
                document.body.appendChild(picker);

                picker.addEventListener('emoji-click', event => {
                    document.getElementById("message-input").value += event.detail.unicode;
                    picker.remove();
                });

                document.addEventListener('click', (event) => {
                    if (!picker.contains(event.target) && event.target !== emojiButton) {
                        picker.remove();
                    }
                }, { once: true });
            });

            // ========== GIF Picker (Giphy API) ==========
            const gifButton = document.getElementById("gif-button");
            const gifContainer = document.getElementById("gif-container");

            gifButton.addEventListener("click", function () {
                gifContainer.innerHTML = '<input type="text" id="gif-search" class="form-control mb-2" placeholder="Введите запрос для GIF">';
                gifContainer.classList.remove("d-none");

                document.getElementById("gif-search").addEventListener("keyup", function () {
                    let searchTerm = this.value;
                    if (searchTerm.length > 2) {
                        fetch(`https://api.giphy.com/v1/gifs/search?api_key=YOUR_GIPHY_API_KEY&q=${searchTerm}&limit=5`)
                            .then(response => response.json())
                            .then(data => {
                                gifContainer.innerHTML = '<input type="text" id="gif-search" class="form-control mb-2" placeholder="Введите запрос для GIF">';
                                data.data.forEach(gif => {
                                    let img = document.createElement("img");
                                    img.src = gif.images.fixed_height.url;
                                    img.classList.add("m-1", "gif-choice");
                                    img.style.cursor = "pointer";
                                    img.onclick = () => {
                                        document.getElementById("message-input").value += `<img src="${gif.images.fixed_height.url}">`;
                                        gifContainer.classList.add("d-none");
                                    };
                                    gifContainer.appendChild(img);
                                });
                            });
                    }
                });
            });
        });
    </script>
@endsection
