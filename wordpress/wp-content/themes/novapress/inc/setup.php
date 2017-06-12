<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 * @package understrap
 */

function novapress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'novapress_content_width', 730 );
}
add_action( 'after_setup_theme', 'novapress_content_width', 0 );


if ( ! function_exists( 'novapress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function novapress_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on understrap, use a find and replace
	 * to change 'novapress' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'novapress', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'novapress' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
    
    /*
	 * Adding Thumbnail basic support
	 */
    add_theme_support( "post-thumbnails" );
    add_image_size( 'novapress-wide', 760, 280, true );
    add_image_size( 'novapress-square', 680, 500, true );
    add_image_size( 'novapress-rectangle', 600, 300, true );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'novapress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Set up the WordPress core custom logo feature.
    add_theme_support( 'custom-logo', array(
       'height'      => 50,
       'width'       => 300,
       'flex-width' => true,
       'flex-height' => true,
    ) );
    
}
endif; // novapress_setup
function update_user_notices(){
	//remove notice dismissal flags from all users that might have it.
	delete_metadata( 'user', null, 'novapress_welcome_admin_notice', null, true );
}

add_action( 'after_setup_theme', 'novapress_setup' );
add_action('switch_theme', 'update_user_notices');