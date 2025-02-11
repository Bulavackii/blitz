<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\SerializesModels;
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
     * @return PresenceChannel
     */
    public function broadcastOn(): PresenceChannel
    {
        return new PresenceChannel('chat');
    }

    /**
     * Ограничиваем трансляцию только для новых сообщений
     *
     * @return bool
     */
    public function broadcastWhen(): bool
    {
        return $this->message->wasRecentlyCreated;
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
        return array_filter([
            'id'         => $this->message->id,
            'user_id'    => $this->message->user_id,
            'username'   => $this->message->user->name ?? 'Unknown',
            'content'    => $this->message->content,
            'created_at' => optional($this->message->created_at)->toISOString(),
        ]);
    }
}
