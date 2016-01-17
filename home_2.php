<!doctype html>
<html>
	<head>
		<?php require("initBootstrap.php");?>
		<style type="text/css">
			*
			{
				margin:0;
				padding:0;
			}
			#welcome
			{
				background:url("res/am-logo-7.png") 50% 0 no-repeat fixed;
				width: 100%;
				height: 1200px;
				position: relative;
				box-shadow: 0 0 50px rgba(0,0,0,0.8);
				z-index: -1;
			}
			#welcome article
			{
				background:url("res/Welcome-text-vertical.png") no-repeat scroll center left;
				width:100%;
				height:600px;
				left:-200px;
				position:absolute;
				top:300px;
			}
			#products
			{
				background:url("res/photo-1428999418909-363f8e091c50.jpe") 50% 0 no-repeat fixed;
				width: 100%;
				height: 1200px;
				position:relative;
				box-shadow: 0 0 50px rgba(0,0,0,0.8);
				z-index: -2;
			}
			#products article
			{
				background:url("res/Prodcuts-text-vertical.png") no-repeat scroll center left;
				width:100%;
				height:600px;
				left:-200px;
				position:absolute;
				top:300px;
			}
			#about
			{
				background:url("res/photo-1431538510849-b719825bf08b.jpe") 50% 0 no-repeat fixed;
				width: 100%;
				height: 1200px;
				position:relative;
				box-shadow: 0 0 50px rgba(0,0,0,0.8);
				z-index: -3;
			}
			#about article
			{
				background:url("res/About-text-vertical.png") no-repeat scroll center left;
				width:100%;
				height:600px;
				left:-200px;
				position:absolute;
				top:300px;
			}
			#contact
			{
				background:url("res/photo-1434064511983-18c6dae20ed5.jpe") 50% 0 no-repeat fixed;
				width: 100%;
				height: 1200px;
				position:relative;
				box-shadow: 0 0 50px rgba(0,0,0,0.8);
				z-index: -4;
			}
			#contact article
			{
				background:url("res/Getintouch-text-vertical.png") no-repeat scroll center left;
				width:100%;
				height:600px;
				left:-200px;
				position:absolute;
				top:300px;
			}
			.row2
			{
				display: none;
				opacity:1;
			}
			.row3
			{
				display: none;
			}
			.row4
			{
				display: none;
			}
		
		</style>
		<script type="text/javascript">

			$(document).ready(function(){
				//Module to fade in articles
				$('.row2').hide();
				var scrollvar;
				$(window).scroll(function(){
	
					if($(window).scrollTop()>1367)
					{
						$('.row2').fadeIn(1000);
					}
					if($(window).scrollTop()>2600)
					{
						$('.row3').fadeIn(1000);
					}
					if($(window).scrollTop()>3700)
					{
						$('.row4').fadeIn(1000);
					}
				});

				//Module for parallax effect
				$window = $(window);
				$('section[data-type="background"]').each(function(){
					var $bgobj = $(this);
					$(window).scroll(function(){
						var ypos = -($window.scrollTop() / $bgobj.data('speed'));
						var coords = '50% '+ ypos + 'px';
						$bgobj.css({ backgroundPosition: coords });
					});
				});

				//Products redirection
				$('.thumb-pd').click(function(){
					window.location.href = "http://localhost/agar/boot/products_1.php";
				});

				$("#one").addClass("active");

			});
		</script>
	</head>
	<body>
		<?php require("navbar_2.php");?>
		<a href="#welcome" id="ssWelcome" class="smoothScroll"></a>
		<!--<p style="position:fixed; top:50px;z-index=100;">scrollTop = <span>0</span></p>-->

		<section style="margin-top:-2em;" id="welcome" data-type="background" data-speed="3">
			<article data-type="heads"></article>
		</section>

		<section id="products" data-type="background" data-speed="7">
			<article data-type="heads">
				<a name="welcome"></a>
				<div class="row row2">
					<div class="col-md-6"></div>
					<div class="col-md-2">
						<div class="thumbnail thumb-pd" style="background-color:lavender;">
							<img src="res/embroidery-backing-papers-240x180.jpg" height="180" width="240">
							<div class="caption">
								<h3>Embroidery Backing Papers</h3>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="thumbnail" style="background-color:#F3FF7F;">
							<img src="res/embroidery-threads-240x180.png" height="180" width="240">
							<div class="caption">
								<h3>Embroidery Threads</h3>
							</div>
						</div>
					</div>
					.
					<div class="col-md-2">
						<div class="thumbnail" style="background-color:#7AFF5A;">
							<img src="res/fashion-felts-240x180.png" height="180" width="240">
							<div class="caption">
								<h3>Fashion Felts</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row row2">
					<div class="col-md-6"></div>
					<div class="col-md-2">
						<div class="thumbnail" style="background-color:pink;">
							<img src="res/garment-material-240x180.png" height="180" width="240">
							<div class="caption">
								<h3>Garment Material</h3>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="thumbnail" style="background-color:#ED9FFF">
							<img src="res/liquid-lubricants-240x180.png" height="180" width="240">
							<div class="caption">
								<h3>Liquid Lubricants</h3>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="thumbnail" onclick="gotoproducts()" style="background-color:#7FFFFF;">
							<img src="res/spun-polyester-thread-240x180.png" height="180" width="240">
							<div class="caption">
								<h3>Spun Poyester Threads</h3>
							</div>
						</div>
					</div>
				</div>
			</article>
		</section>


		<section id="about" data-type="background" data-speed="5">
			<article data-type="heads">
				<div class="container">
					<div class="row row3">
						<div class="col-sm-5"></div>
						<div class="col-sm-7" style="background-color:lavender;border-radius:0.5em;">
							<p style="font-size:1.5em;padding:0.5em;">Well established since 1978, we "AGARWAL MARKETING" are eminent suppliers of tailoring material 
			to various segments of garment manufacturers and tailor shops. 
			All our products are highly used in making superior quality garments 
			in order to match the latest fashion trends. Our Products are well 
			applauded by our past and present clients for certain features 
			like durability, color fastness, perfect finish & cut and cost effectiveness.</p>
						</div>
					</div>
					<div class="row row3" style="margin-top:3em;">
						<div class="col-sm-5"></div>
						<div class="col-sm-7" style="background-color:lavender;border-radius:0.5em;">
							<p style="font-size:1.5em;padding:0.5em;">CLIENT SATISFACTION : 
