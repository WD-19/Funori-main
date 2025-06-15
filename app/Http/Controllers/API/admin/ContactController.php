<?php

namespace App\Http\Controllers\API\admin;

use Illuminate\Http\Request;
use App\Models\ContactSubmission;

class ContactController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contacts = ContactSubmission::query();

        // Lọc theo trạng thái xóa mềm nếu có tham số ?trashed=1
        if ($request->has('trashed') && $request->trashed) {
            $contacts = $contacts->onlyTrashed();
        }

        return response()->json($contacts->orderByDesc('id')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'status'  => 'nullable|string',
        ]);

        $contact = ContactSubmission::create($data);

        return response()->json([
            'message' => 'Tạo liên hệ thành công!',
            'contact' => $contact,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = ContactSubmission::withTrashed()->findOrFail($id);
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contact = ContactSubmission::withTrashed()->findOrFail($id);

        $data = $request->validate([
            'name'    => 'sometimes|string|max:255',
            'email'   => 'sometimes|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'status'  => 'nullable|string',
        ]);

        $contact->update($data);

        return response()->json([
            'message' => 'Cập nhật liên hệ thành công!',
            'contact' => $contact,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = ContactSubmission::findOrFail($id);
        $contact->delete();

        return response()->json([
            'message' => 'Đã xóa mềm liên hệ!',
        ]);
    }

    // Khôi phục liên hệ đã xóa mềm
    public function restore($id)
    {
        $contact = ContactSubmission::onlyTrashed()->findOrFail($id);
        $contact->restore();

        return response()->json([
            'message' => 'Khôi phục liên hệ thành công!',
            'contact' => $contact,
        ]);
    }

    // Xóa vĩnh viễn liên hệ
    public function forceDelete($id)
    {
        $contact = ContactSubmission::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();

        return response()->json([
            'message' => 'Đã xóa vĩnh viễn liên hệ!',
        ]);
    }
}
