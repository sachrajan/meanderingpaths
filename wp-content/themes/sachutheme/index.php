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
			      <li data-target="#myCarousel" data-slide-to="0"></li>
			      <li data-target="#myCarousel" data-slide-to="1"></li>
			      <li data-target="#myCarousel" data-slide-to="2"></li>
			    </ol>
				    <div class="carousel-inner">
				      <div class="item carousel-image active" id="elem1">
				        <img class ="post-image1" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/birds-original.jpg">
				      </div>
				      <div class="item carousel-image" id="elem2">
				       <img class ="post-image2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/target-slider-new-years-resolution.jpg">
				      </div>
				      <div class="item carousel-image" id="elem3">
				       <img class ="post-image3" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/carousel-preview-holiday-budgeting.jpg">
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
				<a class="btn link" href="/negativity-and-dealing-with-negative-people/" role="button">Continue Reading...</a>
			</div>
			<div class="row carousel-content2" id="carousel-content2">
				<a class="btn tag" href="/lifestyle/" role="button">Lifestyle</a>
				<div class="post-title">A New Year - Resolutions and Goal Setting</div>
				<p class="latest-preview">
											It's that time of the year when people start listing New Years Resolutions. I for one, have a giant list of goals I am determined to see through next year. The most important one? I struggle with continuity. I always find myself digging around for motivation when it fails me after a brief burst of creativity. This flaw has tyrannized most of my projects, and has threatened a lot of my creative drive.I want to end it...</p>	
				<a class="btn link" href="a-new-year-resolutions-goal-setting/" role="button">Continue Reading...</a>
			</div>
			<div class="row carousel-content3" id="carousel-content3">
				<a class="btn tag" href="/wordpress/holidays" role="button">Holidays</a>
				<div class="post-title">Holiday Decorating on a Budget</div>
					<p class"latest-preview">Growing up, I distinctly remember these family traditions my family had around the holidays. The fact that we grew up in a predominantly Hindu household didn’t serve as an impediment when it came to celebrating Christmas; we still had our quaint plastic Christmas tree lit up, there was a present exchange with the neighbours and my mom would always bake her amazing pound cake for us to munch on as we played with our new toys...</p>
					<br>
				<a class="btn link" href="/holiday-decorating-budget/" role="button">Continue Reading...</a>
			</div>
			<div class="row carousel-thumbnail">
				<div class="col-md-4 col-xs-4">
					<img id="car-img-1" class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/birds.jpg">
				</div>
				<div class="col-md-4 col-xs-4">
					<img id="car-img-2" class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/target-new-years-resolution-thumb.jpg">	
				</div>
				<div class="col-md-4 col-xs-4">
					<img id="car-img-3" class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/carousel-thumb-holiday-budgeting.jpg">	
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
					<a href="/negativity-and-dealing-with-negative-people/" class="popular-preview-mobile">
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
					<img class="thumb-mobile img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/diy-christmas-ornaments-carousel-preview.jpg">
					</a>
					<img class="thumb img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/diy-christmas-ornaments-carousel-preview.jpg">
						<a href="/diy-christmas-ornaments-30/" class="popular-preview">
							<div class="middle">
								<div class="post-prev">Christmas decorating can be super stressful; it’s time consuming, takes out a lot of energy and if you’re on a tight budget, it can be really expensive....
								</div>
							</div>
						</a>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-xs-6 popular-posts">
					<a href="/holiday-decorating-budget/" class="popular-preview-mobile">
					<img class="thumb-mobile img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/carousel-thumb-holiday-budgeting.jpg">
					</a>
					<img class="thumb img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/carousel-thumb-holiday-budgeting.jpg">
					<a href="/holiday-decorating-budget/" class="popular-preview">
						<div class="middle">
						<div class="post-prev">Growing up, I distinctly remember these family traditions my family had around the holidays. The fact that we grew up in a predominantly Hindu household...</div>
						</div>
					</a>
				</div>
				<div class="col-sm-6 col-xs-6 popular-posts">
					<a href="/a-new-year-resolutions-goal-setting/" class="popular-preview-mobile">
					<img class="thumb-mobile img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/target-new-years-resolution-thumb.jpg">
					</a>
					<img class="thumb img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/target-new-years-resolution-thumb.jpg">
					<a href="/a-new-year-resolutions-goal-setting/" class="popular-preview">
						<div class="middle">
						<div class="post-prev">It's that time of the year when people start listing New Years Resolutions. I for one, have a giant list of goals I am determined to see through next year... </div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 about-panel">
				<h3 class="text-center"> About Me</h3>
				<img class="thumb-panel" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/saraswathi-meandering-paths-300x169.jpg"> <p class="panel-text-image">Hi, I’m Saraswathi! Welcome to Meandering Paths, your one stop for finding content that is relatable and genuine. </p>
				<p>I started Meandering Paths about a year ago, when I was at my lowest point. I was living an unfulfilled life in a country that held me back in many ways and Meandering Paths was my salvation.<a class="btn link" href="/about-me/" role="button">Read More</a></p>
		</div>
	</div>
</section>
<?php get_footer(); ?>