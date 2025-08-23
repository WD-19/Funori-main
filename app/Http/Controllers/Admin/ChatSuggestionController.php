<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatSuggestion;
use Illuminate\Http\Request;

class ChatSuggestionController extends Controller
{
    public function index()
    {
        $suggestions = ChatSuggestion::all();
        return view('admin.chat_suggestions.index', compact('suggestions'));
    }

    public function store(Request $request)
    {
        $request->validate(['content' => 'required|string|max:255']);
        ChatSuggestion::create($request->only('content'));
        return back()->with('success', 'Đã thêm gợi ý!');
    }

    public function update(Request $request, ChatSuggestion $chatSuggestion)
    {
        $request->validate(['content' => 'required|string|max:255']);
        $chatSuggestion->update($request->only('content'));
        return back()->with('success', 'Đã sửa gợi ý!');
    }

    public function destroy(ChatSuggestion $chatSuggestion)
    {
        $chatSuggestion->delete();
        return back()->with('success', 'Đã xóa gợi ý!');
    }
}