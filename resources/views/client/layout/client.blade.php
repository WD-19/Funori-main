<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome & Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="{{ asset('client/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/shop.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/main-mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('client/ecomus/css/styles.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YRJ52MEC41"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-YRJ52MEC41');
    </script>
</head>

<style>
    /* Loader full screen */
    #preload {
        position: fixed;
        z-index: 9999;
        inset: 0;
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    #preload.fade-out {
        opacity: 0;
        visibility: hidden;
    }

    .preloading i {
        font-size: 3rem;
        color: #333;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .bubble {
        padding: 7px 20px;
        border-radius: 24px 24px 24px 8px;
        background: #fff;
        font-size: 16px;
        max-width: 70%;
        word-break: break-word;
        overflow-wrap: anywhere;
        box-shadow: 0 2px 8px #0084ff11;
        border: 1px solid #e8e8e8;
        color: #222;
        text-align: justify;
    }

    /* Custom scrollbar for chat body */
    #chat-body {
        scrollbar-width: thin;
        scrollbar-color: lightgray #f3f3f3;
    }

    /* Chrome, Edge, Safari */
    #chat-body::-webkit-scrollbar {
        width: 8px;
        background: #f3f3f3;
        border-radius: 8px;
    }

    #chat-body::-webkit-scrollbar-thumb {
        background: #007bff;
        border-radius: 8px;
    }

    #chat-body::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }
</style>
</head>

<body>
    <!-- Loader -->
    <div id="preload">
        <div class="preloading">
            <i class="fas fa-spinner"></i>
        </div>
    </div>

    <!-- Header -->
    @include('client.partials.header')

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    @include('client.partials.footer')

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/eda05fcf5c.js" crossorigin="anonymous"></script>
    <script src="{{ asset('client/js/main.js') }}"></script>
    <script src="{{ asset('client/ecomus/js/jquery.min.js') }}"></script>
    <script src="{{ asset('client/ecomus/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('client/ecomus/js/swiper-bundle.min.js') }}"></script>
    <!-- Bootstrap 5 JS for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('client/ecomus/js/carousel.js') }}"></script>
    <script src="{{ asset('client/ecomus/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('client/ecomus/js/lazysize.min.js') }}"></script>
    <script src="{{ asset('client/ecomus/js/count-down.js') }}"></script>
    <script src="{{ asset('client/ecomus/js/wow.min.js') }}"></script>
    <script src="{{ asset('client/ecomus/js/multiple-modal.js') }}"></script>
    <script src="{{ asset('client/ecomus/js/main.js') }}"></script>
    <script src="{{ asset('client/ecomus/js/rangle-slider.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Fade-out effect on load -->
    <script>
        window.addEventListener('load', function () {
            const preload = document.getElementById('preload');
            preload.classList.add('fade-out');
        });
    </script>

    <!-- Nút mở chat -->
    @if (Auth::check())
        <div id="chat-toggle"
            style="position:fixed;bottom:30px;right:30px;z-index:9999;cursor:pointer;background:#007bff;color:#fff;width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,0.2);">
            <i class="fas fa-comments"></i>
        </div>
    @endif

    <!-- Khung chat -->
    <div id="chat-box"
        style="position:fixed;bottom:90px;right:30px;width:420px;max-width:98vw;background:#fff;border-radius:10px;box-shadow:0 2px 16px rgba(0,0,0,0.2);display:none;flex-direction:column;z-index:9999;">
        <div
            style="background:#007bff;color:#fff;padding:12px 16px;border-radius:10px 10px 0 0;display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:20px;">
                <i class="fas fa-user-circle"></i>
                <span>Nhắn tin với chúng tôi</span>
            </span>
        </div>
        <div id="chat-body" style="padding:12px;height:440px;overflow-y:auto;font-size:15px;">
            <div style="color:#888;">Xin chào! Bạn cần hỗ trợ gì?</div>
        </div>
        <div id="chat-suggestions" style="padding:8px 12px 0 12px; display:flex; flex-wrap:wrap; gap:8px;">
            @foreach(\App\Models\ChatSuggestion::all() as $suggestion)
                <button type="button" class="btn btn-light btn-sm chat-suggestion-btn"
                    style="border-radius:18px; background:#f1f1f1; color:#222; font-size:15px; padding:6px 18px; margin-bottom:4px; box-shadow:0 1px 4px #0001; border:none;">
                    {{ $suggestion->content }}
                </button>
            @endforeach
        </div>
        <div style="padding:8px 12px; border-top:1px solid #eee; display:flex; gap:8px; align-items:center;">
            <input id="chat-input" type="text" class="form-control" placeholder="Nhập tin nhắn..."
                style="flex:1; min-width:0;">
            <div id="chatImagePreview" style="display:flex; gap:8px; align-items:center;"></div>
            <label for="chatImageInput" style="margin-left:8px;cursor:pointer;display:flex;align-items:center;">
                <i class="fa fa-paperclip" style="font-size:22px;"></i>
            </label>
            <button type="button" id="chatEmojiBtn"
                style="background:none; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:22px; padding:0; transition:transform 0.2s;"
                onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">
                <i class="far fa-smile"></i>
            </button>
            <button id="chat-send" class="btn btn-primary" type="button"
                style="display:flex; align-items:center; justify-content:center;">Gửi</button>
        </div>
        <input id="chatImageInput" type="file" accept="image/*" style="display:none;">
        <div id="chatImagePreview" style="display:flex; gap:8px; align-items:center;"></div>
    </div>

    <!-- Modal xem ảnh lớn -->
    <div id="clientChatImageModal"
        style="display:none;position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.7);justify-content:center;align-items:center;">
        <img id="clientChatImageModalImg" src=""
            style="max-width:90vw;max-height:90vh;border-radius:16px;box-shadow:0 4px 32px #0008;">
    </div>

