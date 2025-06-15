@extends('admin.layout.admin')

@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Danh sách liên hệ</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Trang chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Liên hệ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Danh sách liên hệ</div>
                    </li>
                </ul>
            </div>
            <!-- order-list -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search flex gap10" method="GET">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm tên hoặc email..." name="keyword"
                                    value="{{ request('keyword') }}">
                            </fieldset>
                            <fieldset>
                                <select name="status">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Mới</option>
                                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Đã đọc
                                    </option>
                                    <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Đã trả
                                        lời</option>
                                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Đã xử
                                        lý</option>
                                </select>
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.contacts.trash') }}">
                        <i class="icon-trash-2"></i>Thùng rác
                    </a>

                    <a class="tf-button style-1 w208" href="{{ route('admin.contacts.export') }}">
                        <i class="icon-file-text"></i>Xuất tất cả liên hệ
                    </a>
                </div>
                <div class="wg-table table-all-category">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">Email</div>
                        </li>
                        <li>
                            <div class="body-title">Họ tên</div>
                        </li>
                        <li>
                            <div class="body-title">Số điện thoại</div>
                        </li>
                        <li>
                            <div class="body-title">Tiêu đề</div>
                        </li>
                        <li>
                            <div class="body-title">Nội dung</div>
                        </li>
                        <li>
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li>
                            <div class="body-title">Phản hồi của admin</div>
                        </li>
                        <li>
                            <div class="body-title">Người trả lời</div>
                        </li>
                        <li>
                            <div class="body-title">Ngày tạo</div>
                        </li>
                        <li>
                            <div class="body-title">Thao tác</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        @foreach ($contacts as $value)
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4">{{ $value->email }}</div>
                                <div class="body-text text-main-dark mt-4">{{ Str::limit($value->name, 30) }}</div>
                                <div class="body-text text-main-dark mt-4">{{ $value->phone }}</div>
                                <div class="body-text text-main-dark mt-4">{{ Str::limit($value->subject, 30) }}</div>
                                <div class="body-text text-main-dark mt-4">{{ Str::limit($value->message, 30) }}</div>
                                <div>
                                    <div class="block-available status-{{ $value->status }} fw-7">
                                        @php
                                            $statusText = match ($value->status) {
                                                'new' => 'Mới',
                                                'read' => 'Đã đọc',
                                                'replied' => 'Đã trả lời',
                                                'resolved' => 'Đã xử lý',
                                                default => ucfirst($value->status),
                                            };
                                        @endphp
                                        {{ $statusText }}
                                    </div>
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    @if ($value->admin_reply)
                                        {{ Str::limit($value->admin_reply, 30) }}
                                    @else
                                        <span class="badge bg-danger">Chưa phản hồi</span>
                                    @endif
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    @if ($value->replied_by)
                                        {{ \App\Models\User::find($value->replied_by)->full_name ?? 'Không rõ' }}
                                    @else
                                        <span class="badge bg-danger">Không rõ</span>
                                    @endif
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    {{ $value->created_at->format('d-m-Y') }}
                                </div>
                                <div class="list-icon-function">
                                    <div class="item eye" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal{{ $value->id }}">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <!-- Modal Quick View contact -->
                                    <div class="modal fade" id="quickViewModal{{ $value->id }}" tabindex="-1"
                                        aria-labelledby="quickViewLabel{{ $value->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content shadow-lg rounded-5 border-0"
                                                style="font-size: 18px; border-radius: 32px;">
                                                <div class="modal-header bg-gradient-primary text-white rounded-top-5"
                                                    style="background: linear-gradient(90deg, #007bff 0%, #00c6ff 100%); border-top-left-radius: 32px; border-top-right-radius: 32px;">
                                                    <h3 class="modal-title fw-bold mb-0 text-light"
                                                        id="quickViewLabel{{ $value->id }}">
                                                        <i class="fa-solid fa-envelope-open-text me-2"></i>Chi tiết liên hệ
                                                    </h3>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                </div>
                                                <div class="modal-body px-5 py-4"
                                                    style="background: #f8fafc; border-bottom-left-radius: 32px; border-bottom-right-radius: 32px;">
                                                    <div class="row gy-4">
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-user me-2 text-primary"></i>
                                                            <strong>Họ tên:</strong>
                                                            <span class="text-dark ms-1 fs-5">{{ $value->name }}</span>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-envelope me-2 text-primary"></i>
                                                            <strong>Email:</strong>
                                                            <span class="text-dark ms-1 fs-5">{{ $value->email }}</span>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-phone me-2 text-primary"></i>
                                                            <strong>Số điện thoại:</strong>
                                                            <span class="text-dark ms-1 fs-5">{{ $value->phone }}</span>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-tag me-2 text-primary"></i>
                                                            <strong>Tiêu đề:</strong>
                                                            <span class="text-dark ms-1 fs-5">{{ $value->subject }}</span>
                                                        </div>
                                                        <div class="col-12 mb-2">
                                                            <i class="fa-solid fa-message me-2 text-primary"></i>
                                                            <strong>Nội dung:</strong>
                                                            <div
                                                                class="border rounded-4 p-4 bg-white text-secondary fst-italic mt-2 fs-5 shadow-sm">
                                                                {{ $value->message }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-circle-info me-2 text-primary"></i>
                                                            <strong>Trạng thái:</strong>
                                                            <span class="badge ms-2 fs-6"
                                                                style="background: #007bff; color: #fff; font-weight: bold; border-radius: 12px; padding: 8px 18px;">
                                                                {{ $statusText }}
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-user-shield me-2 text-primary"></i>
                                                            <strong>Phản hồi của admin:</strong>
                                                            <div
                                                                class="border rounded-4 p-3 bg-light text-secondary fst-italic mt-2 fs-6 shadow-sm">
                                                                {{ $value->admin_reply ?? '(Chưa có phản hồi)' }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-user-tie me-2 text-primary"></i>
                                                            <strong>Người trả lời:</strong>
                                                            <span class="text-dark ms-1 fs-5">
                                                                @if ($value->replied_by)
                                                                    {{ \App\Models\User::find($value->replied_by)->full_name ?? 'Không rõ' }}
                                                                @else
                                                                    Không rõ
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 mb-2">
                                                            <i class="fa-solid fa-calendar-days me-2 text-primary"></i>
                                                            <strong>Ngày tạo:</strong>
                                                            <span
                                                                class="text-dark ms-1 fs-5">{{ $value->created_at->format('d-m-Y H:i') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item edit">
                                        <a href="{{ route('admin.contacts.edit', $value->id) }}"><i
                                                class="icon-edit-3"></i></a>
                                    </div>
                                    <div class="item trash">
                                        <form action="{{ route('admin.contacts.destroy', $value->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa liên hệ này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; color: inherit; cursor: pointer; display: flex; align-items: center;">
                                                <i class="icon-trash-2" style="color: red; font-size: 20px;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Hiển thị {{ $contacts->firstItem() }} đến {{ $contacts->lastItem() }} trong tổng số
                        {{ $contacts->total() }} bản ghi
                    </div>
                    <ul class="wg-pagination">
                        {{-- Previous Page Link --}}
                        <li class="{{ $contacts->onFirstPage() ? 'disabled' : '' }}">
                            <a href="{{ $contacts->previousPageUrl() ?? '#' }}">
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>
                        {{-- Pagination Elements --}}
                        @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                            <li class="{{ $contacts->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $contacts->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        {{-- Next Page Link --}}
                        <li class="{{ $contacts->hasMorePages() ? '' : 'disabled' }}">
                            <a href="{{ $contacts->nextPageUrl() ?? '#' }}">
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /order-list -->
        </div>
        <!-- /main-content-wrap -->
    </div>
@endsection
