<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции (создание таблицы новостей).
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Связь с users
            $table->string('title', 255); // Заголовок новости
            $table->text('content'); // Содержание
            $table->string('image')->nullable(); // URL изображения (если есть)
            $table->timestamps(); // created_at и updated_at
        });
    }

    /**
     * Откат миграции (удаление таблицы новостей).
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
