<?php

class GC_Settings_AJAX extends GC_Ajax{
	
	protected static $nonce_key = 'gc_settings_nonce';
	
	public function __construct($user_capability){
		$this->user_capability = $user_capability;
	}
	
	public function add_actions(){
		add_action('wp_ajax_gc_register', array($this, 'register'));
		add_action('wp_ajax_gc_signin', array($this, 'sign_in'));
		add_action('wp_ajax_gc_refresh_account', array($this, 'refresh_account'));
		add_action('wp_ajax_gc_get_manage_account_link', array($this, 'get_manage_account_link'));
	}
	
	public function register(){
		$this->validate_request(true);
		
		$name = $this->get_request_required_param('name');
		$email = $this->get_request_required_param('email');
		$password = $this->get_request_required_param('password');
		
		try {
		    $account_options = GC_Account_Manager::register($name, $email, $password);
			$this->return_success($account_options);
		} catch (Exception $e) {
			$this->return_error( $e->getMessage() );
		}
	}
	
	public function sign_in(){
		$this->validate_request(true);
		
		$email = $this->get_request_required_param('email');
		$password = $this->get_request_required_param('password');
		
		try {
		    $account_options = GC_Account_Manager::sign_in($email, $password);
			$this->return_success($account_options);
		} catch (Exception $e) {
			$this->return_error( $e->getMessage() );
		}
	}
	
	public function refresh_account(){
		$this->validate_request(true);
		
		$result = GC_Account_Manager::refresh_account_status();
		if(is_wp_error($result)){
			$this->return_error($result->get_error_message());
		}else{
			$this->return_success(GC_Account::get_info());
		}
	}
	
	public function get_manage_account_link(){
		$this->validate_request(true);
		
		$link = GC_Account_Manager::get_manage_account_link();
		$this->return_success(array('link' => $link));
	}

}