We are a prominent organization involved in offering premium quality Garment Accessories and Threads. All our business policies are designed to maximize the level of client satisfaction. We realize that our market performance is dependent on client satisfaction and to ensure this we constantly remain in touch with them to keep track of their expectations and requirements.</p>
						</div>
					</div>
				</div>
			</article>
		</section>
		
		<section style="margin-bottom:-2.3em;" id="contact" data-type="background" data-speed="7">
			<article data-type="heads">
				<div class="row row4">
					<div class="col-sm-5"></div>
					<div class="col-sm-3" style="background-color:lavender;border-radius:0.5em;">
						<h2>Our Location</h2>
						<address>
							<p><strong><span class="glyphicon glyphicon-map-marker" style="color:BLUE;"></span>AGARWAL MARKETING</strong><br/>
							<span style="padding-left:20px"></span>Shop no. L-8, near sai service gate,<br/>
							<span style="padding-left:20px"></span>D.S. Road, Gandhinagar,<br/>
							<span style="padding-left:20px"></span>Worli, Lower Parel,<br/>
							<span style="padding-left:20px"></span>Mumbai-400 013<br/></p>
							<p><abbr><span class="glyphicon glyphicon-phone-alt" style="color:BLUE;"></span> P:</abbr> 022-24966056<br/>
							<abbr><span class="glyphicon glyphicon-phone-alt" style="color:BLUE;"></span> P:</abbr> 022-24955928<br/></p>
							<p><abbr><span class="glyphicon glyphicon-phone" style="color:BLUE;"></span> M:</abbr> 9320857310<br/></p>
							<p><span class="glyphicon glyphicon-envelope" style="color:blue;"></span> agarwalmarketingmumbai@gmail.com</p>
						</address>
					</div>
					<div class="col-sm-2" style="background-color:lavender;border-radius:0.5em;margin-left:3em;">
						<div class="row" style="padding:1em;">
							<div class="col-sm-6"><span id="fb_span" class="fa fa-facebook fa-5x" style="color:#0E0788;"></span></div>
							<div class="col-sm-6"><span id="twitter_span" class="fa fa-twitter fa-5x" style="color:#756EFD;"></span></div>
						</div>
						<div class="row" style="padding:1em;">
							<div class="col-sm-6"><span class="fa fa-youtube-play fa-5x" style="color:#C90000;"></span></div>
							<div class="col-sm-6"><span class="fa fa-google-plus fa-5x" style="color:#C90000;"></span></div>
						</div>
					</div>
				</div>
				<div class="row row4" style="margin:4em;">
					<div class="col-sm-5"></div>
					<!--<div class="col-sm-5"><button class="btn btn-info" style="width:45em;;height:3em;z-index:100000;">Know More</button></div>-->
				</div>
			</article>
		</section>


		<?php require("footer.php");?>
		
	</body>
</html>