<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_API_URL{

	const BASE_URL = 'https://app.gridcanvas.com';
	protected static $endpoints = array(
		'base' => '',
		'users' => '/api/v1/users',
		'subscription' => '/api/v1/subscription',
		'canvases' => '/api/v1/canvases',
		'password_reset' => '/password_reset',
		'access_token' => '/api/v1/access_token',
		'manage_account' => '/manage_account',
		'status' => '/api/v1/status'
	);
	
	public static function build($endpoint, $args = null){
		$url = self::BASE_URL.self::get_path($endpoint);
		if(is_array($args)){
			$url = add_query_arg($args, $url);
		}
		return $url;
	}
	
	
	protected static function get_path($endpoint){
		if(isset(self::$endpoints[$endpoint])){
			return self::$endpoints[$endpoint];
		}else{
			throw new Exception("Invalid enpoint");
		}
	}
	
}