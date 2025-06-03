@extends('admin.layout.admin')

@section('content')
<div class="container">
    <h2>Edit Attribute Value</h2>
    <form action="{{ route('admin.attributes.update', $attributeValue->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="attribute_id" class="form-label">Attribute</label>
            <select name="attribute_id" id="attribute_id" class="form-control" required>
                @foreach($attributes as $attribute)
                    <option value="{{ $attribute->id }}" {{ $attributeValue->attribute_id == $attribute->id ? 'selected' : '' }}>
                        {{ $attribute->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="text" name="value" id="value" class="form-control" value="{{ old('value', $attributeValue->value) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection