<?php
/**
 * Declaring widgets
 *
 *
 * @package understrap
 */

function novapress_widgets_init() {
	
    register_sidebar( array(
		'name'          => __( 'Sidebar', 'novapress' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Sidebar widget area', 'novapress' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'novapress_widgets_init' );