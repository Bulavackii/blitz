<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    /**
     * Получение списка сообщений с пагинацией и списка онлайн пользователей
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Вы должны войти, чтобы видеть чат.');
        }

        // Загружаем сообщения с пользователями, пагинация
        $messages = Message::with('user')->latest()->paginate($request->get('per_page', 20));

        // Получаем список онлайн пользователей
        $onlineUsers = User::where('is_online', true)->get(['id', 'name']);

        return view('chat.index', compact('messages', 'onlineUsers'));
    }

    /**
     * Отправка нового сообщения
     */
    public function sendMessage(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['error' => 'Вы должны быть авторизованы'], 403);
            }

            // Валидация
            $request->validate([
                'content' => 'required|string|max:1000',
            ]);

            // Создание нового сообщения
            $message = Message::create([
                'user_id' => Auth::id(),
                'content' => e($request->content), // Защита от XSS
            ]);

            // Отправка события через Pusher
            broadcast(new NewChatMessage($message))->toOthers();

            return response()->json([
                'id' => $message->id,
                'user_id' => $message->user_id,
                'username' => $message->user->name ?? 'Unknown',
                'content' => $message->content,
                'created_at' => $message->created_at->format('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            Log::error("Ошибка при отправке сообщения: " . $e->getMessage());
            return response()->json(['error' => 'Ошибка при отправке сообщения'], 500);
        }
    }

    /**
     * Удаление сообщения (только автор или админ)
     */
    public function deleteMessage($id)
    {
        try {
            $message = Message::findOrFail($id);

            // Проверка прав (автор или админ)
            if (Auth::id() !== $message->user_id && !Auth::user()?->is_admin) {
                return response()->json(['error' => 'У вас нет прав для удаления этого сообщения'], 403);
            }

            $message->delete();

            return response()->json(['message' => 'Сообщение удалено']);
        } catch (\Exception $e) {
            Log::error("Ошибка при удалении сообщения: " . $e->getMessage());
            return response()->json(['error' => 'Ошибка при удалении сообщения'], 500);
        }
    }
}
