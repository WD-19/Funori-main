@extends('client.profile.profile_base') {{-- Đã thay đổi --}}

@section('title', 'Thông báo của tôi')

@section('content_profile')
    <div class="account-content-wrapper">
        <div class="section-heading">Thông báo của tôi</div>
        <p class="section-description">Các thông báo mới nhất về tài khoản và hoạt động của bạn.</p>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- @if($notifications->count() > 0)
            <div class="notification-list">
                @foreach($notifications as $notification)
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6 class="card-title">{{ $notification->title }}</h6>
                            <p class="card-text">{{ $notification->message }}</p>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                Bạn chưa có thông báo mới nào.
            </div>
        @endif --}}
    </div>
@endsection