<?php
//function arphabet_widgets_init() {
	//register_sidebar( array(
		//'name' => 'Instagram Feed',
	   // 'before_widget' => '<div class = "widgetizedArea">',
	    //'after_widget' => '</div>',
	    //'before_title' => '<h3>',
	    //'after_title' => '</h3>',
	//) );
//}
	register_sidebar( array(
		'name' => 'Footer Sidebar 1',
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


add_action( 'widgets_init', 'arphabet_widgets_init' );
if ( function_exists ('register_sidebar')) { 
    register_sidebar ('custom'); 
}

register_sidebar( array(
		'name' => 'Sidebar 1',
		'id' => 'sidebar-1',
		'description' => 'Appears in the sidebar area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

register_sidebar( array(
		'name' => 'Social Media Share',
		'id' => 'sharebar',
		'description' => 'Appears below a post',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 50, 50);

?>
