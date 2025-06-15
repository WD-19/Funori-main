@extends('admin.layout.admin')
@section('title', 'Quản lý Banner')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap-20 mb-30">
            <div>
                <h3 class="text-lg font-semibold">Danh sách Banner</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap-10 mt-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Bảng điều khiển</div></a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Banner</div>
                    </li>
                </ul>
            </div>
            <a href="{{ route('admin.banners.create') }}" class="tf-button">+ Thêm banner mới</a>
        </div>

        <form method="get" class="flex flex-wrap gap-4 mb-4">
            <select name="position" class="form-select" style="min-width:140px;">
                <option value="">-- Vị trí --</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos }}" @if(request('position')==$pos) selected @endif>{{ $pos }}</option>
                @endforeach
            </select>
            <select name="is_active" class="form-select" style="min-width:120px;">
                <option value="">-- Trạng thái --</option>
                <option value="1" @if(request('is_active')==='1') selected @endif>Hiện</option>
                <option value="0" @if(request('is_active')==='0') selected @endif>Ẩn</option>
            </select>
            <button class="tf-button" type="submit">Lọc</button>
        </form>
        <div class="wg-box">
            <div class="wg-table table-all-category mt-2">
                <ul class="table-title flex gap10 mb-14" style="background:#f3f4f6;">
                    <li style="min-width:100px"><div class="body-title">Ảnh</div></li>
                    <li style="min-width:160px"><div class="body-title">Tiêu đề</div></li>
                    <li style="min-width:100px"><div class="body-title">Vị trí</div></li>
                    <li style="min-width:70px"><div class="body-title">Thứ tự</div></li>
                    <li style="min-width:180px"><div class="body-title">Thời gian sử dụng</div></li>
                    <li style="min-width:90px"><div class="body-title">Trạng thái</div></li>
                    <li style="min-width:140px"><div class="body-title">Hành động</div></li>
                </ul>
                <ul class="flex flex-column">
                    @forelse($banners as $banner)
                    <li class="wg-product item-row gap10" style="align-items:center; border-bottom:1px solid #eee; padding:12px 0;">
                        <div style="min-width:100px">
                            <div class="image" style="width:60px;height:32px;border-radius:4px;overflow:hidden;background:#f3f4f6;">
                                <img src="{{ asset('storage/' . $banner->image_url) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                        </div>
                        <div class="body-text" style="min-width:160px">{{ $banner->title }}</div>
                       
                        <div style="min-width:100px"><span class="badge bg-info">{{ $banner->position }}</span></div>
                        <div style="min-width:70px"><span class="badge bg-light text-dark">{{ $banner->order }}</span></div>
                        <div style="min-width:180px">
                            <div class="text-tiny">
                                {{ $banner->start_date ? \Carbon\Carbon::parse($banner->start_date)->format('d/m/Y H:i') : '-' }}
                                <br>
                                {{ $banner->end_date ? \Carbon\Carbon::parse($banner->end_date)->format('d/m/Y H:i') : '-' }}
                            </div>
                        </div>
                        <div style="min-width:90px">
                            <form method="post" action="{{ route('admin.banners.toggle', $banner->id) }}" class="d-inline">
                                @csrf
                                <label class="switch">
                                    <input type="checkbox" onchange="this.form.submit()" {{ $banner->is_active ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </form>
                        </div>
                        <div class="list-icon-function" style="min-width:140px">
                            <a href="{{ route('admin.banners.show', $banner->id) }}" class="item eye" title="Xem chi tiết"><i class="icon-eye"></i></a>
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="item edit" title="Sửa"><i class="icon-edit-3"></i></a>
                            <form method="post" action="{{ route('admin.banners.destroy', $banner->id) }}" onsubmit="return confirm('Xác nhận xóa?')" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="item trash" type="submit" title="Xóa" style="background:none;border:none;padding:0;"><i class="icon-trash-2"></i></button>
                            </form>
                        </div>
                    </li>
                    @empty
                    <li>
                        <div class="body-text text-center py-4">Chưa có banner nào.</div>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 38px;
  height: 22px;
  vertical-align: middle;
}
.switch input {display:none;}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .3s;
  border-radius: 22px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 16px; width: 16px;
  left: 3px; bottom: 3px;
  background-color: white;
  transition: .3s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #10b981;
}
input:checked + .slider:before {
  transform: translateX(16px);
}
</style>
@endsection
