# 1. Установка Laravel и базовых пакетов
composer create-project --prefer-dist laravel/laravel wot_blitz_clan_site
cd wot_blitz_clan_site

# 2. Установка необходимых зависимостей
composer require livewire/livewire  # Добавляет поддержку Livewire для динамических компонентов
composer require beyondcode/laravel-websockets  # Устанавливает WebSockets для чата
composer require pusher/pusher-php-server  # Подключает Pusher для работы с WebSockets
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
npm install && npm run dev  # Устанавливает frontend-зависимости и компилирует файлы

# 3. Настройка .env
cp .env.example .env  # Создаем файл конфигурации окружения
php artisan key:generate  # Генерируем ключ приложения

# В .env файле добавить конфигурацию для WebSockets и Pusher
# PUSHER_APP_ID=your_app_id  # ID приложения Pusher
# PUSHER_APP_KEY=your_app_key  # Ключ Pusher
# PUSHER_APP_SECRET=your_app_secret  # Секретный ключ Pusher
# BROADCAST_DRIVER=pusher  # Драйвер трансляции
# WEBSOCKETS_PORT=6001  # Порт для WebSockets

# 4. Настройка базы данных
php artisan make:model Message -m  # Создаем модель и миграцию для сообщений
php artisan make:model News -m  # Создаем модель и миграцию для новостей
php artisan make:model UserCall -m  # Создаем модель и миграцию для звонков
php artisan migrate  # Применяем миграции базы данных

# 5. Создание контроллеров
php artisan make:controller ChatController  # Контроллер для чата
php artisan make:controller NewsController  # Контроллер для новостей
php artisan make:controller CallController  # Контроллер для звонков

# 6. Настройка маршрутов (routes/web.php)
echo "Route::get('/chat', [ChatController::class, 'index']);" >> routes/web.php
echo "Route::post('/chat/send', [ChatController::class, 'sendMessage']);" >> routes/web.php
echo "Route::get('/news', [NewsController::class, 'index']);" >> routes/web.php
echo "Route::post('/call/start', [CallController::class, 'startCall']);" >> routes/web.php

# 7. Запуск WebSockets
php artisan websockets:serve &  # Запускаем сервер WebSockets в фоновом режиме

# 8. Запуск сервера
php artisan serve  # Запускаем Laravel-сервер


composer require laravel/breeze --dev
