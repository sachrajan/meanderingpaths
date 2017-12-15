<?php
/**
 * Plugin Name: Grid Canvas - Pinterest Image Creator
 * Plugin URI: http://gridcanvas.com/
 * Description: Pinterest and social media grid image creation tool
 * Version: 0.1.2
 * Author: Grid Canvas
 * Text Domain: grid-canvas-pinterest
 * Domain Path: /lang
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Grid Canvas is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 */


 if(!defined( 'ABSPATH' )){
 	exit;
 }

 global $grid_canvas;
 $grid_canvas = new StdClass();

 if(! class_exists('Grid_Canvas')){

 	/**
 	 * Includes all of the initalization functionality of the Users Insights plugin.
 	 */
 	class Grid_Canvas{

 		public $title;
 		protected static $instance;

 		protected function __construct(){}

 		/**
 		 * Returns the instance of the class, it is a singleton class.
 		 */
 		public static function get_instance(){
 			if(! self::$instance ){
 				self::$instance = new Grid_Canvas();
 				self::$instance->init();
 			}
 			return self::$instance;
 		}
		
		/**
		 * Initialize all the main plugin functionality.
		 */
		public function init(){
			$this->config();
			$this->include_files();
			GC_Version::set('0.1.2');
			
			if(is_admin()){
				add_action('current_screen', array($this, 'show_settings_notice'));
				
				$meta = new GC_Builder_Meta($this->title);
				$meta->init();
				
				$assets = new GC_Builder_Assets();
				$assets->init();
				
				$ajax = new GC_Builder_AJAX();
				$ajax->add_actions();
				
				$settings_page = new GC_Settings_Page($this->title);
				$settings_page->init();
				
				add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this, 'add_settings_page_link') );
			}
		}
		
		/**
		 * Config some of the options as constants.
		 */
		public function config(){

			$this->title = __('Grid Canvas', 'grid-canvas-pinterest');

			//set constants
			if ( ! defined( 'GC_PLUGIN_FILE' ) ) {
				define( 'GC_PLUGIN_FILE', __FILE__);
			}
			if ( ! defined( 'GC_PLUGIN_PATH' ) ) {
				define( 'GC_PLUGIN_PATH', plugin_dir_path(__FILE__));
			}
		}
		
		/**
		 * Adds a "Settings" link to the plugin listing
		 */
		public function add_settings_page_link($links){
			$links[]= sprintf('<a href="%s">%s</a>',
				GC_Settings_Page::get_url(), __('Settings', 'grid-canvas-pinterest'));
			return $links;
		}
		
		/**
		 * Include all the required files.
		 */
		public function include_files(){
			
			include_once('core/helpers/helper.php');
			
			if(is_admin()){
				GC_Helper::include_files('core/', array('ajax.php', 'api-caller.php', 'notice.php', 'status.php'));
				GC_Helper::include_files('core/helpers/', array('image-helper.php', 'api-url.php'));
				GC_Helper::include_files('core/builder/', array('builder-meta.php', 'builder-assets.php', 'builder-ajax.php', 'generator.php'));
				GC_Helper::include_files('core/settings/', array('settings-ajax.php','settings-assets.php', 'settings-page.php', 'subscription-info.php', 'account.php', 'account-manager.php'));
			}
			
			GC_Helper::include_file('core/builder/', 'generated-image.php');
			GC_Helper::include_file('core/', 'version.php');
			
			
		}
		
		public function show_settings_notice(){
			if(!GC_Settings_Page::is_settings_page() && !GC_Account::is_set()){
				$data = new StdClass();
				$data->kind = 'info';
				$data->content = __('Almost there! Please visit the Grid Canvas Settings Page to get started.', 'grid-canvas-pinterest');
				$data->id = 'settings_notice';
				
				new GC_Notice($data);
			}
			
		}
		
	}
}

$grid_canvas->manager = Grid_Canvas::get_instance();
