<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="widgettitle">Destinations</h2>
                <address class="contact-details">
                <ul class="list-unstyled">
                    <li>
                        <a href="#">India</a>
                    </li>
                    <li>
                        <a href="#">Nepal</a>
                    </li>
                    <li>
                        <a href="#">Bhutan</a>
                    </li>
                    <li>
                        <a href="#">Customized Tours</a>
                    </li>
                </ul>
                <br>
                <h3 class="mb-sm-4 mb-3 pb-3">Quick Links</h3>
                <ul class="list-unstyled">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="#">About Us</a>
                    </li>
                    <li>
                        <a href="#">Our Team</a>
                    </li>
                    <li>
                        <a href="#">Testimonials</a>
                    </li>
                    <li>
                        <a href="#">Contact Us</a>
                    </li>
                    <li>
                        <a href="#">Blog</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
            <h3 class="mb-sm-4 mb-3 pb-3">Activities</h3>
            <ul class="list-unstyled">
            <li>
            <a href="index.html">Culture tour</a>
            </li>
            <li>
            <a href="#">Festival Tours</a>
            </li>
            <li>
            <a href="#">Home stay trek</a>
            </li>
            <li>
            <a href="#">Motorbike tours</a>
            </li>
            <li>
            <a href="#">Mountain bike tours</a>
            </li>
            <li>
            <a href="#">Off the Beaten Track</a>
            </li>
            <li>
            <a href="#">Trekking in Himalayan India</a>
            </li>
            <li>
            <a href="#">Trekking Peaks</a>
            </li>
            <li>
            <a href="#">Walk and Explore</a>
            </li>
            <li>
            <a href="#">Yoga</a>
            </li>
            </ul>
            </div>
            <div class="col-md-3">
            <h3 class="mb-sm-4 mb-3 pb-3">Useful Links</h3>
            <ul class="list-unstyled">
            <li>
            <a href="index.html">Payment Methods</a>
            </li>
            <li>
            <a href="#">Modification of Prices</a>
            </li>
            <li>
            <a href="#">Terms and Conditions</a>
            </li>
            <li>
            <a href="#">Privacy Policy</a>
            </li>
            </ul>
            <br>
            <br>
            <div class="touch">
            <div id="travcontactwidget-2" class="contact-box small-box widget_travcontactwidget">
            <h2 class="widgettitle">Get in Touch</h2>
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
            <div class="col-md-3">
                <h3 class="mb-sm-4 mb-3 pb-3">Our Affiliates</h3>
                <img src="{{url('images/neew.png')}}">
            </div>
        </div>
    </div>
</div>

<!-- //footer -->
<!-- copyright -->
<div class="copy_right position-relative">
    <p class="text-center text-wh py-sm-3 py-3">© 2019 Himalaya. All rights reserved</p>
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
<!--script src="{{ asset('js/app.js') }}"></script-->

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