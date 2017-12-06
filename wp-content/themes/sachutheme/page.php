<?php get_header(); ?>
	<div class="container content-section">
		<?php echo get_post(get_the_ID())->post_content; ?>
	</div>
<?php get_footer(); ?>