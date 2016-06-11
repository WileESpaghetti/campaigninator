<?php
/*
Plugin Name: Campaigninator
Plugin URI:  http://www.developforfun.com
Description: Create Google Analytics campaign URLs on pages and posts
Version:     0.0.0
Author:      Lehman Black
Author URI:  http://www.lehmanblack.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: campaigninator
*/

defined( 'ABSPATH' ) or die( 'WordPress must be running to use plugin' );

define('CAMPAIGNINATOR_PATH',    plugin_dir_path(__FILE__));
define('CAMPAIGNINATOR_URL',     plugin_dir_url(__FILE__));

register_activation_hook(   __FILE__, 'campaigninator_on_activate' );
register_deactivation_hook( __FILE__, 'campaigninator_on_deactivate' );
register_uninstall_hook(    __FILE__, 'campaigninator_on_uninstall' );

function campaigninator_on_activate() {
    // FIXME stub
}

function campaigninator_on_deactivate() {
    // FIXME stub
}

function campaigninator_on_uninstall() {
    // FIXME stub
}
