<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index(Request $request){
        return response()->json($request->user()->chats);
    }

    public function create(Request $request){
        $data = $request->validate(['user_id'=>'required']);
        $chat = new Chat();
        $chat->save();
        $chat->users()->attach($request->user()->id);
        $chat->users()->attach($data['user_id']);
        // sneaky shortcut husshhhhh
        return response()->json(Chat::find($chat->id));
    }


    
    

}
