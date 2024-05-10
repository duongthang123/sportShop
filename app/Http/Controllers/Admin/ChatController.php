<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageSend;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('admin.chat.index');
    }

    public function messageReceived(Request $request)
    {
        $rules = [
            'message' => 'required',
        ];
        $request->validate($rules);

        $user = Auth::user();
        $message = new Message();
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->save();

        broadcast(new MessageSend($request->user(), $request->message));
        return response()->json('Message broadcast');
    }

    public function getMessage()
    {
        return Message::with(['user', 'user.images'])->get();
    }
}
