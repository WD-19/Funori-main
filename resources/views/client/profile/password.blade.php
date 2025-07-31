@extends('client.profile.profile_base')

@section('page_title', 'Đổi Mật Khẩu')

@section('content_profile')
    <div class="my-account-content account-edit py-5">
        <div class="container">

            <div class="card-body">
                <div class="text-center mb-4">
                    <span class="d-inline-block mb-2" style="font-size:2.5rem;color:#ff3029;">
                        <i class="bx bx-lock-alt"></i>
                    </span>
                    <h3 class="card-title fw-bold mb-1" style="color:#222;">Đổi Mật Khẩu</h3>
                    <div class="text-muted mb-2" style="font-size:1em;">Vui lòng nhập đầy đủ thông tin để đổi mật khẩu mới.
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="form-password-change" action="{{ route('client.profile.password.update') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="current_password" name="current_password"
                            placeholder="Mật khẩu hiện tại">
                        <label for="current_password">Mật khẩu hiện tại</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="new_password" name="new_password"
                            placeholder="Mật khẩu mới">
                        <label for="new_password">Mật khẩu mới</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="confirm_new_password" name="new_password_confirmation"
                            placeholder="Xác nhận mật khẩu mới">
                        <label for="confirm_new_password">Xác nhận mật khẩu mới</label>
                    </div>
                    <div class="d-flex justify-content-center"> {{-- Thẻ div này được thêm vào để canh giữa --}}
                        <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 mt-4">Lưu thay đổi</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 1.25rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.10);
            border: none;
        }

        .form-floating>label {
            color: #888;
            font-weight: 500;
        }

        .form-control {
            border-radius: 0.75rem;
            padding: 0.85rem 1rem;
            border: 1.5px solid #e0e0e0;
            font-size: 1.05em;
            background: #fafbfc;
            color: #222;
            transition: border 0.2s;
        }

        .form-control:focus {
            border-color: #ff3029;
            box-shadow: 0 0 0 0.15rem rgba(255, 48, 41, 0.13);
            background: #fff;
        }

        .alert {
            font-size: 1em;
            border-radius: 0.5rem;
            margin-bottom: 1.2rem;
        }

        .save {
            background: red;

        }

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
            text-align: center;
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

        @media (max-width: 576px) {
            .card-body {
                padding: 1.2rem !important;
            }

            .form-control {
                font-size: 1em;
                padding: 0.7rem 0.8rem;
            }

            .btn-save-change {
                font-size: 1em;
                padding: 10px 24px;
                min-width: 120px;
            }
        }
    </style>
@endpush
