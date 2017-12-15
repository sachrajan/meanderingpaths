<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_API_Caller{
	
	protected static function get_request($endpoint, $data, $check_for_errors = true){
		$url = GC_API_URL::build($endpoint, $data);
		
		$response = wp_remote_get( $url, array('timeout'=>20));
				
		if($check_for_errors){
			self::verify_response($response);
		}
		
		return json_decode(wp_remote_retrieve_body($response));
	}
	
	protected static function post_request($endpoint, $data, $check_for_errors = true){
		$url = GC_API_URL::build($endpoint);
		$response = wp_remote_post( $url, array('body'=>$data, 'timeout'=>20));
		
		if($check_for_errors){
			self::verify_response($response);
		}		
		
		return json_decode(wp_remote_retrieve_body($response));
	}
	
	protected static function verify_response($res){
		if(is_wp_error($res)){
			self::error(__('Error making API request: ', 'grid-canvas-pinterest').$res->get_error_message());
		}
		if(wp_remote_retrieve_response_code($res)>=400){
			$error = self::get_body_error_message($res);
			if(empty($error)){
				$error = __('Error making API request: ', 'grid-canvas-pinterest'). $res['response']['code'].' '.$res['response']['message'];
			}
			self::error($error);
		}
	}
	
	protected static function get_body_error_message($res){
		$body = json_decode(wp_remote_retrieve_body($res));
		if(!empty($body)){
			if(!empty($body->errors) && is_array($body->errors)){
				return __('Error: ', 'grid-canvas-pinterest').self::replace_settings_text_with_link( implode(', ', $body->errors) );
			}
			if(!empty($body->error)){
				return __('Error: ', 'grid-canvas-pinterest').self::replace_settings_text_with_link( $body->error );
			}
		}
		return null;
	}
	
	protected static function replace_settings_text_with_link($text){
		$replace_text = 'Grid Canvas Settings Page';
		$link = sprintf('<a href="%s" target="_blank">%s</a>', GC_Settings_Page::get_url(), $replace_text);
		return str_ireplace($replace_text, $link, $text);
	}
	
	protected static function error($message){
		throw new Exception($message);
	}
}