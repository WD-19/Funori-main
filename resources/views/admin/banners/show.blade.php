@extends('admin.layout.admin')
@section('title', 'Chi tiết Banner')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap-20 mb-30">
            <h3 class="text-lg font-semibold">Chi tiết Banner</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap-10">
                <li>
                    <a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Bảng điều khiển</div></a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="{{ route('admin.banners.index') }}"><div class="text-tiny">Banner</div></a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Chi tiết</div>
                </li>
            </ul>
        </div>
        <div class="wg-box" style="max-width:600px;margin:auto;">
            <div class="mb-4 text-center">
                <img src="{{ asset('storage/' . $banner->image_url) }}" alt="" style="max-width:100%;height:auto;border-radius:8px;">
            </div>
            <div class="mb-3">
                <strong>Tiêu đề:</strong> {{ $banner->title }}
            </div>
            <div class="mb-3">
                <strong>Link:</strong>
                @if($banner->link)
                    <a href="{{ $banner->link }}" target="_blank" class="text-blue-600 underline">{{ $banner->link }}</a>
                @else
                    <span>-</span>
                @endif
            </div>
            <div class="mb-3">
                <strong>Vị trí:</strong> {{ $banner->position }}
            </div>
            <div class="mb-3">
                <strong>Thứ tự:</strong> {{ $banner->order }}
            </div>
            <div class="mb-3">
                <strong>Thời gian sử dụng:</strong>
                <div>
                    {{ $banner->start_at ? \Carbon\Carbon::parse($banner->start_at)->format('d/m/Y H:i') : '-' }}
                    &rarr;
                    {{ $banner->end_at ? \Carbon\Carbon::parse($banner->end_at)->format('d/m/Y H:i') : '-' }}
                </div>
            </div>
            <div class="mb-3">
                <strong>Trạng thái:</strong>
                @if($banner->is_active)
                    <span class="badge bg-success">Hiện</span>
                @else
                    <span class="badge bg-secondary">Ẩn</span>
                @endif
            </div>
            <div class="mt-4 flex gap-2">
                <a href="{{ route('admin.banners.index') }}" class="tf-button style">Quay lại</a>
            </div>
        </div>
    </div>
</div>
@endsection
