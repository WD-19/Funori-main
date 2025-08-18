@extends('client.profile.profile_base')

@section('content_profile')
    <div class="my-account-content account-address" style="background-color: #f9fafb; border-radius: 12px; padding: 30px; box-shadow: 0 2px 12px rgba(0,0,0,0.05);">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <div>
                <h3 style="font-size: 24px; font-weight: 700; color: #333; margin: 0 0 8px 0;">Địa chỉ giao hàng</h3>
                <p style="color: #6b7280; margin: 0; font-size: 15px;">Quản lý các địa chỉ giao hàng của bạn</p>
            </div>
            <button id="btnShowAddAddress" style="display: inline-flex; align-items: center; padding: 12px 20px; background-color: #ff3029; border: none; border-radius: 8px; color: white; font-weight: 600; font-size: 15px; cursor: pointer; box-shadow: 0 2px 8px rgba(255, 48, 41, 0.25); transition: all 0.2s ease-in-out;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(255, 48, 41, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(255, 48, 41, 0.25)';">
                <i class='bx bx-plus' style="margin-right: 8px; font-size: 20px;"></i>Thêm địa chỉ mới
            </button>
        </div>
        
        <div style="width: 100%; height: 1px; background: linear-gradient(to right, #f0f0f0, #e0e0e0, #f0f0f0); margin-bottom: 24px;"></div>
        
        <div class="address-container">
            <div class="address-form-wrapper" style="display:none; margin-bottom:30px;" id="formnewAddressWrapper">
                <div style="max-width:600px; margin:0 auto; background-color:#fff; border-radius:16px; padding:30px; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                    <form class="address-form" id="formnewAddress" action="{{ route('client.profile.address.store') }}" method="POST">
                        @csrf
                        <div style="text-align:center; margin-bottom:30px;">
                            <div style="width:60px; height:60px; background-color:#ff30290d; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                                <i class="bx bx-map-pin" style="color:#ff3029; font-size:28px;"></i>
                            </div>
                            <h3 style="margin:0; font-size:22px; font-weight:700; color:#111827;">Thông tin địa chỉ mới</h3>
                        </div>
                        
                        <div style="margin-bottom:24px;">
                            <label style="display:block; margin-bottom:8px; font-weight:500; color:#4b5563; font-size:15px;">Họ và tên người nhận</label>
                            <div style="position:relative;">
                                <i class='bx bx-user' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px;"></i>
                                <input type="text" name="receiver_name" id="receiver_name" required value="{{ old('receiver_name') }}"
                                    style="width:100%; padding:12px 12px 12px 40px; border:1px solid #e5e7eb; border-radius:8px; font-size:15px; background-color:#fff; transition:all 0.2s ease;" 
                                    placeholder="Nhập họ tên người nhận"
                                    onFocus="this.style.borderColor='#ff3029'; this.style.boxShadow='0 0 0 3px rgba(255, 48, 41, 0.1)';" 
                                    onBlur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                            </div>
                        </div>
                        
                        <div style="margin-bottom:24px;">
                            <label style="display:block; margin-bottom:8px; font-weight:500; color:#4b5563; font-size:15px;">Số điện thoại</label>
                            <div style="position:relative;">
                                <i class='bx bx-phone' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px;"></i>
                                <input type="text" name="receiver_phone" id="receiver_phone" required value="{{ old('receiver_phone') }}"
                                    style="width:100%; padding:12px 12px 12px 40px; border:1px solid #e5e7eb; border-radius:8px; font-size:15px; background-color:#fff; transition:all 0.2s ease;" 
                                    placeholder="Nhập số điện thoại liên hệ"
                                    onFocus="this.style.borderColor='#ff3029'; this.style.boxShadow='0 0 0 3px rgba(255, 48, 41, 0.1)';" 
                                    onBlur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                            </div>
                        </div>
                        
                        <div style="margin-bottom:24px;">
                            <div style="display:flex; gap:16px;">
                                <div style="flex:1;">
                                    <label style="display:block; margin-bottom:8px; font-weight:500; color:#4b5563; font-size:15px;">Tỉnh/Thành phố</label>
                                    <div style="position:relative;">
                                        <i class='bx bx-buildings' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px;"></i>
                                        <select name="province_disabled" id="add_province_disabled" disabled 
                                            style="width:100%; padding:12px 12px 12px 40px; border:1px solid #e5e7eb; border-radius:8px; font-size:15px; background-color:#f9fafb; color:#4b5563; appearance:none; cursor:not-allowed;">
                                            <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                                        </select>
                                        <i class='bx bx-chevron-down' style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; pointer-events:none;"></i>
                                        <input type="hidden" name="province" value="Thành phố Hà Nội">
                                    </div>
                                </div>
                                
                                <div style="flex:1;">
                                    <label style="display:block; margin-bottom:8px; font-weight:500; color:#4b5563; font-size:15px;">Phường/Xã</label>
                                    <div style="position:relative;">
                                        <i class='bx bx-map-pin' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; z-index:2;"></i>
                                                                        <input type="text" id="add_ward_search" placeholder="Tìm kiếm phường/xã..." 
                                    style="width:100%; padding:12px 12px 12px 40px; border:1px solid #e5e7eb; border-radius:8px; font-size:15px; background-color:#fff; transition:all 0.2s ease;"
                                    onFocus="this.style.borderColor='#ff3029'; this.style.boxShadow='0 0 0 3px rgba(255, 48, 41, 0.1)'; showWardDropdown('add');" 
                                    onBlur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'; setTimeout(() => hideWardDropdown('add'), 150);">
                                        <i class='bx bx-chevron-down' style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; z-index:2; cursor:pointer;" onclick="showWardDropdown('add')"></i>
                                        <input type="hidden" name="ward" id="add_ward_hidden" required>
                                        <input type="hidden" name="district" value="Quốc Oai">
                                        
                                        <!-- Dropdown tìm kiếm phường/xã -->
                                        <div id="add_ward_dropdown" style="display:none; position:absolute; top:100%; left:0; right:0; background:#fff; border:1px solid #e5e7eb; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.1); z-index:1000; max-height:200px; overflow-y:auto; margin-top:2px;">
                                            <div style="padding:8px 12px; border-bottom:1px solid #f3f4f6; color:#6b7280; font-size:13px; font-weight:500;">
                                                <i class='bx bx-search' style="margin-right:6px;"></i>Gõ để tìm kiếm phường/xã
                                            </div>
                                            <div id="add_ward_options" style="max-height:150px; overflow-y:auto;">
                                                <!-- Các option sẽ được thêm bằng JavaScript -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div style="margin-bottom:24px;">
                            <label style="display:block; margin-bottom:8px; font-weight:500; color:#4b5563; font-size:15px;">Địa chỉ cụ thể</label>
                            <div style="position:relative;">
                                <i class='bx bx-home-alt' style="position:absolute; left:12px; top:14px; color:#9ca3af; font-size:18px;"></i>
                                <textarea name="street_address" id="street_address" required rows="2"
                                    style="width:100%; padding:12px 12px 12px 40px; border:1px solid #e5e7eb; border-radius:8px; font-size:15px; background-color:#fff; transition:all 0.2s ease; resize:none; font-family:inherit;"
                                    placeholder="Nhập số nhà, tên đường hoặc thông tin địa chỉ chi tiết"
                                    onFocus="this.style.borderColor='#ff3029'; this.style.boxShadow='0 0 0 3px rgba(255, 48, 41, 0.1)';" 
                                    onBlur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">{{ old('street_address') }}</textarea>
                            </div>
                        </div>
                        
                        <div style="margin-bottom:30px; background-color:#f9fafb; border-radius:8px; padding:16px; display:flex; align-items:center;">
                            <div style="position:relative; margin-right:14px;">
                                <input type="checkbox" id="check-new-address" name="is_default" value="1" {{ old('is_default') ? 'checked' : '' }}
                                    style="position:absolute; opacity:0; width:0; height:0;">
                                <label for="check-new-address" 
                                    style="display:block; width:20px; height:20px; border:2px solid #d1d5db; border-radius:4px; cursor:pointer; position:relative; transition:all 0.2s ease;"
                                    onclick="this.style.borderColor='#ff3029'; this.style.backgroundColor=document.getElementById('check-new-address').checked ? '#ff3029' : 'white';">
                                    <span style="position:absolute; top:1px; left:3px; width:10px; height:10px; border-bottom:2px solid white; border-right:2px solid white; transform:rotate(45deg); opacity:0; transition:opacity 0.2s ease;"
                                          id="check-mark"></span>
                                </label>
                                <script>
                                    document.getElementById('check-new-address').addEventListener('change', function() {
                                        document.getElementById('check-mark').style.opacity = this.checked ? '1' : '0';
                                        document.querySelector('label[for="check-new-address"]').style.backgroundColor = this.checked ? '#ff3029' : 'white';
                                    });
                                </script>
                            </div>
                            <div>
                                <label for="check-new-address" style="font-weight:500; color:#111827; cursor:pointer; font-size:15px;">Đặt làm địa chỉ mặc định</label>
                                <p style="margin:4px 0 0; color:#6b7280; font-size:13px;">Địa chỉ này sẽ được sử dụng mặc định cho các đơn hàng của bạn</p>
                            </div>
                        </div>
                        
                        <div style="display:flex; gap:16px; margin-top:10px;">
                            <button type="button" id="btnHideAddAddress"
                                    style="flex:1; padding:13px; border-radius:8px; background-color:#f3f4f6; color:#4b5563; border:none; font-weight:600; cursor:pointer; font-size:15px; transition:all 0.2s ease;"
                                    onMouseOver="this.style.backgroundColor='#e5e7eb';"
                                    onMouseOut="this.style.backgroundColor='#f3f4f6';">
                                Hủy bỏ
                            </button>
                            <button type="submit" 
                                    style="flex:1; padding:13px; border-radius:8px; background-color:#ff3029; color:white; border:none; font-weight:600; cursor:pointer; font-size:15px; box-shadow:0 2px 6px rgba(255, 48, 41, 0.2); transition:all 0.2s ease;"
                                    onMouseOver="this.style.backgroundColor='#e31c25';"
                                    onMouseOut="this.style.backgroundColor='#ff3029';">
                                Lưu địa chỉ
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            </div>

            <div class="address-list-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 20px;">
                @forelse($addresses as $address)
                    <div class="address-card" style="position: relative; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05); transition: all 0.2s;">
                        @if ($address->is_default)
                            <div style="position: absolute; top: -10px; right: 24px; background-color: #ff3029; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; box-shadow: 0 2px 5px rgba(255, 48, 41, 0.2);">
                                <i class='bx bxs-check-circle' style="vertical-align: middle; margin-right: 4px;"></i> Mặc định
                            </div>
                        @endif
                        
                        <div style="display: flex; align-items: center; margin-bottom: 16px;">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #f0f4ff; display: flex; align-items: center; justify-content: center; margin-right: 14px;">
                                <i class='bx bxs-map' style="font-size: 20px; color: #4f46e5;"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0; font-size: 18px; font-weight: 600; color: #111827;">{{ $address->receiver_name }}</h4>
                                <p style="margin: 4px 0 0; color: #4b5563; font-size: 14px;">{{ $address->receiver_phone }}</p>
                            </div>
                        </div>
                        
                        <div style="background-color: #f9fafb; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
                            <div style="display: flex; margin-bottom: 8px;">
                                <div style="flex-shrink: 0; width: 24px; color: #6b7280; text-align: center;">
                                    <i class='bx bx-buildings'></i>
                                </div>
                                <div style="margin-left: 8px; color: #374151; font-weight: 500;">{{ $address->province }}</div>
                            </div>
                            <div style="display: flex; margin-bottom: 8px;">
                                <div style="flex-shrink: 0; width: 24px; color: #6b7280; text-align: center;">
                                    <i class='bx bx-map-pin'></i>
                                </div>
                                <div style="margin-left: 8px; color: #374151; font-weight: 500;">{{ $address->ward }}</div>
                            </div>
                            <div style="display: flex;">
                                <div style="flex-shrink: 0; width: 24px; color: #6b7280; text-align: center;">
                                    <i class='bx bx-home-alt'></i>
                                </div>
                                <div style="margin-left: 8px; color: #374151; font-weight: 500;">{{ $address->street_address }}</div>
                            </div>
                        </div>
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            <button type="button" class="edit-address-btn" data-id="{{ $address->id }}"
                                style="flex-grow: 1; display: inline-flex; align-items: center; justify-content: center; padding: 10px; background-color: #f9fafb; border: none; border-radius: 8px; color: #4b5563; font-weight: 600; cursor: pointer; font-size: 14px; transition: all 0.2s;">
                                <i class='bx bx-edit' style="margin-right: 6px; font-size: 18px;"></i> Sửa
                            </button>
                            
                            @if (!$address->is_default)
                                <form action="{{ route('client.profile.address.setDefault', $address->id) }}" method="POST" 
                                      class="set-default-address-form" style="flex-grow: 1;">
                                    @csrf
                                    <button type="submit"
                                        style="width: 100%; display: inline-flex; align-items: center; justify-content: center; padding: 10px; background-color: #eef2ff; border: none; border-radius: 8px; color: #4f46e5; font-weight: 600; cursor: pointer; font-size: 14px; transition: all 0.2s;">
                                        <i class='bx bx-check-circle' style="margin-right: 6px; font-size: 18px;"></i> Đặt mặc định
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('client.profile.address.destroy', $address->id) }}" method="POST"
                                class="delete-address-form" style="flex-grow: 1;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="width: 100%; display: inline-flex; align-items: center; justify-content: center; padding: 10px; background-color: #fff1f1; border: none; border-radius: 8px; color: #e11d48; font-weight: 600; cursor: pointer; font-size: 14px; transition: all 0.2s;">
                                    <i class='bx bx-trash' style="margin-right: 6px; font-size: 18px;"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px; background-color: #fff; border-radius: 12px; border: 1px dashed #e5e7eb;">
                        <div style="width: 80px; height: 80px; margin: 0 auto 20px; border-radius: 50%; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                            <i class='bx bxs-map' style="font-size: 40px; color: #9ca3af;"></i>
                        </div>
                        <h4 style="margin: 0 0 10px; font-size: 18px; font-weight: 600; color: #111827;">Chưa có địa chỉ</h4>
                        <p style="margin: 0; color: #6b7280; max-width: 400px; margin: 0 auto;">Bạn chưa thêm địa chỉ nào. Vui lòng thêm địa chỉ để tiếp tục mua sắm.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
    @if ($errors->any())
        <div class="alert-container" style="margin-top:20px; padding:15px; border-radius:8px; background-color:#fef2f2; border-left:4px solid #ef4444;">
            <h5 style="margin:0 0 10px; font-size:16px; color:#b91c1c; font-weight:600;">Vui lòng kiểm tra lại thông tin</h5>
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li style="margin-bottom:5px; color:#7f1d1d;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="editAddressModal"
        style="display:none; position:fixed; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center; overflow:auto; padding:40px 0;">
        <div
            style="background:#fff; padding:30px; border-radius:16px; width:500px; max-width:90vw; margin:auto; position:relative; box-shadow:0 10px 25px rgba(0,0,0,0.15); animation:fadeIn 0.3s ease;">
            
            <div style="position:absolute; top:15px; right:15px;">
                <button type="button" id="closeEditModal" style="background:none; border:none; width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; color:#6b7280; transition:all 0.2s;" onMouseOver="this.style.backgroundColor='#f3f4f6';" onMouseOut="this.style.backgroundColor='transparent';">
                    <i class='bx bx-x' style="font-size:24px;"></i>
                </button>
            </div>
            
            <div style="text-align:center; margin-bottom:30px;">
                <div style="width:60px; height:60px; background-color:#ff30290d; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                    <i class="bx bx-edit" style="color:#ff3029; font-size:28px;"></i>
                </div>
                <h3 style="margin:0; font-size:22px; font-weight:700; color:#111827;">Cập nhật địa chỉ</h3>
            </div>
            
            <form id="editAddressForm">
                @csrf
                <input type="hidden" id="edit_address_id">
                
                <div style="margin-bottom:24px;">
                    <label style="display:block; margin-bottom:8px; font-weight:500; color:#4b5563; font-size:15px;">Họ và tên người nhận</label>
                    <div style="position:relative;">
                        <i class='bx bx-user' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px;"></i>
                        <input type="text" name="receiver_name" id="edit_receiver_name" required 
                            style="width:100%; padding:12px 12px 12px 40px; border:1px solid #e5e7eb; border-radius:8px; font-size:15px; background-color:#fff; transition:all 0.2s ease;" 
                            placeholder="Nhập họ tên người nhận"
                            onFocus="this.style.borderColor='#ff3029'; this.style.boxShadow='0 0 0 3px rgba(255, 48, 41, 0.1)';" 
                            onBlur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    </div>
                </div>
                
                <div style="margin-bottom:24px;">
                    <label style="display:block; margin-bottom:8px; font-weight:500; color:#4b5563; font-size:15px;">Số điện thoại</label>
                    <div style="position:relative;">
                        <i class='bx bx-phone' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px;"></i>
                        <input type="text" name="receiver_phone" id="edit_receiver_phone" required 
                            style="width:100%; padding:12px 12px 12px 40px; border:1px solid #e5e7eb; border-radius:8px; font-size:15px; background-color:#fff; transition:all 0.2s ease;" 
                            placeholder="Nhập số điện thoại liên hệ"
                            onFocus="this.style.borderColor='#ff3029'; this.style.boxShadow='0 0 0 3px rgba(255, 48, 41, 0.1)';" 
                            onBlur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    </div>
                </div>
                
                <div style="margin-bottom:24px;">
                    <div style="display:flex; gap:16px;">
                        <div style="flex:1;">
                            <label style="display:block; margin-bottom:8px; font-weight:500; color:#4b5563; font-size:15px;">Tỉnh/Thành phố</label>
                            <div style="position:relative;">
                                <i class='bx bx-buildings' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px;"></i>
                                <select name="province_disabled" id="edit_province_disabled" disabled 
                                    style="width:100%; padding:12px 12px 12px 40px; border:1px solid #e5e7eb; border-radius:8px; font-size:15px; background-color:#f9fafb; color:#4b5563; appearance:none; cursor:not-allowed;">
                                    <option value="Thành phố Hà Nội">Thành phố Hà Nội</option>
                                </select>
                                <i class='bx bx-chevron-down' style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; pointer-events:none;"></i>
                                <input type="hidden" name="province" value="Thành phố Hà Nội">
                            </div>
                        </div>
                        
                        <div style="flex:1;">
                            <label style="display:block; margin-bottom:8px; font-weight:500; color:#4b5563; font-size:15px;">Phường/Xã</label>
                            <div style="position:relative;">
                                <i class='bx bx-map-pin' style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; z-index:2;"></i>
                                <input type="text" id="edit_ward_search" placeholder="Tìm kiếm phường/xã..." 
                                    style="width:100%; padding:12px 12px 12px 40px; border:1px solid #e5e7eb; border-radius:8px; font-size:15px; background-color:#fff; transition:all 0.2s ease;"
                                    onFocus="this.style.borderColor='#ff3029'; this.style.boxShadow='0 0 0 3px rgba(255, 48, 41, 0.1)'; showWardDropdown('edit');" 
                                    onBlur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'; setTimeout(() => hideWardDropdown('edit'), 150);">
                                <i class='bx bx-chevron-down' style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; z-index:2; cursor:pointer;" onclick="showWardDropdown('edit')"></i>
                                <input type="hidden" name="ward" id="edit_ward_hidden" required>
                                <input type="hidden" name="district" value="Quốc Oai">
                                
                                <!-- Dropdown tìm kiếm phường/xã -->
                                <div id="edit_ward_dropdown" style="display:none; position:absolute; top:100%; left:0; right:0; background:#fff; border:1px solid #e5e7eb; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.1); z-index:1000; max-height:200px; overflow-y:auto; margin-top:2px;">
                                    <div style="padding:8px 12px; border-bottom:1px solid #f3f4f6; color:#6b7280; font-size:13px; font-weight:500;">
                                        <i class='bx bx-search' style="margin-right:6px;"></i>Gõ để tìm kiếm phường/xã
                                    </div>
                                    <div id="edit_ward_options" style="max-height:150px; overflow-y:auto;">
                                        <!-- Các option sẽ được thêm bằng JavaScript -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="margin-bottom:30px;">
                    <label style="display:block; margin-bottom:8px; font-weight:500; color:#4b5563; font-size:15px;">Địa chỉ cụ thể</label>
                    <div style="position:relative;">
                        <i class='bx bx-home-alt' style="position:absolute; left:12px; top:14px; color:#9ca3af; font-size:18px;"></i>
                        <textarea name="street_address" id="edit_street_address" required rows="2"
                            style="width:100%; padding:12px 12px 12px 40px; border:1px solid #e5e7eb; border-radius:8px; font-size:15px; background-color:#fff; transition:all 0.2s ease; resize:none; font-family:inherit;"
                            placeholder="Nhập số nhà, tên đường hoặc thông tin địa chỉ chi tiết"
                            onFocus="this.style.borderColor='#ff3029'; this.style.boxShadow='0 0 0 3px rgba(255, 48, 41, 0.1)';" 
                            onBlur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';"></textarea>
                    </div>
                </div>
                
                <div style="display:flex; gap:16px;">
                    <button type="button" id="closeEditModal2"
                            style="flex:1; padding:13px; border-radius:8px; background-color:#f3f4f6; color:#4b5563; border:none; font-weight:600; cursor:pointer; font-size:15px; transition:all 0.2s ease;"
                            onMouseOver="this.style.backgroundColor='#e5e7eb';"
                            onMouseOut="this.style.backgroundColor='#f3f4f6';">
                        Hủy bỏ
                    </button>
                    <button type="submit" 
                            style="flex:1; padding:13px; border-radius:8px; background-color:#ff3029; color:white; border:none; font-weight:600; cursor:pointer; font-size:15px; box-shadow:0 2px 6px rgba(255, 48, 41, 0.2); transition:all 0.2s ease;"
                            onMouseOver="this.style.backgroundColor='#e31c25';"
                            onMouseOut="this.style.backgroundColor='#ff3029';">
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    
    <script>
        document.getElementById('closeEditModal2').onclick = function() {
            document.getElementById('editAddressModal').style.display = 'none';
        };
    </script>
    {{-- Bắt đầu lại các script của bạn, không thay đổi gì --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        document.getElementById('btnShowAddAddress').onclick = function() {
            document.getElementById('formnewAddressWrapper').style.display = 'block';
            this.style.display = 'none';
        };
        document.getElementById('btnHideAddAddress').onclick = function() {
            document.getElementById('formnewAddressWrapper').style.display = 'none';
            document.getElementById('btnShowAddAddress').style.display = 'inline-block';
        };
    </script>
   <script>
    // Biến lưu trữ dữ liệu địa chỉ
    let addressData = [];
    let provinces = [];
    let wards = {};
    let allWards = []; // Lưu tất cả phường/xã để tìm kiếm
    
    // Hàm hiển thị dropdown tìm kiếm
    function showWardDropdown(type) {
        const dropdown = document.getElementById(`${type}_ward_dropdown`);
        const optionsContainer = document.getElementById(`${type}_ward_options`);
        
        // Hiển thị tất cả phường/xã ban đầu
        renderWardOptions(allWards, optionsContainer, type);
        dropdown.style.display = 'block';
    }
    
    // Hàm ẩn dropdown tìm kiếm
    function hideWardDropdown(type) {
        const dropdown = document.getElementById(`${type}_ward_dropdown`);
        dropdown.style.display = 'none';
    }
    
    // Hàm render options cho dropdown
    function renderWardOptions(wards, container, type) {
        container.innerHTML = '';
        
        if (wards.length === 0) {
            container.innerHTML = '<div style="padding:12px; text-align:center; color:#6b7280; font-size:14px;">Không tìm thấy phường/xã phù hợp</div>';
            return;
        }
        
        wards.forEach(ward => {
            const option = document.createElement('div');
            option.className = 'ward-option';
            option.style.cssText = 'padding:10px 12px; cursor:pointer; border-bottom:1px solid #f3f4f6; transition:background-color 0.2s; font-size:14px;';
            option.textContent = ward.tenphuongxa;
            option.dataset.value = ward.tenphuongxa;
            
            option.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f9fafb';
            });
            
            option.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
            });
            
            option.addEventListener('mousedown', function(e) {
                e.preventDefault(); // Ngăn chặn blur event
                selectWard(ward.tenphuongxa, type);
            });
            
            container.appendChild(option);
        });
    }
    
    // Hàm chọn phường/xã
    function selectWard(wardName, type) {
        console.log('selectWard called:', wardName, type); // Debug
        
        const searchInput = document.getElementById(`${type}_ward_search`);
        const hiddenInput = document.getElementById(`${type}_ward_hidden`);
        const districtInput = document.querySelector(`form#${type === 'add' ? 'formnewAddress' : 'editAddressForm'} input[name="district"]`);
        
        console.log('Elements found:', { searchInput, hiddenInput, districtInput }); // Debug
        
        if (searchInput) searchInput.value = wardName;
        if (hiddenInput) hiddenInput.value = wardName;
        if (districtInput) {
            districtInput.value = wardName;
        }
        
       
        
        console.log('Values set:', { 
            searchValue: searchInput?.value, 
            hiddenValue: hiddenInput?.value, 
            districtValue: districtInput?.value 
        }); // Debug
        
        hideWardDropdown(type);
    }
    
    // Hàm tìm kiếm phường/xã
    function searchWards(query, type) {
        const filteredWards = allWards.filter(ward => 
            ward.tenphuongxa.toLowerCase().includes(query.toLowerCase())
        );
        
        const optionsContainer = document.getElementById(`${type}_ward_options`);
        renderWardOptions(filteredWards, optionsContainer, type);
    }

    // --- Xử lý JSON địa chỉ địa phương ---
    // Hàm tải dữ liệu địa chỉ từ JSON
    async function loadAddressData() {
        try {
            const response = await fetch('/data/hanoi-districts.json');
            if (!response.ok) {
                throw new Error('Không thể tải dữ liệu: ' + response.statusText);
            }
            
            const data = await response.json();
            
            // Lưu dữ liệu gốc
            addressData = data;
            
            // Lấy danh sách tỉnh/thành phố
            if (data && data.length > 0) {
                provinces = data;
                
                // Lấy dữ liệu Hà Nội
                const hanoiData = data[0];
                
                // Lấy danh sách phường/xã của Hà Nội
                if (hanoiData && hanoiData.phuongxa) {
                    // Thêm Quốc Oai vào đầu danh sách nếu chưa có
                    let phuongxaList = [...hanoiData.phuongxa];
                    const quocOaiExists = phuongxaList.some(px => px.tenphuongxa === "Quốc Oai");
                    
                    if (!quocOaiExists) {
                        phuongxaList.unshift({
                            maphuongxa: 99999999,
                            tenphuongxa: "Quốc Oai"
                        });
                    }
                    
                    // Sắp xếp phường/xã theo bảng chữ cái
                    phuongxaList.sort((a, b) => {
                        // Đảm bảo Quốc Oai luôn ở đầu
                        if (a.tenphuongxa === "Quốc Oai") return -1;
                        if (b.tenphuongxa === "Quốc Oai") return 1;
                        return a.tenphuongxa.localeCompare(b.tenphuongxa);
                    });
                    
                    // Lưu danh sách phường/xã
                    wards["01"] = phuongxaList;
                    allWards = phuongxaList; // Lưu cho tìm kiếm
                    
                    console.log("Đã tải " + phuongxaList.length + " phường/xã");
                    
                    // Thiết lập sự kiện tìm kiếm cho cả hai form
                    setupSearchEvents();
                } else {
                    console.error("Không tìm thấy dữ liệu phường/xã trong JSON");
                }
            } else {
                console.error("Dữ liệu JSON không đúng định dạng hoặc rỗng");
            }
        } catch (error) {
            console.error("Lỗi khi tải dữ liệu địa chỉ:", error);
        }
    }
    
    // Thiết lập sự kiện tìm kiếm
    function setupSearchEvents() {
        // Sự kiện cho form thêm mới
        const addSearchInput = document.getElementById('add_ward_search');
        if (addSearchInput) {
            addSearchInput.addEventListener('input', function() {
                const query = this.value.trim();
                if (query.length > 0) {
                    searchWards(query, 'add');
                } else {
                    const optionsContainer = document.getElementById('add_ward_options');
                    renderWardOptions(allWards, optionsContainer, 'add');
                }
            });
        }
        
        // Sự kiện cho form edit
        const editSearchInput = document.getElementById('edit_ward_search');
        if (editSearchInput) {
            editSearchInput.addEventListener('input', function() {
                const query = this.value.trim();
                if (query.length > 0) {
                    searchWards(query, 'edit');
                } else {
                    const optionsContainer = document.getElementById('edit_ward_options');
                    renderWardOptions(allWards, optionsContainer, 'edit');
                }
            });
        }
    }

    // Load dữ liệu khi trang load
    loadAddressData();
    
    // Xử lý click outside để đóng dropdown
    document.addEventListener('click', function(e) {
        const addDropdown = document.getElementById('add_ward_dropdown');
        const editDropdown = document.getElementById('edit_ward_dropdown');
        const addSearch = document.getElementById('add_ward_search');
        const editSearch = document.getElementById('edit_ward_search');
        
        // Đóng dropdown add nếu click outside
        if (addDropdown && addSearch && !addDropdown.contains(e.target) && !addSearch.contains(e.target)) {
            hideWardDropdown('add');
        }
        
        // Đóng dropdown edit nếu click outside
        if (editDropdown && editSearch && !editDropdown.contains(e.target) && !editSearch.contains(e.target)) {
            hideWardDropdown('edit');
        }
    });
    
    // Ngăn chặn sự kiện click trong dropdown để tránh đóng dropdown khi click vào option
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('ward-option')) {
            e.stopPropagation();
        }
    });

    // Xử lý form thêm địa chỉ
    document.getElementById('formnewAddress').onsubmit = async function(e) {
        e.preventDefault();
        let form = this;
        let formData = new FormData(form);
        
        // Lấy giá trị phường/xã đã chọn
        const wardHidden = document.getElementById('add_ward_hidden');
        const wardSearch = document.getElementById('add_ward_search');
        
        // Kiểm tra xem người dùng đã chọn phường/xã chưa
        if (!wardHidden.value || wardHidden.value.trim() === '') {
            alert('Vui lòng chọn phường/xã');
            wardSearch.focus();
            return;
        }
        
        const selectedWard = wardHidden.value;
        
        // Thiết lập dữ liệu form
        formData.set('province', 'Thành phố Hà Nội');
        formData.set('ward', selectedWard);
        formData.set('district', selectedWard); // Sử dụng giá trị của phường/xã cho district

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
            body: formData
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
        } else if (response.ok) {
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
                let url = '{{ route('client.profile.address.edit', ['address' => ':id']) }}'.replace(':id',
                    id);
                
                try {
                    let response = await fetch(url);
                    if (!response.ok) {
                        throw new Error('Không thể tải thông tin địa chỉ');
                    }
                    
                    let addressData = await response.json();
    
                    // Điền thông tin cơ bản
                    document.getElementById('edit_address_id').value = addressData.id;
                    document.getElementById('edit_receiver_name').value = addressData.receiver_name;
                    document.getElementById('edit_receiver_phone').value = addressData.receiver_phone;
                    document.getElementById('edit_street_address').value = addressData.street_address;
                    
                    // Cập nhật trường district
                    const districtInput = document.querySelector('form#editAddressForm input[name="district"]');
                    if (districtInput) {
                        districtInput.value = addressData.ward || 'Quốc Oai';
                    }
                    
                    // Đảm bảo danh sách phường/xã đã được tải
                    if (!wards["01"] || wards["01"].length === 0) {
                        await loadAddressData();
                    }
                    
                    // Điền giá trị phường/xã vào input tìm kiếm
                    setTimeout(() => {
                        const editWardSearch = document.getElementById('edit_ward_search');
                        const editWardHidden = document.getElementById('edit_ward_hidden');
                        
                        if (editWardSearch && addressData.ward) {
                            editWardSearch.value = addressData.ward;
                            editWardHidden.value = addressData.ward;
                        }
                        
                        // Nếu địa chỉ là Quốc Oai, đặt giá trị Quốc Oai cho street_address
                        if (addressData.ward === "Quốc Oai") {
                            document.getElementById('edit_street_address').value = "Quốc Oai";
                        }
                    }, 100);
    
                    const modal = document.getElementById('editAddressModal');
                    modal.style.display = 'flex';
                    
                    // Đảm bảo modal hiện lên trên màn hình
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                } catch (error) {
                    console.error("Lỗi khi tải thông tin địa chỉ:", error);
                    alert("Không thể tải thông tin địa chỉ. Vui lòng thử lại sau.");
                }
            }
        });
        
        document.getElementById('closeEditModal').onclick = function() {
            document.getElementById('editAddressModal').style.display = 'none';
        };
        document.getElementById('editAddressForm').onsubmit = async function(e) {
            e.preventDefault();
            let id = document.getElementById('edit_address_id').value;
            let formData = new FormData(this);
            
            // Lấy giá trị phường/xã đã chọn
            const wardHidden = document.getElementById('edit_ward_hidden');
            const wardSearch = document.getElementById('edit_ward_search');
            
            // Kiểm tra xem người dùng đã chọn phường/xã chưa
            if (!wardHidden.value || wardHidden.value.trim() === '') {
                alert('Vui lòng chọn phường/xã');
                wardSearch.focus();
                return;
            }
            
            const selectedWard = wardHidden.value;
            
            // Thiết lập dữ liệu form
            formData.set('province', 'Thành phố Hà Nội');
            formData.set('ward', selectedWard);
            formData.set('district', selectedWard); // Sử dụng giá trị của phường/xã cho district
            
            let url = '{{ route('client.profile.address.update', ['address' => ':id']) }}'.replace(':id', id);
            let res = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            });
            if (res.status === 422) {
                let data = await res.json();
                alert(Object.values(data.errors).flat().join('\n'));
            } else {
                alert('Cập nhật địa chỉ thành công!');
                location.reload();
            }
        };

        // --- Xử lý địa chỉ ---
        // Các sự kiện đã được xử lý trong setupSearchEvents() và selectWard()
        
        // Khởi tạo khi trang load
        loadAddressData();
    </script>
