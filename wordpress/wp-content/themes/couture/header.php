<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package couture
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'couture' ); ?></a>

	<header id="masthead" class="site-header grid gridpad" role="banner">
		<div class="site-branding col-1-1"><h1 class="site-title">
<?php

                $output = null;

                if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                    $output .= get_custom_logo();
                } else {
                    $output .= '<a href="'. esc_url( trailingslashit( home_url() ) ).'" title="'.esc_attr( get_bloginfo( 'name' ) ).'" rel="home">';
                    $output .= get_bloginfo( 'name' );
                    $output .= '</a>';
                }

                echo $output;

              if ( get_theme_mod( 'off_canvas', true ) ) {
              	do_action( 'couture_do_prim`ary_nav' ); }
            ?></h1><?php

            $description = get_bloginfo( 'description', 'display' );
            if ( ( function_exists( 'the_custom_logo' ) && ! has_custom_logo() ) && $description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>
		</div><!-- .site-branding -->
		<div class="col-1-1">
		<?php	if (  has_nav_menu( 'primary' ) ) {
		 wp_nav_menu(array(
        'container_id' => 'cssmenu',
        'theme_location' => 'primary',
        'walker' => new Couture_CSS_Menu_Walker()
    ));

}?>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content grid gridpad">
<?php do_action('couture_custom_header'); ?>