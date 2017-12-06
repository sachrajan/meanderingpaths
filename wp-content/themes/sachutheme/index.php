<?php 
	get_header(); 
	$firstPost = get_post(get_the_ID())->post_content;
?>
<section class="carousel">
		<div class="container-fluid">
			<div class ="col-md-6 col-sm-6 col-xs-12 col-lg-6 post-image1">
				<img class ="post-image img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/images/birds.jpg">
			</div>
			<div class ="col-md-6 col-sm-6 col-xs-12 col-lg-6 post-image2">
				<img class ="post-image img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/images/get-help-mental-health-therapy-grief-loss.jpg">
			</div>
			<div class ="col-md-6 col-sm-6 col-xs-12 col-lg-6 post-image3">
				<img class ="post-image img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/images/bangles-shopping-online-misleading.jpg">
			</div>
			<div class ="col-md-6 col-sm-6 col-xs-12 col-lg-6 post-image4">
				<img class ="post-image img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
			</div>


			<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
				<div class="row carousel-content1">
					<a class="btn tag" href="#" role="button">Lifestyle</a>
					<h3 class="post-title">	Negativity and dealing with “negative people”</h3>
					<p class="latest-preview"> A few months ago I hit rock bottom. I was fighting with my husband on a regular basis, I spent most of my time just sitting and watching tv or playing games, and I didn’t care to clean my apartment or eat well. The cause - my mother’s death - was a lone circumstance that snowballed every single ugliness under my skin and threatened to take down any good that lay in its way.
					</p>
					<a class="btn link" href="#" role="button">Continue Reading...</a>
				</div>
				<div class="row carousel-content2">
					<a class="btn tag" href="#" role="button">Lifestyle</a>
					<h3 class="post-title">When good intentions turn ugly – how to approach someone dealing with loss</h3>
					<p class="latest-preview"> A couple months ago, I read an article in Slate magazine about approaching people when they’ve gone through loss.

												“Finally” I thought, “someone decided to take a stance and educate people on the proper etiquette of dealing with death as an outsider”.	
					</p>
					<a class="btn link" href="#" role="button">Continue Reading...</a>
				</div>
				<div class="row carousel-content3">
					<a class="btn tag" href="#" role="button">Lifestyle</a>
					<h3 class="post-title">Six Things to Keep in Mind when Online Shopping</h3>
					<p class="latest-preview"> I have a love-hate relationship with online shopping. The list for the reasons why I hate it  isn’t all that long, but the content on my hate list sure trump the love list. To have your physical purchasing experience match your online experience is far too idealistic but you can get close enough with these 5 tips in mind!
					
					</p>
					<a class="btn link" href="#" role="button">Continue Reading...</a>
				</div>
				<div class="row carousel-content4">
					<a class="btn tag" href="#" role="button">Lifestyle</a>
					<h3 class="post-title"> Blog Post Title 4</h3>
					<p class="latest-preview"> 
						
					</p>
					<a class="btn link" href="#" role="button">Continue Reading...</a>
				</div>
				<div class="row">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner item" role="listbox">
							<div class="col-md-3 col-xs-3 active">
								<img id="car-img-1" class="img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
							</div>
							<div class="col-md-3 col-xs-3">
								<img id="car-img-2" class="img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">	
							</div>
							<div class="col-md-3 col-xs-3">
								<img id="car-img-3" class="img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">	
							</div>
							<div class="col-md-3 col-xs-3">
								<img id="car-img-4" class="img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
							</div>
							<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			  					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							</a>
							<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			 					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</section>
	<section>
		<div class="container">
			<h3> Popular Posts</h3>
			<div class="col-lg-8 col-md-8 popular">	
				<div class="row">
					<div class="col-sm-6 col-xs-6 popular-posts">
						<img class="thumb img-responsive" id="thumb1" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
							<p class="post-prev"id="post-prev1">orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
					</div>
					<div class="col-sm-6 col-xs-6 popular-posts">
						<img class="thumb img-responsive" id="thumb2" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
							<p class="post-prev"id="post-prev2">orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-xs-6 popular-posts">
						<img class="thumb img-responsive" id="thumb3" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
							<p class="post-prev"id="post-prev3">orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
					</div>
					<div class="col-sm-6 col-xs-6 popular-posts">
						<img class="thumb img-responsive" id="thumb4" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						<p class="post-prev"id="post-prev4">orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-xs-6 popular-posts">
						<img class="thumb img-responsive" id="thumb5" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						<p class="post-prev"id="post-prev5">orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
					</div>
					<div class="col-sm-6 col-xs-6 popular-posts">
						<img class="thumb img-responsive" id="thumb6" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						<p class="post-prev"id="post-prev6">orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 about-panel">
					<h3 class="text-center"> About Me</h3>
					<p class="panel-text-image"><img class="thumb-panel" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry'sorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.
					<br><a class="btn link" href="#" role="button">Read More</a></p>
			</div>
		</div>
	</section>
<?php get_footer(); ?>