<?php
/**
 * Plugin Name:       Facebook Multi pixel COD
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           2.0.0
 * Author:            Youcef Bellouche
 * Author URI:        https://www.facebook.com/bellou.fecuoy2000/
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}
require_once 'vendor/autoload.php';
// Define Constants
define( 'COD_FB_MP_PLUGIN_VERSION', '2.0.0' );
define( 'COD_FB_MP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'COD_FB_MP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'COD_FB_MP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );


require_once COD_FB_MP_PLUGIN_DIR . 'inc/classes/class-cod-fb-mp-settings.php';
require_once COD_FB_MP_PLUGIN_DIR . 'inc/classes/class-cod-fb-mp-script.php';
require_once COD_FB_MP_PLUGIN_DIR . 'inc/classes/class-cod-fb-conversion-events.php';
