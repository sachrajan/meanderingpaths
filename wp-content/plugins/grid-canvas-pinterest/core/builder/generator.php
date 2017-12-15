<?php

class GC_Generator extends GC_API_Caller{
	
	protected $meta_key = 'gc_image';
	
	public function __construct($post_id){
		$this->post_id = $post_id;
		$this->includes();
	}
	
	protected function includes(){
		GC_Helper::include_file('core/builder/', 'area.php');
	}
	
	public function call($data){
		$result = null;
		try {
		    $result = $this->generate_image($data);
		} catch (Exception $e) {
			$result = new WP_Error('generation_failed', $e->getMessage());
		}
		GC_Account_Manager::refresh_account_status();
		return $result;
	}
	
	protected function generate_image($data){
		if(!isset($data['size'])){
			throw new Exception(__('Error: Missing size options', 'grid-canvas-pinterest'));
		}
		if(!isset($data['areas'])){
			throw new Exception(__('Error: Missing areas options', 'grid-canvas-pinterest'));
		}
		
		$canvas_size = $data['size'];
		$areas = array();
		foreach ($data['areas'] as $area_options) {
			$area = new GC_Area($area_options);
			$areas[]= $area->export_for($canvas_size);
		}
		
		$args = array(
			'size'=> $canvas_size,
			'areas' => $areas,
			'email' => GC_Account::get_email(),
			'site' => home_url(),
			'token' => GC_Account::get_token()
		);
		
		$img_data = $this->request_to_generate($args);
		$image_id = $this->save_image($img_data);
		
		$image = $this->save_image_data($image_id, $data);
		return $image->get_share_options($this->post_id);
	}
	
	protected function request_to_generate($args){
		$url = GC_API_URL::build('canvases');
		$res = wp_remote_post( $url, array('body'=>$args, 'timeout'=>30));
			
		self::verify_response($res);
		return wp_remote_retrieve_body( $res, array('stream'=>true) );
	}
	
	protected function save_image($bits){
		$res = wp_upload_bits( "grid-canvas-$this->post_id.jpg", null, $bits);
		if(!empty($res['error'])){
			throw new Exception(__('Error saving the image file', 'grid-canvas-pinterest'));
		}
		
		$image_id = $this->create_attachment($res['file']);
		if($image_id === 0){
			throw new Exception(__('Error creating an attachment', 'grid-canvas-pinterest'));
		}
		
		return $image_id;
	}
	
	protected function create_attachment($filename){

		$filetype = wp_check_filetype( basename( $filename ), null );
		$wp_upload_dir = wp_upload_dir();
		// Prepare an array of post data for the attachment.
		$attachment = array(
			'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);

		// Insert the attachment.
		$image_id = wp_insert_attachment( $attachment, $filename );

		// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
		require_once( ABSPATH . 'wp-admin/includes/image.php' );

		// Generate the metadata for the attachment, and update the database record.
		$attach_data = wp_generate_attachment_metadata( $image_id, $filename );
		wp_update_attachment_metadata( $image_id, $attach_data );
		
		return $image_id;
	}
	
	protected function save_image_data($image_id, $data){
		$image = new GC_Generated_Image($image_id, $data);
		$image->save($this->post_id);
		return $image;
	}
	
	
}