<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel; // Если не нужен список пользователей, замени PresenceChannel на Channel
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Traits\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class NewChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

    /**
     * Создание события нового сообщения в чате
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Определяем канал трансляции события
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('chat'); // Если нужен список участников - верни PresenceChannel
    }

    /**
     * Ограничиваем трансляцию только для новых сообщений
     *
     * @return bool
     */
    public function broadcastWhen(): bool
    {
        return isset($this->message->id) && $this->message->wasRecentlyCreated;
    }

    /**
     * Указываем имя события для фронта
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'NewChatMessage';
    }

    /**
     * Данные, которые будут отправлены клиентам
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'id'         => $this->message->id,
            'user_id'    => $this->message->user_id,
            'username'   => $this->message->user->name ?? 'Unknown',
            'content'    => $this->message->content,
            'created_at' => $this->message->created_at?->toISOString(),
        ];
    }
}
