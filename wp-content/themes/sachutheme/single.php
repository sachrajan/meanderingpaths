<?php get_header(); ?>
	<section>
		<div class="container content-section">
			<h3 class="blog-post-title"> Main post title</h3>
			<div class="col-md-8 col-sm-8 post-section">
				<?php echo get_post(get_the_ID())->post_content; ?>
				<br> 
				<?php comments_template(); ?>
				<div class="signup-container">
					<h4 class="signup">Join my mailing list!</h4>
						<div class="col-md-6 col-sm-6">
						<img class="img-responsive" src="<?php echo get_stylesheet_directory_uri() ?>/1.jpg">
							<p class="signup"> Receive updates and news from Meandering Paths in your inbox today! I promise you, I won't spam you!</p>
						</div>
					 	<div class="form-group row" align="center"> 
							<div class="col-md-6 col-sm-6 col-xs-12 email-signup">
						    	 <form action="/action_page.php">
						        <input class="form-control signup" placeholder="Enter your email address here" id="ex5" type="text">
						        <input type="submit" class="signup-now" value="Sign up now!">
								</form>
							</div>
						</div>
						<div class="signup-bottom">
						</div> 
				</div>
			</div>
				<div class="col-md-4 col-sm-4 post-section">
					<?php get_sidebar(); ?>
				</div>

		</div>
	</section>
<?php get_footer(); ?>