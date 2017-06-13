<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directl

	$user = wp_get_current_user();
	
	if ( in_array( 'subscriber', (array) $user->roles ) || in_array( 'client', (array) $user->roles ) ) {
	    echo '<h2>You don\'t have access to this page </h2>';
	    die();
	}

	require_once $vm_shc_dir_path . '/inc/functions.php';
	global $post;

	$all_posts = get_home_library_posts();
	remove_shortcode( 'V' );
?>
	
<?php if ( !isset( $_GET['action'] ) ) : ?>
	<div style="text-align: right;float: right;margin-top: -70px;">
		<button onclick="window.location.href='?page=home-library-fronend&action=new'" >Add New</button>
	</div>
	<table class="home-library-frontend">
		<thead>
			<tr>
				<td style="width: 30%;"><p>Name</p></td>
				<td><p>City</p></td>
				<td><p>State</p></td>
				<td><p>Shortcode</p></td>
				<td><p>Date</p></td>
				<td><p>Edit</p></td>
				<td><p>Remove</p></td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $all_posts as $post ) : setup_postdata( $post ); ?>
				<?php $post_id = $post->ID; ?>
				<tr>
					<td><p><?php the_title(); ?></p></td>
					<td><p><?php echo get_field( 'vm_city', $post_id ); ?></p></td>
					<td><p><?php echo get_field( 'vm_state', $post_id ); ?></p></td>
					<td><b><?php echo get_field( 'video_shortcode', $post_id ); ?></b></td>
					<td><p><?php echo get_the_date(); ?></p></td>
					<td><p><a href="?page=home-library-fronend&action=edit&post_id=<?php echo $post_id ?>">Edit</a></p></td>
					<td><p><a href="?page=home-library-fronend&action=remove&post_id=<?php echo $post_id ?>">Remove</a></p></td>
				</tr>
				
			<?php endforeach; 
			wp_reset_postdata(); ?>
		</tbody>
	</table>
<?php endif ?>

<?php if ( (isset( $_GET['action'] ) && $_GET['action'] == 'edit' ) && (isset( $_GET['page'] ) && $_GET['page'] == 'home-library-fronend' ) ) : ?>
	<?php acf_form_head(); ?>
	<?php acf_form(array(
					'post_id'	=> $_GET['post_id'],
					'post_title'	=> 1,
					'submit_value'	=> 'Update the post!',
				)); ?>

<?php endif ?>

<?php if ( (isset( $_GET['action'] ) && $_GET['action'] == 'new' ) && (isset( $_GET['page'] ) && $_GET['page'] == 'home-library-fronend' ) ) : ?>
	<?php acf_form_head(); ?>
	
	<?php acf_form(array(
		'post_id'		=> 'new_post',
		'post_title'	=> true,
		'new_post'		=> array(
			'post_type'		=> 'home_library',
			'post_status'	=> 'publish'
		),
		'return' => $_SERVER['REDIRECT_URL'],
		'submit_value'		=> 'Create'
	)); ?>

<?php endif ?>