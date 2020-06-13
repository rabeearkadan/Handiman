<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Genie Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
    <meta property="og:title" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="">
    <meta property="og:description" content="">

    <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">

    <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
    <link href="favicon.ico" rel="shortcut icon">


    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="../../public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="../../public/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../public/lib/animate-css/animate.min.css" rel="stylesheet">

    <link href="../../public/css/style.css" rel="stylesheet">
{{--    <!-- Main Stylesheet File -->--}}
{{--    <link href="../../public/css/style.css" rel="stylesheet">--}}


<!-- Main Stylesheet File -->
    <link href="../../public/css/style.css" rel="stylesheet">

    <!-- =======================================================
          Theme Name: Imperial
          Theme URL: https://bootstrapmade.com/imperial-free-onepage-bootstrap-theme/
          Author: BootstrapMade.com
          Author URL: https://bootstrapmade.com
        ======================================================= -->
</head>

<body>
<div id="preloader"></div>

<section id="hero">
    <div class="hero-container">
        <div class="wow fadeIn">
            {{--            <div class="hero-logo">--}}
            {{--                <img class="" src="../../public/img/logo.png" alt="Genie">--}}
            {{--            </div>--}}

            <h1>Welcome to Genie</h1>
            <h2>We provide <span class="rotating">handyman Scheduling, services availability</span>
            </h2>
            <div class="actions">
                <a href="{{ route('register') }}" class="btn-get-started">Get Strated</a>
                <a href="#services" class="btn-services">Our Services</a>
            </div>
        </div>
    </div>
</section>
<header id="header">
    <div class="container">

        <div id="logo" class="pull-left">
            <a href="#hero"><img src="../../public/img/logo.png" alt="" title=""/></a>
            <!-- Uncomment below if you prefer to use a text image -->
            <!--<h1><a href="#hero">Header 1</a></h1>-->
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="menu-active"><a href="#hero">Home</a></li>
                <li><a href="#about">About Us</a></li>

                <li><a href="#team">Team</a></li>

                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            </ul>
        </nav>
        <!-- #nav-menu-container -->
    </div>
</header>
<!-- #header -->


<!--==========================
About Section
============================-->
<section id="about">
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">About Us</h3>
                <div class="section-title-divider"></div>
            </div>
        </div>
    </div>
    <div class="container about-container wow fadeInUp">
        <div class="row">

            <div class="col-lg-6 about-img">
                <img src="../../public/img/plumber.jpg" alt="">
            </div>

            <div class="col-md-6 about-content">
                <h2 class="about-title">We provide great services and ideas</h2>
                <p class="about-text">
                    It is common that every home has some problems with any of the household items such as kitchen
                    equipment, Air Conditioner, washing machine, Television, etc and you might need plumber or
                    electrician or mechanic or any other handy service. There are a lot of handyman available but still
                    it has become a challenging task to get the things to be serviced as no handyman will be available
                    on time. Despite this, when you get a handyman, he might charge heavy cost. Nonetheless, it is of
                    great difficulty to choose a reputable handyman, a stranger that will enter the home. Locating
                    handyman service providers is a challenging task especially when one travels and moves to a new
                    place because service providers are situated across different areas and differ in costs, quality and
                    type of service that they provide.
                </p>
                <p class="about-text">
                    Also, a lot of handyman are not aware of the customers who are in need of their services. This made
                    an impact on both, individual and the handy service provider. To overcome this, technology gave the
                    right solution. When an appealing mobile application is built, paired with a web platform, it
                    becomes easy for both the parties. An individual can get the right person for a reasonable cost and
                    the handy service provider can get connected with the customers easily.
                </p>

            </div>
        </div>
    </div>
</section>

<!--==========================
Services Section
============================-->
<section id="services">
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Our Services</h3>
                <div class="section-title-divider"></div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-4 service-item">
                <div class="service-icon"><i class="fa fa-desktop"></i></div>
                <h4 class="service-title"><a href=""> ACCEPT/REJECT JOB REQUEST </a></h4>
                <p class="service-description"> According to the product availability, number of handymen available and
                    the pending orders, accept or reject the orders through app for finding Handyman. </p>
            </div>
            <div class="col-md-4 service-item">
                <div class="service-icon"><i class="fa fa-bar-chart"></i></div>
                <h4 class="service-title"><a href=""> SWITCH ONLINE/OFFLINE </a></h4>
                <p class="service-description"> You may toggle the availability of the handymen within your on demand
                    handyman app. The handymans may also set their availability. </p>
            </div>
            <div class="col-md-4 service-item">
                <div class="service-icon"><i class="fa fa-paper-plane"></i></div>
                <h4 class="service-title"><a href=""> PAY BY CASH/CREDIT CARD </a></h4>
                <p class="service-description">Let the Handymen on demand app users pay through different payment
                    mediums, including cash, net banking or credit/debit cards.</p>
            </div>
            <div class="col-md-4 service-item">
                <div class="service-icon"><i class="fa fa-photo"></i></div>
                <h4 class="service-title"><a href=""> INSTANT ALERT </a></h4>
                <p class="service-description"> The app for finding Handyman sends instant alerts for booking,
                    cancelation, scheduling, and arrival time of handyman and job completion. </p>
            </div>
            <div class="col-md-4 service-item">
                <div class="service-icon"><i class="fa fa-road"></i></div>
                <h4 class="service-title"><a href=""> GENERATE NEW BILLS EASILY </a></h4>
                <p class="service-description"> The app for finding Handyman sends instant alerts for booking,
                    cancelation, scheduling, and arrival time of handyman and job completion. </p>
            </div>
            <div class="col-md-4 service-item">
                <div class="service-icon"><i class="fa fa-shopping-bag"></i></div>
                <h4 class="service-title"><a href="">CANCEL BOOKINGS</a></h4>
                <p class="service-description">The on demand Handyman service app users may cancel the booking if they
                    are not available at home or have found an alternative.</p>
            </div>
        </div>
    </div>
