<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_Helper{
	
	public static function include_file($path, $file_name){
		include_once GC_PLUGIN_PATH.$path.$file_name;
	}
	
	public static function include_files($path, $file_names){
		foreach ($file_names as $file_name ) {
			self::include_file($path, $file_name);
		}
	}
	
	public static function set_headers($headers){
		return $headers.' | Grid Canvas WP';
	}
}

add_filter('http_headers_useragent', array('GC_Helper', 'set_headers'), 10000);