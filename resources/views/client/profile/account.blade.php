@extends('client.profile.profile_base') {{-- Đảm bảo extends đúng layout --}}

@section('title', 'Thông tin tài khoản')

@section('content_profile')
    <div class="account-content-wrapper"> {{-- Đổi từ my-account-content sang account-content-wrapper để đồng bộ CSS --}}
        <h3 class="section-heading">Thông tin tài khoản</h3>
        <p class="section-description">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
        <hr class="my-4"> {{-- Thêm class my-4 cho khoảng cách tốt hơn --}}

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('client.profile.account.update') }}" method="POST" enctype="multipart/form-data">
            {{-- THÊM enctype cho upload file --}}
            @csrf
            <div class="row">
                <div class="col-md-4 text-center"> {{-- Cột cho Avatar --}}
                    <div class="profile-avatar-upload mb-4">
                        <label for="avatarInput" style="cursor:pointer;">
                            <img id="avatarPreview"
                                src="{{ $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/images.jpg') }}"
                                alt="Ảnh đại diện" class="img-fluid rounded-circle avatar-lg-preview">
                        </label>
                        <input type="file" id="avatarInput" name="avatar_url" accept="image/*" style="display:none;">
                        @error('avatar_url')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-8"> {{-- Cột cho các trường thông tin --}}
                    <div class="form-group">
                        <label for="full_name">Họ và tên</label>
                        <input type="text" class="form-control" id="full_name" name="full_name"
                            value="{{ old('full_name', $user->full_name ?? '') }}" required>
                        @error('full_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            value="{{ old('phone_number', $user->phone_number ?? '') }}" required>
                        @error('phone_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $user->email ?? '') }}" readonly> {{-- Email thường là readonly --}}
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 mt-4">Lưu thay đổi</button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var input = document.getElementById('avatarInput');
                var preview = document.getElementById('avatarPreview');
                if (input && preview) {
                    input.addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file && file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }
            });
        </script>
    @endpush
    <style>
        /* Account Content Wrapper (khung chứa toàn bộ nội dung của trang profile cụ thể) */
        .account-content-wrapper {
            padding: 30px;

        }

        /* Tiêu đề chính của trang */
        .account-content-wrapper .section-heading {
            font-size: 2.2em;
            /* Kích thước lớn hơn */
            font-weight: 700;
            /* Rất đậm */
            color: #212529;
            /* Màu tối hơn cho sự sang trọng */
            margin-bottom: 10px;
            position: relative;
            /* Để tạo đường gạch dưới giả */
            padding-bottom: 10px;
            /* Khoảng cách cho đường gạch */
        }

        .account-content-wrapper .section-heading::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            /* Độ dài đường gạch */
            height: 4px;
            /* Độ dày đường gạch */

            /* Màu đỏ nổi bật */
            border-radius: 2px;
        }


        /* Mô tả dưới tiêu đề */
        .account-content-wrapper .section-description {
            font-size: 1.1em;
            /* Kích thước dễ đọc */
            color: #6c757d;
            /* Màu xám dịu */
            margin-bottom: 25px;
            /* Khoảng cách với HR */
        }

        /* Đường phân cách ngang */
        .account-content-wrapper hr.my-4 {
            border-top: 1px solid #e9ecef;
            /* Màu nhạt hơn */
            margin-top: 30px;
            /* Khoảng cách trên */
            margin-bottom: 30px;
            /* Khoảng cách dưới */
        }

        /* ================== */
        /* Phần Avatar Upload */
        /* ================== */
        .profile-avatar-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Căn giữa theo chiều ngang */
            margin-bottom: 30px;
            /* Khoảng cách với form */
            padding: 20px;
            background-color: #f8f9fa;
            /* Nền nhẹ cho vùng avatar */
            border-radius: 10px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
            /* Bóng đổ vào trong */
        }

        .avatar-lg-preview {
            width: 180px;
            /* Kích thước avatar RẤT LỚN */
            height: 180px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid rgba(255, 48, 41, 0.15);
            /* Viền đỏ dày hơn */
            padding: 4px;
            /* Đệm bên trong viền */
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            /* Bóng đổ mạnh cho avatar */
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            /* Cho biết có thể tương tác */
        }

        .avatar-lg-preview:hover {
            transform: scale(1.05);
            /* Phóng to nhẹ khi hover */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Nút chọn ảnh mới */
        .profile-avatar-upload .btn-secondary {
            background-color: #6c757d;
            /* Màu xám mặc định */
            color: white;
            padding: 10px 25px;
            /* Đệm lớn hơn */
            border: none;
            border-radius: 8px;
            /* Bo tròn góc */
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 20px;
            /* Khoảng cách từ ảnh */
        }

        .profile-avatar-upload .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            /* Hiệu ứng nổi nhẹ */
        }

        /* ================== */
        /* Form Fields */
        /* ================== */
        .form-group {
            margin-bottom: 1.8rem;
            /* Khoảng cách lớn hơn giữa các nhóm form */
        }

        .form-group label {
            display: block;
            /* Đảm bảo label nằm trên input */
            margin-bottom: 8px;
            /* Khoảng cách từ label đến input */
            font-weight: 600;
            /* Chữ label đậm hơn */
            color: #495057;
            /* Màu label rõ ràng */
            font-size: 0.95em;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 12px 15px;
            /* Đệm lớn hơn cho input */
            font-size: 1em;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            /* Viền mỏng */
            border-radius: 8px;
            /* Bo tròn góc input */
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            /* Màu focus của Bootstrap */
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            /* Box shadow khi focus */
        }

        .form-control[readonly] {
            background-color: #e9ecef;
            /* Màu nền cho input readonly */
            opacity: 1;
            /* Đảm bảo không bị mờ */
            cursor: not-allowed;
            /* Biểu tượng cấm chỉnh sửa */
        }

        .text-danger {
            font-size: 0.875em;
            /* Kích thước nhỏ hơn cho lỗi */
            color: #dc3545;
            /* Màu đỏ của lỗi */
            margin-top: 5px;
            /* Khoảng cách từ input */
        }

        /* ================== */
        /* Button Submit */
        /* ================== */
        .tf-btn.btn-fill {
            background-color: #ff3029;
            /* Màu đỏ nổi bật */
            color: white;
            border: 1px solid #ff3029;
            padding: 12px 30px;
            /* Đệm lớn hơn */
            font-size: 1.1em;
            /* Font size lớn hơn */
            font-weight: 700;
            /* Rất đậm */
            border-radius: 8px;
            /* Bo tròn góc */
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 15px rgba(255, 48, 41, 0.3);
            /* Bóng đổ cho nút */
        }

        .tf-btn.btn-fill:hover {
            background-color: #e02a24;
            /* Màu đỏ đậm hơn khi hover */
            border-color: #e02a24;
            box-shadow: 0 6px 20px rgba(255, 48, 41, 0.4);
            /* Bóng đổ mạnh hơn khi hover */
            transform: translateY(-2px);
            /* Hiệu ứng nổi nhẹ */
        }

        /* ================== */
        /* Alert Messages */
        /* ================== */
        .alert {
            padding: 15px 20px;
            margin-bottom: 25px;
            /* Khoảng cách dưới */
            border: 1px solid transparent;
            border-radius: 8px;
            /* Bo tròn góc */
            font-size: 1em;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 20px;
        }
    </style>
@endsection
