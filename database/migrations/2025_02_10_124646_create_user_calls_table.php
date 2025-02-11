<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции (создание таблицы звонков).
     */
    public function up(): void
    {
        Schema::create('user_calls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caller_id')->constrained('users')->onDelete('cascade'); // Звонивший
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // Получатель
            $table->enum('status', ['active', 'ended', 'missed'])->default('active'); // Статус звонка
            $table->timestamp('started_at')->nullable(); // Начало звонка
            $table->timestamp('ended_at')->nullable(); // Окончание звонка
            $table->timestamps(); // created_at и updated_at
        });
    }

    /**
     * Откат миграции (удаление таблицы звонков).
     */
    public function down(): void
    {
        Schema::dropIfExists('user_calls');
    }
};
