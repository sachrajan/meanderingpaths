<?php 
	get_header(); 
	$firstPost = get_post(get_the_ID())->post_content;
?>

<section>
	<div class="container-fluid">
		<div class="row carousel-section">
		<div class ="col-lg-6 col-md-12 col-sm-12 col-xs-12">
			<div class="row carousel slide" div id="myCarousel" data ride="carousel">
				<ol class="carousel-indicators">
			      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			      <li data-target="#myCarousel" data-slide-to="1"></li>
			      <li data-target="#myCarousel" data-slide-to="2"></li>
			    </ol>
				    <div class="carousel-inner">
				      <div class="item active carousel-image" id="elem1">
				        <img class ="post-image1" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/birds-original.jpg">
				      </div>
				      <div class="item carousel-image" id="elem2">
				       <img class ="post-image2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/diy-christmas-ornaments-carousel.jpg">
				      </div>
				      <div class="item carousel-image" id="elem3">
				       <img class ="post-image3" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/coming-soon-carousel-preview.png">
				      </div>
				    </div>
				     <a class="left carousel-control" href="#myCarousel" data-slide="prev">
				      <span class="glyphicon glyphicon-chevron-left"></span>
				      <span class="sr-only">Previous</span>
				    </a>
				    <a class="right carousel-control" href="#myCarousel" data-slide="next">
				      <span class="glyphicon glyphicon-chevron-right"></span>
				      <span class="sr-only">Next</span>
				    </a>
				</div>
			</div>			
		<div class="col-md-12 col-sm-12 col-xs-12 col-lg-6 carousel-preview">
			<div class="row carousel-content1" id="carousel-content1">
				<a class="btn tag" href="/lifestyle" role="button">Lifestyle</a>
				<div class="post-title">Negativity and dealing with “negative people”</div>
				<p class="latest-preview">A few months ago I hit rock bottom. I was fighting with my husband on a regular basis, I spent most of my time just sitting and watching tv or playing games, and I didn’t care to clean my apartment or eat well. The cause - my mother’s death - was a lone circumstance that snowballed every single ugliness under my skin and threatened to take down any good that lay in it's way...
				</p>
				<a class="btn link" href="/wordpress/negativity-and-dealing-with-negative-people/" role="button">Continue Reading...</a>
			</div>
			<div class="row carousel-content2" id="carousel-content2">
				<a class="btn tag" href="/holidays" role="button">Holidays</a>
				<div class="post-title">Diy Christmas Ornaments under $30</div>
				<p class="latest-preview"> Christmas decorating can be super stressful; it’s time consuming, takes out a lot of energy and if you’re on a tight budget, it can be really expensive. I finally figured out how to cut corners on decorating my tree, and I think it’s time to let you in on the “not a big secret” secret - DIY ornaments. DIY ornaments are personal, unique and each ornament comes with its own story...</p>	
				<a class="btn link" href="/diy-christmas-ornaments-30/" role="button">Continue Reading...</a>
			</div>
			<div class="row carousel-content3" id="carousel-content3">
				<a class="btn tag" href="/wordpress/lifestyle" role="button">Lifestyle</a>
				<div class="post-title">I'm still working on getting some great content for you!</div>
					<p class"latest-preview">
					<br>
					<br>
					In the meantime, please keep watching this space, enjoy my other blog posts, leave your thoughts, and follow me on social media to get updates when I post new content...
					<br>
					<br>
				</p>
				<a class="btn link" href="#" role="button">Continue Reading...</a>
			</div>
			<div class="row carousel-thumbnail">
				<div class="col-md-4 col-xs-4">
					<img id="car-img-1" class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/birds.jpg">
				</div>
				<div class="col-md-4 col-xs-4">
					<img id="car-img-2" class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/diy-christmas-ornaments-carousel-preview.jpg">	
				</div>
				<div class="col-md-4 col-xs-4">
					<img id="car-img-3" class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/coming-soon-carousel-preview.jpg">	
				</div>
			</div>
		</div>
	</div>
	</div>
</section>

<section>
	<div class="container">
		<h3 class="popular-section-title"> Popular Posts</h3>
		<div class="col-lg-8 col-md-8 popular">	
			<div class="row">
				<div class="col-sm-6 col-xs-6 popular-posts">
					<a href="/wordpress/negativity-and-dealing-with-negative-people/" class="popular-preview-mobile">
					<img class="thumb-mobile img-responsive" id="thumb1" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/birds.jpg">
					</a>
					<img class="thumb img-responsive" id="thumb1" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/birds.jpg">
						<a href="/negativity-and-dealing-with-negative-people/" class="popular-preview">
						<div class="middle">
							<div class="post-prev">A few months ago I hit rock bottom. I was fighting with my husband on a regular basis, I spent most of my time just sitting and watching tv or playing games... </div>
						</div>
						</a>
					</div>
				<div class="col-sm-6 col-xs-6 popular-posts">
					<a href="/diy-christmas-ornaments-30/" class="popular-preview-mobile">
					<img class="thumb-mobile img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/get-help-mental-health-therapy-grief-loss.jpg">
					</a>
					<img class="thumb img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/get-help-mental-health-therapy-grief-loss.jpg">
						<a href="/diy-christmas-ornaments-30/" class="popular-preview">
							<div class="middle">
								<div class="post-prev">A couple months ago, I read an article in Slate magazine about approaching people when they’ve gone through loss.“Finally” I thought, “someone decided...
								</div>
							</div>
						</a>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-xs-6 popular-posts">
					<a href="/wordpress/six-things-keep-mind-online-shopping/" class="popular-preview-mobile">
					<img class="thumb-mobile img-responsive" id="thumb3" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/online-shopping-things-to-remember.jpg">
					</a>
					<img class="thumb img-responsive" id="thumb3" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/online-shopping-things-to-remember.jpg">
						<a href="/wordpress/six-things-keep-mind-online-shopping/" class="popular-preview">
							<div class="middle">
								<div class="post-prev">I have a love-hate relationship with online shopping. The list for the reasons why I hate it  isn’t all that long, but the content on my hate list sure trump the love list...</div>
							</div>
						</a>
				</div>
				<div class="col-sm-6 col-xs-6 popular-posts">
					<a href="/wordpress/coming-soon/" class="popular-preview-mobile">
					<img class="thumb-mobile img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/coming-soon-thumb.png">
					</a>
					<img class="thumb img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/coming-soon-thumb.png">
					<a href="/wordpress/coming-soon/" class="popular-preview">
						<div class="middle">
						<div class="post-prev">Keep checking this space for a new post!</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 about-panel">
				<h3 class="text-center"> About Me</h3>
				<img class="thumb-panel" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/saraswathi-meandering-paths-300x169.jpg"> <p class="panel-text-image">Hi, I’m Saraswathi! Welcome to Meandering Paths, your one stop for finding content that is relatable and genuine. </p>
				<p>I started Meandering Paths about a year ago, when I was at my lowest point. I was living an unfulfilled life in a country that held me back in many ways and Meandering Paths was my salvation.<a class="btn link" href="/wordpress/about-me/" role="button">Read More</a></p>
		</div>
	</div>
</section>
<?php get_footer(); ?>