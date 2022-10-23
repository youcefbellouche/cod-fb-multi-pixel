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

// Define Constants
define( 'COD_FB_MP_PLUGIN_VERSION', '2.0.2' );
define( 'COD_FB_MP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'COD_FB_MP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'COD_FB_MP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
/**
 * Require Vendor
 */
require_once COD_FB_MP_PLUGIN_DIR . 'vendor/autoload.php';

/**
 * Require Classes
 */
require_once COD_FB_MP_PLUGIN_DIR . 'inc/classes/class-cod-fb-mp-settings.php';
require_once COD_FB_MP_PLUGIN_DIR . 'inc/classes/class-cod-fb-mp-script.php';
require_once COD_FB_MP_PLUGIN_DIR . 'inc/classes/class-cod-fb-conversion-api.php';
require_once COD_FB_MP_PLUGIN_DIR . 'inc/classes/class-cod-fb-conversion-events.php';