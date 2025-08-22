<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MessageController
{
    public function index(Request $request)
    {
        // Lấy conversation của user hiện tại
        $conversation = Conversation::where('user_id', Auth::id())->first();
        if (!$conversation) {
            return response()->json([
                'admin_name' => null,
                'messages' => []
            ]);
        }
        
        // Lấy messages cơ bản
        $messages = Message::where('conversation_id', $conversation->id)
            ->orderBy('created_at')
            ->get(['id','content', 'is_admin', 'created_at', 'files', 'admin_id', 'sender_id']);
            
        // Thu thập admin_id để tránh N+1
        $adminIds = $messages->pluck('admin_id')->filter()->unique()->values()->all();
        $admins = collect();
        if (!empty($adminIds)) {
            $admins = User::whereIn('id', $adminIds)->get()->keyBy('id');
        }

        // Tìm admin đã nhắn tin gần nhất (dùng để header nếu cần)
        $lastAdminMessage = $messages->where('is_admin', true)->whereNotNull('admin_id')->last();
        $adminNameHeader = null;
        if ($lastAdminMessage && $lastAdminMessage->admin_id && isset($admins[$lastAdminMessage->admin_id])) {
            $admin = $admins[$lastAdminMessage->admin_id];
            $adminNameHeader = $admin->full_name ?? $admin->name ?? $admin->email;
        }

        // Map messages: decode files, thêm admin_name/admin_avatar cho tin nhắn admin
        $messages = $messages->map(function ($msg) use ($admins) {
            $msg->files = $msg->files ? json_decode($msg->files, true) : [];
            $msg->admin_name = null;
            $msg->admin_avatar = null;

            if ($msg->is_admin && $msg->admin_id) {
                if (isset($admins[$msg->admin_id])) {
                    $admin = $admins[$msg->admin_id];
                    $msg->admin_name = $admin->full_name ?? $admin->name ?? $admin->email;

                    // Try common avatar fields
                    if (isset($admin->profile_photo_url) && $admin->profile_photo_url) {
                        $msg->admin_avatar = $admin->profile_photo_url;
                    } elseif (isset($admin->profile_photo_path) && $admin->profile_photo_path) {
                        $msg->admin_avatar = url($admin->profile_photo_path);
                    } elseif (isset($admin->avatar) && $admin->avatar) {
                        $msg->admin_avatar = url($admin->avatar);
                    } elseif (method_exists($admin, 'getFirstMediaUrl')) {
                        // if using medialibrary
                        $msg->admin_avatar = $admin->getFirstMediaUrl() ?: null;
                    }
                }
            }

            // Format created_at to string for client
            $msg->created_at = $msg->created_at ? $msg->created_at->toDateTimeString() : null;

            return $msg;
        })->values()->all();

        return response()->json([
            'admin_name' => $adminNameHeader,
            'messages' => $messages
        ]);
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
