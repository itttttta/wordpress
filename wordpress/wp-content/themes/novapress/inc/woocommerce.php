<?php
/**
 * Add WooCommerce support
 *
 *
 * @package understrap
 */

add_action( 'after_setup_theme', 'novapress_woocommerce_support' );
function novapress_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}