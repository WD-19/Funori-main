{{-- filepath: c:\laragon\www\Funori-main\resources\views\admin\users\edit.blade.php --}}
@extends('admin.layout.admin')

@section('title', 'Sửa user')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Edit User</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <div class="text-tiny">User List</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit User</div>
                    </li>
                </ul>
            </div>
            <!-- edit-user -->
            @php
                $isSelf = auth()->id() == $user->id;
                $isEditingAdmin = $user->role === 'admin';
                $isCurrentAdmin = auth()->user()->role === 'admin';
            @endphp

            <form class="form-add-new-user form-style-2" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Tài khoản</h5>
                        <div class="body-text1">
                            @if($isSelf)
                                Bạn chỉ có thể chỉnh sửa thông tin cá nhân.
                            @elseif($isEditingAdmin)
                                Không thể chỉnh sửa thông tin của admin khác.
                            @else
                                Bạn chỉ có thể chỉnh sửa quyền và trạng thái tài khoản.
                            @endif
                        </div>
                        <div class="avatar-upload mt-3 mb-4">
                            <label @if($isSelf) for="avatarInput" style="cursor:pointer;" @endif>
                                <img src="{{ asset($user->avatar_url ? $user->avatar_url : 'images/images.jpg') }}"
                                    alt="Avatar" class="avatar-preview" id="avatarPreview">
                            </label>
                            @if($isSelf)
                                <input type="file" id="avatarInput" name="avatar_url" accept="image/*"
                                style="display: none;">
                            @endif
                        </div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Tên người dùng</div>
                            <input class="flex-grow" type="text" name="full_name" value="{{ $user->full_name }}"
                                @if(!$isSelf) readonly @endif>
                        </fieldset>
                        <fieldset class="email mb-24">
                            <div class="body-title mb-10">Email</div>
                            <input class="flex-grow" type="email" name="email" value="{{ $user->email }}"
                                @if(!$isSelf) readonly @endif>
                        </fieldset>
                        <fieldset class="phone mb-24">
                            <div class="body-title mb-10">Số điện thoại</div>
                            <input class="flex-grow" type="text" name="phone_number" value="{{ $user->phone_number }}"
                                @if(!$isSelf) readonly @endif>
                        </fieldset>
                        <fieldset class="password mb-24">
                            <div class="body-title mb-10">Mật khẩu</div>
                            <div class="password-input-wrapper">
                                <input class="password-input" type="password" placeholder="Password" name="password"
                                    value="*********" readonly id="passwordInput" style="padding-right: 36px;">
                                @if($isSelf)
                                    <span id="resetPasswordIcon" title="Reset password" style="font-size: 18px">
                                        <i class="fas fa-sync-alt"></i>
                                    </span>
                                @endif
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Quyền & Trạng thái tài khoản</h5>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Trạng thái tài khoản</div>
                            <div class="radio-buttons">
                                <div class="item">
                                    <input type="radio" name="account_status" id="apply-product1" value="active"
                                        {{ old('account_status', $user->account_status) == 'active' ? 'checked' : '' }}
                                        @if($isSelf || $isEditingAdmin) disabled @endif>
                                    <label for="apply-product1"><span class="body-title-2">Active</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="account_status" id="apply-product2" value="inactive"
                                        {{ old('account_status', $user->account_status) == 'inactive' ? 'checked' : '' }}
                                        @if($isSelf || $isEditingAdmin) disabled @endif>
                                    <label for="apply-product2"><span class="body-title-2">Inactive</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="account_status" id="apply-product3" value="banned"
                                        {{ old('account_status', $user->account_status) == 'banned' ? 'checked' : '' }}
                                        @if($isSelf || $isEditingAdmin) disabled @endif>
                                    <label for="apply-product3"><span class="body-title-2">Banned</span></label>
                                </div>
                            </div>
                            @error('account_status')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        <fieldset>
                            <div class="body-title mb-10">Quyền</div>
                            <div class="radio-buttons">
                                <div class="item">
                                    <input type="radio" name="role" id="create-product1" value="admin"
                                        {{ old('role', $user->role) == 'admin' ? 'checked' : '' }}
                                        @if($isSelf || $isEditingAdmin) disabled @endif>
                                    <label for="create-product1"><span class="body-title-2">Admin</span></label>
                                </div>
                                <div class="item">
                                    <input type="radio" name="role" id="create-product2" value="user"
                                        {{ old('role', $user->role) == 'user' ? 'checked' : '' }}
                                        @if($isSelf || $isEditingAdmin) disabled @endif>
                                    <label for="create-product2"><span class="body-title-2">User</span></label>
                                </div>
                            </div>
                            @error('role')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="bot">
                    <a href="{{ route('admin.users.index') }}" class="tf-button w180">Back</a>
                    <button class="tf-button w180" type="submit">Save</button>
                </div>
            </form>
            <!-- /edit-user -->
            <!-- Modal đặt lại mật khẩu -->
            <div id="resetPasswordModal"
                style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); align-items:center; justify-content:center;">
                <div
                    style="background:#fff; padding:48px 36px 36px 36px; border-radius:18px; min-width:420px; max-width:98vw; box-shadow:0 12px 48px rgba(0,0,0,0.18); position:relative;">
                    <span id="closeResetModal"
                        style="position:absolute; top:12px; right:16px; font-size:28px; cursor:pointer; line-height:1; background:none; border:none; font-family:sans-serif;">
                        &times;
                    </span>



                    <h3 style="margin-bottom:28px; font-size:2.5rem;">Reset Password</h3>
                    <form id="resetPasswordForm" method="POST"
                        action="{{ route('admin.users.resetPassword', $user->id) }}">
                        @csrf
                        <div style="margin-bottom:20px;">
                            <label style="font-weight:700; font-size: 10px;">Old Password</label>
                            <input type="password" name="old_password" class="form-control strong-input" required
                                style="width:100%;margin-top:8px; background-color: #e5e2e2;">
                        </div>
                        <div style="margin-bottom:20px;">
                            <label style="font-weight:700; font-size: 10px;">New Password</label>
                            <input type="password" name="new_password" class="form-control strong-input" required
                                style="width:100%;margin-top:8px; background-color: #e5e2e2;">
                        </div>
                        <div style="margin-bottom:28px;">
                            <label style="font-weight:600; font-size: 10px;">Confirm Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control strong-input"
                                required style="width:100%;margin-top:8px; background-color: #e5e2e2;">
                        </div>

                        <button type="submit" class="tf-button w100" style="font-size:1.1rem;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Avatar preview
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

            // Reset password modal
            var resetIcon = document.getElementById('resetPasswordIcon');
            var resetModal = document.getElementById('resetPasswordModal');
            var closeModal = document.getElementById('closeResetModal');

            if (resetIcon && resetModal) {
                resetIcon.addEventListener('click', function() {
                    resetModal.style.display = 'flex';
                });
            }
            if (closeModal && resetModal) {
                closeModal.addEventListener('click', function() {
                    resetModal.style.display = 'none';
                });
            }
            // Đóng modal khi click ra ngoài
            window.onclick = function(event) {
                if (event.target === resetModal) {
                    resetModal.style.display = 'none';
                }
            }
        });
    </script>
@endpush


