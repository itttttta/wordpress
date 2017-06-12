<?php
/**
 * understrap enqueue scripts
 *
 * @package understrap
 */

function novapress_scripts() {
    wp_enqueue_style( 'novapress-understrap-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), '0.4.4');
    wp_enqueue_style( 'novapress-multicolumnsrow-css', get_stylesheet_directory_uri() . '/css/multi-columns-row.css');
    wp_enqueue_style( 'novapress-styles', get_stylesheet_directory_uri() . '/style.css', array(), '0.4.4');
    wp_enqueue_script( 'novapress-scripts', get_template_directory_uri() . '/js/theme.min.js', array('jquery'), '0.4.4', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'novapress_scripts' );