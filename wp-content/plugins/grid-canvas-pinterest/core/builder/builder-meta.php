<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_Builder_Meta{
	
	protected $title;
	
	public function __construct($title){
		$this->title = $title;
	}
	
	public function init(){
		add_action( 'add_meta_boxes', array($this, 'add_meta_box'), 10, 2 );
	}
	
	public function add_meta_box($post_type, $post){
		$post_types = get_post_types(array('public'=>true));
		
		add_meta_box( 
	        'gc-builder',
	        '<span class="gc-meta-logo"></span>'.$this->title,
	        array($this, 'render_meta_box'),
	        array_values($post_types),
	        'normal',
	        'high'
	    );
	}
	
	public function render_meta_box(){
		
		if(!GC_Account::is_set()){
			?>
			<p>
			<?php echo sprintf( __('Almost there! <a href="%s">Set up your Grid Canvas account</a> to get started.'),
				GC_Settings_Page::get_url());  ?>
			</p>
			<?php 
		}else{
			//the account is active
		?>
			<div id="gc-wrapper"></div>
		<?php
		}
	}
	
}