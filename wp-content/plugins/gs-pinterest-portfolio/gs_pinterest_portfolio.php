<?php 
/**
 *
 * @package   GS_Pinterest_Portfolio
 * @author    Golam Samdani <samdani1997@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.gsamdani.com
 * @copyright 2016 Golam Samdani
 *
 * @wordpress-plugin
 * Plugin Name:			GS Pinterest Portfolio Lite
 * Plugin URI:			http://www.gsamdani.com/wordpress-plugins
 * Description:       	Best Responsive Pinterest plugin for Wordpress to showcase Pinterest Pins. Display anywhere at your site using shortcode like [gs_pinterest] & widgets. Check more shortcode examples and documentation at <a href="http://www.pinterest.gsamdani.com">GS Pinterest Porfolio PRO Demos & Docs</a>
 * Version:           	1.0.0
 * Author:       		Golam Samdani
 * Author URI:       	http://www.gsamdani.com
 * Text Domain:       	gs-pinterest
 * License:           	GPL-2.0+
 * License URI:       	http://www.gnu.org/licenses/gpl-2.0.txt
*/

if( ! defined( 'GSBEH_HACK_MSG' ) ) define( 'GSBEH_HACK_MSG', __( 'Sorry cowboy! This is not your place', 'gs-pinterest' ) );

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSBEH_HACK_MSG );

/**
 * Defining constants
 */
if( ! defined( 'GSPIN_VERSION' ) ) define( 'GSPIN_VERSION', '1.0.0' );
if( ! defined( 'GSPIN_MENU_POSITION' ) ) define( 'GSPIN_MENU_POSITION', 31 );
if( ! defined( 'GSPIN_PLUGIN_DIR' ) ) define( 'GSPIN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if( ! defined( 'GSPIN_FILES_DIR' ) ) define( 'GSPIN_FILES_DIR', GSPIN_PLUGIN_DIR . 'gs-pinterest-assets' );
if( ! defined( 'GSPIN_PLUGIN_URI' ) ) define( 'GSPIN_PLUGIN_URI', plugins_url( '', __FILE__ ) );
if( ! defined( 'GSPIN_FILES_URI' ) ) define( 'GSPIN_FILES_URI', GSPIN_PLUGIN_URI . '/gs-pinterest-assets' );

require_once GSPIN_FILES_DIR . '/gs-plugins/gs-plugins.php';
require_once GSPIN_FILES_DIR . '/includes/gs-pinterest-shortcode.php';
require_once GSPIN_FILES_DIR . '/includes/gs-pin-function.php';
require_once GSPIN_FILES_DIR . '/includes/gs-single-pin-widgets.php';
require_once GSPIN_FILES_DIR . '/includes/gs-follow-pin-widgets.php';
require_once GSPIN_FILES_DIR . '/includes/gs-pin-boards-widget.php';
require_once GSPIN_FILES_DIR . '/includes/gs-pin-profile-widget.php';
require_once GSPIN_FILES_DIR . '/admin/class.settings-api.php';
require_once GSPIN_FILES_DIR . '/admin/gs_pinterest_options_config.php';
require_once GSPIN_FILES_DIR . '/gs-pinterest-scripts.php';

if ( ! function_exists('gs_pinterest_pro_link') ) {
	function gs_pinterest_pro_link( $gsPin_links ) {
		$gsPin_links[] = '<a class="gs-pro-link" href="https://www.gsamdani.com/product/gs-pinterest-portfolio" target="_blank">Go Pro!</a>';
		$gsPin_links[] = '<a href="https://www.gsamdani.com/wordpress-plugins" target="_blank">GS Plugins</a>';
		return $gsPin_links;
	}
	add_filter( 'plugin_action_links_' .plugin_basename(__FILE__), 'gs_pinterest_pro_link' );
}