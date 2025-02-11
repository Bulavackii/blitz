<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Получение списка новостей (с пагинацией)
     */
    public function index()
    {
        $news = News::with('user')->latest()->paginate(10);
        return $this->sendResponse($news, 'Список новостей');
    }

    /**
     * Создание новой новости
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048', // Макс. 2MB
        ]);

        $news = News::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'content' => $request->content,
            'image'   => $this->handleImageUpload($request),
        ]);

        return $this->sendResponse($news, 'Новость создана');
    }

    /**
     * Получение одной новости
     */
    public function show($id)
    {
        $news = News::with('user')->findOrFail($id);
        return $this->sendResponse($news, 'Детали новости');
    }

    /**
     * Обновление новости
     */
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $this->authorizeNewsAction($news);

        $request->validate([
            'title'   => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteOldImage($news->image);
            $news->image = $this->handleImageUpload($request);
        }

        $news->update($request->only(['title', 'content', 'image']));

        return $this->sendResponse($news, 'Новость обновлена');
    }

    /**
     * Удаление новости
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $this->authorizeNewsAction($news);

        $this->deleteOldImage($news->image);
        $news->delete();

        return $this->sendResponse([], 'Новость удалена');
    }

    /**
     * Проверяет, имеет ли пользователь право изменять/удалять новость.
     */
    private function authorizeNewsAction(News $news)
    {
        if (Auth::id() !== $news->user_id && !Auth::user()->is_admin) {
            return $this->sendError('Доступ запрещен', [], 403);
        }
    }

    /**
     * Обрабатывает загрузку изображения.
     */
    private function handleImageUpload(Request $request): ?string
    {
        return $request->hasFile('image') ? $request->file('image')->store('news_images', 'public') : null;
    }

    /**
     * Удаляет старое изображение, если оно есть.
     */
    private function deleteOldImage(?string $imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
