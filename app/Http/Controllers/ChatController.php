<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use App\Services\AblyService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    protected $ablyService;

    public function __construct(AblyService $ablyService)
    {
        $this->ablyService = $ablyService;
    }

    public function chat()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('chat', compact('users'));
    }
    

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'chat_type' => 'required|in:public,private',
            'receiver_id' => 'nullable|integer|exists:users,id',
        ]);
    
        // Save message to the database
        $savedMessage = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'chat_type' => $request->chat_type,
            'is_read' => false,
        ]);
    
        // Prepare message data for Ably
        $messageData = [
            'sender_id' => $savedMessage->sender_id,
            'sender_name' => auth()->user()->name,
            'message' => $savedMessage->message,
            'timestamp' => $savedMessage->created_at->toDateTimeString(),
            'profile_picture' => auth()->user()->profile_picture,
        ];
    
        // Publish to Ably based on chat type
        if ($request->chat_type === 'public') {
            $this->ablyService->publishMessage('chat-room', 'message.sent', $messageData);
        } else {
            $channelName = "private-chat-{$request->receiver_id}";
            $this->ablyService->publishMessage($channelName, 'message.sent', $messageData);
        }
    
        return response()->json(['success' => true, 'message' => 'Message sent']);
    }
    public function fetchMessages($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', auth()->id());
        })
        ->with('sender')  // Eager load the sender relationship
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function ($message) {
            return [
                'id' => $message->id,
                'sender_id' => $message->sender_id,
                'receiver_id' => $message->receiver_id,
                'message' => $message->message,
                'timestamp' => $message->created_at->toDateTimeString(),
                'sender_name' => $message->sender->name,  // Include sender name
                'profile_picture' => $message->sender->profile_picture,  // Include sender name
            ];
        });
    
        return response()->json($messages);
    }
    

}