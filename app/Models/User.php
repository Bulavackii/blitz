<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Разрешаем массовое заполнение
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'is_online',
    ];

    /**
     * Скрытые атрибуты
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Автоматическое преобразование полей
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Связь: пользователь может иметь несколько сообщений
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class)->select(['id', 'user_id', 'content', 'created_at']);
    }

    /**
     * Связь: пользователь может публиковать новости
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class)->select(['id', 'user_id', 'title', 'content', 'image', 'created_at']);
    }

    /**
     * Очистка имени пользователя от XSS
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strip_tags($value);
    }

    /**
     * Получение URL аватара пользователя
     */
    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/default-avatar.png');
    }

    /**
     * Автоудаление старого аватара при обновлении
     */
    public function setAvatarAttribute($value)
    {
        if ($this->attributes['avatar'] ?? false) {
            Storage::disk('public')->delete($this->attributes['avatar']);
        }

        $this->attributes['avatar'] = $value;
    }
}
