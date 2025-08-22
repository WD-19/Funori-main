<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController
{

    public function index(Request $request)
    {
        if ($request->has('sidebar')) {
            $conversations = Conversation::with(['latestMessage', 'user'])->get()
                ->sortByDesc(function ($conv) {
                    return optional($conv->latestMessage)->created_at;
                })->values();

            return response()->json([
                'conversations' => $conversations->map(function ($conv) {
                    return [
                        'id' => $conv->id,
                        'user_id' => $conv->user->id ?? null,
                        'user_name' => $conv->user->full_name ?? 'Không xác định',
                        'user_avatar' => $conv->user->avatar_url ?? asset('images/avatar/user-1.png'),
                        'latest_message' => $conv->latestMessage->content ?? 'Chưa có tin nhắn',
                        'latest_time' => optional($conv->latestMessage)->created_at,
                    ];
                })
            ]);
        }

        $conversations = Conversation::with(['latestMessage', 'user'])->get()
            ->sortByDesc(function ($conv) {
                return optional($conv->latestMessage)->created_at;
            })->values();

        $activeId = $request->get('conversation_id', $conversations->first()?->id);
        $activeConversation = Conversation::with(['messages', 'user'])->find($activeId);

        return view('admin.message.index', [
            'conversations' => $conversations,
            'activeConversation' => $activeConversation,
            'activeId' => $activeId,
        ]);
    }

    public function messages($id)
    {
        $conversation = Conversation::with('messages')->findOrFail($id);
        $messages = $conversation->messages->map(function ($msg) {
            $files = [];
            if ($msg->files) {
                $files = json_decode($msg->files, true);
            } elseif ($msg->content && preg_match('/^http.*\.(jpg|jpeg|png|gif)$/i', $msg->content)) {
                $files = [$msg->content];
            }
            return [
                'content' => $msg->content,
                'files' => $files,
                'is_admin' => $msg->is_admin,
            ];
        });
        return response()->json([
            'messages' => $messages
        ]);
    }

    public function store(Request $request, $id)
    {
        $conversation = Conversation::findOrFail($id);

        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->content = $request->input('content') ?? '';
        $message->is_admin = true;
        $message->sender_id = Auth::id();
        $message->admin_id = Auth::id(); // Thêm dòng này
        $message->save();

        // Lưu file vào public/chat_files
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('chat_files'), $filename);
            $url = asset('chat_files/' . $filename);
            $message->files = json_encode([$url]);
            $message->save();
        }

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function delete($id)
    {
        $conversation = Conversation::findOrFail($id);
        $conversation->delete();
        return redirect()->back()->with('success', 'Đã xóa đoạn chat!');
    }

    public function sendFile(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
        ]);
        $conversation = Conversation::findOrFail($id);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('chat_files'), $filename);
            $url = asset('chat_files/' . $filename);
            $message = $conversation->messages()->create([
                'content' => '',
                'files' => json_encode([$url]),
                'is_admin' => true,
                'sender_id' => Auth::id(),
            ]);
            return response()->json(['success' => true, 'message' => $message]);
        }
        return response()->json(['success' => false], 400);
    }

    public function getNotifications(Request $request)
    {
        $conversations = Conversation::with(['user', 'messages' => function ($query) {
            $query->orderBy('created_at', 'desc')->take(1);
        }])
            ->whereHas('messages', function ($query) {
                $query->where('is_admin', false);
            })
            ->orderBy('last_message_at', 'desc')
            ->take(5)
            ->get();

        // Format dữ liệu để trả về
        $formattedConversations = $conversations->map(function ($conversation) {
            $lastMessage = $conversation->messages->first();
            return [
                'id' => $conversation->id,
                'user' => [
                    'id' => $conversation->user->id,
                    'name' => $conversation->user->full_name ?? $conversation->user->name ?? $conversation->user->email,
                    'email' => $conversation->user->email,
                    'avatar_url' => $conversation->user->avatar_url
                        ? asset('storage/' . $conversation->user->avatar_url)
                        : asset('images/images.jpg')
                ],
                'last_message' => $lastMessage ? [
                    'content' => \Illuminate\Support\Str::limit($lastMessage->content, 30),
                    'created_at' => $lastMessage->created_at->format('H:i d/m')
                ] : null,
                'last_message_at' => $conversation->last_message_at ?
                    \Carbon\Carbon::parse($conversation->last_message_at)->format('H:i d/m') : null
            ];
        });

        $newMessageCount = Conversation::whereHas('messages', function ($query) {
            $query->where('is_admin', false)->where('is_read', false);
        })->count();

        return response()->json([
            'conversations' => $formattedConversations,
            'count' => $newMessageCount
        ]);
    }
}