</section>

<!--==========================
Subscrbe Section
============================-->
<section id="subscribe">
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col-md-8">
                <h3 class="subscribe-title">Subscribe For Updates</h3>
                <p class="subscribe-text">Join our 1000+ subscribers and get access to the latest tools, freebies,
                    product announcements and much more!</p>
            </div>
            <div class="col-md-4 subscribe-btn-container">
                <a class="subscribe-btn" href="#">Subscribe Now</a>
            </div>
        </div>
    </div>
</section>



<!--==========================
Testimonials Section
============================-->
<section id="testimonials">
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Supervisor</h3>
                <div class="section-title-divider"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="profile">
                    <div class="pic"><img src="../../public/img/Dr-Islam-El-Kabbani.jpg" alt=""></div>
                    <h4>Dr. Islam El-Kabani</h4>
                    <span>Assistant Professor of Computer Science</span>
                </div>
            </div>
            <div class="col-md-9">
                <div class="quote">
                    <small><img
                            src="../../public/img/quote_sign_left.png"
                            alt=""></small>
                    Dr. Islam Elkabani received his Ph.D.
                    in Computer Science from New Mexico State University (NMSU), USA in 2007. He worked as a Teaching
                    and Research Assistant during his graduate studies at NMSU. Between 2007 and 2009, he worked as an
                    Assistant Professor of Computer Science and an Executive Director of the Computer Center of the
                    Faculty of Science at Alexandria University, Egypt. He has been a faculty member in the Computer
                    Science Department at Beirut Arab University since September 2009. His research interests include
                    Knowledge Representation, Answer Set Programming, Social Networks Analysis and Mining, Assistive
                    Technologies, Natural Language Processing and Data Mining. <small><img
                            src="../../public/img/quote_sign_right.png"
                            alt=""></small>
                </div>
            </div>
        </div>


    </div>
</section>

<!--==========================
Team Section
============================-->
<section id="team">
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Our Team</h3>
                <div class="section-title-divider"></div>
                <p class="section-description">Computer Science Students at Beirut Arab University</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="member">
                    <div class="pic"><img src="../../public/img/Mhmd_itani.jpeg" alt=""></div>
                    <h4>Mohammad H. Itani</h4>
                    <div class="social">
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-google-plus"></i></a>
                        <a href=""><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="member">
                    <div class="pic"><img src="../../public/img/ahmddorra.jpeg" alt=""></div>
                    <h4>Ahmad Dorra</h4>

                    <div class="social">
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-google-plus"></i></a>
                        <a href=""><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="member">
                    <div class="pic"><img src="../../public/img/noura_shouli.jpeg" alt=""></div>
                    <h4>Noura Shouli</h4>
                    <div class="social">
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-google-plus"></i></a>
                        <a href=""><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="member">
                    <div class="pic"><img src="../../public/img/rami_chamseddine.jpeg" alt=""></div>
                    <h4>Rami Chamseddine</h4>
                    <div class="social">
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-google-plus"></i></a>
                        <a href=""><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!--==========================
Contact Section
============================-->
<section id="contact">
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Contact Us</h3>
                <div class="section-title-divider"></div>
                <p class="section-description"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-md-push-2">
                <div class="info">
                    <div>
                        <i class="fa fa-map-marker"></i>
                        <p>Beirut, Lebanon</p>
                    </div>

                    <div>
                        <i class="fa fa-envelope"></i>
                        <p>geniesenior2020@gmail.com</p>
                    </div>

                    <div>
                        <i class="fa fa-phone"></i>
                        <p>+961 76979280</p>
                    </div>

                </div>
            </div>

            <div class="col-md-5 col-md-push-2">
                <div class="form">
                    <div id="sendmessage">Your message has been sent. Thank you!</div>
                    <div id="errormessage"></div>
                    <form action="{{route('mail.contact')}}" method="post" role="form" class="contactForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                   data-rule="minlen:4" data-msg="Please enter at least 4 chars"/>
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                                   data-rule="email" data-msg="Please enter a valid email"/>
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                                   data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject"/>
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required"
                                      data-msg="Please write something for us" placeholder="Message"></textarea>
                            <div class="validation"></div>
                        </div>
                        <div class="text-center">
                            <button type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!--==========================
Footer
============================-->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    &copy; Copyright <strong>Genie Team</strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!--
                      All the links in the footer should remain intact.
                      You can delete the links only if you purchased the pro version.
                      Licensing information: https://bootstrapmade.com/license/
                      Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Imperial
                    -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- #footer -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- Required JavaScript Libraries -->
<script src="../../public/lib/jquery/jquery.min.js"></script>
<script src="../../public/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../../public/lib/superfish/hoverIntent.js"></script>
<script src="../../public/lib/superfish/superfish.min.js"></script>
<script src="../../public/lib/morphext/morphext.min.js"></script>
<script src="../../public/lib/wow/wow.min.js"></script>
<script src="../../public/lib/stickyjs/sticky.js"></script>
<script src="../../public/lib/easing/easing.js"></script>

<!-- Template Specisifc Custom Javascript File -->
<script src="../../public/js/custom.js"></script>

<script src="../../public/contactform/contactform.js"></script>


</body>

</html>
