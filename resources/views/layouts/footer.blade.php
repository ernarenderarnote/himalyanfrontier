<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <h3 class="mb-sm-4 mb-3 pb-3">Quick Links</h3>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{route('home')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('aboutUs')}}">About Us</a>
                    </li>
                    <li>
                        <a href="{{route('ourTeam')}}">Our Team</a>
                    </li>
                    <li>
                        <a href="{{route('testimonials')}}">Testimonials</a>
                    </li>
                    <li>
                        <a href="{{route('ContactUs')}}">Contact Us</a>
                    </li>
                    <li>
                        <a href="{{route('blogs')}}">Blog</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-md-3 col-sm-12">
            <h3 class="mb-sm-4 mb-3 pb-3">Useful Links</h3>
            <ul class="list-unstyled">
            <li>
            <a href="{{route('PaymentMethods')}}">Payment Methods</a>
            </li>
            <li>
            <a href="{{route('modificationOfPrices')}}">Modification of Prices</a>
            </li>
            <li>
            <a href="{{route('termsConditions')}}">Terms and Conditions</a>
            </li>
            <li>
            <a href="{{route('PrivacyPolicy')}}">Privacy Policy</a>
            </li>
            </ul>
            <br>
            <br>
            </div>
            <div class="col-md-3 col-sm-12">
            <div class="touch">
            <div id="travcontactwidget-2" class="contact-box small-box widget_travcontactwidget">
            <h3 class="mb-sm-4 mb-3 pb-3">Get in Touch</h3>
            <address class="contact-details">
            <span class="contact-phone"><i class="fa fa-phone" aria-hidden="true"></i>  91 1902 250384</span>
            <br>
            <span class="contact-icon"><i class="fa fa-envelope" aria-hidden="true"></i>
            <a class="contact-email" href="mailto:info@himalayanfrontiers.com">  info@himalayanfrontiers.com</a></span>
            </address>
            <img src="{{url('images/trip.png')}}" class="responsive-main">
            </div>
            </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <h3 class="mb-sm-4 mb-3 pb-3">Secure Online Payments</h3>
                <img src="{{url('images/neew.png')}}">
            </div>
        </div>
    </div>
</div>
<div class="full_img"><img src="{{url('images/footer.png')}}"></div>
<!-- //footer -->
<!-- copyright -->
<div class="copy_right position-relative custom_copy9">
    <p class="text-center text-wh py-sm-3 py-3">© 2017 - Himalayan Frontiers Culture & Adventure Tours (Pvt.) Ltd. All Rights Reserved.</p>
    <!-- move top icon -->
    <a href="#home" class="move-top text-center">
    <span class="fa fa-level-up" aria-hidden="true"></span>
    </a>
    <!-- //move top icon -->
</div>
<!-- //copyright -->

<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="{{ asset('js/highlight.js') }}"></script>
<script src="{{ asset('js/jPages.min.js') }}"></script>
<script src="{{ asset('js/jQuery.lazyload.js') }}"></script>
<script src="{{ asset('build/js/intlTelInput.js') }}"></script>
<!--script src="{{ asset('js/app.js') }}"></script-->
<script>
    $(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 200) {
        $(".custom_header").addClass("darkHeader");
    } else {
        $(".custom_header").removeClass("darkHeader");
    }
});
</script>

<script>
    $(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 200) {
        $(".right_bar4").addClass("fix_right");
    } else {
        $(".right_bar4").removeClass("fix_right");
    }
});
</script>

<script>
    $(document).ready(function() {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            margin: 10,
            nav: true,
            loop: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        });
    });
</script>