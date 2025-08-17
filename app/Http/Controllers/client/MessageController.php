<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class MessageController
{
    public function index(Request $request)
    {
        // Lấy conversation của user hiện tại
        $conversation = Conversation::where('user_id', Auth::id())->first();
        if (!$conversation) {
            return response()->json([]);
        }
        // Thêm trường 'files'
        $messages = Message::where('conversation_id', $conversation->id)
            ->orderBy('created_at')
            ->get(['content', 'is_admin', 'created_at', 'files']);
        // Giải mã files nếu có
        $messages = $messages->map(function ($msg) {
            $msg->files = $msg->files ? json_decode($msg->files, true) : [];
            return $msg;
        });
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        // Tìm hoặc tạo conversation cho user hiện tại
        $conversation = Conversation::firstOrCreate(
            ['user_id' => Auth::id()],
            ['last_message_at' => now()]
        );

        // Lưu tin nhắn mới
        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->sender_id = Auth::id();
        $message->content = $request->input('content') ?? '';
        $message->is_admin = false;

        // Xử lý file ảnh nếu có
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('chat_files'), $filename);
            $url = '/chat_files/' . $filename;
            $message->files = json_encode([$url]);
        } else {
            $message->files = json_encode([]);
        }

        $message->save();

        // Cập nhật thời gian tin nhắn cuối
        $conversation->last_message_at = now();
        $conversation->save();

        return response()->json([
            'success' => true,
            'message' => 'Tin nhắn đã được gửi!',
            'data' => $message
        ]);
    }
}
