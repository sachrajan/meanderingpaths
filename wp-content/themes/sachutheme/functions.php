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
add_action( 'widgets_init', 'arphabet_widgets_init' );
?>