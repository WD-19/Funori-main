@extends('admin.layout.admin')

@section('content')
    <!-- message-list -->
    <style>
        .zalo-chat-container {
            display: flex;
            height: 630px;
            border-radius: 16px;
            overflow: hidden;
            font-size: 20px;
            background: #f6f8fa;
            box-shadow: 0 2px 16px 0px #0002;
        }

        .chat-list {
            background: #fff;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 12px #0001;
            border-right: none;
        }

        .chat-list-header {
            font-weight: bold;
            font-size: 22px;
            background: #fff;
            border-bottom: none;
            letter-spacing: 1px;
        }

        .chat-list ul {
            list-style: none;
            margin: 0;
            padding: 0;
            flex: 1;
            overflow-y: auto;
        }

        .chat-list ul li {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 10px 12px;
            cursor: pointer;
            background: #fff;
            font-size: 20px;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px #00000008;
            border-bottom: none;
        }

        .chat-list ul li.active,
        .chat-list ul li:hover {
            background: #e8f0fe;
            box-shadow: 0 4px 16px #0084ff22;
        }

        .chat-list .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e5e7eb;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 2px 8px #0001;
        }

        .chat-list .info {
            flex: 1;
            min-width: 0;
        }

        .chat-list .info strong {
            display: block;
            font-size: 20px;
            color: #222;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-list .info .latest {
            font-size: 15px;
            color: #888;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 2px;
        }

        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f6f8fa;
            border-radius: 0 16px 16px 0;
        }

        .chat-area-header {
            padding: 10px;
            font-weight: bold;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            background: #f6f8fa;
            border-bottom: 1px solid #e8e8e8;
        }

        .chat-area-header .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e5e7eb;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 2px 8px #0001;
        }

        .chat-messages {
            flex: 1;
            padding: 32px 24px 24px 24px;
            overflow-y: auto;
            background: #f6f8fa;
            font-size: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .chat-message {
            display: flex;
            align-items: flex-end;
            gap: 10px;
        }

        .chat-message.me {
            justify-content: flex-end;
        }

        .chat-message .bubble {
            display: inline-block;
            padding: 14px 24px;
            border-radius: 24px 24px 24px 8px;
            background: #fff;
            font-size: 20px;
            max-width: 60%;
            word-break: break-word;
            overflow-wrap: anywhere;
            /* Thêm dòng này */
            box-shadow: 0 2px 8px #0084ff11;
            border: 1px solid #e8e8e8;
            color: #222;
            text-align: justify;
        }

        .chat-message.me .bubble {
            background: #0084ff;
            color: #fff;
            border-radius: 24px 24px 8px 24px;
            border: none;
            box-shadow: 0 2px 8px #0084ff33;
        }

        .chat-message .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e5e7eb;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 2px 8px #0001;
        }

        .chat-input-form {
            display: flex;
            align-items: center;
            /* Thêm dòng này để các thành phần nằm ngang */
            border-top: 1px solid #e8e8e8;
            padding: 10px;
            background: #f6f8fa;
            border-radius: 0 0 16px 0;
        }

        .chat-input-form input {
            flex: 1;
            border: none;
            outline: none;
            border-radius: 30px;
            background: #fff;
            font-size: 22px;
            box-shadow: 0 2px 8px #00000008;
            border: 1px solid #e8e8e8;
            color: #222;
        }

        .chat-input-form label[for="chatFile"] {
            display: flex;
            align-items: center;
            margin-left: 12px;
            cursor: pointer;
            height: 40px;
            /* Đặt chiều cao giống nút gửi */
        }

        .chat-input-form button {
            margin-left: 12px;
            background: #0084ff;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 0 16px;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 2px 8px #0084ff33;
            height: 40px;
            /* Đặt chiều cao giống icon ghim */
            display: flex;
            align-items: center;
        }

        #chatMessages.fade-in {
            animation: fadeInChat 0.3s;
        }

        @keyframes fadeInChat {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scrollbar đẹp cho sidebar và vùng chat */
        .chat-list ul,
        .chat-messages {
            scrollbar-width: thin;
            scrollbar-color: lightgray #e8f0fe;
        }

        /* Chrome, Edge, Safari */
        .chat-list ul::-webkit-scrollbar,
        .chat-messages::-webkit-scrollbar {
            width: 8px;
            background: #e8f0fe;
            border-radius: 8px;
        }

        .chat-list ul::-webkit-scrollbar-thumb,
        .chat-messages::-webkit-scrollbar-thumb {
            background: #0084ff;
            border-radius: 8px;
            min-height: 24px;
        }

        .chat-list ul::-webkit-scrollbar-thumb:hover,
        .chat-messages::-webkit-scrollbar-thumb:hover {
            background: #005bb5;
        }
    </style>
    <div class="zalo-chat-container">
        <!-- Danh sách cuộc trò chuyện -->
        <div class="chat-list">
            <form id="chatSearchForm" style="padding: 4.5px; background: #fff; border-bottom: none;">
                <input id="chatSearchInput" type="text" class="form-control" placeholder="Tìm kiếm đoạn chat..."
                    style="font-size: 18px; border-radius: 8px;">
            </form>
            <script>
                let isSearching = false;

                document.getElementById('chatSearchInput').addEventListener('input', function () {
                    const keyword = this.value.toLowerCase();
                    isSearching = !!keyword; // Đang tìm kiếm nếu có từ khóa
                    let found = false;
                    document.querySelectorAll('#chatList .chat-item').forEach(item => {
                        const name = item.querySelector('.info strong').innerText.toLowerCase();
                        if (name.includes(keyword)) {
                            item.style.display = '';
                            found = true;
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    let emptyMsg = document.getElementById('chatListEmpty');
                    if (!found) {
                        if (!emptyMsg) {
                            emptyMsg = document.createElement('li');
                            emptyMsg.id = 'chatListEmpty';
                            emptyMsg.style = 'text-align:center;color:#888;padding:24px 0;';
                            emptyMsg.innerText = 'Không tìm thấy đoạn chat nào!';
                            document.getElementById('chatList').appendChild(emptyMsg);
                        }
                    } else {
                        if (emptyMsg) emptyMsg.remove();
                    }
                });
            </script>
            <ul id="chatList">
                @foreach ($conversations as $conv)
                    <li class="chat-item {{ $conv->id == $activeId ? 'active' : '' }}" data-id="{{ $conv->id }}">
                        <img class="avatar"
                            src="{{ $conv->user->avatar_url ? asset('storage/' . $conv->user->avatar_url) : asset('images/avatar/user-1.png') }}"
                            alt="avatar">
                        <div class="info">
                            <strong>{{ $conv->user->full_name ?? 'Không xác định' }}</strong>
                            <span
                                class="latest">{{ Str::limit($conv->latestMessage->content ?? 'Chưa có tin nhắn', 20) }}</span>
                        </div>
                        <div class="dropdown ms-auto">
                            <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span style="font-size: 24px;">&#8230;</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.users.show', $conv->user->id) }}"
                                        target="_blank">
                                        Xem người dùng
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('admin.messages.delete', $conv->id) }}"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa đoạn chat này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item text-danger" type="submit">Xóa đoạn chat</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <style>
            .btn-link {
                text-decoration: none !important;
                /* Bỏ gạch chân dấu ... */
                border: none !important;
                /* Bỏ border khi active */
                box-shadow: none !important;
                /* Bỏ shadow khi active */
            }

            .btn-link:focus,
            .btn-link:active {
                outline: none !important;
                border: none !important;
                box-shadow: none !important;
            }

            .btn-link span {
                text-decoration: none !important;
                /* Bỏ gạch chân cho dấu ... */
            }
        </style>
        <!-- Vùng chat -->
        <div class="chat-area">
            <div id="chatHeader" class="chat-area-header">
                <img class="avatar"
                    src="{{ $activeConversation?->user?->avatar_url ? asset('storage/' . $activeConversation?->user?->avatar_url) : asset('images/avatar/user-1.png') }}"
                    alt="avatar">
                <span>{{ $activeConversation?->user?->full_name ?? 'Không xác định' }}</span>
            </div>
            <div id="chatMessages" class="chat-messages">
                @if ($activeConversation)
                    @foreach ($activeConversation->messages as $msg)
                        <div class="chat-message{{ $msg->is_admin ? ' me' : '' }}">
                            <div class="bubble">
                                @if ($msg->content === '/strong')
                                    <svg width="26" height="26" viewBox="0 0 24 24" fill="#0084ff" style="vertical-align:middle;">
                                        <path d="M2 21h4V9H2v12zm20-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L13.17 2
                                                                                                7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1.09
                                                                                                l-.01-.01L22 10z" />
                                    </svg>
                                @else
                                    {{ $msg->content }}
                                @endif
                                <span class="msg-actions" data-id="{{ $msg->id }}"
                                    style="cursor:pointer;float:right;margin-left:8px;font-size:22px;">&#8230;</span>
                            </div>
                        </div>
                    @endforeach

                    <!-- Popup actions -->
                    <div id="msgActionsPopup"
                        style="display:none;position:absolute;z-index:999;background:#fff;border-radius:8px;box-shadow:0 2px 8px #0002;padding:8px 0;">
                        <button id="copyMsgBtn"
                            style="display:block;width:100%;background:none;border:none;padding:8px 24px;text-align:left;">Sao
                            chép</button>
                        <button id="revokeMsgBtn"
                            style="display:block;width:100%;background:none;border:none;padding:8px 24px;text-align:left;color:#d00;">Thu
                            hồi</button>
                    </div>
                @endif
            </div>
            <form id="chatForm" class="chat-input-form" onsubmit="sendMessage(event)" enctype="multipart/form-data">
                <input id="chatInput" type="text" placeholder="Nhập tin nhắn..." autocomplete="off">
                <button type="button" id="emojiBtn" style="background:none;border:none;font-size:22px;margin-left:6px;cursor:pointer;">😊</button>
                <div id="chatImagePreview" style="display:flex; gap:8px; align-items:center;"></div>
                <input id="chatFile" type="file" style="display:none;" multiple accept="image/*">
                <script>
                    let pastedImageFile = null;

                    // Paste ảnh từ clipboard
                    chatInput.addEventListener('paste', function (e) {
                        const items = (e.clipboardData || window.clipboardData).items;
                        for (let i = 0; i < items.length; i++) {
                            if (items[i].type.indexOf('image') !== -1) {
                                pastedImageFile = items[i].getAsFile();
                                updateImagePreview();
                                e.preventDefault();
                                break;
                            }
                        }
                    });

                    // Chọn file từ máy
                    document.getElementById('chatFile').addEventListener('change', function (e) {
                        const files = Array.from(e.target.files);
                        if (files.length > 0) {
                            pastedImageFile = files[0];
                        }
                        updateImagePreview();
                        e.target.value = '';
                    });

                    // Preview ảnh
                    function updateImagePreview() {
                        const preview = document.getElementById('chatImagePreview');
                        preview.innerHTML = '';
                        if (pastedImageFile) {
                            const reader = new FileReader();
                            reader.onload = function (evt) {
                                const div = document.createElement('div');
                                div.style.position = 'relative';
                                div.style.display = 'inline-block';
                                div.innerHTML = `
                    <img src="${evt.target.result}" style="width:56px;height:56px;border-radius:8px;object-fit:cover;">
                    <span style="position:absolute;top:2px;right:2px;background:#222b;padding:2px 6px;border-radius:50%;color:#fff;cursor:pointer;font-size:16px;">×</span>
                `;
                                div.querySelector('span').onclick = function () {
                                    pastedImageFile = null;
                                    updateImagePreview();
                                };
                                preview.appendChild(div);
                            };
                            reader.readAsDataURL(pastedImageFile);
                        }
                    }

                    // Khi gửi tin nhắn
                    function sendMessage(e) {
                        e.preventDefault();
                        let text = chatInput.value.trim();

                        const formData = new FormData();
                        // Nếu không có text, vẫn phải truyền content rỗng
                        formData.append('content', text || '');
                        formData.append('_token', '{{ csrf_token() }}');
                        if (pastedImageFile) {
                            formData.append('file', pastedImageFile);
                        }

                        $.ajax({
                            url: `/admin/message/messages/${activeId}`,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function () {
                                chatInput.value = '';
                                pastedImageFile = null;
                                updateImagePreview();
                                loadMessages(true);
                                loadConversations();
                            },
                            error: function (xhr) {
                                alert('Gửi ảnh thất bại: ' + xhr.status + ' - ' + xhr.responseText);
                                pastedImageFile = null;
                                updateImagePreview();
                            }
                        });
                    }

                    function sendImageOnly() {
                        const formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        if (pastedImageFile) {
                            formData.append('file', pastedImageFile); // key là 'file'
                        } else {
                            alert('Chưa chọn ảnh!');
                            return;
                        }

                        $.ajax({
                            url: `/admin/message/messages/${activeId}/file`,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function () {
                                pastedImageFile = null;
                                updateImagePreview();
                                loadMessages(true);
                                loadConversations();
                            },
                            error: function (xhr) {
                                alert('Gửi ảnh thất bại: ' + xhr.status + ' - ' + xhr.responseText);
                            }
                        });
                    }
                </script>

                <button type="submit">Gửi</button>
            </form>
            <!-- Emoji Picker -->
            <div id="emojiPicker" style="display:none; position:absolute; bottom:80px; right:40px; background:#fff; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,0.15); padding:15px; width:340px; max-height:320px; overflow-y:auto; z-index:99999;">
                <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:8px;">
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😀</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😃</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😄</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😁</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😆</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😅</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🤣</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😂</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😊</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🙂</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😍</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🥰</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😘</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😗</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😙</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😚</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😛</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😝</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😜</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🤪</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😎</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🤩</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🤭</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🥳</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🙄</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😏</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🥺</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😔</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😢</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😭</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😞</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😓</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😱</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😤</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🤔</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🤫</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😴</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🤐</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">😷</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🤒</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">👍</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">👎</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">👏</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🙏</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🤝</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">👌</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">✌️</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">👊</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">❤️</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🧡</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">💛</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">💚</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">💙</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">💜</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🖤</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">💕</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🌸</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🌺</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🌹</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🌈</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">☀️</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🌙</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">⭐</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">✨</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🍕</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🍔</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🍦</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🍰</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🧁</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🍷</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🍻</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">☕</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">⚽</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🏀</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🎮</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🎯</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🏆</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🎵</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🎬</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🎁</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🔥</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">✅</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">❌</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">⚠️</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">💯</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">🎉</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">💢</span>
                    <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;">💤</span>
                </div>
            </div>
    <style>
        #emojiPicker .emoji-btn:hover {
            background: #f3f3f3;
            transform: scale(1.2);
        }
    </style>
            </form>
        </div>
    </div>
    <!-- Modal xem ảnh lớn -->
    <div id="chatImageModal"
        style="display:none;position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.7);justify-content:center;align-items:center;">
        <img id="chatImageModalImg" src=""
            style="max-width:90vw;max-height:90vh;border-radius:16px;box-shadow:0 4px 32px #0008;">
    </div>
    <script>
        // Emoji picker logic
        document.addEventListener('DOMContentLoaded', function () {
            const emojiBtn = document.getElementById('emojiBtn');
            const emojiPicker = document.getElementById('emojiPicker');
            const chatInput = document.getElementById('chatInput');
            // Toggle emoji picker
            emojiBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                emojiPicker.style.display = emojiPicker.style.display === 'none' ? 'block' : 'none';
            });
            // Insert emoji
            emojiPicker.querySelectorAll('.emoji-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const emoji = this.textContent;
                    // Insert at cursor position
                    const start = chatInput.selectionStart;
                    const end = chatInput.selectionEnd;
                    const value = chatInput.value;
                    chatInput.value = value.substring(0, start) + emoji + value.substring(end);
                    chatInput.focus();
                    chatInput.selectionStart = chatInput.selectionEnd = start + emoji.length;
                    emojiPicker.style.display = 'none';
                });
            });
            // Hide emoji picker when clicking outside
            document.addEventListener('click', function (e) {
                if (!emojiPicker.contains(e.target) && e.target !== emojiBtn) {
                    emojiPicker.style.display = 'none';
                }
            });
        });
        let activeId = '{{ $activeId }}';
        let chatInterval = null;
        let isSwitchingChat = false;
        // Thêm biến toàn cục
        let needSwitchToFirst = false;
        const chatMessages = document.getElementById('chatMessages');
        const chatHeader = document.getElementById('chatHeader');
        const chatInput = document.getElementById('chatInput');
        const chatList = document.getElementById('chatList');

        // Hàm load lại tin nhắn của đoạn chat đang chọn
        function loadMessages(scroll = true) {
            fetch(`/admin/message/messages/${activeId}`)
                .then(res => res.json())
                .then(data => {
                    if (isSwitchingChat) {
                        chatMessages.classList.remove('fade-in');
                        void chatMessages.offsetWidth; // Force reflow
                    }
                    chatMessages.innerHTML = '';
                    data.messages.forEach(msg => {
                        let content = msg.content;
                        let hasImage = false;
                        // Nếu có file ảnh thì hiển thị ảnh
                        if (msg.files && msg.files.length) {
                            msg.files.forEach(fileUrl => {
                                if (/\.(jpg|jpeg|png|gif)$/i.test(fileUrl)) {
                                    content +=
                                        `<br><img src="${fileUrl}" style="max-width:220px;max-height:220px;border-radius:12px;margin-top:8px;">`;
                                    hasImage = true;
                                }
                            });
                        }
                        if (content === '/strong') {
                            content = `<svg width="36" height="36" viewBox="0 0 24 24" style="vertical-align:middle;">
                <path fill="#f9d4b7" d="M2 21h4V9H2v12zm20-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L13.17 2
                    7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1.09
                    l-.01-.01L22 10z"/>
            </svg>`;
                        } else if (/^https?:\/\/\S+$/i.test(content)) {
                            content =
                                `<a href="${content}" target="_blank" style="color: #fff;text-decoration:underline;">${content}</a>`;
                        }
                        // Nếu là ảnh thì không có nền xanh
                        let bubbleClass = "bubble";
                        if (msg.is_admin && !hasImage) bubbleClass += " me";
                        chatMessages.innerHTML += `<div class="chat-message${msg.is_admin ? ' me' : ''}">
            <div class="${bubbleClass}" style="${hasImage ? 'background:transparent;border:none;box-shadow:none;padding:0;' : ''}">${content}</div>
        </div>`;
                    });
                    if (isSwitchingChat) {
                        chatMessages.classList.add('fade-in');
                        isSwitchingChat = false;
                    }
                    if (scroll) {
                        requestAnimationFrame(() => {
                            chatMessages.scrollTop = chatMessages.scrollHeight;
                        });
                    }
                });
        }

        // Hàm load lại danh sách đoạn chat (sidebar)
        function loadConversations() {
            // Lưu lại đoạn chat đang mở dropdown (nếu có)
            const openedDropdown = document.querySelector('.chat-item .dropdown .dropdown-menu.show');
            let openedId = null;
            if (openedDropdown) {
                const parentLi = openedDropdown.closest('.chat-item');
                if (parentLi) openedId = parentLi.dataset.id;
            }

            fetch('/admin/messages?sidebar=1')
                .then(res => res.json())
                .then(data => {
                    chatList.innerHTML = '';
                    data.conversations.forEach(conv => {
                        let avatar = conv.user_avatar
                            ? (/^https?:\/\//.test(conv.user_avatar)
                                ? conv.user_avatar
                                : '/storage/' + conv.user_avatar.replace(/^\/+/, ''))
                            : '{{ asset('images/avatar/user-1.png') }}'; 
                        let latestMsg = conv.latest_message ?? 'Chưa có tin nhắn';
                        if (latestMsg.length > 15) {
                            latestMsg = latestMsg.substring(0, 15) + '...';
                        }
                        chatList.innerHTML += `
    <li class="chat-item${conv.id == activeId ? ' active' : ''}" data-id="${conv.id}">
        <img class="avatar" src="${avatar}" alt="avatar">
        <div class="info">
            <strong>${conv.user_name}</strong>
            <span class="latest">${latestMsg}</span>
        </div>
        <div class="dropdown ms-auto">
            <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span style="font-size: 24px;">&#8230;</span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" style="font-size: 16px;" href="/admin/users/${conv.user_id}" target="_blank">
                        Xem người dùng
                    </a>
                </li>
                <li>
                    <button class="dropdown-item text-danger btn-delete-chat" style="font-size: 16px;" data-id="${conv.id}" type="button">
                        Xóa đoạn chat
                    </button>
                </li>
            </ul>
        </div>
    </li>
                            `;

                    });

                    // Gán lại sự kiện click cho các item mới
                    document.querySelectorAll('.chat-item').forEach(item => {
                        item.addEventListener('click', function (e) {
                            // Nếu click vào dropdown hoặc bên trong dropdown thì không chuyển đoạn chat
                            if (
                                e.target.closest('.dropdown') ||
                                e.target.closest('.dropdown-menu')
                            ) return;

                            if (this.classList.contains('active')) return;
                            document.querySelectorAll('.chat-item').forEach(i => i.classList.remove(
                                'active'));
                            this.classList.add('active');
                            activeId = this.dataset.id;
                            chatHeader.querySelector('span').innerText = this.querySelector(
                                '.info strong').innerText;
                            chatHeader.querySelector('.avatar').src = this.querySelector('.avatar').src;
                            isSwitchingChat = true;
                            loadMessages(true); // Chỉ cuộn và fade khi chuyển đoạn chat
                            if (chatInterval) clearInterval(chatInterval);
                            chatInterval = setInterval(() => loadMessages(false),
                                2000); // KHÔNG cuộn, KHÔNG fade khi reload tự động
                        });
                    });

                    // Mở lại dropdown nếu trước đó đang mở
                    if (openedId) {
                        const li = chatList.querySelector(`.chat-item[data-id="${openedId}"]`);
                        if (li) {
                            const dropdownBtn = li.querySelector('[data-bs-toggle="dropdown"]');
                            if (dropdownBtn) {
                                dropdownBtn.click();
                            }
                        }
                    }

                    // Chuyển sang đoạn chat đầu tiên nếu vừa xóa đoạn chat đang xem
                    if (needSwitchToFirst) {
                        const firstChat = document.querySelector('.chat-item');
                        if (firstChat) firstChat.click();
                        else {
                            chatMessages.innerHTML =
                                '<div style="text-align:center;color:#888;">Không còn đoạn chat nào!</div>';
                            chatHeader.innerText = '';
                        }
                        needSwitchToFirst = false;
                    }
                });
        }

        // Gửi tin nhắn
        function sendMessage(e) {
            e.preventDefault();
            let text = chatInput.value.trim();

            const formData = new FormData();
            // Nếu không có text, vẫn phải truyền content rỗng
            formData.append('content', text || '');
            formData.append('_token', '{{ csrf_token() }}');
            if (pastedImageFile) {
                formData.append('file', pastedImageFile);
            }

            $.ajax({
                url: `/admin/message/messages/${activeId}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    chatInput.value = '';
                    pastedImageFile = null;
                    updateImagePreview();
                    loadMessages(true);
                    loadConversations();
                },
                error: function (xhr) {
                    alert('Gửi ảnh thất bại: ' + xhr.status + ' - ' + xhr.responseText);
                    pastedImageFile = null;
                    updateImagePreview();
                }
            });
        }

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-delete-chat')) {
                const chatId = e.target.getAttribute('data-id');
                if (!confirm('Bạn có chắc muốn xóa đoạn chat này?')) return;
                if (activeId == chatId) {
                    needSwitchToFirst = true;
                }
                fetch(`/admin/messages/${chatId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(res => {
                        if (res.ok) {
                            loadConversations();
                        }
                    });
            }
        });


        // Tải tin nhắn lần đầu
        loadMessages(true);
        // Tự động reload tin nhắn mỗi 2 giây, KHÔNG cuộn xuống cuối
        chatInterval = setInterval(() => loadMessages(false), 2000);
        // Tự động reload sidebar mỗi 5 giây (hoặc giữ nguyên 2 giây nếu muốn)
        setInterval(() => {
            if (!isSearching) loadConversations();
        }, 2000);

        // Mở ảnh lớn khi click vào ảnh trong tin nhắn
        document.getElementById('chatMessages').addEventListener('click', function (e) {
            if (e.target.tagName === 'IMG' && e.target.closest('.bubble')) {
                const imgSrc = e.target.src;
                const modal = document.getElementById('chatImageModal');
                const modalImg = document.getElementById('chatImageModalImg');
                modalImg.src = imgSrc;
                modal.style.display = 'flex';

                // Đóng modal khi click vào ảnh lớn
                modal.onclick = function () {
                    modal.style.display = 'none';
                };
            }
        });

        document.addEventListener('click', function (e) {
            // Nếu click vào ảnh trong chat
            if (e.target.matches('.chat-messages img')) {
                const modal = document.getElementById('chatImageModal');
                const modalImg = document.getElementById('chatImageModalImg');
                modalImg.src = e.target.src;
                modal.style.display = 'flex';
            }
            // Nếu click ra ngoài ảnh thì đóng modal
            if (e.target.id === 'chatImageModal') {
                e.target.style.display = 'none';
                document.getElementById('chatImageModalImg').src = '';
            }
        });
    </script>
    <!-- /message-list -->
    <br>
@endsection