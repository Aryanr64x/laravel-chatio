<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageContoller extends Controller
{
    public function index(Request $request, $chat_id){
        return response()->json(Message::where('chat_id', '=', $chat_id)->get());
    }

    public function create(Request $request, $chat_id){
        $data = $request->validate(['text'=>'required']);
        $message = new Message();
        $message->chat_id = $chat_id;
        $message->user_id = $request->user()->id;
        $message->text = $data['text'];
        $message->save();
        event(new \App\Events\Message($message));
        return response()->json($message);
    }



        
}