<div id="emojiPicker" style="display:none; position:absolute; bottom:80px; right:20px; background:#fff; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,0.15); padding:15px; width:340px; max-height:320px; overflow-y:auto; z-index:99999;">
    <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:8px;">
        <!-- Mặt cười cơ bản -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😀</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😃</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😄</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😁</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😆</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😅</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🤣</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😂</span>
        
        <!-- Tình yêu -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😊</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🙂</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😍</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🥰</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😘</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😗</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😙</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😚</span>
        
        <!-- Vui vẻ -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😛</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😝</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😜</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🤪</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😎</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🤩</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🤭</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🥳</span>
        
        <!-- Buồn bã -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🙄</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😏</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🥺</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😔</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😢</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😭</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😞</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😓</span>
        
        <!-- Khác -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😱</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😤</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🤔</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🤫</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😴</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🤐</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😷</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🤒</span>
        
        <!-- Cử chỉ -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">👍</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">👎</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">👏</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🙏</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🤝</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">👌</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">✌️</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">👊</span>
        
        <!-- Trái tim -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">❤️</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🧡</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">💛</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">💚</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">💙</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">💜</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🖤</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">💕</span>
        
        <!-- Thiên nhiên và động vật -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🌸</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🌺</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🌹</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🌈</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">☀️</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🌙</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">⭐</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">✨</span>
        
        <!-- Đồ ăn -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🍕</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🍔</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🍦</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🍰</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🧁</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🍷</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🍻</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">☕</span>
        
        <!-- Hoạt động -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">⚽</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🏀</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🎮</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🎯</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🏆</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🎵</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🎬</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🎁</span>
        
        <!-- Biểu tượng -->
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🔥</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">✅</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">❌</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">⚠️</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">💯</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🎉</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">💢</span>
        <span class="emoji-btn" style="cursor:pointer; font-size:24px; padding:6px; transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">💤</span>
    </div>
</div>
</body>

<!--End of Tawk.to Script-->
<script src="https://kit.fontawesome.com/eda05fcf5c.js" crossorigin="anonymous"></script>
<script src="{{ asset('client/js/main.js') }}"></script>

<script src="{{ asset('client/ecomus/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/jquery.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/carousel.js') }}"></script>
<script src="{{ asset('client/ecomus/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/lazysize.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/count-down.js') }}"></script>
<script src="{{ asset('client/ecomus/js/wow.min.js') }}"></script>
<script src="{{ asset('client/ecomus/js/multiple-modal.js') }}"></script>
<script src="{{ asset('client/ecomus/js/main.js') }}"></script>
<script type="text/javascript" src="js/rangle-slider.js"></script>

<!-- Toastr JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    const preload = document.getElementById('preload');

    // 1. Xử lý khi load lại do back/forward
    window.addEventListener('pageshow', function (event) {
        // Nếu trình duyệt load từ cache (bfcache) hoặc là dạng "back_forward"
        const isBack = event.persisted || performance.getEntriesByType("navigation")[0]?.type ===
            "back_forward";

        if (isBack) {
            // Cho hiện preload
            if (preload) {
                preload.style.opacity = '1';
                preload.style.visibility = 'visible';
                preload.classList.remove('fade-out');
            }

            // Lưu cờ trong sessionStorage để biết là đang reload lại
            sessionStorage.setItem('forceReload', 'yes');

            // Reload lại sau 50ms (cho preload kịp hiển thị)
            setTimeout(() => {
                window.location.reload();
            }, 50);
        }
    });

    // 2. Khi trang load bình thường
    window.addEventListener('load', function () {
        const forceReload = sessionStorage.getItem('forceReload');

        if (forceReload === 'yes') {
            // Vừa reload xong sau back → KHÔNG ẩn preload
            sessionStorage.removeItem('forceReload');
            return;
        }

        // Load bình thường → fade out preload
        if (preload) {
            preload.classList.add('fade-out');
        }
    });
