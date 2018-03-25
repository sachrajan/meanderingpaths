<?php 
	get_header(); 
	$firstPost = get_post(get_the_ID())->post_content;
?>

<section>
	 <div class="container-fluid">
        <div class="carousel-container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="carousel slide" id="myCarousel">
                    <div class="carousel-inner">
                        <div class="item">
                          <div class="col-md-4 col-sm-4 col-xs-4 carousel-item"><a href="/approach-dealing-grief-loss/"><img src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/carousel/grief-loss-candles.jpg" class="img-responsive carousel-image"></a>
                          	<div class="carousel-preview carousel-textbox"> 
                          		<a href="/personal-development/"><span class="tag"> Personal Development </span></a>
                          		<span class="misc"> / </span>
                          		<span class="entry-date"> February 12, 2018</span>
                          		<div class="carousel-post-title"> <a class="carousel-post-title" href="/approach-dealing-grief-loss/">How to approach someone dealing with grief and loss</a> </div>
                          	</div>
                          	</div>
                        </div>
                         <div class="item">
                          <div class="col-md-4 col-sm-4 col-xs-4 carousel-item"><a href="/dubai-101/"><img src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/carousel/1.jpg" class="img-responsive carousel-image"></a>
                          <div class="carousel-preview carousel-textbox">
                          		<a href="/travel/"><span class="tag"> Travel </span></a> 
                          		<span class="misc"> / </span>
                          		<span class="entry-date"> February 27, 2018</span> 
                          		<div class="carousel-post-title"><a class="carousel-post-title" href="/dubai-101/">Dubai 101</a></div>
                          	</div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="col-md-4 col-sm-4 col-xs-4 carousel-item"><a href="/beat-the-holiday-blues-with-these-tips/"><img src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/carousel/winter-blues-dull.jpg" class="img-responsive carousel-image"></a>
                          <div class="carousel-preview carousel-textbox"> 
                          		<a href="/lifestyle/"><span class="tag"> Lifestyle </span> </a>
                          		<span class="misc"> / </span>
                          		<span class="entry-date"> January 08, 2018</span>
                          		<div class="carousel-post-title"> <a class="carousel-post-title" href="/beat-the-holiday-blues-with-these-tips/">Beat the Holiday Blues With These Tips </a></div>
                          	</div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="col-md-4 col-sm-4 col-xs-4 carousel-item"><a href="/negativity-and-dealing-with-negative-people/"><img src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/carousel/birds-ignore-negativity.jpg" class="img-responsive carousel-image"></a>
                          <div class="carousel-preview carousel-textbox"> 
                          		<a href="/personal-development/"><span class="tag"> Personal Development </span></a>
                          		<span class="misc"> / </span>
                          		<span class="entry-date"> December 17, 2017</span>
                          		<div class="carousel-post-title"> <a class="carousel-post-title" href="/negativity-and-dealing-with-negative-people/"> Negativity and Dealing with “Negative People”</a></div>
                          	</div>
                          </div>
                        </div>
                         <div class="item">
                          <div class="col-md-4 col-sm-4 col-xs-4 carousel-item"><a href="/charm-character-ikea-furnished-home/"><img src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/carousel/IKEA-logo-building-exterior.jpg" class="img-responsive carousel-image"></a>
                          <div class="carousel-preview carousel-textbox">
                          		<a href="/lifestyle/"><span class="tag"> Lifestyle </span></a>
                          		<span class="misc"> / </span> 
                         		<span class="entry-date"> January 16, 2018</span>
                          		<div class="carousel-post-title"><a class="carousel-post-title" href="/charm-character-ikea-furnished-home/"> Charm and Character in an Ikea Furnished Home</a></div>
                          	</div>
                          </div>
                        </div>
                        <div class="item active">
                          <div class="col-md-4 col-sm-4 col-xs-4 carousel-item"><a href="/26-life-lessons-i-learned-in-26-years/"><img src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/carousel/26-things-monttremblant.jpg" class="img-responsive carousel-image"></a>
                          <div class="carousel-preview carousel-textbox"> 
                          		<a href="/personal-development/"><span class="tag"> Personal Development </span> </a>
                          		<span class="misc"> / </span>
                          		<span class="entry-date"> March 7, 2018</span> 
                          		<div class="carousel-post-title"> <a class="carousel-post-title" href="/26-life-lessons-i-learned-in-26-years/"> 26 Life Lessons I Learned in 26 Years</a></div>
                          	</div>
                          </div>
                        </div>
                    </div>
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><div></div><i class="glyphicon glyphicon-chevron-left"></i></a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next"><div></div><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <script>
$('#myCarousel').carousel({
  interval: 10000
})

