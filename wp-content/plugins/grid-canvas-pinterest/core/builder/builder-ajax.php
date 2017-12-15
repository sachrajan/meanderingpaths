<?php

class GC_Builder_AJAX extends GC_Ajax{
	
	protected static $nonce_key = 'gc_buider_nonce';
	
	public function add_actions(){
		add_action('wp_ajax_gc_get_post_images', array($this, 'get_post_images'));
		add_action('wp_ajax_gc_generate_image', array($this, 'generate_image'));
		add_action('wp_ajax_gc_get_image_data', array($this, 'get_image_data'));
	}
	
	public function get_post_images(){
		$this->validate_request();
		
		$post_id = $this->get_request_int('post_id');
		if(!$post_id){
			$this->return_error(__('Missing or invalid post ID', 'grid-canvas-pinterest'));
		}
		
		$res = GC_Image_Helper::get_post_images($post_id);
		$this->return_success($res);
	}
	
	public function generate_image(){
		$this->validate_request();
		
		$post_id = $this->get_request_int('post_id');
		$data = $this->get_request_val('data');
		
		if(!$post_id){
			$this->return_error( __('Missing or invalid post ID', 'grid-canvas-pinterest') );
		}
		
		if(empty($data)){
			$this->return_error( __('Missing image data', 'grid-canvas-pinterest') );
		}
		
		$generator = new GC_Generator($post_id);
		$res = $generator->call($data);
		
		if(is_wp_error($res)){
			$this->return_error($res->get_error_message());
		}else{
			$this->return_success($res);
		}
		
	}
	
	public function get_image_data(){
		$this->validate_request();
		
		$image_ids = $this->get_request_array_of_integers('image_ids');
		
		$res = GC_Image_Helper::get_images_data($image_ids);
		$this->return_success($res);
	}
}