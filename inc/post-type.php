<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directl

function home_library_posttype() {
  register_post_type( 'home_library',
    array(
      'labels' => array(
        'name' => __( 'Home Library' ),
        'singular_name' => __( 'Video' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'home_library'),
    )
  );
}
add_action( 'init', 'home_library_posttype' );

function set_custom_home_library_columns($columns) {
    $new = array();

    foreach($columns as $key => $title) {
      if ($key=='date'){
        $new['city_column'] = __( 'City', 'vm_shortcode' );
        $new['state_column'] = __( 'State', 'vm_shortcode' );
        $new['shortcode_column'] = __( 'Shortcode', 'vm_shortcode' );
      }
      $new[$key] = $title;
    }
    return $new;
}
add_filter( 'manage_home_library_posts_columns', 'set_custom_home_library_columns' );

function custom_home_library_column( $column, $post_id ) {
    
    switch ( $column ) {
        case 'city_column' :
            echo get_field( 'vm_city', $post_id );
            break;
        case 'state_column' :
            echo get_field( 'vm_state', $post_id );
            break;
        case 'shortcode_column' :
            echo '<strong>' . get_field( 'video_shortcode', $post_id ) . '</strong>';
            break;
    }
}
add_action( 'manage_home_library_posts_custom_column' , 'custom_home_library_column', 10, 2 );

if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_home-library',
    'title' => 'Home Library',
    'fields' => array (
      array (
        'key' => 'field_5921237659a22',
        'label' => 'City',
        'name' => 'vm_city',
        'type' => 'text',
        'required' => 1,
        'default_value' => '',
        'placeholder' => 'City',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_552321d59a22',
        'label' => 'State',
        'name' => 'vm_state',
        'type' => 'select',
        'required' => 1,
        'choices' => array (
      'AL' => 'Alabama',
			'AK' => 'Alaska',
			'AZ' => 'Arizona',
			'AR' => 'Arkansas',
			'CA' => 'California',
			'CO' => 'Colorado',
			'CT' => 'Connecticut',
			'DE' => 'Delaware',
			'DC' => 'District of Colombia',
			'FL' => 'Florida',
			'GA' => 'Georgia',
			'HI' => 'Hawaii',
			'ID' => 'Idaho',
			'IL' => 'Illinois',
			'IN' => 'Indiana',
			'IA' => 'Iowa',
			'KS' => 'Kansas',
			'KY' => 'Kentucky',
			'LA' => 'Louisiana',
			'ME' => 'Maine',
			'MD' => 'Maryland',
			'MA' => 'Massachusetts',
			'MI' => 'Michigan',
			'MN' => 'Minnesota',
			'MS' => 'Mississippi',
			'MO' => 'Missouri',
			'MT' => 'Montana',
			'NE' => 'Nebraska',
			'NV' => 'Nevada',
			'NH' => 'New Hampshire',
			'NJ' => 'New Jersey',
			'NM' => 'New Mexico',
			'NY' => 'New York',
			'NC' => 'North Carolina',
			'ND' => 'North Dakota',
			'OH' => 'Ohio',
			'OK' => 'Oklahoma',
			'OR' => 'Oregon',
			'PA' => 'Pennsylvania',
			'PR' => 'Puerto Rico',
			'RI' => 'Rhode Island',
			'SC' => 'South Carolina',
			'SD' => 'South Dakota',
			'TN' => 'Tennessee',
			'TX' => 'Texas',
			'UT' => 'Utah',
			'VT' => 'Vermont',
			'VA' => 'Virginia',
			'WA' => 'Washington',
			'WV' => 'West Virginia',
			'WI' => 'Wisconsin',
			'WY' => 'Wyoming',
        ),
        'default_value' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array (
        'key' => 'field_5926e1121e4f8',
        'label' => 'Video Type',
        'name' => 'video_type',
        'type' => 'select',
        'required' => 1,
        'choices' => array (
          'regular' => 'Regular',
          '360_video' => '360 Video',
        ),
        'default_value' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array (
        'key' => 'field_5926e1a861cc1',
        'label' => 'Video Link',
        'name' => 'video_link',
        'type' => 'text',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5926e67866e8c',
        'label' => 'Shortcode',
        'name' => 'video_shortcode',
        'type' => 'text',
        'required' => 0,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'home_library',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 0,
  ));
}