<?php
/**
 * couture functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package couture
 */

if ( ! function_exists( 'couture_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function couture_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on couture, use a find and replace
	 * to change 'couture' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'couture', get_template_directory() . '/languages' );

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
    add_image_size( 'couture-thumbnail', 350, 410, TRUE );
    add_image_size( 'couture-featured', 1440, 600, TRUE );
    add_image_size( 'couture-single', 800, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'couture' ),
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
	add_theme_support( 'custom-background', apply_filters( 'couture_custom_background_args', array(
		'default-color' => 'f5f5f5',
		'default-image' => '',
	) ) );

        add_theme_support( 'custom-logo' );

         // Custom Site Logo
         add_theme_support( 'site-logo', array(
        'header-text' => array(
            'site-title',
            'tagline',
        ),
        'size' => 'medium',
    ) );
}
endif;
add_action( 'after_setup_theme', 'couture_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function couture_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'couture_content_width', 640 );
}
add_action( 'after_setup_theme', 'couture_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function couture_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'couture' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'couture' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'couture_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'couture_fonts_url' ) ) :
/**
 * Register Google fonts for Couture.
 *
 * Create your own couture_fonts_url() function to override in a child theme.
 *
 * @since couture 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function couture_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'couture' ) ) {
		$fonts[] = 'Oswald:400,700,900,400italic,700italic,900italic';
	}
	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'couture' ) ) {
		$fonts[] = 'Lato:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;
}
endif;
function couture_scripts() {
	wp_enqueue_style( 'couture-fonts', couture_fonts_url(), array(), null );

	wp_enqueue_style( 'couture-grid', get_template_directory_uri() . '/css/grid.css' );

	wp_enqueue_style( 'couture-style', get_stylesheet_uri() );

	wp_enqueue_script( 'couture-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery','masonry'), '20152215', true );

	wp_enqueue_script( 'couture-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'couture-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'couture_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/couture-kirki.php';

require get_template_directory() . '/inc/couture-include-kirki.php';

require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


require get_template_directory() . '/pt-pro/class-customize.php';



class Couture_CSS_Menu_Walker extends Walker {

  var $db_fields = array( 'parent' =>'menu_item_parent', 'id' => 'db_id' );

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul>\n";
  }

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = '';
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    /* Add active class */
    if(in_array('current-menu-item', $classes)) {
      $classes[] = 'active';
      unset($classes['current-menu-item']);
    }

    /* Check for children */
    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' =>'_menu_item_menu_item_parent', 'meta_value' => $item->ID));
    if (!empty($children)) {
      $classes[] = 'has-sub';
    }

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'><span>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</span></a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}