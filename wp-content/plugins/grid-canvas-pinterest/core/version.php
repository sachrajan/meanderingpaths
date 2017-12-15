<?php

class GC_Version{
	
	protected static $version;
	const IN_BETA_KEY = 'gc_in_beta';

	public static function get(){
		return self::$version;
	}
	
	/**
	 * Set the version only once.
	 * @param [type] $version [description]
	 */
	public static function set($version){
		if(!isset(self::$version)){
			self::$version = $version;
		}
	}
	
	public static function is_in_beta(){
		$in_beta_option = get_option(self::IN_BETA_KEY, null);
		if($in_beta_option !== null){
			return (bool)$in_beta_option;
		}else{
			return version_compare(self::get(), '1.0.0', '<');
		}
	}
	
	public static function update_in_beta($in_beta){
		update_option(self::IN_BETA_KEY, $in_beta);
	}
	
}