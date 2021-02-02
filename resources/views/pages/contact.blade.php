<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

     <!-- Site Metas -->
    <title>Ichiro ITS Robotic Team</title>
    <meta name="keywords" content="Ichiro ITS">
    <meta name="description" content="Official Website of Ichiro ITS Robotics Team">
    <meta name="author" content="Created by Bryan Yehuda - Jupiter Development">

    <!-- Site Icons -->
    <link rel = "icon" type = "image/png" href = "{{asset('assets/uploads/images/ichiro.png')}}">
    <!-- For apple devices -->
    <link rel = "apple-touch-icon" type = "image/png" href = "{{asset('assets/uploads/images/ichiro.png')}}"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <!-- Colors CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/colors.css')}}">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/versions.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="barber_version">

    <!-- LOADER -->
    <div id="preloader">
        <div class="cube-wrapper">
		      <div class="cube-folding">
			     <span class="leaf1"></span>
                 <span class="leaf2"></span>
			     <span class="leaf3"></span>
			     <span class="leaf4"></span>
		      </div>
		</div>
    </div><!-- end loader -->
    <!-- END LOADER -->

    <div id="wrapper">

        <!-- Sidebar-wrapper -->
        <div id="sidebar-wrapper">
			<div class="side-top">
				<div class="logo-sidebar">
					<a href="/"><img src="{{asset('assets/uploads/images/ichiro.png')}}"></a>
				</div>
				<ul class="sidebar-nav">
					<li><a href="/">Home</a></li>
                    <li><a href="/teams">Our Team</a></li>
                    <li><a href="/achievement">Achievement</a></li>
					<li><a href="/robots">Robots</a></li>
                    <li><a href="/research">Publication</a></li>
                    <li><a href="/sponsors">Sponsors</a></li>
					<li><a class="active" href="/contact">Contact</a></li>
				</ul>
			</div>
        </div>
        <!-- End Sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <a href="#menu-toggle" class="menuopener" id="menu-toggle"><i class="fa fa-bars"></i></a>

            <div class="all-page-bar-contact">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="title title-1 text-center">
								<div class="title--heading">
									<h1>Contact</h1>
								</div>
								<div class="clearfix"></div>
								<ol class="breadcrumb">
									<li><a href="/">Home</a></li>
									<li class="active">Contact</li>
								</ol>
							</div>
							<!-- .title end -->
						</div>
					</div>
				</div>
			</div><!-- end all-page-bar -->

            <section class="section nopad cac text-center">
                <a href="#"><h3>Satu Hati, Untuk Negeri, Wani!</h3></a>
            </section>

            <div id="contact" class="section wb">
                <div class="container-fluid">

                    <div class="section-title row text-center">
                        <div class="col-md-8 col-md-offset-2">
                        <small>Please send us your ideas, bug reports, suggestions! Any feedback would be appreciated</small>
                        <h3>Our Contact</h3>
                        <hr class="grd1">
                        <p class="lead">Email: ichiro.its@gmail.com</p>
                        <p class="lead">Phone: +62 8588 3483 473 (Arsy)</p>
                        <p class="lead"><br></p>
                        <p class="lead">Address:</p>
                        <p class="lead">Gedung Robotika ITS</p>
                        <p class="lead">ITS Campus, Sukolilo, Surabaya, Jawa Timur, Indonesia</p>
                        </div>
                    </div><!-- end title -->

                </div><!-- end container -->
            </div><!-- end section -->

            <div id="map" class="map-box">
                <div class="container-fluid">

                </div><!-- end container -->
            </div><!-- end section -->
        </div>
    </div><!-- end wrapper -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="{{asset('assets/js/all.js')}}"></script>
	<script src="{{asset('assets/js/responsive-tabs.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

    <!-- Menu Toggle Script -->
    <script>
    (function($) {
        "use strict";
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        smoothScroll.init({
            selector: '[data-scroll]', // Selector for links (must be a class, ID, data attribute, or element tag)
            selectorHeader: null, // Selector for fixed headers (must be a valid CSS selector) [optional]
            speed: 500, // Integer. How fast to complete the scroll in milliseconds
            easing: 'easeInOutCubic', // Easing pattern to use
            offset: 0, // Integer. How far to offset the scrolling anchor location in pixels
            callback: function ( anchor, toggle ) {} // Function to run after scrolling
        });
    })(jQuery);
    </script>

</body>
</html>
