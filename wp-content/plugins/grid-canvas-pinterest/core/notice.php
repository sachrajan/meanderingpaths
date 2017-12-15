<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_Notice{
	
	public $kind = 'info';
	public $content = null;
	public $min_version = null;
	public $max_version = null;
	public $id = 0;
	const DISMISSED_KEY = 'gc-notice-dismissed-';
	
	
	public function __construct($data){
		if(isset($data->kind)){ $this->kind = $data->kind; }
		if(isset($data->content)){ $this->content = $data->content; }
		if(isset($data->id)){ $this->id = $data->id; }
		if(isset($data->min_version)){ $this->min_version = $data->min_version; }
		if(isset($data->max_version)){ $this->max_version = $data->max_version; }
		
		if(!empty($this->content)){
			$this->init();
		}
	}
	
	
	protected function init(){
		if($this->should_display()){
			add_action( 'admin_notices', array($this, 'print_notice') );
			add_action( 'admin_enqueue_scripts', array($this, 'enqueue_scripts') );
		}
	}
	
	protected function should_display(){
		$dismissed = get_option(self::dismissed_key($this->id));
		if($dismissed){
			return false;
		}
		
		if(isset($this->min_version) && version_compare(GC_Version::get(), $this->min_version, '<')){
			return false;
		}
		if(isset($this->max_version) && version_compare(GC_Version::get(), $this->max_version, '>')){
			return false;
		}
		return true;
	}
	
	public function print_notice(){
		
		$content = wp_kses_data($this->content);
		
		//replace the occurrence of the settings page with a link to that page
		$replace_text = 'Grid Canvas Settings Page';
		$link = sprintf('<a href="%s">%s</a>', GC_Settings_Page::get_url(), $replace_text);
		$content = str_ireplace($replace_text, $link, $content);
		
		echo sprintf('<div class="notice is-dismissible gc-notice %s" data-notice_id="%s"><p>%s</p></div>',
			$this->get_notice_class(), $this->id, $content);
	}
	
	protected function get_notice_class(){
		$types = array(
			'success' => 'notice-success',
			'info' => 'notice-warning',
			'alert' => 'notice-error' 
		);
		return isset($types[$this->kind]) ? $types[$this->kind] : 'notice-info';
	}
	
	/**
	 * Enqueue the script to mark the notices as dismissed.
	 */
	public function enqueue_scripts(){
		wp_enqueue_script( 'gc-notices', plugins_url( '/js/notices.js', GC_PLUGIN_FILE ), 
			array( 'jquery' ), GC_Version::get() , true );
	}
	
	
	// STATIC CLASS METHDOS

	/**
	 * Create helper method that creates an instance. Use this static method for
	 * better code readability.
	 */
	public static function create($data){
		return new GC_Notice($data);
	}
	
	public static function mark_as_dismissed(){
		if(isset($_GET['notice_id'])){
			update_option(self::dismissed_key($_GET['notice_id']), true);
		}
		exit;
	}
	
	protected static function dismissed_key($id){
		return self::DISMISSED_KEY.$id;
	}
	
}

add_action( 'wp_ajax_gc_mark_notice_as_dismissed', array('GC_Notice', 'mark_as_dismissed') );
