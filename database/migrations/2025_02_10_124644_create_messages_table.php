<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции (создание таблицы сообщений).
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Связь с users
            $table->text('content'); // Текст сообщения
            $table->timestamps(); // created_at и updated_at
        });
    }

    /**
     * Откат миграции (удаление таблицы сообщений).
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
