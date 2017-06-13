<?php
/*
Plugin Name: Vimeo Shortcode
Description: Vimeo Shortcode
Author: Denis Nichik
Version: 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directl

define("VM_SHC_PLUGIN_ID", "vm_shortcode");
define("VM_SHC_PLUGIN_NAME", "Vimeo shortcode");

$vm_shc_dir_path = dirname( __FILE__ );

require_once $vm_shc_dir_path . '/inc/functions.php';
require_once $vm_shc_dir_path . '/inc/post-type.php';
require_once $vm_shc_dir_path . '/inc/shortcodes.php';

add_action('admin_enqueue_scripts', 'vm_shortcode_scripts');
add_action('wp_enqueue_scripts', 'vm_shortcode_site_scripts');

function vm_shortcode_scripts( $hook ) {

    if( get_post_type() == 'home_library' ) {
     
      wp_register_script('vm_shortcode_script', plugins_url( 'js/scripts.js', __FILE__), array('jquery'));
      wp_enqueue_script( 'vm_shortcode_script');
    }

}

function vm_shortcode_site_scripts( $hook ) {

	wp_register_style( 'vm-style', plugins_url( 'css/vm-style.css', __FILE__) ); 
	wp_enqueue_style( 'vm-style' );

     wp_register_script('vm_shortcode_site_script', plugins_url( 'js/site_scripts.js', __FILE__), array('jquery'));
     wp_enqueue_script( 'vm_shortcode_site_script');

}