@extends('client.layout.client') {{-- Kế thừa từ layout client chung của bạn --}}

{{-- Bạn có thể ghi đè tiêu đề ở đây hoặc để các trang con tự định nghĩa --}}
@section('title', $pageTitle ?? 'Tài khoản của tôi')

@section('content') {{-- Đây là section 'content' mà client.blade.php cung cấp --}}
    {{-- Nếu bạn muốn có một tiêu đề trang lớn ở đầu cho riêng khu vực profile, thêm nó vào đây --}}
    {{-- Ví dụ: --}}
  
    <section class="flat-spacing-11 py-5 profile">
        <div class="container1 mx-auto px-4 profile">
            <div class="row d-flex">
                {{-- Cột bên trái: Sidebar Điều Hướng --}}
                <div class="col-lg-4 col-md-4">
                    @include('client.profile.sidebar')
                </div>

                {{-- Cột bên phải: Nội dung Profile Cụ thể --}}
                <div class="col-lg-8 col-md-8 right">
                    @yield('content_profile') {{-- Section này sẽ được định nghĩa bởi các trang profile con --}}
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Bạn có thể thêm các script hoặc style đặc biệt cho profile ở đây, nếu client.blade.php có @stack('scripts') --}}
@push('scripts')
    {{-- <script src="{{ asset('js/profile_specific.js') }}"></script> --}}
@endpush

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/profile_specific.css') }}"> --}}
@endpush

<style>
.right
{
    background-color: #ffffff; /* Nền trắng */
    border-radius: 12px; /* Bo tròn góc nhiều hơn */
    box-shadow: 0 5px 35px rgb(16 16 16 / 46%); /* Bóng đổ mạnh và rõ ràng hơn */
    padding: 25px 20px; /* Đệm trên dưới */
    display: flex;
    flex-direction: column;
    overflow: hidden; /* Ngăn chặn nội dung tràn ra ngoài nếu quá lớn */
}
.profile
{
    padding-left: 50px;
    padding-right: 50px;
}
</style>