<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class LiveChatController extends Controller
{
    public function fetch()
    {
        return Message::orderBy('created_at')->get();
    }

    public function send(Request $request)
    {
        $message = $request->input('message');
        $sender  = $request->input('sender', 'user'); 

        if (!$message) {
            return response()->json(['error' => 'Empty message'], 400);
        }

        $msg = Message::create([
            'user_id' => 1,      
            'sender'  => $sender, 
            'message' => $message,
        ]);

        return response()->json($msg);
    }

    public function sendFile(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file'], 400);
        }

        $file = $request->file('file');
        $path = $file->store('chat_files', 'public');

        $msg = Message::create([
            'user_id'   => 1,
            'sender'    => $request->input('sender', 'user'),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
        ]);

        return response()->json($msg);
    }
}
