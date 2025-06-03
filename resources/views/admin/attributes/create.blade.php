@extends('admin.layout.admin')

@section('content')
<div class="container">
    <h2>Add Attribute Value</h2>
    <form action="{{ route('admin.attributes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="attribute_id" class="form-label">Attribute</label>
            <select name="attribute_id" id="attribute_id" class="form-control" required>
                <option value="">-- Select Attribute --</option>
                @foreach($attributes as $attribute)
                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="text" name="value" id="value" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection