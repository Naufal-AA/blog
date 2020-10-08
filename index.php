<!DOCTYPE HTML>
<HTML lang="en">
<HEAD>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<TITLE>Dashboard</TITLE>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/publicstyle.css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="shortcut icon" href="assets/Image/favicon.png">
</HEAD>
<style type="text/css">
	.carousel, .item, .active {
    height:100%;
	}
	.carousel-inner {
		height:100%;
	}
	.carousel {
		margin-bottom: 60px;
	}
	.carousel-control {
		z-index: 0;
	}
	.carousel-caption {
		z-index: 10;
	}
	.carousel .item {
		background-color: #777;
	}
	.carousel .carousel-inner .carousel-img {
		background-repeat:no-repeat;
		background-size:cover;
	}
	.carousel .carousel-inner .carousel-img1 {
		background-image:url(../assets/image/banner-1.jpg);
		background-position: center top;
	}
	.carousel .carousel-inner .carousel-img2 {
		background-image:url(../assets/image/banner-2.jpg);
		background-position: center center;
	}
	.carousel .carousel-inner .carousel-img3 {
		background-image:url(../assets/image/banner-3.jpg);
		background-position: center bottom;
	}
</style>
<BODY>

	<!-- Top menu -->
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">blog design</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<form action="blog.php" class="navbar-form navbar-right">
						<div class="input-group">
							<input class="form-control" type="text" name="Search" id="search" placeholder="Search">
						<div class="input-group-btn"><button class="btn btn-default" name="Searchbutton"><span class="glyphicon glyphicon-search">
						</span></button></div></div>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Home</a></li>
						<li><a href="blog.php?Page=1">Blog</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Feature</a></li>
					</ul>
				</div>
			</div>
		</nav>
	
<div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            </ol>
                <div class="carousel-inner">
                    <div class="item carousel-img carousel-img1 active">
                        <div class="container">
                            <div class="carousel-caption animated bounceInLeft visible" data-animation="bounceInLeft" data-animation-delay="100">
                                <h1 class="font-pacifico text-capitalize color-light mt-50 text-right"><span class="alpha10">No. #1 Recommended<br>Web Service</span><br>
                                </h1>
                                <p class="color-light text-right mt20 ml10">
                                    <a href="http://myboodesign.com/pasific/mp-index-carousel-3.html#" class="color-light alpha5 font-pacifico">~ George Webb. Themeforest.net</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="item carousel-img carousel-img2">
                        <div class="container">
                            <div class="carousel-caption mt-50 animated bounceInUp visible" data-animation="bounceInUp" data-animation-delay="100">
                                <h1 class="font-pacifico text-capitalize color-dark mt-25">
                                    The One Stop<br>Website Service
                                </h1>
                                <p class="color-dark mt25">
                                    Wordpress. Joomla. eCommerce. HTML. Etc.<br>
                                    <a href="http://myboodesign.com/pasific/mp-index-carousel-3.html#" class="button button-md button-pasific hover-ripple-out mt30">Start Project</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="item carousel-img carousel-img3">
                        <div class="container">
                            <div class="carousel-caption animated bounceInLeft visible" data-animation="bounceInLeft" data-animation-delay="100">
                                <h1 class="font-pacifico text-capitalize text-left color-dark mt-50">We <i class="fa fa-wordpress"></i>Wordpress<br>Developer.</h1>
                                <p class="mt25 text-left color-light">The most powerfull website engine so far.<br>
                                    <a href="http://myboodesign.com/pasific/mp-index-carousel-3.html#" class="button button-pasific hover-ripple-out button-md mt30">Start Project</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <a class="left carousel-control" href="" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="http://myboodesign.com/pasific/mp-index-carousel-3.html#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            
            <div class="svg-container-bottom">
                <svg id="svgLineTop" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="300" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 300" preserveAspectRatio="xMinYMax">
                    
                    <polygon points="-150,450 0,100 600,300 2000,100 5200,450" fill="#fff" stroke="none"></polygon>
                    
                </svg>
            </div>
            
        </div>    
	 <!-- Body -->
	<div class="bodycontainer">
		<div class="container">
			
		</div>
    
	
	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-1">
                    <h3>blog design</h3>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.
		                    		Ut wisi enim ad minim veniam, quis nostrud.</p>
				</div>
				<div class="col-md-5 col-md-offset-2">
					<div>
						<h3>Contact US</h3>
					</div>
					<div>
						<div class="contact">
	                			<span class="fooicon glyphicon glyphicon-home"></span>
								<p> Kasaragod - 671121 , Kerala, India</p>
	                	</div>
			
						<div class="contact">
	                			<span class="fooicon glyphicon glyphicon-earphone control-col"></span>
								<p> +91 8136919446</p>
	                	</div>
						<div class="contact">
	                			<span class="fooicon glyphicon glyphicon-envelope"></span>
								<p> noufalnoupu673@gmail.com</p>
	                	</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix col-md-12 col-sm-12">
				<div class="footer-copyright">
					<p>Copyright &copy; 2020  blog design</p>
				</div>
			</div>
			<div class="clearfix col-md-12 col-sm-12">
				<hr>
			</div>

			<div class="col-md-12 col-sm-12">
				<ul class="social-icon">
					<li><a href="#" class="fa fa-facebook"></a></li>
					<li><a href="#" class="fa fa-twitter"></a></li>
					<li><a href="#" class="fa fa-google-plus"></a></li>	
					<li><a href="#" class="fa fa-linkedin"></a></li>
				</ul>
			</div>
		</div>
	</footer>
</BODY>
</HTML>
