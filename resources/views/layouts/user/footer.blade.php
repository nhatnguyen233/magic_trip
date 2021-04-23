<footer>
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-5 col-md-12 p-r-5">
                <p><img src="{{ asset('img/logo.svg') }}" width="150" height="36" alt=""></p>
                <p class="text-justify">Du lịch trong nước luôn là lựa chọn tuyệt vời. Đường bờ biển dài hơn 3260km, những khu bảo tồn thiên nhiên tuyệt vời,
                    những thành phố nhộn nhịp, những di tích lịch sử hào hùng, nền văn hóa độc đáo và hấp dẫn, cùng một danh sách dài những món ăn ngon nhất thế giới, Việt Nam có tất cả những điều đó.
                    Với lịch trình dày, khởi hành đúng thời gian cam kết, Magic là công ty du lịch tín nhất hiện nay tại Việt Nam,
                    luôn sẵn sàng phục vụ du khách mọi lúc, mọi nơi, đảm bảo tính chuyên nghiệp và chất lượng dịch vụ tốt nhất thị trường.</p>
                <div class="follow_us">
                    <ul>
                        <li>Follow us</li>
                        <li><a href="https://www.facebook.com/nhat.nguyenhuu.233"><i class="ti-facebook"></i></a></li>
                        <li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
                        <li><a href="#0"><i class="ti-google"></i></a></li>
                        <li><a href="#0"><i class="ti-pinterest"></i></a></li>
                        <li><a href="https://www.instagram.com/toilanhat__"><i class="ti-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 ml-lg-auto">
                <h5>Liên kết</h5>
                <ul class="links">
                    <li><a href="about.html">Về chúng tôi</a></li>
                    <li><a href="login.html">Đăng nhập</a></li>
                    <li><a href="{{ route('customer.register') }}">Đăng ký</a></li>
                    <li><a href="blog.html">Tin tức &amp; Sự kiện</a></li>
                    <li><a href="contacts.html">Liện</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Liên hệ với chúng tôi</h5>
                <ul class="contacts">
                    <li><a href="tel://84280932400"><i class="ti-mobile"></i> + 84 976 663 241</a></li>
                    <li><a href="mailto:toilanhat233@gmail.com"><i class="ti-email"></i> toilanhat233@gmail.com</a></li>
                </ul>
                <div id="newsletter">
                    <h6>Bản tin</h6>
                    <div id="message-newsletter"></div>
                    <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control"
                                   placeholder="Email của bạn">
                            <input type="submit" value="Gửi" id="submit-newsletter">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/row-->
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <ul id="footer-selector">
                    <li>
                        <div class="styled-select" id="lang-selector">
                            <select>
                                <option value="English" selected>English</option>
                                <option value="French">French</option>
                                <option value="Spanish">Spanish</option>
                                <option value="Russian">Russian</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="styled-select" id="currency-selector">
                            <select>
                                <option value="US Dollars" selected>US Dollars</option>
                                <option value="Euro">Euro</option>
                                <option value="Viet Nam">VND</option>
                            </select>
                        </div>
                    </li>
                    <li><img src="img/cards_all.svg" alt=""></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul id="additional_links">
                    <li><a href="#0">Các điều khoản và điều kiện</a></li>
                    <li><a href="#0">Riêng tư</a></li>
                    <li><span>© 2021 Nhat Nguyen</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
