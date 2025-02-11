<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class UserCall extends Model
{
    use HasFactory;

    /**
     * Разрешаем массовое заполнение
     */
    protected $fillable = [
        'caller_id',
        'receiver_id',
        'status',
        'started_at',
        'ended_at',
    ];

    /**
     * Автоматическое преобразование дат в объекты Carbon
     */
    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /**
     * Связь: Звонящий пользователь
     */
    public function caller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'caller_id');
    }

    /**
     * Связь: Принимающий звонок пользователь
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Проверка, активен ли звонок
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Проверка, завершен ли звонок
     */
    public function isEnded(): bool
    {
        return $this->status === 'ended';
    }

    /**
     * Получение длительности звонка (в секундах)
     */
    public function getDurationInSeconds(): ?int
    {
        return $this->started_at && $this->ended_at
            ? $this->started_at->diffInSeconds($this->ended_at)
            : null;
    }

    /**
     * Форматированное отображение времени начала звонка
     */
    public function getFormattedStartTimeAttribute(): ?string
    {
        return $this->started_at?->format('d.m.Y H:i');
    }
}
