@extends('admin.layout.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Edit Review</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <a href="{{ route('admin.reviews.index') }}">
                            <div class="text-tiny">Reviews</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">Edit Review</div>
                    </li>
                </ul>
            </div>
            <!-- form-edit-review -->
            <form class="form-edit-review" method="POST" action="{{ route('admin.reviews.update', $review->id) }}">
                @csrf
                @method('PUT')
                <div class="wg-box mb-30">
                    <fieldset>
                        <div class="body-title mb-10">Người dùng</div>
                        <input type="text" class="form-control" value="{{ $review->user->full_name ?? 'Không rõ' }}"
                            readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Sản phẩm</div>
                        <input type="text" class="form-control" value="{{ $review->product->name ?? 'Không rõ' }}"
                            readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Mã đơn hàng</div>
                        @php
                            $orderId = $review->orderItem->order_id ?? null;
                            $order = $orders->firstWhere('id', $orderId);
                        @endphp
                        <input type="text" class="form-control"
                            value="{{ $order ? $order->order_code : $orderId ?? 'N/A' }}" readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Đánh giá (sao)</div>
                        <input type="number" name="rating" class="form-control" min="1" max="5"
                            value="{{ old('rating', $review->rating) }}" readonly>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Bình luận</div>
                        <input name="comment" type="text" class="form-control" value="{{ old('comment', $review->comment) }}" readonly></input>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Trạng thái*</div>
                        <select name="status">
                            <option value="pending" {{ $review->status == 'pending' ? 'selected' : '' }}>Chờ duyệt
                            </option>
                            <option value="approved" {{ $review->status == 'approved' ? 'selected' : '' }}>Đã duyệt
                            </option>
                            <option value="rejected" {{ $review->status == 'rejected' ? 'selected' : '' }}>Từ chối
                            </option>
                        </select>
                    </fieldset>
                    <fieldset>
                        <div class="body-title mb-10">Ngày tạo</div>
                        <input type="text" class="form-control" value="{{ $review->created_at->format('d-m-Y H:i') }}"
                            readonly>
                    </fieldset>
                </div>
                <div class="cols gap10">
                    <button class="tf-button w380" type="submit">Cập nhật đánh giá</button>
                    <a href="{{ route('admin.reviews.index') }}" class="tf-button style-3 w380">Hủy</a>
                </div>
            </form>
            <!-- /form-edit-review -->
        </div>
    </div>
@endsection
