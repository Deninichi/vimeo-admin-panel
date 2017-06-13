<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directl

add_shortcode( 'V', 'vm_shortcode_add_shortcode' );
add_shortcode( 'VM_Frontend', 'vm_shortcode_frontend_panel' );

function vm_shortcode_add_shortcode( $atts ){
	$atts = shortcode_atts( 
		array(
			'id' => 0,
		), $atts
	);

	extract($atts);

	$video_type = get_field( 'video_type', $id );
	$link = get_field( 'video_link', $id );
	$link = explode('https://vimeo.com/', $link);

	if ( $video_type == 'regular' ){
		return '<iframe src="https://player.vimeo.com/video/' . $link[1] . '" width="1027" height="578" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	} else {
		return '<iframe src="https://player.vimeo.com/video/' . $link[1] . '" width="1027" height="578" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	}
}

function vm_shortcode_frontend_panel(){
	global $vm_shc_dir_path;

	ob_start();
	include $vm_shc_dir_path . '/templates/frontend.php';
	
	return ob_get_clean();
}