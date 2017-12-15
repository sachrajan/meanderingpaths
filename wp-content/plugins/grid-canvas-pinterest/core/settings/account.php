<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_Account{
	
	protected static $option_key = 'gc_account';
	
	public static function save($options){
		update_option(self::$option_key, $options);
	}
	
	public static function get(){
		return get_option(self::$option_key);
	}
	
	public static function get_email(){
		return self::get_option('email');
	}
	
	public static function get_token(){
		return self::get_option('token');
	}
	
	public static function is_set(){
		$account = self::get();
		return !empty($account);
	}
	
	public static function update_subscription($subscription){
		$account = self::get();
		if(!empty($account) && !empty($subscription) && 
			isset($subscription->status) && isset($subscription->generations_used)){
			$account['subscription'] = $subscription;
			self::save($account);
			return true;
		}
		return false;
	}
	
	protected static function get_option($key){
		$options = self::get();
		if(isset($options[$key])){
			return $options[$key];
		}
	}
	
	/**
	 * Returns the account status data in a title:value formatted repesentation
	 * @return [type] [description]
	 */
	public static function get_info(){
		$account = self::get();
		
		if($account === false){
			return false;
		}
		
		//do not pass the token
		unset($account['token']);
		
		$subscription_info = new GC_Subscription_Info($account['subscription']);
		$info = $subscription_info->generate();
		
		$info[]=array('label' => __('Account Email', 'grid-canvas-pinterest'), 'value' => $account['email']);
		
		$account['info'] = $info;
		
		return $account;
	}
	
}