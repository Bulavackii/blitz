<?php

namespace App\Events;

use App\Models\UserCall;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class CallStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public UserCall $call;

    /**
     * Создание события обновления статуса звонка
     */
    public function __construct(UserCall $call)
    {
        $this->call = $call;
    }

    /**
     * Определяем, на каком канале будет транслироваться событие
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [
            new PrivateChannel('calls.' . $this->call->receiver_id),
            new PrivateChannel('calls.' . $this->call->caller_id),
        ];
    }

    /**
     * Ограничение: отправлять событие только при изменении статуса
     *
     * @return bool
     */
    public function broadcastWhen()
    {
        return $this->call->wasChanged('status');
    }

    /**
     * Указываем имя события для фронта
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'CallStatusUpdated';
    }

    /**
     * Данные, которые будут отправлены клиентам
     *
     * @return array
     */
    public function broadcastWith()
    {
        return array_filter([
            'id'          => $this->call->id,
            'caller_id'   => $this->call->caller_id,
            'receiver_id' => $this->call->receiver_id,
            'status'      => $this->call->status,
            'started_at'  => optional($this->call->started_at)->toISOString(),
            'ended_at'    => optional($this->call->ended_at)->toISOString(),
        ]);
    }
}
