{{-- filepath: resources/views/admin/chat_suggestions/index.blade.php --}}
@extends('admin.layout.admin')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold" style="font-size:2.5rem;">Gợi ý chat</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.chat-suggestions.store') }}" class="flex items-center gap-2 mb-4">
        @csrf
        <input type="text" name="content" class="form-control form-control-lg rounded-pill shadow-sm flex-grow-1" placeholder="Nhập gợi ý mới" required>
        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
            <i class="fa fa-plus"></i> Thêm
        </button>
    </form>

    <div class="wg-table table-product-list" style="min-width: max-content;">
        <ul class="table-title flex gap2 mb-10" style="min-width: max-content;">
            <li style="width: 60%;"><div class="body-title" style="font-size:1.3rem;">Nội dung gợi ý</div></li>
            <li style="width: 40%;" class="text-end"><div class="body-title" style="font-size:1.3rem;">Thao tác</div></li>
        </ul>
        <ul class="flex flex-column" style="min-width: max-content;">
            @forelse($suggestions as $suggestion)
                <li class="wg-product item-row gap2 align-items-center" style="display: flex; min-height: 70px;">
                    {{-- Nội dung gợi ý --}}
                    <div style="width: 60%;">
                        <form method="POST" action="{{ route('admin.chat-suggestions.update', $suggestion) }}" class="d-flex align-items-center gap-2">
                            @csrf @method('PUT')
                            <input type="text" name="content" value="{{ $suggestion->content }}"
                                class="form-control border-0 bg-white rounded-pill px-4 py-3 shadow-sm"
                                style="max-width: 600px; font-size:1.5rem; height: 56px; transition: box-shadow 0.2s;"
                                onfocus="this.style.boxShadow='0 0 0 0.2rem #0d6efd33'"
                                onblur="this.style.boxShadow='none'">
                            <button type="submit" class="btn btn-success btn-lg rounded-circle ms-2" title="Lưu sửa" style="width:48px; height:48px;">
                                <i class="fa fa-check" style="font-size:1.3rem;"></i>
                            </button>
                        </form>
                    </div>
                    {{-- Thao tác --}}
                    <div style="width: 40%;" class="text-end">
                        <form method="POST" action="{{ route('admin.chat-suggestions.destroy', $suggestion) }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg rounded-circle" onclick="return confirm('Xóa gợi ý này?')" title="Xóa" style="width:48px; height:48px;">
                                <i class="fa fa-trash" style="font-size:1.3rem;"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li>
                    <div class="text-center text-muted py-3" style="font-size:1.2rem;">Chưa có gợi ý nào.</div>
                </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection