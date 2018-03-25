<?php 
	get_header(); 
	$firstPost = get_post(get_the_ID())->post_content;
?>
<div class="container">
	<h3 class="sideheadings">Category: <?php single_cat_title(); ?></h3>
<?php
$tagSlug = single_cat_title("", false);
$the_query = new WP_Query( 'category='.$tagSlug );

if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
    	?>
    		<?php $the_query->the_post(); ?>
				<div class="col-lg-8 col-md-8 col-sm-8">
				 	<div class="row page-posts">
				   		<div class="img-responsive preview-image col-lg-6 col-md-6 col-sm-6 col-xs-12">
			             <img src="https://s3.us-east-2.amazonaws.com/meanderingpaths/images/angry-cat-negativity-negative-people-positivity1.jpg" class="blog-post-image img-responsive" alt="negativity-dealing-with-negative-people-angry-cat">
			           </div>
			             <div class="all-post-title"><?php echo get_the_title(); ?></div>
				   		<p class="category-post-preview">A few months ago I hit rock bottom. I was fighting with my husband on a regular basis, I spent most of my time just sitting and watching tv or playing games, and I didn’t care to clean my apartment or eat well. The cause...
			            <a class="btn link" href="/negativity-and-dealing-with-negative-people/" role="button">Continue Reading...</a></p>
				   </div>
				</div>
        <?php
    }
} else {
    // no posts found
}
?>
	<div class="col-md-4 col-sm-4">
		<?php get_sidebar ('custom'); ?>
		<?php
			//dynamic_sidebar('sidebar-1');
		?>
	</div>
</div>
<?php get_footer(); ?>