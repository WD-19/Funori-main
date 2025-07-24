@extends('client.layout.client')

@section('title', 'Về Chúng Tôi')

@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">@yield('page_title', 'Về Chúng Tôi')</div>
        </div>
    </div>
    <div class="box-introduce">
        <div class="in-introduce">
            <div class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512"
                    style="enable-background:new 0 0 512 512" xml:space="preserve">
                    <g>
                        <path xmlns="http://www.w3.org/2000/svg"
                            d="m218.417 209.314a52.855 52.855 0 0 0 -13.765 14.306 6 6 0 1 0 10.051 6.557 40.9 40.9 0 0 1 10.653-11.077 6 6 0 0 0 -6.939-9.79z"
                            fill="" data-original=""></path>
                        <path xmlns="http://www.w3.org/2000/svg"
                            d="m109.75 466.605h-43.98v-274.861c0-.1.014-.192.014-.29 0-47.453 36.608-86.059 81.605-86.059 43.257 0 78.743 35.686 81.422 80.605a52.944 52.944 0 0 0 -46.694 52.5v9.375a6 6 0 0 0 6 6h26.7c2.652 9.6 11.228 16.691 21.272 16.691s18.619-7.087 21.27-16.691h24.509a6 6 0 0 0 6-6v-9.375a52.946 52.946 0 0 0 -47.025-52.544c-2.731-51.523-43.6-92.563-93.453-92.563-51.442 0-93.32 43.7-93.6 97.521-.01.139-.021.278-.021.419v275.27h-37.769a6 6 0 0 0 0 12h93.75a6 6 0 0 0 0-12zm126.338-208.037a9.941 9.941 0 0 1 -8.283-4.691h16.565a9.941 9.941 0 0 1 -8.282 4.691zm39.779-20.068v3.375h-81.75v-3.375a40.875 40.875 0 0 1 81.75 0z"
                            fill="" data-original=""></path>
                        <path xmlns="http://www.w3.org/2000/svg"
                            d="m473.663 373.9v-39.7a25.286 25.286 0 0 0 -25.451-25.06h-109.794a25.216 25.216 0 0 0 -18 7.428c-.494.5-.959 1.014-1.406 1.544a25.564 25.564 0 0 0 -19.494-8.972h-110.418a25.287 25.287 0 0 0 -25.452 25.06v39.814a29.012 29.012 0 0 0 -26.454 28.657v69.937a6 6 0 0 0 6 6h46.519a6 6 0 0 0 6-6v-7.993l247.769.076v7.917a6 6 0 0 0 6 6h46.518a6 6 0 0 0 6-6v-69.94a29.039 29.039 0 0 0 -28.337-28.768zm-144.745-48.866a13.3 13.3 0 0 1 9.5-3.9h109.794a13.275 13.275 0 0 1 13.451 13.06v41.829a28.838 28.838 0 0 0 -18.181 26.642v2.35l-118.482-.03.015-70.187a13.616 13.616 0 0 1 3.903-9.764zm-139.818-3.9h110.416a13.275 13.275 0 0 1 13.451 13.066l.027 70.782-117.281-.032v-2.281a28.884 28.884 0 0 0 -20.065-27.327v-41.142a13.276 13.276 0 0 1 13.452-13.063zm-5.387 145.468h-34.519v-63.934a17.266 17.266 0 0 1 34.519 0zm12-13.993v-35.66l123.278.034h.009l124.481.035v35.67zm294.287 13.996h-34.518v-63.937a17.265 17.265 0 0 1 34.518 0z"
                            fill="" data-original=""></path>
                    </g>
                </svg>
            </div>
            <div class="title-introduce">
                <div class="in-title-introduce">Tương lai của Funori</div>
            </div>
            <div class="on-title">
                <p>NGÀY CÀNG TỐT HƠN – CÙNG NHAU PHÁT TRIỂN</p>
            </div>
        </div>
    </div>
    <div class="box-banner-about-2">
        <div class="in-box-banner">
            <img src="{{ asset('client/Picture/Shop/banner-33.jpg') }}" alt="">
        </div>
    </div>
    <div class="box-introduce-1">
        <div class="box-picture">
            <img src="{{ asset('client/Picture/Shop/banner-34.jpg') }}" alt="">
        </div>
        <div class="box-content-1">
            <div class="in-first-title">CHÚNG TÔI THIẾT KẾ NỘI THẤT</div>
            <h2 class="in-second-title">Sáng tạo đơn giản</h2>
            <div class="all-box-boder-in">
                <div class="box-boder-in"></div>
            </div>
            <div class="in-container">
                Chúng tôi luôn hướng đến sự sáng tạo và đơn giản trong từng thiết kế, mang lại không gian sống hiện đại, tiện nghi cho mọi gia đình.
            </div>
            <div class="in-container">
                Đội ngũ Funori cam kết mang đến những sản phẩm chất lượng, phù hợp với mọi phong cách sống.
            </div>
        </div>
    </div>
    <div class="box-introduce-1">
        <div class="box-content-1">
            <div class="in-first-title">CHÚNG TÔI THIẾT KẾ NỘI THẤT</div>
            <h2 class="in-second-title">Chất lượng thiết kế</h2>
            <div class="all-box-boder-in">
                <div class="box-boder-in"></div>
            </div>
            <div class="in-container">
                Sản phẩm của Funori được chú trọng từ khâu ý tưởng đến sản xuất, đảm bảo chất lượng và thẩm mỹ cao nhất cho khách hàng.
            </div>
            <div class="in-container">
                Chúng tôi không ngừng đổi mới để đáp ứng nhu cầu ngày càng cao của thị trường nội thất Việt Nam.
            </div>
        </div>
        <div class="box-picture">
            <img src="{{ asset('client/Picture/Shop/banner-34.jpg') }}" alt="">
        </div>
    </div>
    <div class="box-padding"></div>
    <div class="box-introduce-2">
        <div class="in-introduce-2">
            <div class="title">CHÚNG TÔI THIẾT KẾ NỘI THẤT</div>
            <h2>Tham quan cửa hàng của chúng tôi</h2>
        </div>
    </div>
    <div class="box-map">
        <div class="box-iframe">
            <iframe class="frame-1"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8638060211515!2d105.74468151143324!3d21.038134787374535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1752569490635!5m2!1svi!2s"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="in-frame-1">
                <h2>
                    FPT Polytechnic,<br>
                    Hà Nội
                </h2>
                <div class="location">
                    Tòa nhà FPT Polytechnic, Trịnh Văn Bô, Nam Từ Liêm, Hà Nội
                </div>
            </div>
        </div>
        <div class="box-iframe">
            <iframe class="frame-2"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8638060211515!2d105.74468151143324!3d21.038134787374535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1752569490635!5m2!1svi!2s"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="in-frame-1">
                <h2>
                    FPT Polytechnic,<br>
                    Hà Nội
                </h2>
                <div class="location">
                    Tòa nhà FPT Polytechnic, Trịnh Văn Bô, Nam Từ Liêm, Hà Nội
                </div>
            </div>
        </div>
    </div>
    <div class="border"></div>
@endsection
