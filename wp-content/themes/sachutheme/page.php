<?php get_header(); ?>
	<div class="container content-section">
		<?php echo get_post(get_the_ID())->post_content; ?>
		<div class="col-md-4 col-sm-4">
					<?php get_sidebar(); ?>
				</div>
	</div>
<?php get_footer(); ?>