$('.carousel .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  if (next.next().length>0) {
    next.next().children(':first-child').clone().appendTo($(this));
  }
  else {
    $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
  }
});
</script>
</section>
	<!--POPULAR POSTS <!-->
	<section>
		<div class="container">
			<h3 class="popular-section-title"> Popular Posts</h3>
				<div class="popular">
					<div class="col-lg-8 col-md-8">	
						<div class="row">
							<article>
								<div class="col-sm-6 col-xs-12">
									<div class="container-a">
										<div class="popular-posts article-box">
											<div class="popular-post-img">
												<a href="/dubai-101/" class="popular-preview-mobile">
												<img class="thumb-mobile img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/dubai-101-pp-mob.jpg">
												</a>
												<img class="thumb img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/dubai-101-pp.jpg">
												<a href="/dubai-101/" class="popular-preview">
												</a>
											</div>
											<div class="popular-posts-text">
												<span class="category-tag">
												<a href="/travel/" class="category-tag">Travel</a>
												</span>
												<h2 class="pop-post-title">
												<a href="/dubai-101/" class="pop-post-title">Dubai 101</a>
												</h2>
												<span class="entry-date"> February 27 2018</span>
											</div>
											<div class="overlay">
											   	<div class="text-a">
											    	<div class="popular-posts-details">
											    		<span class="category-tag-hover">
														<a href="/travel/" class="category-tag-hover">Travel</a>
														</span>
														<h2 class="pop-post-title-hover">
														<a href="/dubai-101/" class="pop-post-title-hover">Dubai 101</a>
														</h2>
														<span class="entry-date-hover"> February 27 2018</span>
													</div>
											    		<p class="popular-post-preview">What pops into your head the minute you hear the name “Dubai”? Every time I hear someone say “Dubai”, a rush of memories fill my head. Photos with camels... </p>
								   				</div>
								  			</div>
								  		</div>
									</div>
								</div>
							</article>
							<article>
								<div class="col-sm-6 col-xs-12">
									<div class="container-a">
										<div class="popular-posts article-box">
											<div class="popular-post-img">
												<a href="/charm-character-ikea-furnished-home/" class="popular-preview-mobile">
												<img class="thumb-mobile img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/ikea-logo-building-pp-mob.jpg">
												</a>
												<img class="thumb img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/ikea-logo-building-pp.jpg">
												<a href="/charm-character-ikea-furnished-home/" class="popular-preview">
												</a>
											</div>
											<div class="popular-posts-text">
												<span class="category-tag">
												<a href="/lifestyle/" class="category-tag">Lifestyle</a>
												</span>
												<h2 class="pop-post-title">
												<a href="/charm-character-ikea-furnished-home/" class="pop-post-title">DIY Ikea</a>
												</h2>
												<span class="entry-date"> January 16 2018</span>
											</div>
											<div class="overlay">
											   	<div class="text-a">
											    	<div class="popular-posts-details">
											    		<span class="category-tag-hover">
														<a href="/lifestyle/" class="category-tag-hover">Lifestyle</a>
														</span>
														<h2 class="pop-post-title-hover">
														<a href="/charm-character-ikea-furnished-home/" class="pop-post-title-hover">DIY Ikea</a>
														</h2>
														<span class="entry-date-hover"> January 16 2018</span>
													</div>
											    		<p class="popular-post-preview">Ikea is the furniture Goddess (or God) you go to when you need affordable, Scandinavian style furniture. Or, if you’re anything like me, Ikea is the land of... </p>
								   				</div>
								  			</div>
								  		</div>
									</div>
								</div>
							</article>
						</div>
						<div class="row">
							<article>
								<div class="col-sm-6 col-xs-12">
									<div class="container-a">
										<div class="popular-posts article-box">
											<div class="popular-post-img">
												<a href="/approach-dealing-grief-loss/" class="popular-preview-mobile">
												<img class="thumb-mobile img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/candles-grief-support-pp-mob.jpg">
												</a>
												<img class="thumb img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/grief-loss-candles-pp.jpg" srcset="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/candles-grief-support.jpg" sizes="(min-width: 400px)">
												<a href="/approach-dealing-grief-loss/" class="popular-preview">
												</a>
											</div>
											<div class="popular-posts-text">
												<span class="category-tag">
												<a href="/personal-development/" class="category-tag">Personal Development</a>
												</span>
												<h2 class="pop-post-title">
												<a href="/approach-dealing-grief-loss/" class="pop-post-title">Approaching someone dealing with grief</a>
												</h2>
												<span class="entry-date"> February 12 2018</span>
											</div>
											<div class="overlay">
											   	<div class="text-a">
											    	<div class="popular-posts-details">
											    		<span class="category-tag-hover">
														<a href="/personal-development/" class="category-tag-hover">Personal Development</a>
														</span>
														<h2 class="pop-post-title-hover">
														<a href="/approach-dealing-grief-loss/" class="pop-post-title-hover">Approaching someone dealing with grief</a>
														</h2>
														<span class="entry-date-hover"> February 12 2018</span>
													</div>
											    		<p class="popular-post-preview">A couple months ago, I read an article in Slate Magazine about approaching people dealing with grief and loss.“Finally,” I thought, “someone decided to take... </p>
								   				</div>
								  			</div>
								  		</div>
									</div>
								</div>
							</article>
							<article>
								<div class="col-sm-6 col-xs-12">
									<div class="container-a">
										<div class="popular-posts article-box">
											<div class="popular-post-img">
												<a href="/negativity-and-dealing-with-negative-people/" class="popular-preview-mobile">
												<img class="thumb-mobile img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/birds-negativity-pp-mob.jpg" srcset="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/category-hp/birds-mobile-category.jpg" sizes="(min-width: 400px)">
												</a>
												<img class="thumb img-responsive" id="thumb2" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/birds-ignore-negativity-pp.jpg">
												<a href="/negativity-and-dealing-with-negative-people/" class="popular-preview">
												</a>
											</div>
											<div class="popular-posts-text">
												<span class="category-tag">
												<a href="/personal-development/" class="category-tag">Personal Development</a>
												</span>
												<h2 class="pop-post-title">
												<a href="/approach-dealing-grief-loss/" class="pop-post-title">Negativity and Dealing with "Negative People"</a>
												</h2>
												<span class="entry-date"> December 23 2017</span>
											</div>
											<div class="overlay">
											   	<div class="text-a">
											    	<div class="popular-posts-details">
											    		<span class="category-tag-hover">
														<a href="/personal-development/" class="category-tag-hover">Personal Development</a>
														</span>
														<h2 class="pop-post-title-hover">
														<a href="/negativity-and-dealing-with-negative-people/" class="pop-post-title-hover">Negativity and Dealing with "Negative People"</a>
														</h2>
														<span class="entry-date-hover"> December 23 2017</span>
													</div>
											    		<p class="popular-post-preview">A few months ago I hit rock bottom. I was fighting with my husband on a regular basis, I spent most of my time just sitting and watching tv or playing games... </p>
								   				</div>
								  			</div>
								  		</div>
									</div>
								</div>
							</article>
						</div>
					</div>
				</div>
					<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
						<div class="socialmedia-widget col-sm-12">
							<div class="socialmedia-follow-text">
								<h4 class="heading-center"> Follow Me on Social Media! </h4>
							</div>
							<div class="socialmedia-fa-icons row">
								<div class="col-md-4 col-xs-4">
									<a href="https://twitter.com/meandering_path" target="_blank" class="fa-links"><i class="fab fa-twitter-square fa-2x"></i></a>
								</div>
								<div class="col-md-4 col-xs-4">
									<a href="https://www.instagram.com/meandering.paths" target="_blank" class="fa-links"><i class="fab fa-instagram fa-2x"></i></a>
								</div>
								<div class="col-md-4 col-xs-4">
									<a href="https://www.pinterest.ca/meanderingpaths/pins" target="_blank" class="fa-links"><i class="fab fa-pinterest-square fa-2x"></i></a>
								</div>
							</div>
						</div>
						<div class="category-teaser-hp-box">
							<h4 class="heading-center"> Categories </h4>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6 category-box">
									<div class="cat-image-hp-mob">
										<a href="/lifestyle/"><img class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/online-shopping-discount-category-hp-mob.jpg"></a>
									</div>
									<div class="cat-image-hp">
										<a href="/lifestyle/"><img class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/category-hp/online-shopping-discount-category.jpg"></a>
									</div>
									<a href="/lifestyle/"><span class="category-type"> Lifestyle </span></a>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 category-box">
									<div class="cat-image-hp-mob">
										<a href="/personal-development/"><img class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/birds-original-category-hp-mob.jpg"></a>
									</div>
									<div class="cat-image-hp">
										<a href="/personal-development/"><img class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/birds.jpg"></a>
									</div>
									<a href="/personal-development/"><span class="category-type"> Personal Development </span></a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6 category-box">
									<div class="cat-image-hp-mob">
										<a href="/travel/"><img class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/dubai-101-travel-category-hp-mob.jpg"></a>
									</div>
									<div class="cat-image-hp">
									<a href="/travel/"><img class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/category-hp/dubai-travel-category.jpg"></a>
									</div>
									<a href="/travel/"><span class="category-type"> Travel </span></a>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 category-box">
									<div class="cat-image-hp-mob">
										<a href="/holidays/"><img class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/popular-posts/celebration-christmas-decoration-cat-hp-mob.jpg"></a>
									</div>
									<div class="cat-image-hp">
									<a href="/holidays/"><img class="img-responsive" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/category-hp/holidas-category.jpg"></a>
									</div>
									<a href="/holidays/"><span class="category-type"> Holidays </span></a>
								</div>
							</div>
						</div>
					</div>
				
		</div>
	</section>
<section>
		<div class="container">
			<div class="container-aboutme-hp">
				<div class="row">
					<div class="aboutme-block-container" style="margin-bottom: 30px;">
						<div class="container-aboutme-hp-content">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="box-aboutme-left">
									<div class="aboutme-hp-bg">
									<img class="img-responsive aboutme-img" src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/birds.jpg">
									</div>
								</div>
							</div>
							<div class="col-md-6  col-sm-6 col-xs-12">
								<div class="box-aboutme-right">
									<div class="alt-bg-aboutme">
										<div class="text-aboutme">
											<h2> About Me</h2>
											<p> Hi, I’m Saraswathi! Welcome to Meandering Paths, your one stop for finding content that is relatable and genuine.
											I started Meandering Paths about a year ago, when I was at my lowest point. I was living an unfulfilled life in a country that held me back in many ways and Meandering Paths was my salvation.</p>
											<a class="btn tag" href="/about-me/" role="button">Read More...</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>