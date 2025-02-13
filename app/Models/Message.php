<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\HTML; // Для защиты контента от XSS
use Carbon\Carbon;

class Message extends Model
{
    use HasFactory;

    /**
     * Разрешаем массовое заполнение
     */
    protected $fillable = ['user_id', 'content'];

    /**
     * Связь: Сообщение принадлежит пользователю
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->select(['id', 'name', 'avatar']); // Загружаем только нужные поля
    }

    /**
     * Автоматическая очистка контента от XSS
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strip_tags($value); // Убираем HTML-теги для безопасности
    }

    /**
     * Форматированная дата создания (локализованная)
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        Carbon::setLocale('ru'); // Локализация для русского языка
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
