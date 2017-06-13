<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directl

if ( (isset( $_GET['action'] ) && $_GET['action'] == 'remove') && (isset( $_GET['page'] ) && $_GET['page'] == 'home-library-fronend') ) {
	wp_delete_post( $_GET['post_id'] );

	header( 'Location:' . $_SERVER['REDIRECT_URL'] );
	exit();
}

//save shortcode post from back-end
function vm_save_shortcode( $post_id ) {

	// If this is a revision, don't send the email.
	if ( get_post_type() != 'home_library' )
		return;

	update_field( 'video_shortcode', '[V id=' . $post_id . ' ]', $post_id );
}
add_action( 'save_post', 'vm_save_shortcode', 10, 3 );

//save shortcode post from front-end
function after_save_post( $post_id ) {
    update_field( 'video_shortcode', '[V id=' . $post_id . ' ]', $post_id );
}
add_action('acf/save_post', 'after_save_post', 20 );


function get_home_library_posts(){
	$args = array(
		'posts_per_page'   => 20,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'home_library',

	);
	$posts_array = get_posts( $args );

	return $posts_array;
}

function remove_post_on_frontrnd( $post_id ){
	if( "home-library" != get_post_type( $post_id )) 
		return true;

	wp_delete_post( $post_id );
}