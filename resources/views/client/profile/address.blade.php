@extends('client.profile.index')

@section('page_title', 'Địa chỉ')

@section('content_profile')
    <div class="my-account-content account-address">
        <div class="text-center widget-inner-address">
            <button class="tf-btn btn-fill animate-hover-btn btn-address mb_20" id="btnShowAddAddress">Thêm địa chỉ
                mới</button>
            <form class="show-form-address wd-form-address" id="formnewAddress"
                action="{{ route('client.profile.address.store') }}" method="POST" style="display:none">
                @csrf
                <div class="title">Thêm địa chỉ mới</div>
                <div class="box-field">
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" type="text" name="receiver_name" id="receiver_name"
                            value="{{ old('receiver_name') }}" required>
                        <label class="tf-field-label fw-4 text_black-2">Họ và tên</label>
                    </div>
                </div>
                <div class="box-field">
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" type="text" name="receiver_phone" id="receiver_phone"
                            value="{{ old('receiver_phone') }}" required>
                        <label class="tf-field-label fw-4 text_black-2">Số điện thoại</label>
                    </div>
                </div>
                <div class="box-field">
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" type="text" name="street_address" id="street_address"
                            value="{{ old('street_address') }}" required>
                        <label class="tf-field-label fw-4 text_black-2">Địa chỉ cụ thể</label>
                    </div>
                </div>
                <div class="box-field text-start">
                    <div class="box-checkbox fieldset-radio d-flex align-items-center gap-8">
                        <input type="checkbox" id="check-new-address" name="is_default" value="1" class="tf-check"
                            {{ old('is_default') ? 'checked' : '' }}>
                        <label for="check-new-address" class="text_black-2 fw-4">Đặt làm địa chỉ mặc định</label>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center gap-20">
                    <button type="submit" class="tf-btn btn-fill animate-hover-btn">Lưu địa chỉ</button>
                    <span class="tf-btn btn-fill animate-hover-btn btn-hide-address" style="cursor:pointer">Hủy</span>
                </div>
            </form>
            <div class="list-account-address">
                @forelse($addresses as $address)
                    <div class="account-address-item" style="border-bottom:1px solid #eee; padding:16px 0;">
                        <div>
                            <strong>{{ $address->receiver_name }}</strong>
                            <span style="color:gray;">| {{ $address->receiver_phone }}</span>
                        </div>
                        <div>{{ $address->street_address }}</div>
                        @if ($address->is_default)
                            <div>
                                <span
                                    style="color:#e74c3c; border:1px solid #e74c3c; border-radius:3px; padding:2px 6px; font-size:12px;">Mặc
                                    định</span>
                            </div>
                        @endif
                        <div style="margin-top:8px;">
                            <a href="#" class="edit-address-btn" data-id="{{ $address->id }}"
                                style="color:#3498db; margin-right:8px;">Cập nhật</a>
                            <form action="{{ route('client.profile.address.destroy', $address->id) }}" method="POST"
                                class="d-inline delete-address-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="color:#e74c3c; background:none; border:none; cursor:pointer;">Xóa</button>
                            </form>
                            @if (!$address->is_default)
                                <form action="{{ route('client.profile.address.setDefault', $address->id) }}"
                                    method="POST" class="d-inline set-default-address-form" style="display:inline;">
                                    @csrf
                                    <button type="submit"
                                        style="border:1px solid #888; border-radius:3px; padding:2px 8px; background:#fff; cursor:pointer;">Thiết
                                        lập mặc định</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div>Bạn chưa có địa chỉ nào.</div>
                @endforelse
            </div>

        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="editAddressModal"
        style="display:none; position:fixed; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:9999; align-items:center; justify-content:center;">
        <div
            style="background:#fff; padding:32px; border-radius:8px; min-width:350px; max-width:90vw; margin:auto; position:relative;">
            <h4>Cập nhật địa chỉ</h4>
            <form id="editAddressForm">
                @csrf
                <input type="hidden" id="edit_address_id">
                <div class="box-field">
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" type="text" name="receiver_name" id="edit_receiver_name"
                            required>
                        <label class="tf-field-label fw-4 text_black-2">Họ và tên</label>
                    </div>
                </div>
                <div class="box-field">
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" type="text" name="receiver_phone" id="edit_receiver_phone"
                            required>
                        <label class="tf-field-label fw-4 text_black-2">Số điện thoại</label>
                    </div>
                </div>
                <div class="box-field">
                    <div class="tf-field style-1">
                        <input class="tf-field-input tf-input" type="text" name="street_address" id="edit_street_address"
                            required>
                        <label class="tf-field-label fw-4 text_black-2">Địa chỉ cụ thể</label>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center gap-20" style="margin-top:16px;">
                    <button type="submit" class="tf-btn btn-fill animate-hover-btn">Lưu thay đổi</button>
                    <span class="tf-btn btn-fill animate-hover-btn" id="closeEditModal"
                        style="cursor:pointer; background:#eee; color:#333;">Hủy</span>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('btnShowAddAddress').onclick = function() {
            document.getElementById('formnewAddress').style.display = 'block';
            this.style.display = 'none';
        };
        document.querySelector('.btn-hide-address').onclick = function() {
            document.getElementById('formnewAddress').style.display = 'none';
            document.getElementById('btnShowAddAddress').style.display = 'inline-block';
        };
    </script>
    <script>
        document.getElementById('formnewAddress').onsubmit = async function(e) {
            e.preventDefault();
            let form = this;
            let data = new FormData(form);

            // Xóa thông báo lỗi cũ
            let alertDiv = document.querySelector('.alert.alert-danger');
            if (alertDiv) alertDiv.remove();

            // Gửi AJAX
            let response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: data
            });

            if (response.status === 422) {
                let result = await response.json();
                // Hiển thị lỗi
                let errorHtml = '<div class="alert alert-danger"><ul>';
                Object.values(result.errors).forEach(function(msgArr) {
                    msgArr.forEach(function(msg) {
                        errorHtml += '<li>' + msg + '</li>';
                    });
                });
                errorHtml += '</ul></div>';
                form.insertAdjacentHTML('beforebegin', errorHtml);
                // Giữ lại dữ liệu đã nhập (không cần làm gì thêm, input vẫn giữ nguyên)
            } else if (response.ok) {
                // Thành công, có thể reset form, ẩn form, hiện lại danh sách, v.v.
                alert('Thêm địa chỉ thành công!');
                location.reload();
            }
        };
    </script>
    <script>
        document.querySelectorAll('.delete-address-form').forEach(form => {
            form.onsubmit = async function(e) {
                e.preventDefault();
                if (!confirm('Bạn chắc chắn muốn xóa địa chỉ này?')) return;
                let response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new FormData(this)
                });
                let result = await response.json();
                if (result.success) {
                    alert('Xóa địa chỉ thành công!');
                    location.reload();
                }
            }
        });
        document.querySelectorAll('.set-default-address-form').forEach(form => {
            form.onsubmit = async function(e) {
                e.preventDefault();
                let response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new FormData(this)
                });
                let result = await response.json();
                if (result.success) {
                    alert('Đã thiết lập địa chỉ mặc định thành công!');
                    location.reload();
                }
            }
        });
        document.querySelectorAll('.edit-address-btn').forEach(btn => {
            btn.onclick = async function(e) {
                e.preventDefault();
                let id = this.dataset.id;
                let res = await fetch(`/profile/address/${id}/edit`);
                let data = await res.json();
                document.getElementById('edit_address_id').value = id;
                document.getElementById('edit_receiver_name').value = data.receiver_name;
                document.getElementById('edit_receiver_phone').value = data.receiver_phone;
                document.getElementById('edit_street_address').value = data.street_address;
                document.getElementById('editAddressModal').style.display = 'flex';
            }
        });
        let result = await response.json();
        if(result.success) {
            alert('Đã thiết lập địa chỉ mặc định thành công!');
            location.reload();
        }
    }
});
document.querySelectorAll('.edit-address-btn').forEach(btn => {
    btn.onclick = async function(e) {
        e.preventDefault();
        let id = this.dataset.id;
        let url = '{{ route("client.profile.address.edit", ["address" => ":id"]) }}'.replace(':id', id);
        let res = await fetch(url);
        let data = await res.json();
        document.getElementById('edit_address_id').value = id;
        document.getElementById('edit_receiver_name').value = data.receiver_name;
        document.getElementById('edit_receiver_phone').value = data.receiver_phone;
        document.getElementById('edit_street_address').value = data.street_address;
        document.getElementById('editAddressModal').style.display = 'flex';
    }
});
document.getElementById('closeEditModal').onclick = function() {
    document.getElementById('editAddressModal').style.display = 'none';
};
document.getElementById('editAddressForm').onsubmit = async function(e) {
    e.preventDefault();
    let id = document.getElementById('edit_address_id').value;
    let formData = new FormData(this);
    let url = '{{ route("client.profile.address.update", ["address" => ":id"]) }}'.replace(':id', id);
    let res = await fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: formData
    });
    if(res.status === 422) {
        let data = await res.json();
        alert(Object.values(data.errors).flat().join('\n'));
    } else {
        alert('Cập nhật địa chỉ thành công!');
        location.reload();
    }
};
</script>
@endsection
