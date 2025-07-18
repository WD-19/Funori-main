## Admin

### 1. Nav-bar

* Bỏ icon chọn ngôn ngữ
* Sửa ảnh người dùng trong tin nhắn contact
* Tùy chỉnh icon thông báo (thông báo đơn hàng theo trạng thái)
* tích hợp đánh giá trong icon contact
* Tùy chỉnh Related Apps hoặc bỏ phần này (xóa)
* Tài khoản admin:

  * Cài đặt tài khoản (chỉ có đăng xuất)
  * Link inbox đến contact
  * Taskboard & setting tùy chỉnh (bỏ)
  * Bỏ mục support (bỏ)

### 2. Side-bar

* Button:

  * Active đúng action

* Thương hiệu:

  * Gap lại fieldset

* Sản phẩm:

  * Sửa lại list ảnh, ảnh biến thể hiển thị đẹp hơn, danh sách ảnh biến thể căn giữa, gap lại nút thêm biến thể
  * Xem lại số lượng biến thể (ở bảng thuộc tính hiện tại chỉ có tên, không có số lượng)
  * Khi bấm bộ lọc danh mục cha, sẽ hiển thị tất cả các sản phẩm thuộc danh mục cha đó (cả danh mục con)

* Thuộc tính:

  * Hiện đang cho phép thêm thuộc tính trùng tên => cần ngăn hoặc hiển thị sản phẩm đã dùng thuộc tính đó và số lượng trong kho

* Đơn hàng:

  * Bị thiếu cột, bỏ giá trị đơn hàng
  * Sửa lại bố cục bộ lọc
  * In phiếu giao hàng theo form của bên vận chuyển
  * Sửa màu giá tiền sản phẩm
  * thêm bộ lọc ngày đặt hàng
  * Ẩn cột hình thức vận chuyển

* Người dùng:

  * Sửa lại tiếng Việt của phần detail

* Phương thức thanh toán:

  * Bổ sung logic chi tiết gồm:

    * Dữ liệu giao dịch
    * Thông tin kỹ thuật và bảo mật
    * Thông tin doanh nghiệp
  * Ví dụ:

```
[Đơn hàng #123456]
+ Phương thức: VNPay
+ Trạng thái: Thành công
+ Số tiền: 1.200.000đ
+ Ngày thanh toán: 2025-07-12 10:30
+ Mã giao dịch VNPay: 2307121030157125
+ Mã đơn hàng nội bộ: 123456
+ Ngân hàng: Vietcombank
+ Mã phản hồi: 00 (Thành công)
+ Mã xác thực: 99d8abc37da7...
```

* Phương thức vận chuyển:

  * Bổ sung logic chi tiết như: thông tin từ đối tác vận chuyển (tracking code, trạng thái, COD,...)

* Page:

  * Xem trước bài viết
  * Gap lại fieldset
  * Sửa JS demo ảnh

* Banner:

  * Banner hiển thị ở sidebar => xem xét lại
  * ở sửa ảnh, bỏ thay đổi kích thước ảnh

### Chung (Admin):

* Sửa lại model xem nhanh, link đúng route từ button và ảnh (đổi dashboard thành bảng điều khiển...)
* Xem xét luồng thống kê
* Rà soát validate và hiển thị lỗi dưới từng trường
* Bỏ x-alert, thay bằng toastr (thông báo js)
* Bổ sung trường STT ở đầu danh sách
* Roadmap đúng trang đang làm

---

## Client

### Nav-bar:

* Xem lại button hover của wishlist và cart

### Auth:

* Bổ sung hoặc bỏ đăng nhập bằng Facebook/Google (Career đang lỗi vì không có app\_id)
* khi đã đăng nhập thì không cho vào route login nữa
* Xem xét tính năng quên mật khẩu

### Trang chủ:

* Gắn đầy đủ link ảnh, text dưới footer
* Đổ thêm sản phẩm ra theo: khuyến mãi, sản phẩm mới

### Cửa hàng:

* Giảm số lượng hiển thị trong 1 page
* Bổ sung bộ lọc theo thuộc tính (sản phẩm con có biến thể sẽ hiển thị)

### Giới thiệu:

* Tuỳ chỉnh lại trang

### Tin tức:

* Sửa bố cục bài viết
* Bổ sung phần bên dưới: bình luận nổi bật, sản phẩm yêu thích,...

### Liên hệ:

* In lỗi dưới từng field

### Profile:

* Bổ sung nội dung cho thông báo
* Tài khoản:

  * Cho người dùng chỉnh sửa ảnh
  * Bỏ địa chỉ mặc định (nằm bên địa chỉ rồi)
* Đổi mật khẩu:

  * Cân nhắc xác thực 2 bước (email/SMS)
  * Gộp mục này vào "Tài khoản", bỏ khỏi sidebar
* Đơn hàng:

  * thêm 2 tab con là đơn hàng đã nhận và đơn hàng đã hủy
  * trạng thái giao hàng giống admin
  * Giao diện + trang con:

    * Đã nhận, đã huỷ
* Sản phẩm yêu thích:

  * Làm dạng drag-to-scroll trong card (tránh đẩy xuống quá dài, tham khảo ecomus)

### Giỏ hàng:
* nếu số lượng hết phải làm mờ dấu "+" đi & thêm đoạn số lượng tối đa
* Xem xét phần tính phí vận chuyển
* Logic xử lý:

  * Số lượng giỏ là 6, thanh toán còn 1 => lỗi lưu trữ => dùng input-hidden hoặc ajax-form
  * Khi số lượng biến thể trong kho < trong giỏ => xử lý
  * Biến thể hết hàng, ngừng kinh doanh => xử lý
* Hiển thị đủ thông tin: kích thước, màu sắc...
* Bỏ text-decoration

### Sản phẩm:

* ảnh của biến thể & danh sách biến thể sản phẩm: để trong 1 khung dạng slider và dùng drag-to-scroll hoặc prev để chuyển ảnh sản phẩm muốn xem
* chỉnh chiều cao của ảnh sản phẩm
* Sửa hiển thị biến thể: dùng select-option, chữ to hơn
* Ảnh mờ & khuất => xử lý lại ảnh sản phẩm
* "Thêm phương thức thanh toán": cho phép chọn phương thức & mua ngay (mua đơn)
* Tabs: xem xét lại nội dung
* Mất danh sách ảnh biến thể ở góc trái trên => xử lý lại

### Đơn hàng (Client):

* Xem lại validate
* Phương thức: dùng select-option, tránh chiếm khoảng trống
* Giao diện thanh toán thành công cần rõ ràng hơn

### Chung (Client):

* Card sản phẩm: cả nhóm quyết định
* Roadmap: đúng trang đang làm
* Model xem nhanh: sửa lại, đúng route từ button & ảnh
* Validate: rà soát toàn bộ
* Thông báo: bỏ x-alert, dùng toastr


### Bổ sung :

* Cập nhật API mới nhất hiện tại cho đặt hàng, nếu có thay đổi trên web, phải thay đổi theo trước khi mang đi thi
* Sử dụng thanh toán đơn giản: vnpay, zalopay
* Sau khi đặt hàng, số lượng hiển thị ở admin và chi tiết sản phẩm đều cập nhật (Chú ý: thật chỉn chu trang chi tiết sản phẩm, giám thị để ý nhiều nhất)
* XEM LẠI TOÀN BỘ GIAO DIỆN (HÌNH ẢNH, LOGIC) CỦA TẤT CẢ CÁC TRANG.
