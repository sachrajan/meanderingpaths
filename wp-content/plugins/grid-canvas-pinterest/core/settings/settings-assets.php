<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_Settings_Assets{
	
	protected $version;
	protected $base_file;
	protected $page_slug;
	
	
	public function __construct(){
		$this->base_file = GC_PLUGIN_FILE;
		$this->version = GC_Version::get();
		$this->page_slug = GC_Settings_Page::$slug;
	}
	
	public function init(){
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_assets') );
		add_action( 'admin_print_scripts', array($this, 'init_js') );
	}
	
	protected function is_settings_page(){
		global $current_screen;
		return strpos( $current_screen->base, $this->page_slug ) !== false;
	}
	
	public function enqueue_assets(){
		
		if ( $this->is_settings_page() ) {
			$this->enqueue_scripts();
			$this->enqueue_styles();
		}
		
	}
	
	protected function enqueue_scripts(){
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('underscore');
		wp_enqueue_script('backbone');
		
		
		wp_enqueue_script('gc_settings', 
			plugins_url('js/grid-canvas-settings.js', $this->base_file), 
			array('jquery', 'underscore', 'backbone'), 
			$this->version);
		
	}
	
	protected function enqueue_styles(){
			
		wp_enqueue_style( 'gc_settings_css', 
			plugins_url('css/settings.css', $this->base_file ), 
			array(), 
			$this->version );
			
	}
	
	public function init_js(){
		if ( $this->is_settings_page() ) {
			global $post;
			
			
			$options = array(
				'account' => GC_Account::get_info(),
				'nonce' => GC_Settings_Ajax::generate_nonce(),
				'password_reset_link' => GC_Account_Manager::get_password_reset_link(),
				'show_manage_account_button' => !GC_Version::is_in_beta(), //show the button if it is not in beta
				'manage_account_link_fallback' => GC_API_URL::BASE_URL
			);

			$strings = array(
				'register' => __('Create an account', 'grid-canvas-pinterest'),
				'register_subtitle' => __('Use Grid Canvas for free while in Beta', 'grid-canvas-pinterest'),
				'register_success' => __('Registration successful!<br/>You can now generate your grid images from the edit screen of any post or page.', 'grid-canvas-pinterest'),
				'not_have_account' => __("Don't have a Grid Canvas account yet? ", 'grid-canvas-pinterest'),
				'sign_in' => __('Sign in', 'grid-canvas-pinterest'),
				'sign_in_subtitle' => __('Sign in with an existing account', 'grid-canvas-pinterest'),
				'sign_in_success' => __('Sign in successful', 'grid-canvas-pinterest'),
				'have_account' => __('Already have a Grid Canvas account? ', 'grid-canvas-pinterest'),
				'your_account' => __('Your Grid Canvas Account', 'grid-canvas-pinterest'),
				'name' => __('Full Name', 'grid-canvas-pinterest'),
				'email' => __('E-mail', 'grid-canvas-pinterest'),
				'password' => __('Password', 'grid-canvas-pinterest'),
				'invalid_form' => __('Please complete all fields correctly', 'grid-canvas-pinterest'),
				'start_trial' => __('Start your free trial', 'grid-canvas-pinterest'),
				'ajaxError' => __('Error making an AJAX request', 'grid-canvas-pinterest'),
				'use_another_account' => __('Sign in with a different account', 'grid-canvas-pinterest'),
				'forgot_password' => __('Forgot your password?', 'grid-canvas-pinterest'),
				'refresh' => __('Refresh', 'grid-canvas-pinterest'),
				'manage_account' => __('Manage your subscription', 'grid-canvas-pinterest')
			);

			$options = apply_filters('gc_js_options', $options);
			?>
			<script type="text/javascript">
				window.GC_SETTINGS || (window.GC_SETTINGS = {});
				GC_SETTINGS.options = <?php echo json_encode($options); ?>;
				GC_SETTINGS.strings = <?php echo json_encode($strings); ?>;
			</script>
			<?php
		}

	}
	
}