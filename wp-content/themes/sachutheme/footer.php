
<?php wp_footer(); ?>
	<!--<section class="social-media">
		<div class="container">
			
			<div class="col-md-6">
				<h3 class="text-center"> My Latest Pins</h3>
					<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
				</div>
		</div>
		<div class="col-md-6">
			<h3 class="text-center"> What I've been upto on Instagram</h3>
					<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6">
						<a class="instafeed"> <img class="instafeed" src="<?php echo get_stylesheet_directory_uri() ?>/images/paths4.jpg">
						</a>
					</div>
				</div>
		</div>
	</div>
	</section><!-->
		<footer class="footer">
			<h3 class="text-center"> What I've been upto on Instagram</h3>
			<div id="footer-sidebar" class="secondary">
<div id="footer-sidebar1">
<?php
if(is_active_sidebar('footer-sidebar-1')){
dynamic_sidebar('footer-sidebar-1');
}
?>
</div>
<div id="footer-sidebar2">
<?php
if(is_active_sidebar('footer-sidebar-2')){
dynamic_sidebar('footer-sidebar-2');
}
?>
</div>
</div>
			<div class="container text-center">
				<p>Copyright© 2016 www.meanderingpaths.com ALL RIGHTS RESERVED</p>
			</div>

		</footer>
	</body>
</html>
