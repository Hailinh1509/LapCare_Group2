<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LAPCARE Footer</title>
<link rel="stylesheet" href="footer.css">
</head>
<body>
  <footer class="footer">
    <div class="container">
      <div class="footer-col about">
        <img src="../images/logo.png" alt="LAPCARE" class="logo-footer" />
        <p><strong>LAPCARE</strong> là hệ thống phân phối laptop và phụ kiện công nghệ chính hãng, cam kết uy tín và luôn đặt lợi ích khách hàng lên hàng đầu.</p>
        <p>Đến với <strong>LAPCARE</strong>, bạn có thể hoàn toàn yên tâm khi lựa chọn cho mình những sản phẩm công nghệ chất lượng cao, đa dạng mẫu mã từ các thương hiệu nổi tiếng trên toàn thế giới, đi kèm với dịch vụ hỗ trợ chuyên nghiệp và tận tâm.</p>
      </div>

      <div class="footer-col"> <BR>
        <h4>Về LAPCARE</h4>
        <ul>
          <li><a href="#">Về chúng tôi</a></li>
          <li><a href="#">Liên hệ</a></li>
        </ul>
        <h4>Kết nối</h4>
        <div class="social-icons">
          <a href="#"><img src="../images/facebook.png" alt="Facebook"></a>
     <!--     <a href="#"><img src="../images/insta.png" alt=".."></a>  -->
          <a href="#"><img src="../images/tiktok.png" alt="TIKTOK"></a>
          <a href="#"><img src="../images/zalo.png" alt="Zalo"></i></a>
        </div>
        <h4>Phương thức thanh toán</h4>
      </div>

      <div class="footer-col"><BR>
        <h4>Chính sách</h4>
        <ul>
          <li><a href="{{ route('policy.ShipPay') }}">Giao hàng & Thanh toán</a></li>
          <li><a href="{{ route('policy.warranty') }}">Chính sách bảo hành</a></li>
          <li><a href="{{ route('policy.returns') }}">Chính sách đổi trả</a></li>
          <li><a href="{{ route('policy.privacy') }}">Chính sách bảo mật thông tin</a></li>
          
          <li><a href="{{ route('policy.operation') }}">Quy chế hoạt động</a></li>
        </ul>
      </div>

<div class="footer-col KM">
  <div style="margin-top: 20px;">
    <h4>Địa chỉ cửa hàng</h4>
  
<iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.377722465657!2d105.81645221540264!3d21.016319993579273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab732d2f2e0b%3A0x1a16e6c6b6a6a1!2zMTMzIFAuIFRo4bqjaSBIw6AsIMSQ4buRbmcgxJDDoCwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1702130000000"
    width="100%"
    height="260"
    style="border:0; border-radius:10px;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
</iframe>

    </div>
</div>

    </div>
  </footer>
</body>
</html>
