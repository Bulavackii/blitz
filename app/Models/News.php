<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class News extends Model
{
    use HasFactory;

    /**
     * Разрешаем массовое заполнение
     */
    protected $fillable = ['user_id', 'title', 'content', 'image'];

    /**
     * Связь: новость принадлежит пользователю
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->select(['id', 'name']); // Загружаем только нужные поля
    }

    /**
     * Автоматическая очистка title и content от XSS
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strip_tags($value); // Убираем HTML-теги
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strip_tags($value);
    }

    /**
     * Формируем URL изображения (если оно есть)
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /**
     * Локализованная дата создания
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        Carbon::setLocale('ru');
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * Автоматическое удаление изображения при удалении новости
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($news) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
        });
    }
}
