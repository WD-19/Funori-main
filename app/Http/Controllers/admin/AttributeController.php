<?php

namespace App\Http\Controllers\Admin;

use App\Models\AttributeValue;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttributeController
{
    public function index(Request $request)
    {
        $query = AttributeValue::with('attribute');
        if ($request->filled('name')) {
            $query->whereHas('attribute', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            })->orWhere('value', 'like', '%' . $request->name . '%');
        }
        $attributes = $query->paginate(20)->appends($request->all());
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        $attributes = Attribute::all();
        return view('admin.attributes.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => ['required', 'string', 'max:255', Rule::unique('attribute_values')->where(function ($query) use ($request) {
                return $query->where('attribute_id', $request->attribute_id);
            })],
        ], [
            'attribute_id.required' => 'Thuộc tính là bắt buộc.',
            'attribute_id.exists' => 'Thuộc tính không tồn tại.',
            'value.required' => 'Giá trị thuộc tính là bắt buộc.',
            'value.string' => 'Giá trị thuộc tính phải là chuỗi ký tự.',
            'value.max' => 'Giá trị thuộc tính không được vượt quá 255 ký tự.',
            'value.unique' => 'Giá trị thuộc tính đã tồn tại cho thuộc tính này.',
        ]);

        AttributeValue::create([
            'attribute_id' => $request->attribute_id,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.attributes.index')->with('success', 'Thêm giá trị thuộc tính thành công.');
    }

    public function edit($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributes = Attribute::all();
        return view('admin.attributes.edit', compact('attributeValue', 'attributes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => ['required', 'string', 'max:255', Rule::unique('attribute_values')->where(function ($query) use ($request, $id) {
                return $query->where('attribute_id', $request->attribute_id)->where('id', '!=', $id);
            })],
        ], [
            'attribute_id.required' => 'Thuộc tính là bắt buộc.',
            'attribute_id.exists' => 'Thuộc tính không tồn tại.',
            'value.required' => 'Giá trị thuộc tính là bắt buộc.',
            'value.string' => 'Giá trị thuộc tính phải là chuỗi ký tự.',
            'value.max' => 'Giá trị thuộc tính không được vượt quá 255 ký tự.',
            'value.unique' => 'Giá trị thuộc tính đã tồn tại cho thuộc tính này.',
        ]);

        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->update([
            'attribute_id' => $request->attribute_id,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.attributes.index')->with('success', 'Cập nhật giá trị thuộc tính thành công.');
    }

    public function destroy($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->delete();

        return redirect()->route('admin.attributes.index')->with('success', 'Xóa giá trị thuộc tính thành công.');
    }
}