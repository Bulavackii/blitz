@extends('layouts.app')

@section('title', 'Звонки')

@section('content')
    <h1>Голосовые звонки</h1>

    <form action="{{ route('call.start') }}" method="POST">
        @csrf
        <label>Выберите пользователя:</label>
        <select name="receiver_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <button type="submit">Позвонить</button>
    </form>

    <h2>Активные звонки</h2>
    <ul id="calls-list">
        @foreach ($activeCalls as $call)
            <li id="call-{{ $call->id }}">
                {{ $call->caller->name }} звонит {{ $call->receiver->name }}
                <form action="{{ route('call.end', $call->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">Завершить</button>
                </form>
            </li>
        @endforeach
    </ul>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", { cluster: "eu", encrypted: true });
        var channel = pusher.subscribe('calls');

        channel.bind('CallStatusUpdated', function(data) {
            let callsList = document.getElementById('calls-list');
            if (data.call.status === "active") {
                let callItem = document.createElement('li');
                callItem.id = 'call-' + data.call.id;
                callItem.innerHTML = `${data.call.caller_id} звонит ${data.call.receiver_id}`;
                callsList.appendChild(callItem);
            } else {
                let callItem = document.getElementById('call-' + data.call.id);
                if (callItem) callItem.remove();
            }
        });
    </script>
@endsection
