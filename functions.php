<?php

/********************************************************************************************/
/*	medicine creek 																			*/
/*	functions.php																			*/
/* 	Functions and definitions - mostly used to set up custom fields and post types			*/
/********************************************************************************************/

// Add support for post thumbnails
add_theme_support( 'post-thumbnails' );

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array( 'primary' => __( 'Primary Menu', 'medicinecreek' ), ) );

// Enable support for HTML5 markup.
add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );

// Enqueue scripts and styles.
function medicinecreek_scripts() {
	wp_enqueue_style( 'medicinecreek-style', get_stylesheet_uri() );
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'medicinecreek-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'medicinecreek_scripts' );

// Enqueue scripts and styles for admin area only
function medicinecreek_admin() {
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('admin-js', get_template_directory_uri() . '/js/admin.js', array( 'jquery', 'jquery-ui-datepicker'), false, true);
	wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
}
add_action( 'admin_enqueue_scripts', 'medicinecreek_admin');
/********************************************************************************************/
/*	TOUR DATES - 																			*/
/* 	Functions to create custom post type and custom fields for tour dates					*/ 
/********************************************************************************************/

// Create custome post type for Tour Dates
 
add_action('init', 'create_tour_post_type');
function create_tour_post_type() {
 
	// Custom versions of standard wordpress labels
	$labels = array(
		'name'					=> _x( 'Tour Dates', 'post type general name'),
		'singular_name'			=> _x( 'Tour Date', 'post type singular name'),
		'add_new'				=> __( 'Add New', 'tour' ),
		'add_new_item'			=> __( 'Add New Tour Date' ),
		'edit_item'				=> __( 'Edit Tour Date' ),
		'new_item'				=> __( 'New Tour Date' ),
		'all_items'				=> __( 'All Tour Dates' ),
		'view_item'				=> __( 'View Tour Date' ),
		'search_items'			=> __( 'Search Tour Dates' ),
		'not_found'				=> __( 'No tour dates found' ),
		'not_found_in_trash'	=> __( 'No tour dates found in Trash' ),
		'parent_item_colon'		=> '',
		'menu_name'				=> 'Tour Dates'
	);
 
	// Basic custom post type arguments
	$args = array(
		'labels'		=> $labels,
		'description'	=> 'Holds date and venue information for gig events',
		'public'		=> true,
		'menu_position'	=> 5,
		'supports'		=> array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'	=> false
	);
 
	register_post_type( 'tour', $args );
}
 
// Generate meta box to contain custom fields on Tour Dates post type 
 
add_action( 'add_meta_boxes', 'tour_date_box' );
function tour_date_box() {
 
	add_meta_box(
		'tour_date_box',
		__( 'Gig Info:', 'myplugin_textdomain' ),
		'tour_date_box_content',
		'tour',
		'normal',
		'high'
	);
}

// Template for displaying custom fields on Tour Dates post type

function tour_date_box_content( $post ) {
 
	// Insert hidden 'nonce' field for additional security
	wp_nonce_field( plugin_basename( __FILE__ ), 'tour_date_box_content_nonce' );
	
	// Retrieve previous values for meta fields (if we are editing an existing record)
	$old_date = get_post_meta( $post->ID, 'tour_date_date', true );
	$old_venue = get_post_meta( $post->ID, 'tour_date_venue', true );
	$old_venue_url = get_post_meta( $post->ID, 'tour_date_venue_url', true );
	$old_location = get_post_meta( $post->ID, 'tour_date_location', true );
	
	echo '<label for="tour_date_date"></label>';
	echo '<input type="text" class="date_input" id="tour_date_date" name="tour_date_date" placeholder="YYYYMMDD" value="'.$old_date.'" size="20" /><br /><br />';
	
	echo '<label for="tour_date_venue"></label>';
	echo '<input type="text" id="tour_date_venue" name="tour_date_venue" placeholder="venue" value="'.$old_venue.'" size="50" /><br /><br />';
	
	echo '<label for="tour_date_venue_url"></label>';
	echo '<input type="text" id="tour date_venue_url" name="tour_date_venue_url" placeholder="venue url" value="'.$old_venue_url.'" size="50" /><br /><br />';
	
	echo '<label for="tour_date_location"></label>';
	echo '<input type="text" id="tour_date_location" name="tour_date_location" placeholder="town/city" value="'.$old_location.'" size="50" />';
}
 
// Save custom post data from metabox when Tour Date is created/updated 
 
add_action ('save_post', 'tour_date_box_save' );
function tour_date_box_save( $post_id ) {
	
	$meta_box = array( 'tour_date_date', 'tour_date_venue', 'tour_date_venue_url', 'tour_date_location' );

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;
	
	if ( !wp_verify_nonce( $_POST['tour_date_box_content_nonce'], plugin_basename( __FILE__ ) ) )
	return;
	
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}

	// Loop through all meta box fields - update in DB if new or changed, delete if a previous value has been removed
	
	foreach ( $meta_box as $field ) {
		$old = get_post_meta( $post_id, $field, true );
		$new = $_POST[$field];
		
		if ( $new && $new != $old ) {
			update_post_meta( $post_id, $field, $new );
		} elseif ( '' == $new && $old ) {
			delete_post_meta( $post_id, $field, $new );
		}	
	}	
}
 
