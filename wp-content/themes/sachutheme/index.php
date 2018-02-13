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
				        <img class ="post-image1" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/post8/candles-loss-death-sadness-united-carousel.jpg">
				      </div>
				      <div class="item carousel-image" id="elem2">
				       <img class ="post-image2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/post7/online-shopping-discount-carousel.jpg">
				      </div>
				      <div class="item carousel-image" id="elem3">
				       <img class ="post-image3" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/ikea-logo-building-exterior-carousel.jpg">
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
				<div class="post-title">When good intentions turn ugly - how to approach someone dealing with grief and loss</div>
				<p class="latest-preview">A couple months ago, I read an article in Slate magazine about approaching people dealing with grief and loss. “Finally,” I thought, “someone decided to take a stance and educate people on the proper etiquette of supporting the bereaved”.Losing my mom was hard. Not having a proper support group was harder. Ever since I lost my mom to esophageal cancer, I’ve found...
				</p>
				<a class="btn link" href="/approach-dealing-grief-loss/" role="button">Continue Reading...</a>
			</div>
			<div class="row carousel-content2" id="carousel-content2">
				<a class="btn tag" href="/lifestyle/" role="button">Lifestyle</a>
				<div class="post-title">Six Things to Remember When Shopping Online</div>
				<p class="latest-preview">It’s always that time of the year when you need to power on your laptop and buy something off the internet. It’s not like you can keep running to the shop for every single purchase - not with the ridiculous amount of traffic and work in a day. Major holidays, birthdays, and “I need boots” kind of days force us to to shift our focus from in store purchases to online shopping. No more waiting in queues that keep moving from one register to another (true story)...</p>	
				<a class="btn link" href="/six-things-remember-when-shopping-online/" role="button">Continue Reading...</a>
			</div>
			<div class="row carousel-content3" id="carousel-content3">
				<a class="btn tag" href="/lifestyle" role="button">Lifestyle</a>
				<div class="post-title">Charm and Character in an Ikea Furnished Home</div>
					<p class"latest-preview">Ikea is the furniture Goddess (or God) you go to when you need affordable, Scandinavian style furniture. Or, if you’re anything like me, Ikea is the land of decor inspiration and cheap meals.Ikea is extremely popular for their affordable, modern furniture selection.
				Sadly, Ikea can also be easily passed off as a one stop shop for 3S’s - simple, standard and single use. People are increasingly on the lookout for alternatives to the retail giant, but in my opinion, Ikea still stands out in its sea of competitors...</p>
					
				<a class="btn link" href="/charm-character-ikea-furnished-home/" role="button">Continue Reading...</a>
			</div>
			<div class="row carousel-thumbnail">
				<div class="col-md-4 col-xs-4">
					<img id="car-img-1" class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/post8/candles-loss-death-sadness-thumb.jpg">
				</div>
				<div class="col-md-4 col-xs-4">
					<img id="car-img-2" class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/post7/online-shopping-discount-thumbnail.jpg">	
				</div>
				<div class="col-md-4 col-xs-4">
					<img id="car-img-3" class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/ikea-logo-building-exterior-thumbnail.jpg">	
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
				<div class="col-sm-6 col-xs-6 popular-posts">
					<a href="/charm-character-ikea-furnished-home/" class="popular-preview-mobile">
					<img class="thumb-mobile img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/ikea-logo-building-exterior-post-preview-homepage.jpg">
					</a>
					<img class="thumb img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/ikea-logo-building-exterior-post-preview-homepage.jpg">
					<a href="/charm-character-ikea-furnished-home/" class="popular-preview">
						<div class="middle">
						<div class="post-prev">Ikea is the furniture Goddess (or God) you go to when you need affordable, Scandinavian style furniture. Or, if you’re anything like me, Ikea is the land of...</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-xs-6 popular-posts">
					<a href="/six-things-remember-when-shopping-online/" class="popular-preview-mobile">
					<img class="thumb-mobile img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/post7/online-shopping-discount-homepage-post-preview.jpg">
					</a>
					<img class="thumb img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/post7/online-shopping-discount-homepage-post-preview.jpg">
					<a href="/six-things-remember-when-shopping-online/" class="popular-preview">
						<div class="middle">
						<div class="post-prev">It’s always that time of the year when you need to power on your laptop and buy something off the internet...</div>
						</div>
					</a>
				</div>
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