<?php

namespace App\Http\Controllers;

use App\Events\CallStatusUpdated;
use App\Models\UserCall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CallController extends Controller
{
    /**
     * Начать звонок
     */
    public function startCall(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id|different:caller_id',
        ]);

        // Проверяем, не существует ли уже активный звонок между пользователями
        $existingCall = UserCall::where([
            ['caller_id', Auth::id()],
            ['receiver_id', $request->receiver_id],
            ['status', 'active'],
        ])->orWhere([
            ['caller_id', $request->receiver_id],
            ['receiver_id', Auth::id()],
            ['status', 'active'],
        ])->first();

        if ($existingCall) {
            return response()->json(['message' => 'Уже есть активный звонок'], 400);
        }

        $call = UserCall::create([
            'caller_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'status' => 'active',
            'started_at' => now(),
        ]);

        broadcast(new CallStatusUpdated($call))->toOthers();

        return response()->json([
            'message' => 'Звонок начат',
            'call' => $call,
        ]);
    }

    /**
     * Завершить звонок
     */
    public function endCall($id)
    {
        $call = UserCall::findOrFail($id);

        // Проверяем, является ли пользователь участником звонка
        if (Auth::id() !== $call->caller_id && Auth::id() !== $call->receiver_id) {
            abort(403, 'Вы не можете завершить этот звонок');
        }

        if ($call->status === 'ended') {
            return response()->json(['message' => 'Звонок уже завершен'], 400);
        }

        $call->update([
            'status' => 'ended',
            'ended_at' => now(),
        ]);

        broadcast(new CallStatusUpdated($call))->toOthers();

        return response()->json([
            'message' => 'Звонок завершен',
            'duration' => $call->getDurationInSeconds(),
        ]);
    }

    /**
     * Получить статус звонка
     */
    public function getCallStatus($id)
    {
        $call = UserCall::findOrFail($id);

        return response()->json([
            'status' => $call->status,
            'is_active' => $call->status === 'active',
            'caller_id' => $call->caller_id,
            'receiver_id' => $call->receiver_id,
            'started_at' => $call->started_at,
            'ended_at' => $call->ended_at,
        ]);
    }
}
