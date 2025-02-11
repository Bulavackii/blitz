<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Получение списка сообщений с пагинацией
     */
    public function index(Request $request)
    {
        $messages = Message::with('user')
            ->latest()
            ->paginate($request->get('per_page', 20)); // По умолчанию 20 сообщений

        return response()->json($messages);
    }

    /**
     * Отправка нового сообщения
     */
    public function sendMessage(Request $request)
    {
        if (!Auth::check()) {
            abort(403, 'Вы должны быть авторизованы для отправки сообщений');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        // Отправляем событие WebSockets
        broadcast(new NewChatMessage($message))->toOthers();

        return response()->json([
            'id' => $message->id,
            'user_id' => $message->user_id,
            'username' => $message->user->name ?? 'Unknown',
            'content' => $message->content,
            'created_at' => $message->created_at->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Удаление сообщения (только автор или админ)
     */
    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);

        if (Auth::id() !== $message->user_id && !Auth::user()?->is_admin) {
            abort(403, 'У вас нет прав для удаления этого сообщения');
        }

        $message->delete();

        return response()->json(['message' => 'Сообщение удалено']);
    }
}
