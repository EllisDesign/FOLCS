<?php
/**
 * FOLCS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FOLCS
 */

if ( ! function_exists( 'folcs_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function folcs_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FOLCS, use a find and replace
		 * to change 'folcs' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'folcs', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'folcs' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'folcs_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_editor_style();

		add_image_size( 'thumbnail_cropped', 640, 745, true );
		// add_image_size( 'portrait_cropped', 980, 1470, true );
		add_image_size( 'high', 2048, 5120, false );
	}
endif;
add_action( 'after_setup_theme', 'folcs_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// function folcs_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	// $GLOBALS['content_width'] = apply_filters( 'folcs_content_width', 640 );
// }
// add_action( 'after_setup_theme', 'folcs_content_width', 0 );


// Remove Default Post Type from Menus
function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_default_post_type' );

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );


function remove_menu_items() {
	remove_menu_page( 'themes.php' );
	remove_menu_page( 'edit-comments.php' );
}
add_action('admin_menu','remove_menu_items');

function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
    remove_post_type_support( 'post', 'trackbacks' );
    remove_post_type_support( 'page', 'trackbacks' );
}
add_action('init', 'remove_comment_support', 100);


function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
     
    return array(
        'index.php', // Dashboard
        'separator1', // First separator
        // 'edit.php',
        'edit.php?post_type=blog',
        'edit.php?post_type=author',
        'edit.php?post_type=upcoming',
        'edit.php?post_type=past',
        'edit.php?post_type=press',
        'edit.php?post_type=leader',
        'edit.php?post_type=series',
        'edit.php?post_type=page',
        'upload.php',
        'edit-comments.php'
    );
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');


function theme_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons_2', 'theme_mce_buttons_2' );

function theme_mce_before_init_insert_formats( $init_array ) {  

	$style_formats = array(  
		array(  
			'title' => 'Intro',
			'selector' => 'p',
			'classes' => 'intro'
		),  
		// array(  
		// 	'title' => 'Span',
		// 	'block' => 'span',
		// 	'classes' => 'highlight',
		// 	'wrapper' => true,
		// )
	);  

	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
add_filter( 'tiny_mce_before_init', 'theme_mce_before_init_insert_formats' );


function wpseo_priority() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'wpseo_priority');


