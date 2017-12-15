<?php

if(!defined( 'ABSPATH' )){
   exit;
}

/**
 * Includes the main initialization functionality for the Module Options page.
 */
class GC_Settings_Page{
	
	public static $slug = 'grid-canvas-settings';
	protected $capability = 'administrator';
	protected $assets;
	protected $ajax;

	public $title;

	public function __construct($title){
		$this->title =$title;
	}

	/**
	 * Main initialization functionality, registers the required action hooks.
	 */
	public function init(){
		add_action ( 'admin_menu', array($this, 'add_menu_page'), 20 );
		add_action ( 'current_screen', array($this, 'set_notice') );

		$this->assets = new GC_Settings_Assets();
		$this->assets->init();

		$this->ajax = new GC_Settings_Ajax($this->capability);
		$this->ajax->add_actions();
		
	}

	/**
	 * Adds the page as a menu item.
	 */
	public function add_menu_page(){
		add_options_page( $this->title, $this->title, $this->capability, self::$slug, array($this, 'print_page_markup'));
	}


	/**
	 * Prints the main page markup.
	 */
	public function print_page_markup(){
		?>
		<div class="gc-settings-box">
			<div class="gc-header-logo"></div>
			<div id="gc-settings-wrapper"></div>
		</div>
		
		<?php
	}
	
	public static function get_url(){
		return get_admin_url(null, 'options-general.php?page='.self::$slug);
	}

	public static function is_settings_page(){
		$cur_screen = get_current_screen();
		return $cur_screen->base == 'settings_page_'.self::$slug;
	}
	
	public function set_notice(){
		if(self::is_settings_page() && !GC_Account::is_set()){
			$data = new StdClass();
			$data->kind = 'success';
			$data->content = __('Create an account to use the Grid Canvas image generation service. It takes only a few seconds!', 'grid-canvas-pinterest');
			$data->id = 'create_account_notice';
			
			new GC_Notice($data);
		}
	}

}