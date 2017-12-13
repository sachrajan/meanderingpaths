<?php
function arphabet_widgets_init() {
	register_sidebar( array(
		'name' => 'Instagram Feed',
	    'before_widget' => '<div class = "widgetizedArea">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3>',
	    'after_title' => '</h3>',
	) );
}
	register_sidebar( array(
		'name' => 'Footer Sidebar 1',
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer Sidebar 2',
		'id' => 'footer-sidebar-2',
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

?>