@endsection

{{-- Thêm CSS mới vào đây (hoặc vào file CSS của bạn) --}}
<style>
    /* ========================================================================== */
    /* BỔ SUNG & TỐI ƯU CSS CHO TRANG ĐỊA CHỈ (ADDRESS) */
    /* ========================================================================== */
    .right {
        background-color: #ffffff;
        /* Nền trắng */
        border-radius: 12px;
        /* Bo tròn góc nhiều hơn */
        box-shadow: 0 5px 35px rgb(16 16 16 / 46%);
        /* Bóng đổ mạnh và rõ ràng hơn */
        padding: 25px 20px;
        /* Đệm trên dưới */
        display: flex;
        flex-direction: column;
        overflow: hidden;
        /* Ngăn chặn nội dung tràn ra ngoài nếu quá lớn */
    }

    /* Tiêu đề trang Địa chỉ */
    .section-heading {
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

    .section-description {
        font-size: 1.1em;
        /* Kích thước dễ đọc */
        color: #6c757d;
        /* Màu xám dịu */
        margin-bottom: 25px;
        /* Khoảng cách với HR */
    }

    /* Nút "Thêm địa chỉ mới" */
    .btn-address {
        padding: 12px 25px;
        font-size: 1.05em;
        font-weight: 600;
        display: inline-flex;
        /* Để căn chỉnh icon và text */
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        /* Bo tròn góc */
        box-shadow: 0 4px 15px rgba(255, 48, 41, 0.2);
        /* Bóng đổ nhẹ */
        transition: all 0.3s ease;
    }

    .btn-address i {
        font-size: 1.3em;
        margin-right: 8px;
        /* Khoảng cách giữa icon và text */
    }

    .btn-address:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 48, 41, 0.3);
    }

    /* Form thêm địa chỉ mới (wd-form-address) */
    .wd-form-address {
        background-color: #fcfcfc;
        /* Nền trắng sáng hơn */
        border: 1px solid #e9ecef;
        /* Viền mỏng nhẹ */
        border-radius: 12px;
        /* Bo tròn góc */
        padding: 30px;
        /* Đệm lớn hơn bên trong form */
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        /* Bóng đổ đẹp hơn */
        margin-bottom: 30px;
        /* Khoảng cách từ form đến list địa chỉ */
        display: flex;
        /* Use flexbox for better layout control */
        flex-direction: column;
        /* Stack items vertically */
        gap: 1.5rem;
        /* Consistent spacing between form fields */
    }

    .form-section-title {
        margin-bottom: 15px;
        /* Adjust margin to fit with gap */
        padding-bottom: 15px;
        border-bottom: 1px dashed #e0e0e0;
        /* Viền nét đứt nhẹ */
        text-align: center;
    }

    .form-section-title h4 {
        font-size: 1.5em;
        font-weight: 700;
        color: #444;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-section-title h4 i {
        color: #ff3029;
        /* Màu đỏ của theme */
        margin-right: 10px;
        font-size: 1.2em;
    }

    /* Các trường input trong form địa chỉ */
    .wd-form-address .box-field {
        margin-bottom: 0;
        /* Remove default margin as flex gap handles it */
    }

    /* Styling for tf-field style-1 */
    .tf-field.style-1 {
        position: relative;
        width: 100%;
        /* Ensure it takes full width of its parent */
    }

    .tf-field-input {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 1em;
        height: auto;
        /* Ensure height adjusts to content */
        width: 100%;
        /* Make input fill the container */
        transition: all 0.3s ease;
        background-color: #fff;
        /* Ensure white background */
        color: #343a40;
        /* Darker text for readability */
        box-sizing: border-box;
        /* Include padding and border in the element's total width and height */
    }

    .tf-field-input:focus {
        border-color: #ff3029;
        /* Màu viền focus */
        box-shadow: 0 0 0 0.2rem rgba(255, 48, 41, 0.25);
        /* Bóng đổ focus */
        outline: none;
        /* Remove default outline */
    }

    .tf-field-label {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        font-weight: 600;
        color: #6c757d;
        /* Softer color for label */
        pointer-events: none;
        /* Allow clicks through the label to the input */
        transition: all 0.2s ease;
        background-color: transparent;
        /* Ensure no background to hide input */
        padding: 0 5px;
        /* Slight padding to create a visual break when animated */
    }

    /* Move label up and shrink when input is focused or has content */
    .tf-field-input:focus+.tf-field-label,
    .tf-field-input:not(:placeholder-shown)+.tf-field-label {
        top: 0;
        font-size: 0.8em;
        /* Smaller font size */
        color: #ff3029;
        /* Highlight label color on focus */
        transform: translateY(-50%);
        background-color: #fcfcfc;
        /* Match form background for a "floating" effect */
        padding: 0 5px;
        /* Ensure padding for background color */
    }

    /* Specific styling for select inputs */
    .tf-field-input.tf-input[name="district"],
    .tf-field-input.tf-input[name="ward"],
    .tf-field-input.tf-input[name="province_disabled"] {
        appearance: none;
        /* Remove default select arrow */
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%236c757d%22%20d%3D%22M287%2C197.89c0.4%2C-0.4%2C0.6%2C-1%2C0.6%2C-1.6s-0.2%2C-1.2-0.6%2C-1.6l-140-140c-0.8%2C-0.8-2-0.8-2.8%2C0l-140%2C140c-0.8%2C0.8-0.8%2C2%2C0%2C2.8c0.4%2C0.4%2C1%2C0.6%2C1.4%2C0.6s1-0.2%2C1.4-0.6L146.2%2C62.89L285.6%2C197.89C286.2%2C198.49%2C286.6%2C198.69%2C287%2C197.89z%22%2F%3E%3C%2Fsvg%3E');
        /* Custom arrow */
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 10px;
        padding-right: 35px;
        /* Space for the custom arrow */
    }


    /* Checkbox "Đặt làm địa chỉ mặc định" */
    .box-checkbox {
        padding-left: 0;
        margin-bottom: 1.5rem;
        display: flex;
        /* Use flex for alignment */
        align-items: center;
        /* Vertically align items */
        gap: 8px;
        /* Space between checkbox and label */
    }

    .tf-check {
        width: 1.2em;
        height: 1.2em;
        margin-top: 0;
        /* Remove default margin-top */
        vertical-align: middle;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25em;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        display: inline-block;
        transition: all 0.2s ease;
        flex-shrink: 0;
        /* Prevent checkbox from shrinking */
    }

    .tf-check:checked {
        background-color: #ff3029;
        border-color: #ff3029;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
    }

    .box-checkbox label {
        margin-bottom: 0;
        color: #333;
        font-weight: 500;
        cursor: pointer;
        display: inline;
        /* Keep inline for text flow */
    }

    /* Nút trong form (Lưu địa chỉ, Hủy) */
    .wd-form-address .d-flex.align-items-center.justify-content-center.gap-20 {
        margin-top: 10px;
        /* Adjust spacing above buttons */
    }

    .wd-form-address .tf-btn {
        min-width: 150px;
        font-size: 1.05em;
        font-weight: 600;
        border-radius: 8px;
        padding: 12px 20px;
    }

    .wd-form-address .tf-btn.btn-hide-address {
        background-color: #e9ecef !important;
        color: #6c757d !important;
        border: 1px solid #ced4da !important;
    }

    .wd-form-address .tf-btn.btn-hide-address:hover {
        background-color: #dee2e6 !important;
        color: #495057 !important;
    }


    /* Danh sách địa chỉ (list-account-address) */
    .list-account-address {
        margin-top: 30px;
        /* Khoảng cách từ form */
    }

    .account-address-item1 {
        border: 1px solid #e9ecef;
        /* Viền mỏng */
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        /* Bóng đổ nhẹ */
        transition: all 0.2s ease-in-out;
        padding: 20px;
        /* Thêm padding vào đây để nội dung không dính sát */
        margin-bottom: 15px;
        /* Khoảng cách giữa các item */
        background-color: #fff;
        text-align: left;
        /* Đảm bảo text align trái */
    }

    .account-address-item1:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        /* Nổi bật hơn khi hover */
        transform: translateY(-2px);
    }

    .account-address-item1 strong {
        font-weight: 700;
        color: #333;
        margin-bottom: 0;
    }

    .account-address-item1 span[style*="color:gray"] {
        font-size: 0.95em;
        line-height: 1.6;
    }

    .account-address-item1 span[style*="color:#e74c3c"] {
        background-color: #ff3029;
        /* Màu đỏ của theme */
        color: white !important;
        /* Đảm bảo màu chữ trắng */
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 50rem;
        /* Bo tròn hoàn toàn */
        font-size: 0.8em;
        border: none !important;
        /* Bỏ viền cũ */
        display: inline-block;
        /* Để padding hoạt động */
        margin-left: 10px;
        /* Khoảng cách từ số điện thoại */
    }

    /* Nút hành động trong mỗi địa chỉ */
    .account-address-item1 .d-inline {
        display: inline-block !important;
        /* Ensure forms are inline */
        margin-left: 8px;
        /* Space between action buttons */
    }

    .account-address-item1 a,
    .account-address-item1 button {
        padding: 6px 12px;
        font-size: 0.9em;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        /* Ensure can apply padding/margin */
        border: 1px solid transparent;
        /* Transparent border by default */
        transition: all 0.2s ease;
        cursor: pointer;
        /* Indicate clickable */
    }

    .account-address-item1 a.edit-address-btn {
        background-color: #3498db;
        border-color: #3498db;
        color: white !important;
    }

    .account-address-item1 a.edit-address-btn:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    .account-address-item1 button[type="submit"][style*="color:#e74c3c"] {
        /* Nút Xóa */
        background-color: #e74c3c !important;
        border-color: #e74c3c !important;
        color: white !important;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .account-address-item1 button[type="submit"][style*="color:#e74c3c"]:hover {
        background-color: #c0392b !important;
        border-color: #c0392b !important;
    }

    .account-address-item1 button[type="submit"][style*="border:1px solid #888"] {
        /* Nút Thiết lập mặc định */
        border: 1px solid #6c757d !important;
        color: #6c757d !important;
        background-color: transparent !important;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .account-address-item1 button[type="submit"][style*="border:1px solid #888"]:hover {
        background-color: #6c757d !important;
        color: white !important;
    }


    /* ================== */
    /* Modal Styling (tùy chỉnh cho modal bạn đang dùng) */
    /* ================== */
    #editAddressModal {
        display: flex;
        /* Đảm bảo modal được căn giữa khi hiển thị */
        align-items: center;
        justify-content: center;
    }

    #editAddressModal>div {
        /* Phần nội dung bên trong modal */
        background: #fff;
        padding: 32px;
        border-radius: 8px;
        min-width: 350px;
        max-width: 90vw;
        margin: auto;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: none;
        /* Bỏ viền cũ */
    }

    #editAddressModal h4 {
        font-size: 1.5em;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    #editAddressModal .box-field {
        margin-bottom: 15px;
    }

    #editAddressModal .tf-field-input,
    #editAddressModal select.tf-field-input {
        border-radius: 10px !important;
        border: 1.5px solid #e0e0e0;
        padding: 14px 18px;
        font-size: 1.08em;
        background: #fafbfc;
        color: #222;
        transition: border 0.2s, box-shadow 0.2s;
        box-shadow: none;
    }

    #editAddressModal .tf-field-input:focus,
    #editAddressModal select.tf-field-input:focus {
        border-color: #ff3029;
        background: #fff;
        box-shadow: 0 0 0 0.15rem rgba(255, 48, 41, 0.13);
        outline: none;
    }

    #editAddressModal .tf-field-label {
        color: #888;
        font-weight: 500;
        font-size: 1em;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        transition: all 0.2s;
        pointer-events: none;
    }

    #editAddressModal .tf-field-input:focus + .tf-field-label,
    #editAddressModal .tf-field-input:not(:placeholder-shown) + .tf-field-label {
        top: 0;
        font-size: 0.85em;
        color: #ff3029;
        background: #fff;
        padding: 0 4px;
    }

    #editAddressModal .tf-btn {
        min-width: 120px;
    }

    #closeEditModal {
        background-color: #f0f2f5 !important;
        color: #6c757d !important;
        border: 1px solid #e0e0e0 !important;
    }

    #closeEditModal:hover {
        background-color: #e0e0e0 !important;
        color: #333 !important;
    }

    /* PHẦN CSS MỚI CHO THÔNG BÁO ĐỊA CHỈ TRỐNG */
    .empty-address-message {
        text-align: center;
        /* Căn giữa nội dung */
        padding: 40px 20px;
        /* Khoảng đệm lớn hơn */
        margin-top: 30px;
        /* Khoảng cách với các phần tử khác */
        color: #777;
        /* Màu chữ nhẹ nhàng */
        font-size: 1.1em;
        line-height: 1.6;
        display: flex;
        /* Dùng flexbox để căn giữa icon và text */
        flex-direction: column;
        /* Xếp theo cột: icon trên, text dưới */
        align-items: center;
        /* Căn giữa theo chiều ngang */
        justify-content: center;
        /* Căn giữa theo chiều dọc nếu có không gian */
        background-color: transparent;
        /* Loại bỏ background */
        border: none;
        /* Loại bỏ border */
        box-shadow: none;
        /* Loại bỏ shadow */
    }

    .empty-address-message i.bx {
        font-size: 4.5em;
        /* Kích thước icon lớn hơn một chút */
        color: #ffaa00;
        /* Màu vàng cam nổi bật */
        margin-bottom: 15px;
        animation: pulse 1.5s infinite;
        /* Thêm hiệu ứng nhấp nháy nhẹ */
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 0.8;
        }

        50% {
            transform: scale(1.05);
            opacity: 1;
        }

        100% {
            transform: scale(1);
            opacity: 0.8;
        }
    }

    .empty-address-message p {
        font-size: 1.4em;
        /* Tiêu đề lớn hơn */
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .empty-address-message span {
        font-size: 1.1em;
        color: #666;
        max-width: 80%;
        /* Giới hạn chiều rộng để text không quá dài */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .wd-form-address .d-flex.gap-3.mb-3 {
            flex-direction: column;
            gap: 1.5rem;
            /* Maintain consistent gap */
        }

        .wd-form-address .d-flex.gap-3.mb-3 .box-field.w-100 {
            width: 100%;
            /* Ensure full width on smaller screens */
        }

        .wd-form-address .d-flex.align-items-center.justify-content-center.gap-20 {
            flex-direction: column;
            gap: 15px;
            /* Adjust button spacing */
        }

        .wd-form-address .tf-btn {
            width: 100%;
            min-width: unset;
        }
    }

    /* New styles for the address form wrapper */
    .address-form-wrapper {
        padding: 32px 24px;
        margin: 0 auto 32px auto;
        max-width: 700px;
    }

    .address-form-title {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4em;
        font-weight: 700;
        color: #222;
        margin-bottom: 24px;
        gap: 10px;
    }

    .address-form-title i {
        color: #ff3029;
        font-size: 1.5em;
    }

    .form-floating>label {
        color: #888;
    }

    .btn-dark {
        background: #000;
        color: #fff;
        border-radius: 8px;
        font-weight: 600;
        border: none;
    }

    .btn-dark:hover {
        background: #222;
    }

    .btn-light {
        background: #f3f3f3;
        color: #333;
        border-radius: 8px;
        font-weight: 600;
        border: 1px solid #ddd;
    }

    .btn-light:hover {
        background: #e9ecef;
    }

    .address-form .form-check {
        text-align: left !important;
        margin-left: 2px;
    }

    .tf-btn {
        display: inline-block;
        font-weight: 600;
        border-radius: 8px;
        padding: 12px 32px;
        font-size: 1.08em;
        border: none;
        transition: all 0.2s;
        cursor: pointer;
        text-align: center;
    }

    .tf-btn.btn-main {
        background: linear-gradient(90deg, #ff3029 60%, #ff7e5f 100%);
        color: #fff !important;
        box-shadow: 0 4px 15px rgba(255, 48, 41, 0.13);
    }

    .tf-btn.btn-main:hover {
        background: linear-gradient(90deg, #ff7e5f 60%, #ff3029 100%);
        color: #fff !important;
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 8px 24px rgba(255, 48, 41, 0.18);
    }

    .tf-btn.btn-light {
        background: #f3f3f3 !important;
        color: #333 !important;
        border: 1px solid #ddd;
    }

    .tf-btn.btn-light:hover {
        background: #e9ecef !important;
        color: #ff3029 !important;
    }

    .address-form-wrapper.card-style {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.10);
        padding: 40px 32px 32px 32px;
        max-width: 600px;
        margin: 32px auto;
        border: none;
    }
    .form-title {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .form-floating > label {
        color: #888;
        font-weight: 500;
    }
    .form-control, .form-select {
        border-radius: 10px !important;
        border: 1.5px solid #e0e0e0;
        font-size: 1.08em;
        background: #fafbfc;
        color: #222;
        transition: border 0.2s, box-shadow 0.2s;
        box-shadow: none;
    }
    .form-control:focus, .form-select:focus {
        border-color: #ff3029;
        background: #fff;
        box-shadow: 0 0 0 0.15rem rgba(255, 48, 41, 0.13);
        outline: none;
    }
    .form-check-input {
        border-radius: 4px;
        border: 1.5px solid #ff3029;
        width: 1.2em;
        height: 1.2em;
        margin-right: 8px;
    }
    .form-check-input:checked {
        background-color: #ff3029;
        border-color: #ff3029;
    }
    
    /* CSS cho dropdown tìm kiếm phường/xã */
    .ward-option:hover {
        background-color: #f9fafb !important;
    }
    
    .ward-option:last-child {
        border-bottom: none !important;
    }
    
    /* Tùy chỉnh scrollbar cho dropdown */
    #add_ward_options::-webkit-scrollbar,
    #edit_ward_options::-webkit-scrollbar {
        width: 6px;
    }
    
    #add_ward_options::-webkit-scrollbar-track,
    #edit_ward_options::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    
    #add_ward_options::-webkit-scrollbar-thumb,
    #edit_ward_options::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }
    
    #add_ward_options::-webkit-scrollbar-thumb:hover,
    #edit_ward_options::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
    
    /* Animation cho dropdown */
    #add_ward_dropdown,
    #edit_ward_dropdown {
        animation: fadeInDown 0.2s ease-out;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Hiệu ứng hover cho icon chevron */
    .bx-chevron-down:hover {
        color: #ff3029 !important;
        transform: translateY(-50%) scale(1.1) !important;
        transition: all 0.2s ease;
    }
    
    /* Tùy chỉnh cho ward-option */
    .ward-option {
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    
    .ward-option:active {
        background-color: #e5e7eb !important;
    }
</style>
