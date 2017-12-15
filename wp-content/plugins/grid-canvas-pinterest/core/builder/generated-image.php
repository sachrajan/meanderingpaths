<?php

class GC_Generated_Image{

	public $id = null;
	public $data = null;
	public static $meta_key = 'gc_image';
	
	public function __construct($id, $data){
		$this->id = $id;
		$this->data = $data;
	}
	
	public function save($post_id){
		add_post_meta($post_id, self::$meta_key, $this);
	}
	
	public function get_share_options($post_id){
		$permalink = get_permalink($post_id);
		
		return array(
			'url'=> wp_get_attachment_url( $this->id ),
			'share_link' => $permalink);
	}
	
	
	# STATIC CLASS METHODS
	
	public static function get_all($post_id){
		$meta = get_post_meta($post_id, self::$meta_key);
		return empty($meta) ? array() : $meta;
	}
	
	public static function get_all_with_share_options($post_id){
		$images = self::get_all($post_id);
		$images_info = array();
		
		foreach ($images as $image) {
			$image_options = $image->get_share_options($post_id);
			
			//add the image only if it exists
			if($image_options['url']){
				$images_info []= $image_options;
			}
		}
		
		return $images_info;
	}
	
	
	
}