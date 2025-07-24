<div class="box-first-footer">
    <div class="contact">
        <h2>LIÊN HỆ</h2>
        <div class="in">
            <div>Địa chỉ: 4 Copley Place, Tầng 7, Boston, MA 6</div>
            <div>Điện thoại: 866.453.4748</div>
            <div>Fax nhân sự: 810.222.5439</div>
            <div>Email: sales@funorifurniture.com</div>
        </div>
    </div>
    <div class="contact">
        <h2>DANH MỤC</h2>
        <?php
        use App\Models\Category;
        $footerCategories = Category::all();

        ?>
        <div class="in">
            @foreach ($footerCategories->chunk(3) as $chunk)
                <div class="footer-category-row">
                    @foreach ($chunk as $cat)
                        <a href="{{ route('shop', ['category_id' => $cat->id]) }}" style="flex: 1;">
                            <div>{{ $cat->name }},</div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <div class="contact">
        <h2>DỊCH VỤ</h2>
        <div class="in">
                <div>Khuyến mãi</div>

                <div>Giao hàng nhanh</div>

                <div>Thiết kế mới</div>

                <div>Bảo vệ vải chống sự cố</div>

                <div>Bảo dưỡng nội thất</div>

                <div>Thẻ quà tặng</div>

        </div>
    </div>
    <div class="contact">
        <h2>THAM GIA VỚI CHÚNG TÔI</h2>
        <div class="in">
            <div style="margin-bottom: 25px;">
                Nhập email của bạn để là người đầu tiên biết về bộ sưu tập và sản phẩm mới.
            </div>
            <div class="box-email">
                <input type="text" placeholder="Nhập email...">
                <button type="submit">
                    <i class="fa-solid fa-envelope"></i>
                </button>
            </div>
            <div class="icon-contact">
                <ul>
                    <li>
                        <a href="">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa-brands fa-dribbble"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa-brands fa-behance"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="box-second-footer">
    <div class="first-box">
        <div class="title">
            Bản quyền © 2022. Đã đăng ký bản quyền.
        </div>
    </div>
    <div class="second-box">
        <div class="box-bank">
            <img src="{{ asset('client/picture/payments-1.png') }}" alt="">
        </div>
    </div>
</div>
