<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index()
    {
        $chats = ChatMessage::with(['user', 'admin'])
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Admin/Chat', [
            'chats' => $chats
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        ChatMessage::create([
            'message' => $validated['message'],
            'user_id' => $validated['user_id'],
            'admin_id' => auth()->id(),
            'is_admin' => true
        ]);

        return back();
    }

    public function userMessages()
    {
        return ChatMessage::where('user_id', auth()->id())
            ->orWhere('admin_id', auth()->id())
            ->with(['user', 'admin'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string'
        ]);

        ChatMessage::create([
            'message' => $validated['message'],
            'user_id' => auth()->id(),
            'is_admin' => false
        ]);

        return back();
    }
}