</script>

<style>
    #preload {
        position: fixed;
        inset: 0;
        background: white;
        z-index: 9999;
        opacity: 1;
        visibility: visible;
        transition: opacity 0.4s ease, visibility 0.4s ease;
    }

    #preload.fade-out {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatToggle = document.getElementById('chat-toggle');
        const chatBox = document.getElementById('chat-box');
        const chatClose = document.getElementById('chat-close');
        const chatInput = document.getElementById('chat-input');
        const chatSend = document.getElementById('chat-send');
        const chatBody = document.getElementById('chat-body');
        const chatImageInput = document.getElementById('chatImageInput');
        const chatImagePreview = document.getElementById('chatImagePreview');
        let loading = false;

        chatToggle.onclick = function () {
            if (chatBox.style.display === 'flex') {
                chatBox.style.display = 'none';
            } else {
                chatBox.style.display = 'flex';
                requestAnimationFrame(() => {
                    loadMessages(true);
                });
            }
        };

        chatSend.onclick = sendMessage;
        chatInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') sendMessage();
        });


        let pastedImageFile = null;

        // Dán ảnh từ clipboard
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
        chatImageInput.addEventListener('change', function (e) {
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

        chatImageInput.addEventListener('change', function () {
            const files = Array.from(chatImageInput.files);
            chatImagePreview.innerHTML = '';
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '220px';
                    img.style.maxHeight = '220px';
                    img.style.borderRadius = '12px';
                    img.style.marginTop = '8px';
                    img.style.cursor = 'pointer';
                    chatImagePreview.appendChild(img);

                    // Thêm sự kiện click vào ảnh để mở modal
                    img.addEventListener('click', function () {
                        const modal = document.getElementById(
                            'clientChatImageModal');
                        const modalImg = document.getElementById(
                            'clientChatImageModalImg');
                        modalImg.src = img.src;
                        modal.style.display = 'flex';
                        modal.onclick = function () {
                            modal.style.display = 'none';
                            modalImg.src = '';
                        };
                    });
                }
                reader.readAsDataURL(file);
            });
        });

        function sendMessage() {
            let msg = chatInput.value.trim();
            if (!msg && pastedImageFile) {
                msg = '';
            }
            if ((!msg && !pastedImageFile) || loading) return;
            loading = true;

            const formData = new FormData();
            formData.append('content', msg);
            if (pastedImageFile) {
                formData.append('image', pastedImageFile);
            }

            $.ajax({
                url: '/messages',
                type: 'POST',
                data: formData,
                processData: false, // Không xử lý dữ liệu
                contentType: false, // Để browser tự set multipart/form-data
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    chatInput.value = '';
                    pastedImageFile = null;
                    updateImagePreview();
                    loadMessages(true);
                },
                error: function (xhr) {
                    alert('Lỗi gửi tin nhắn: ' + xhr.responseText);
                },
                complete: function () {
                    loading = false;
                }
            });
        }

        function loadMessages(forceScrollBottom = false) {
            const isAtBottom = chatBody.scrollTop + chatBody.clientHeight >= chatBody.scrollHeight - 10;
            fetch('/messages')
                .then(res => res.json())
                .then(data => {

                    chatBody.innerHTML = '';
                    if (data.messages && data.messages.length === 0) {
                        chatBody.innerHTML = '<div style="color:#888;">Xin chào! Bạn cần hỗ trợ gì?</div>';
                    }

                    // Sử dụng data.messages thay vì data nếu API đã được cập nhật
                    const messages = data.messages || data;

                    // --- replace message rendering to show admin name above each admin message ---
                    messages.forEach(msg => {
                        let content = msg.content || '';
                        let hasImage = false;
                        if (msg.files && msg.files.length) {
                            msg.files.forEach(fileUrl => {
                                fileUrl = fileUrl.replace(/\\/g, '');
                                fileUrl = fileUrl.replace(/^https?:\/\/[^\/]+/, '');
                                content +=
                                    `<br><img src="${fileUrl}" style="max-width:220px;max-height:220px;border-radius:12px;margin-top:8px;cursor:pointer;">`;
                                hasImage = true;
                            });
                        }
                        if (content === '/strong') {
                            content = `<svg width="36" height="36" viewBox="0 0 24 24" style="vertical-align:middle;">
                                <path fill="#f9d4b7" d="M2 21h4V9H2v12zm20-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L13.17 2
                                7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1.09
                                l-.01-.01L22 10z"/>
                            </svg>`;
                        }

                        let bubbleStyle = hasImage ?
                            'background:transparent;border:none;box-shadow:none;padding:0;' :
                            (msg.is_admin ?
                                'background:#fff;color:#222;box-shadow:0 2px 8px #0084ff22;border:1px solid #e8e8e8;' :
                                'background:#007bff;color:#fff;box-shadow:0 2px 8px #0084ff22;border:1px solid #e8e8e8;'
                            );
                        let bubbleClass = "bubble";

                        if (msg.is_admin) {
                            // show admin name above the bubble (like Facebook)
                            const adminName = msg.admin_name || 'Hỗ trợ khách hàng';
                            const adminAvatar = msg.admin_avatar || ''; // optional: add admin_avatar in API if available
                            const avatarHtml = adminAvatar ? `<img src="${adminAvatar}" style="width:32px;height:32px;border-radius:50%;object-fit:cover;margin-right:8px;">` : '';

                            chatBody.innerHTML += `
                                <div style="text-align:left;margin:10px 0;">
                                    <div style="display:flex;align-items:center;gap:8px;margin-left:6px;margin-bottom:6px;">
                                        ${avatarHtml}
                                        <div style="font-size:13px;color:#444;font-weight:600;">${adminName}</div>
                                    </div>
                                    <div>
                                        <span class="${bubbleClass}" style="border-radius:16px 16px 16px 0;display:inline-block;${bubbleStyle}">${content}</span>
                                    </div>
                                </div>
                            `;
                        } else {
                            // user's message (keep existing style)
                            chatBody.innerHTML += `
                                <div style="text-align:right;margin:6px 0;">
                                    <span class="${bubbleClass}" style="border-radius:16px 16px 0 16px;display:inline-block;${bubbleStyle}">${content}</span>
                                </div>
                            `;
                        }
                    });
                    // --- end replacement ---

                    // Scroll xuống cuối sau khi DOM đã render xong
                    if (forceScrollBottom) {
                        requestAnimationFrame(() => {
                            chatBody.scrollTop = chatBody.scrollHeight;
                        });
                    } else if (isAtBottom) {
                        chatBody.scrollTop = chatBody.scrollHeight;
                    }
                });
        }

        // Tự động reload tin nhắn mỗi 2 giây, KHÔNG cuộn xuống cuối
        setInterval(function () {
            loadMessages();
        }, 2000);

        // Sự kiện click vào ảnh để mở modal
        document.getElementById('chat-body').addEventListener('click', function (e) {
            if (e.target.tagName === 'IMG') {
                const modal = document.getElementById('clientChatImageModal');
                const modalImg = document.getElementById('clientChatImageModalImg');
                modalImg.src = e.target.src;
                modal.style.display = 'flex';
                modal.onclick = function () {
                    modal.style.display = 'none';
                    modalImg.src = '';
                };
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.chat-suggestion-btn').forEach(btn => {
            btn.onclick = function () {
                const chatInput = document.getElementById('chat-input');
                chatInput.value = this.textContent;
                chatInput.focus();
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatEmojiBtn = document.getElementById('chatEmojiBtn');
        const emojiPicker = document.getElementById('emojiPicker');
        const chatInput = document.getElementById('chat-input');
        const chatBox = document.getElementById('chat-box');

        // Hiển thị/ẩn emoji picker khi click vào nút emoji
        chatEmojiBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            console.log("Emoji button clicked"); // Để debug

            // Đặt lại vị trí emoji picker mỗi lần click
            emojiPicker.style.position = 'absolute';

            // Hiển thị trong chatBox nếu có thể
            if (chatBox) {
                chatBox.appendChild(emojiPicker);
            }

            if (emojiPicker.style.display === 'flex' || emojiPicker.style.display === 'block') {
                emojiPicker.style.display = 'none';
            } else {
                emojiPicker.style.display = 'flex';
            }
        });

        // Chọn emoji
        document.querySelectorAll('.emoji-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                const emoji = this.textContent;
                chatInput.value += emoji;
                chatInput.focus();
            });
        });

        // Ẩn emoji picker khi click ra ngoài
        document.addEventListener('click', function () {
            emojiPicker.style.display = 'none';
        });

        emojiPicker.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });
</script>

@stack('scripts')