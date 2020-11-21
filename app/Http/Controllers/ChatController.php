<?php

namespace App\Http\Controllers;
use App\Http\Requests\ChatRequest;
use App\Models\Message;
use App\Models\Room;

class ChatController extends Controller
{
    public function store(ChatRequest $request)
    {
        $user = \Auth::user();
        $message = new Message($request->validated());
        $message->room()->associate(Room::find($request->roomId)); // TODO проверка на доступность
        $message->user()->associate($user);
        $message->saveOrFail();
        return 'OK';
    }

    public function destroy(ChatRequest $request, $id)
    {
        //$game = Message::findOrFail($id);
        //if($game->delete()) return response(null, 204);
    }
}
