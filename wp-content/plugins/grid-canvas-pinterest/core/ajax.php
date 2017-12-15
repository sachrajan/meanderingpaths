<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_Ajax{

	protected static $nonce_key = 'gc_ajax_nonce';
	protected $capability = '';

	public function get_nonce(){
		return $_REQUEST['nonce'];
	}
	
	public static function generate_nonce(){
		return wp_create_nonce(self::$nonce_key);
	}

	public function validate_request($with_capability = false){
		if($with_capability === true && !current_user_can($this->user_capability)){
			$this->return_error( __('You are not authorized to do this', 'grid-canvas-pinterest'));
		}
		
		if(!wp_verify_nonce( $this->get_nonce(), self::$nonce_key )){
			$this->return_error( __('Nonce did not verify', 'grid-canvas-pinterest'));
		}
	}
	
	protected function get_request_required_param($key){
		if(isset($_REQUEST[$key]) && !empty($_REQUEST[$key])){
			return $_REQUEST[$key];
		}else{
			$this->return_error( sprintf ( __('Error: Missing required field "%s"', 'grid-canvas-pinterest'), $key));
		}
	}

	protected function get_request_int($key){
		if (isset($_REQUEST[$key])) {
			return intval($_REQUEST[$key]);
		}
		return 0;
	}
	
	protected function get_request_val($key){
		if (isset($_REQUEST[$key])) {
			return $_REQUEST[$key];
		}
		return null;
	}
	
	protected function return_error($message = ''){
		status_header(400);
		wp_send_json(array('error' => $message));
	}
	
	protected function return_success($data = array()){
		$res = empty($data) ? array('success' => true) : $data;
		wp_send_json($res);
	}
	
	protected function get_request_array_of_integers($key){
		if (isset($_REQUEST[$key])) {
			$arr = $_REQUEST[$key];
			$new_arr = array();
			foreach ($arr as $key => $value) {
				$new_arr[$key] = intval($value);
			}
			
			return $new_arr;
		}
		return null;
	}


}