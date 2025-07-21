@extends('client.layout.client')

@section('title', 'Liên hệ')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">@yield('page_title', 'Liên Hệ')</div>
        </div>
    </div>

    <!-- map -->
    <div class="w-100 d-flex justify-content-center">
        <iframe class="frame-2"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8638060211515!2d105.74468151143324!3d21.038134787374535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1752569490635!5m2!1svi!2s"
                width="90%"  height="650" style="border:0; " allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- /map -->

    <!-- form -->
    <section class="flat-spacing-21">
        <div class="container">
            <div class="tf-grid-layout gap30 lg-col-2">
                <div class="tf-content-left">
                    <h5 class="mb_20">Ghé thăm cửa hàng của chúng tôi</h5>
                    <div class="mb_20">
                        <p class="mb_15"><strong>Địa Chỉ</strong></p>
                        <p>Tòa nhà FPT Polytechnic, P. Trịnh Văn Bô, Xuân Phương,<br>Nam Từ Liêm, Hà Nội 100000, Vietnam</p>
                    </div>
                    <div class="mb_20">
                        <p class="mb_15"><strong>Số Điện Thoại</strong></p>
                        <p>+1 (23) 456 789</p>
                    </div>
                    <div class="mb_20">
                        <p class="mb_15"><strong>Email</strong></p>
                        <p>support@funori.vn</p>
                    </div>
                    <div class="mb_36">
                        <p class="mb_15"><strong>Thời Gian Mở Cửa</strong></p>
                        <p class="mb_15">Cửa hàng của chúng tôi đã mở cửa trở lại để mua sắm, </p>
                        <p>hàng ngày 8h sáng đến 21h tối</p>
                    </div>
                    <div>
                        <ul class="tf-social-icon d-flex gap-20 style-default">
                            <li><a href="#" class="box-icon link round social-facebook border-line-black"><i
                                        class="icon fs-14 icon-fb"></i></a></li>
                            <li><a href="#" class="box-icon link round social-twiter border-line-black"><i
                                        class="icon fs-12 icon-Icon-x"></i></a></li>
                            <li><a href="#" class="box-icon link round social-instagram border-line-black"><i
                                        class="icon fs-14 icon-instagram"></i></a></li>
                            <li><a href="#" class="box-icon link round social-tiktok border-line-black"><i
                                        class="icon fs-14 icon-tiktok"></i></a></li>
                            <li><a href="#" class="box-icon link round social-pinterest border-line-black"><i
                                        class="icon fs-14 icon-pinterest-1"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="tf-content-right">
                    <h5 class="mb_20">Liên hệ</h5>
                    <p class="mb_24">Nếu bạn có những sản phẩm tuyệt vời mà bạn tạo ra hoặc muốn làm việc với chúng tôi thì
                        hãy gửi cho chúng tôi một lời nhắn.</p>
                    <div>
                        <form class="form-contact" id="contactform" action="{{ route('client.contact.store') }}"
                            method="POST">
                            @csrf
                            <div class="d-flex gap-15 mb_15">
                                <fieldset class="w-100">
                                    <input type="text" name="name" id="name" placeholder="Họ Và Tên *"
                                        required />
                                </fieldset>

                                <fieldset class="w-100">
                                    <input type="email" name="email" id="email" placeholder="Email *" required />
                                </fieldset>
                            </div>

                            <div class="mb_15">
                                <textarea placeholder="Nội Dung" name="message" id="message" cols="30" rows="10" required></textarea>
                            </div>

                            @auth
                                <div class="send-wrap">
                                    <button type="submit"
                                        class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">
                                        Gửi
                                    </button>
                                </div>
                            @else
                                <div class="send-wrap">
                                    <a href="{{ route('client.login') }}"
                                        class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">
                                        Gửi
                                    </a>
                                </div>
                            @endauth
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /form -->
@endsection
