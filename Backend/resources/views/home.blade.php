@extends ('layout')
@section('titlepage','Website StepViet')
@section('title','StepViet Shop')
@section('content')

<section class="hero">
    <img src="assets/images/banner.png" alt="Skechers The Uno">
</section>

<section class="featured-products">
    <h2>Sản Phẩm Nổi Bật</h2>
    <div class="product-list">
        <div class="product">
            <img src="assets/images/adidas/giay-forum-low-cl-be-ig3779-09-s-1732458719260.webp" alt="Product 1">
            <p>Giày Forum Low CL</p>
            <p>1,195,000 đ</p>
        </div>
        <div class="product">
            <img src="assets/images/Converse/Converse x Comme des Garçons Chuck 70.webp" alt="Product 2">
            <p>Converse x CDG Chuck 70</p>
            <p>1,195,000 đ</p>
        </div>
        <div class="product">
            <img src="assets/images/nike/NIKE+COURT+VISION+LO (2).png" alt="Product 3">
            <p>Nike Court Vision Low</p>
            <p>1,195,000 đ</p>
        </div>
    </div>
</section>

<section class="promotion">
    <img src="assets/images/Banner1.png" alt="Jujutsu Kaisen Collection">
</section>

<section class="shop-section">
    <div class="shop-item">
        <img src="assets/images/Women.png" alt="Shop Women's">
        <p>SHOP WOMEN'S &gt;&gt;</p>
    </div>
    <div class="shop-item">
        <img src="assets/images/Men.png" alt="Shop Men's">
        <p>SHOP MEN'S &gt;&gt;</p>
    </div>
    <div class="shop-item">
        <img src="assets/images/Girls.png" alt="Shop Girl's">
        <p>SHOP GIRL'S &gt;&gt;</p>
    </div>
    <div class="shop-item">
        <img src="assets/images/Boys.png" alt="Shop Boy's">
        <p>SHOP BOY'S &gt;&gt;</p>
    </div>
</section>
<p class="share-style">SHARE YOUR STYLE <span>@StepViet</span></p>

<div class="footer-info">
    <div>
        <p>Mua Hàng Trực Tuyến 24/7</p>
        <p>Mua sắm thoải mái mọi nơi</p>
    </div>
    <div>
        <p>Trả Hàng Trong Vòng 15 Ngày</p>
        <p>Đổi trả dễ dàng</p>
    </div>
    <div>
        <p>Miễn Phí Vận Chuyển</p>
        <p>Cho đơn hàng trên 1,000,000 VND</p>
    </div>
</div>

@endsection