/********************************************************************************************/
/*	ABOUT PAGE - 																			*/
/* 	Functions to create custom post type and custom fields for 'About' page					*/ 
/********************************************************************************************/

// Create custome post type for About Page entries

add_action('init', 'create_about_post_type');
function create_about_post_type() {
 
	// Custom versions of standard wordpress labels
	$labels = array(
		'name'					=> _x( 'About Page Posts', 'post type general name'),
		'singular_name'			=> _x( 'About Page Post', 'post type singular name'),
		'add_new'				=> __( 'Add New', 'about' ),
		'add_new_item'			=> __( 'Add New About Page Post' ),
		'edit_item'				=> __( 'Edit About Page Post' ),
		'new_item'				=> __( 'New About Page Post' ),
		'all_items'				=> __( 'All About Page Posts' ),
		'view_item'				=> __( 'View About Page Post' ),
		'search_items'			=> __( 'Search About Page Posts' ),
		'not_found'				=> __( 'No about page posts found' ),
		'not_found_in_trash'	=> __( 'No about page posts found in Trash' ),
		'parent_item_colon'		=> '',
		'menu_name'				=> 'About Page'
	);
 
	// Basic custom post type arguments
	$args = array(
		'labels'		=> $labels,
		'description'	=> 'Holds images and descriptions for About page',
		'public'		=> true,
		'menu_position'	=> 6,
		'supports'		=> array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'	=> false
	);
 
	register_post_type( 'about', $args );
}

// Generate meta box to contain custom fields on About Page post type 
 
add_action( 'add_meta_boxes', 'about_post_box' );
function about_post_box() {
 
	add_meta_box(
		'about_post_box',
		__( 'Additional Details:', 'myplugin_textdomain' ),
		'about_post_box_content',
		'about',
		'normal',
		'high'
	);
}

// Template for displaying custom fields on Tour Dates post type
// (only using one custom field to set post order at the moment - may add more later)

function about_post_box_content( $post ) {
 
	// Insert hidden 'nonce' field for additional security
	wp_nonce_field( plugin_basename( __FILE__ ), 'about_post_box_content_nonce' );
	
	// Retrieve previous values for meta fields (if we are editing an existing record)
	$old_order = get_post_meta( $post->ID, 'about_post_order', true );

	echo '<label for="about_post_order"></label>';
	echo '<input type="text" id="about_post_order" name="about_post_order" placeholder="Post Display Order" value="'.$old_order.'" size="20" /><br /><br />';	
}

// Save custom post data from metabox when About Page entry is created/updated 
 
add_action ('save_post', 'about_post_box_save' );
function about_post_box_save( $post_id ) {
	
	$meta_box = array( 'about_post_order' );
	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;
	
	if ( !wp_verify_nonce( $_POST['about_post_box_content_nonce'], plugin_basename( __FILE__ ) ) )
	return;
	
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}

	// Loop through all meta box fields - update in DB if new or changed, delete if a previous value has been removed
	foreach ( $meta_box as $field ) {
		$old = get_post_meta( $post_id, $field, true );
		$new = $_POST[$field];
		
		if ( $new && $new != $old ) {
			update_post_meta( $post_id, $field, $new );
		} elseif ( '' == $new && $old ) {
			delete_post_meta( $post_id, $field, $new );
		}	
	}	
}