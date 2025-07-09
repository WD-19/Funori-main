@extends('client.profile.index')

@section('content_profile')
    <style>
        /* Nút Lưu đẹp và hiệu ứng */
        #save-btn {
            background: linear-gradient(90deg, #4f8cff 0%, #38c8fa 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 32px;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.3s, box-shadow 0.3s, transform 0.2s;
            box-shadow: 0 2px 8px rgba(79, 140, 255, 0.08);
        }

        #save-btn:hover {
            background: linear-gradient(90deg, #38c8fa 0%, #4f8cff 100%);
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 4px 16px rgba(56, 200, 250, 0.15);
        }

        /* Hiệu ứng khi đang sửa */
        .editing {
            border: 2px solid #38c8fa !important;
            background: #f0fbff !important;
            transition: border 0.2s, background 0.2s;
        }

        /* Nút sửa đẹp hơn */
        .edit-btn {
            color: #4f8cff !important;
            background: #f0f7ff;
            border: 1px solid #cce1ff;
            border-radius: 4px;
            padding: 4px 18px;
            font-weight: 500;
            transition: background 0.2s, color 0.2s, border 0.2s;
            margin-left: 8px;
        }

        .edit-btn.text-primary,
        .edit-btn.active {
            background: linear-gradient(90deg, #38c8fa 0%, #4f8cff 100%);
            color: #fff !important;
            border: 1px solid #38c8fa;
        }
    </style>
    <div class="my-account-content account-edit">
        <div class="row">
            <div class="col-md-8">
                <form id="form-account-info" action="{{ route('client.profile.account.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="tf-field style-1 mb_15 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <label class="" for="full_name">Tên người dùng</label>
                            <input class="tf-field-input tf-input" placeholder="Tên người dùng" type="text"
                                id="full_name" name="full_name" value="{{ Auth::user()->full_name }}" readonly data-original="{{ Auth::user()->full_name }}">
                        </div>
                        <button type="button" class="edit-btn ms-2" onclick="enableEdit('full_name', this)">Sửa</button>
                    </div>
                    <div class="tf-field style-1 mb_15 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <label class="" for="email">Email</label>
                            <input class="tf-field-input tf-input" placeholder="Email" type="email" id="email"
                                name="email" value="{{ Auth::user()->email }}" readonly data-original="{{ Auth::user()->email }}">
                        </div>
                        <button type="button" class="edit-btn ms-2" onclick="enableEdit('email', this)">Sửa</button>
                    </div>
                    <div class="tf-field style-1 mb_15 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <label class="" for="phone_number">Số điện thoại</label>
                            <input class="tf-field-input tf-input" placeholder="Số điện thoại" type="text"
                                id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}" readonly data-original="{{ Auth::user()->phone_number }}">
                        </div>
                        <button type="button" class="edit-btn ms-2" onclick="enableEdit('phone_number', this)">Sửa</button>
                    </div>
                    <div class="tf-field style-1 mb_15 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <!-- Đã bỏ label "Ảnh đại diện" và input file sẽ chuyển xuống dưới hình ảnh -->
                        </div>
                    </div>

            </div>
            <div class="col-md-4 text-center">
                <div class="avatar-section">
                    @if (Auth::user()->avatar_url)
                        <img src="{{ asset(Auth::user()->avatar_url) }}" alt="Avatar" class="rounded-circle"
                            width="120" height="120" id="avatar-preview">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="rounded-circle"
                            width="120" height="120" id="avatar-preview">
                    @endif
                    <div class="mt-3">
                        <input class="form-control d-inline-block w-auto" type="file" id="avatar" name="avatar"
                            accept="image/png, image/jpeg" style="margin: 0 auto;">
                        <div class="text-muted small mt-1">Dung lượng file tối đa 1 MB<br>Định dạng: .JPEG, .PNG</div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" id="save-btn" style="display:none;">Lưu</button>
            </form>
        </div>
    </div>
    <script>
        // Khi bấm Sửa, chỉ 1 trường được sửa, bấm lại sẽ quay về trạng thái ban đầu
        function enableEdit(field, btn) {
            var input = document.getElementById(field);
            var isEditing = input.classList.contains('editing');
            // Nếu đang sửa trường này, bấm lại sẽ khóa lại và khôi phục giá trị gốc
            if (isEditing) {
                input.setAttribute('readonly', true);
                input.classList.remove('editing');
                btn.classList.remove('text-primary', 'active');
                // Khôi phục giá trị gốc
                input.value = input.getAttribute('data-original');
                document.getElementById('save-btn').style.display = 'none';
                return;
            }
            // Đặt lại tất cả input readonly và bỏ class editing, đồng thời khôi phục giá trị gốc
            document.querySelectorAll('.tf-field-input').forEach(el => {
                el.setAttribute('readonly', true);
                el.classList.remove('editing');
                if (el.hasAttribute('data-original')) {
                    el.value = el.getAttribute('data-original');
                }
            });
            // Đặt lại tất cả nút sửa về mặc định
            document.querySelectorAll('.edit-btn').forEach(b => b.classList.remove('text-primary', 'active'));
            // Đặt trường đang sửa
            input.removeAttribute('readonly');
            input.classList.add('editing');
            input.focus();
            document.getElementById('save-btn').style.display = 'block';
            if (btn) btn.classList.add('text-primary', 'active');
        }
        // Hiển thị ảnh preview khi chọn file mới
        document.getElementById('avatar').addEventListener('change', function(e) {
            const [file] = e.target.files;
            if (file) {
                document.getElementById('avatar-preview').src = URL.createObjectURL(file);
                document.getElementById('save-btn').style.display = 'block';
            }
        });
    </script>
@endsection
