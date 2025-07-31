<h2>Chào bạn!</h2>
<p>Funori vừa có mã giảm giá mới: <strong>{{ $promotion->name }}</strong></p>
@if($promotion->code)
<p>Mã: <strong>{{ $promotion->code }}</strong></p>
@endif
<p>Giá trị giảm: {{ $promotion->discount_value }} {{ $promotion->discount_type == 'percentage' ? '%' : 'VNĐ' }}</p>
@if($promotion->description)
<p>{{ $promotion->description }}</p>
@endif
<p>Hãy truy cập website để sử dụng ngay!</p>