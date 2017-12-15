<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_Account_Manager extends GC_API_Caller{
	
	
	public static function register($name, $email, $password){
		
		$args = array('name'=>$name, 'email'=>$email, 'password'=>$password, 'site'=>home_url());
		$res = self::post_request('users', $args, true);
		
		self::validate_attributes_existence($res);
		
		$account_options = array('token'=>$res->token, 'name'=>$name, 'email'=>$email, 
			'subscription'=>$res->subscription);
		GC_ACCOUNT::save($account_options);
		
		return GC_ACCOUNT::get_info();
		
	}
	
	public static function sign_in($email, $password){
		
		$args = array('email'=>$email, 'password'=>$password, 'site'=>home_url());
		$res = self::get_request('users', $args, true);
		
		self::validate_attributes_existence($res);
		
		$account_options = array('token'=>$res->token, 'email'=>$email, 'subscription'=>$res->subscription);
		GC_ACCOUNT::save($account_options);
		
		return GC_ACCOUNT::get_info();
	}
	
	
	
	public static function refresh_account_status(){
		$account = GC_ACCOUNT::get();
		
		$args = array('email'=>$account['email'], 'token'=>$account['token']);
		
		try{
			$res = self::get_request('subscription', $args, true);
			if(GC_ACCOUNT::update_subscription($res)){
				return $account;
			}
		}catch(Exception $e){}
		
		return new WP_Error('account_refresh_fail', __('Failed to refresh account status', 'grid-canvas-pinterest'));
	}
	
	
	
	public static function get_password_reset_link(){
		return GC_API_URL::build('password_reset');
	}
	
	
	
	public static function get_manage_account_link(){
		$account = GC_ACCOUNT::get();
		
		$args = array('email'=>$account['email'], 'token'=>$account['token']);
		
		try {
			$res = self::get_request('access_token', $args, true);
		} catch (Exception $e) {
			return GC_API_URL::BASE_URL;
		}
				
		if(!empty($res) && !empty($res->token)){
			$args = array('email' => $account['email'], 'token' => $res->token);
			return GC_API_URL::build('manage_account', $args);
		}else{
			return GC_API_URL::BASE_URL;
		}
	}
	
	
	
	protected static function validate_attributes_existence($res){
		if(empty($res->token)){
			self::error(__('Registration error: missing token', 'grid-canvas-pinterest'));
		}
		if(empty($res->subscription)){
			self::error(__('Registration error: missing subscription data', 'grid-canvas-pinterest'));
		}
	}
	
}