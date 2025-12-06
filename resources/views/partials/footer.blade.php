<footer class="footer">
    <div class="container">
        {{-- Cột giới thiệu --}}
        <div class="footer-col about">
            <img src="{{ asset('assets/images/logo.png') }}" alt="LAPCARE" class="logo-footer" />
            <p>
                <strong>LAPCARE</strong> là hệ thống phân phối laptop và phụ kiện công nghệ chính hãng,
                cam kết uy tín và luôn đặt lợi ích khách hàng lên hàng đầu.
            </p>
            <p>
                Đến với <strong>LAPCARE</strong>, bạn có thể hoàn toàn yên tâm khi lựa chọn cho mình những
                sản phẩm công nghệ chất lượng cao, đa dạng mẫu mã từ các thương hiệu nổi tiếng trên toàn
                thế giới, đi kèm với dịch vụ hỗ trợ chuyên nghiệp và tận tâm.
            </p>
        </div>

        {{-- Cột Về LAPCARE + mạng xã hội --}}
        <div class="footer-col"><br>
            <h4>Về LAPCARE</h4>
            <ul>
                {{-- Trang giới thiệu (link tạm, sau này sửa lại cho khớp với route thật) --}}
                <li>
                    <a href="{{ url('/ve-chung-toi') }}">Về chúng tôi</a>
                </li>

                {{-- Trang liên hệ (link tạm) --}}
                <li>
                    <a href="{{ url('/lien-he') }}">Liên hệ</a>
                </li>
            </ul>

            <h4>Kết nối</h4>
            <div class="social-icons">
                {{-- Sau này có link fanpage thật thì thay # bằng url() / route() tương ứng --}}
                <a href="#">
                    <img src="{{ asset('assets/images/facebook.png') }}" alt="Facebook">
                </a>
                <a href="#">
                    <img src="{{ asset('assets/images/insta.png') }}" alt="Instagram">
                </a>
                <a href="#">
                    <img src="{{ asset('assets/images/tiktok.png') }}" alt="TikTok">
                </a>
                <a href="#">
                    <img src="{{ asset('assets/images/zalo.png') }}" alt="Zalo">
                </a>
            </div>

            <h4>Phương thức thanh toán</h4>
        </div>

        {{-- Cột chính sách --}}
        <div class="footer-col"><br>
            <h4>Chính sách</h4>
            <ul>
                <li>
                    <a href="{{ url('/chinh-sach-giao-hang-thanh-toan') }}">Giao hàng &amp; Thanh toán</a>
                </li>
                <li>
                    <a href="{{ url('/chinh-sach-bao-hanh') }}">Chính sách bảo hành</a>
                </li>
                <li>
                    <a href="{{ url('/chinh-sach-doi-tra') }}">Chính sách đổi trả</a>
                </li>
                <li>
                    <a href="{{ url('/chinh-sach-bao-mat-thong-tin') }}">Chính sách bảo mật thông tin</a>
                </li>
                <li>
                    <a href="{{ url('/chinh-sach-van-chuyen') }}">Chính sách vận chuyển</a>
                </li>
                <li>
                    <a href="{{ url('/quy-che-hoat-dong') }}">Quy chế hoạt động</a>
                </li>
            </ul>
        </div>

        {{-- Cột đăng ký khuyến mãi --}}
        <div class="footer-col KM">
            <section class="promo-signup">
                <h2>ĐĂNG KÝ NHẬN TIN KHUYẾN MÃI</h2>
                <p>Nhận ngay voucher 10%</p>
                <p class="note">
                    Voucher sẽ được gửi sau 24h, chỉ áp dụng cho khách hàng mới
                </p>

                {{-- Sau này tạo route newsletter.subscribe để xử lý form --}}
                <form method="POST" action="#">
                    @csrf
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                           placeholder="Nhập email của bạn" required />

                    <label for="phone">Số điện thoại</label>
                    <input type="tel" id="phone" name="phone"
                           placeholder="Nhập số điện thoại của bạn" required />

                    <label class="checkbox">
                        <input type="checkbox" required />
                        Tôi đồng ý với điều khoản của LAPCARE
                    </label>

                    <button type="submit">ĐĂNG KÝ NGAY</button>
                </form>
            </section>
        </div>
    </div>
</footer>