if( function_exists('acf_add_options_page') ) {
	
	// acf_add_options_page();

	acf_add_options_page(array(
			'page_title' 	=> 'Footer',
			'menu_title'	=> 'Footer',
			'menu_slug' 	=> 'footer-options',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	acf_add_options_page(array(
			'page_title' 	=> 'Social Media',
			'menu_title'	=> 'Social Media',
			'menu_slug' 	=> 'social-media-options',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	
}


function series_post_type() {

	$labels = array(
		'name'                  => _x( 'Event Series', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Event Series', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Event Series', 'text_domain' ),
		'name_admin_bar'        => __( 'Event Series', 'text_domain' ),
		'archives'              => __( 'Event Series Archives', 'text_domain' ),
		'attributes'            => __( 'Event Series Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Event Series:', 'text_domain' ),
		'all_items'             => __( 'All Event Series', 'text_domain' ),
		'add_new_item'          => __( 'Add New Event Series', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Event Series', 'text_domain' ),
		'edit_item'             => __( 'Edit Event Series', 'text_domain' ),
		'update_item'           => __( 'Update Event Series', 'text_domain' ),
		'view_item'             => __( 'View Event Series', 'text_domain' ),
		'view_items'            => __( 'View Event Series', 'text_domain' ),
		'search_items'          => __( 'Search Event Series', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Event Series', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Event Series', 'text_domain' ),
		'items_list'            => __( 'Event Series list', 'text_domain' ),
		'items_list_navigation' => __( 'Event Series list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Event Series list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Event Series', 'text_domain' ),
		'description'           => __( 'Event Series', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields', 'editor', 'author', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 0,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array( 'slug' => 'event-series', 'with_front'=>false ),
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'series', $args );

}
add_action( 'init', 'series_post_type', 0 );


function upcoming_post_type() {

	$labels = array(
		'name'                  => _x( 'Upcoming Events', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Upcoming Event', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Upcoming Events', 'text_domain' ),
		'name_admin_bar'        => __( 'Upcoming Events', 'text_domain' ),
		'archives'              => __( 'Upcoming Events Archives', 'text_domain' ),
		'attributes'            => __( 'Upcoming Events Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Upcoming Events:', 'text_domain' ),
		'all_items'             => __( 'All Upcoming Events', 'text_domain' ),
		'add_new_item'          => __( 'Add New Upcoming Event', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Upcoming Event', 'text_domain' ),
		'edit_item'             => __( 'Edit Upcoming Event', 'text_domain' ),
		'update_item'           => __( 'Update Upcoming Event', 'text_domain' ),
		'view_item'             => __( 'View Upcoming Event', 'text_domain' ),
		'view_items'            => __( 'View Upcoming Events', 'text_domain' ),
		'search_items'          => __( 'Search Upcoming Events', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Upcoming Events', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Upcoming Events', 'text_domain' ),
		'items_list'            => __( 'Upcoming Events list', 'text_domain' ),
		'items_list_navigation' => __( 'Upcoming Events list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Upcoming Events list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Upcoming Events', 'text_domain' ),
		'description'           => __( 'Upcoming Events', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields', 'author', 'thumbnail' ),
		'taxonomies'            => array( 'upcoming-taxonomy' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 0,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array( 'slug' => 'upcoming-events', 'with_front'=>false ),
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'upcoming', $args );

}
add_action( 'init', 'upcoming_post_type', 0 );


function past_post_type() {

	$labels = array(
		'name'                  => _x( 'Past Events', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Past Event', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Past Events', 'text_domain' ),
		'name_admin_bar'        => __( 'Past Events', 'text_domain' ),
		'archives'              => __( 'Past Events Archives', 'text_domain' ),
		'attributes'            => __( 'Past Events Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Past Events:', 'text_domain' ),
		'all_items'             => __( 'All Past Events', 'text_domain' ),
		'add_new_item'          => __( 'Add New Past Event', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Past Event', 'text_domain' ),
		'edit_item'             => __( 'Edit Past Event', 'text_domain' ),
		'update_item'           => __( 'Update Past Event', 'text_domain' ),
		'view_item'             => __( 'View Past Event', 'text_domain' ),
		'view_items'            => __( 'View Past Events', 'text_domain' ),
		'search_items'          => __( 'Search Past Events', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Past Events', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Past Events', 'text_domain' ),
		'items_list'            => __( 'Past Events list', 'text_domain' ),
		'items_list_navigation' => __( 'Past Events list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Past Events list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Past Events', 'text_domain' ),
		'description'           => __( 'Past Events', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields', 'author', 'thumbnail' ),
		'taxonomies'            => array( 'past-taxonomy' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 0,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array( 'slug' => 'past-events', 'with_front'=>false ),
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'past', $args );

}
add_action( 'init', 'past_post_type', 0 );


function blog_post_type() {

	$labels = array(
		'name'                  => _x( 'Blog', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Blog', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Blog', 'text_domain' ),
		'name_admin_bar'        => __( 'Blog', 'text_domain' ),
		'archives'              => __( 'Blog Archives', 'text_domain' ),
		'attributes'            => __( 'Blog Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Blog:', 'text_domain' ),
		'all_items'             => __( 'All Blog', 'text_domain' ),
		'add_new_item'          => __( 'Add New Blog', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Blog', 'text_domain' ),
		'edit_item'             => __( 'Edit Blog', 'text_domain' ),
		'update_item'           => __( 'Update Blog', 'text_domain' ),
		'view_item'             => __( 'View Blog', 'text_domain' ),
		'view_items'            => __( 'View Blog', 'text_domain' ),
		'search_items'          => __( 'Search Blog', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Blog', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Blog', 'text_domain' ),
		'items_list'            => __( 'Blog list', 'text_domain' ),
		'items_list_navigation' => __( 'Blog list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Blog list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Blog', 'text_domain' ),
		'description'           => __( 'Blog', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields', 'author', 'thumbnail' ),
		'taxonomies'            => array( 'blog-taxonomy' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 0,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array( 'slug' => 'blog', 'with_front'=>false ),
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'blog', $args );

}
add_action( 'init', 'blog_post_type', 0 );


function author_post_type() {

	$labels = array(
		'name'                  => _x( 'Authors', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Author', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Authors', 'text_domain' ),
		'name_admin_bar'        => __( 'Authors', 'text_domain' ),
		'archives'              => __( 'Authors Archives', 'text_domain' ),
		'attributes'            => __( 'Authors Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Authors:', 'text_domain' ),
		'all_items'             => __( 'All Authors', 'text_domain' ),
		'add_new_item'          => __( 'Add New Author', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Author', 'text_domain' ),
		'edit_item'             => __( 'Edit Author', 'text_domain' ),
		'update_item'           => __( 'Update Author', 'text_domain' ),
		'view_item'             => __( 'View Author', 'text_domain' ),
		'view_items'            => __( 'View Authors', 'text_domain' ),
		'search_items'          => __( 'Search Authors', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Authors', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Authors', 'text_domain' ),
		'items_list'            => __( 'Authors list', 'text_domain' ),
		'items_list_navigation' => __( 'Authors list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Authors list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Authors', 'text_domain' ),
		'description'           => __( 'Authors', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields', 'author', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 0,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array( 'slug' => 'author', 'with_front'=>false ),
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'author', $args );

}
add_action( 'init', 'author_post_type', 0 );


function press_post_type() {

	$labels = array(
		'name'                  => _x( 'Press', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Press', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Press', 'text_domain' ),
		'name_admin_bar'        => __( 'Press', 'text_domain' ),
		'archives'              => __( 'Press Archives', 'text_domain' ),
		'attributes'            => __( 'Press Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Press:', 'text_domain' ),
		'all_items'             => __( 'All Press', 'text_domain' ),
		'add_new_item'          => __( 'Add New Press', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Press', 'text_domain' ),
		'edit_item'             => __( 'Edit Press', 'text_domain' ),
		'update_item'           => __( 'Update Press', 'text_domain' ),
		'view_item'             => __( 'View Press', 'text_domain' ),
		'view_items'            => __( 'View Press', 'text_domain' ),
		'search_items'          => __( 'Search Press', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Press', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Press', 'text_domain' ),
		'items_list'            => __( 'Press list', 'text_domain' ),
		'items_list_navigation' => __( 'Press list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Press list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Press', 'text_domain' ),
		'description'           => __( 'Press', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields', 'author' ),
		'taxonomies'            => array( 'press-taxonomy' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 0,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array( 'slug' => 'press', 'with_front'=>false ),
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'press', $args );

}
add_action( 'init', 'press_post_type', 0 );


function leader_post_type() {

	$labels = array(
		'name'                  => _x( 'Leadership', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Leadership', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Leadership', 'text_domain' ),
		'name_admin_bar'        => __( 'Leadership', 'text_domain' ),
		'archives'              => __( 'Leadership Archives', 'text_domain' ),
		'attributes'            => __( 'Leadership Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Leadership:', 'text_domain' ),
		'all_items'             => __( 'All Leadership', 'text_domain' ),
		'add_new_item'          => __( 'Add New Leadership', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Leadership', 'text_domain' ),
		'edit_item'             => __( 'Edit Leadership', 'text_domain' ),
		'update_item'           => __( 'Update Leadership', 'text_domain' ),
		'view_item'             => __( 'View Leadership', 'text_domain' ),
		'view_items'            => __( 'View Leadership', 'text_domain' ),
		'search_items'          => __( 'Search Leadership', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Leadership', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Leadership', 'text_domain' ),
		'items_list'            => __( 'Leadership list', 'text_domain' ),
		'items_list_navigation' => __( 'Leadership list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Leadership list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Leadership', 'text_domain' ),
		'description'           => __( 'Leadership', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields', 'author' ),
		'taxonomies'            => array( 'leader-taxonomy' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 0,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => array( 'slug' => 'team', 'with_front'=>false ),
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'leader', $args );

}
add_action( 'init', 'leader_post_type', 0 );


// function event_taxonomy() {

//     register_taxonomy(
//         'event-category',
//         array( 'upcoming', 'past' ),
//         array(
//             'label' => __( 'Event Category' ),
//             'rewrite' => array( 'slug' => 'event-category' ),
//             'hierarchical' => true,
//         )
//     );
// }
// add_action( 'init', 'event_taxonomy' );


function upcoming_taxonomy() {

    register_taxonomy(
        'upcoming-taxonomy',
        array( 'upcoming' ),
        array(
            'label' => __( 'Upcoming Category' ),
            'rewrite' => array( 'slug' => 'upcoming-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'upcoming_taxonomy' );

function past_taxonomy() {

    register_taxonomy(
        'past-taxonomy',
        array( 'past' ),
        array(
            'label' => __( 'Past Category' ),
            'rewrite' => array( 'slug' => 'past-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'past_taxonomy' );

function blog_taxonomy() {

    register_taxonomy(
        'blog-taxonomy',
        array( 'blog' ),
        array(
            'label' => __( 'Blog Category' ),
            'rewrite' => array( 'slug' => 'blog-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'blog_taxonomy' );

function press_taxonomy() {

    register_taxonomy(
        'press-taxonomy',
        'press',
        array(
            'label' => __( 'Press Category' ),
            'rewrite' => array( 'slug' => 'press-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'press_taxonomy' );

function leader_taxonomy() {

    register_taxonomy(
        'leader-taxonomy',
        'leader',
        array(
            'label' => __( 'Leader Category' ),
            'rewrite' => array( 'slug' => 'leader-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'leader_taxonomy' );


function my_searchwp_acf_repeater_keys( $keys ) {
	$keys[] = 'event_episode_items';
	return $keys;
}
add_filter( 'searchwp_custom_field_keys', 'my_searchwp_acf_repeater_keys' );


function my_searchwp_include_only_category( $ids, $engine, $terms ) {
	// if and only if a category ID was submitted:
	// we only want to apply this limitation to the default search engine
	// if you would like to change that you can do so here
	if ( ! empty( $_GET['qseries'] ) ) { // && 'past_events' == $engine ) {
		// $category_id = absint( $_GET['qseries'] );
		$category_args = array(
				// 'category'       => $category_id,  // limit to the chosen category ID
				'post_type'     => array( 'past' ),
				'fields'         => 'ids',         // we only want the IDs of these posts
				'posts_per_page' => -1,            // return ALL posts
				'tax_query' => array(
					array (
			            'taxonomy' => 'past-taxonomy',
			            'field' => 'slug',
			            'terms' => $_GET['qseries']
			        )
			    )
			);
		$ids = get_posts( $category_args );
		// if there were no posts returned we need to force an empty result
		if ( 0 == count( $ids ) ) {
			$ids = array( 0 ); // this will force SearchWP to return zero results
		}
	}
	// always return our $ids
	return $ids;
}
add_filter( 'searchwp_include', 'my_searchwp_include_only_category', 10, 3 );


// function wpb_change_search_url() {
//     if ( is_search() && ! empty( $_GET['s'] ) ) {
//         wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
//         exit();
//     }   
// }
// add_action( 'template_redirect', 'wpb_change_search_url' );


/**
 * Enqueue scripts and styles.
 */
function folcs_scripts() {
	global $post;
    $template_file = basename( get_page_template() );

	wp_enqueue_style( 'reset-normalize', get_template_directory_uri() . '/reset-normalize.css', array(), null, 'all');
    
    wp_enqueue_style( 'folcs-style', get_template_directory_uri() . '/style.1.0.css', array(), '1.0.6', 'all');

    wp_enqueue_style( 'googlefonts-style', 'https://fonts.googleapis.com/css?family=Barlow:300,300i,400,500,600,700', array(), null, 'all');

    wp_enqueue_style( 'adobetypekit-style', 'https://use.typekit.net/hjs5kct.css', array(), null, 'all');

    wp_enqueue_script( 'jquery-3.3.1', get_template_directory_uri() . '/js/vendor/jquery-3.3.1.min.js', array(), null, true);

	wp_add_inline_script( 'jquery-3.3.1', 'var jQuery3_3_1 = $.noConflict(true);', 'after');

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr-custom.js', array(), null, true);

	wp_enqueue_script( 'TweenMax', get_template_directory_uri() . '/js/vendor/TweenMax.min.js', array(), null, true);

	wp_enqueue_script( 'ScrollMagic', get_template_directory_uri() . '/js/vendor/ScrollMagic.min.js', array(), null, true);

	wp_enqueue_script( 'animation-gsap', get_template_directory_uri() . '/js/vendor/animation.gsap.min.js', array(), null, true);

	wp_enqueue_script( 'jump', get_template_directory_uri() . '/js/vendor/jump.js', array(), null, true);

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/vendor/slick.noconflict.min.js', array('jquery-3.3.1'), null, true);

	wp_enqueue_script( 'folcs-js', get_template_directory_uri() . '/js/folcs.1.0.js', array('jquery-3.3.1'), '1.0.0', true);


if($template_file == 'page-home.php'){
	
	wp_enqueue_script( 'folcs-home', get_template_directory_uri() . '/js/folcs.home.1.0.js', array('jquery-3.3.1'), null, true);
}
if($template_file == 'page-event-series.php'){
	
	wp_enqueue_script( 'folcs-series', get_template_directory_uri() . '/js/folcs.series.1.0.js', array('jquery-3.3.1'), null, true);
}
if($post->post_type == 'series' || $post->post_type == 'upcoming' || $post->post_type == 'past' || $post->post_type == 'blog'){
	
	wp_enqueue_script( 'folcs-gallery', get_template_directory_uri() . '/js/folcs.gallery.1.0.js', array('jquery-3.3.1'), null, true);
}
if($template_file == 'page-past-events.php'){
	
	wp_enqueue_script( 'folcs-past', get_template_directory_uri() . '/js/folcs.past.1.0.js', array('jquery-3.3.1'), null, true);
}
if($template_file == 'page-leadership.php'){
	
	wp_enqueue_script( 'folcs-leadership', get_template_directory_uri() . '/js/folcs.leadership.1.0.js', array('jquery-3.3.1'), null, true);
}

if($template_file == 'page-press.php'){

	wp_enqueue_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery-3.3.1'), null, true);

	wp_localize_script( 'my_loadmore', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

if($post->post_type == 'upcoming'){

	wp_enqueue_script( 'addtocalendar', get_stylesheet_directory_uri() . '/js/folcs.addtocalendar.js', array('jquery-3.3.1'), null, true);

	wp_localize_script( 'addtocalendar', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

}
add_action( 'wp_enqueue_scripts', 'folcs_scripts' );


function page_templates( $template ) {
	global $post;

	if ( ($post->post_type == 'upcoming' || $post->post_type == 'past') ) {

		$new_template = locate_template( array( 'single-event.php' ) );
		if ( '' != $new_template ) {
			return $new_template;
		}
	}

	return $template;
}
add_filter( 'single_template', 'page_templates', 99 );


require get_template_directory() . '/inc/class.taxonomy-single-term.php';

$custom_tax_upcoming = new Taxonomy_Single_Term( 'upcoming-taxonomy', array( 'upcoming' ), 'radio' );
$custom_tax_past = new Taxonomy_Single_Term( 'past-taxonomy', array( 'past' ), 'radio' );
$custom_tax_blog = new Taxonomy_Single_Term( 'blog-taxonomy', array( 'blog' ), 'radio' );
$custom_tax_leader = new Taxonomy_Single_Term( 'leader-taxonomy', array( 'leader' ), 'radio' );

$custom_tax_upcoming->set( 'priority', 'low' );
$custom_tax_past->set( 'priority', 'low' );
$custom_tax_blog->set( 'priority', 'low' );
$custom_tax_leader->set( 'priority', 'low' );


function misha_loadmore_ajax_handler(){
 
	$args['paged'] = $_POST['page'] + 1;

	$press_args = array (
		'post_type'     => array( 'press' ),
		'post_status'   => array( 'publish' ),
		'tax_query' => array(
			array (
	            'taxonomy' => 'press-taxonomy',
	            'field' => 'slug',
	            'terms' => 'featured',
	            'operator' => 'NOT IN'
	        )
	    ),
		// 'nopaging'      => false,
		'posts_per_page'=> 6,
		'paged' => $_POST['page'] + 1,
		'order'         => 'DSC',
	);

	$press_query = new WP_Query( $press_args );

	if ( $press_query->have_posts() ) :

		echo '<div class="row event-cards press-event-cards category-margin-5 h2-margin-2 sequence-margin-last">';

	while($press_query->have_posts()) : $press_query->the_post(); 
 
			get_template_part( 'template-parts/content', 'page-press-more' );
 
		endwhile;

		echo '</div>';
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}


require get_template_directory() . '/inc/event-ics.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

