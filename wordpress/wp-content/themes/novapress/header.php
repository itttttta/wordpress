<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
    
    <!-- ******************* The Navbar Area ******************* -->
    <div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">
	
        <a class="skip-link screen-reader-text sr-only" href="#content"><?php _e( 'Skip to content', 'novapress' ); ?></a>

        <nav class="navbar navbar-default navbar-fixed-top affix site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                            
            <div class="container">
                
                <div class="row">
                    
                    <div class="col-md-12">

                        <div class="navbar-header">

                            <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->

                            <button class="navbar-toggle hidden-lg-up" type="button" data-toggle="collapse" data-target=".exCollapsingNavbar">
                                <span class="sr-only"><?php _e( 'Toggle navigation', 'novapress' ); ?></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <?php if (!has_custom_logo()) : ?>
                                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                            <?php else : ?>
                                <?php the_custom_logo() ?>
                            <?php endif; ?>

                            <!-- The WordPress Menu goes here -->
                            <?php wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary',
                                        'container_class' => 'collapse navbar-toggleable-md exCollapsingNavbar navbar-right',
                                        'menu_class' => 'nav navbar-nav navbar-right',
                                        'fallback_cb' => '',
                                        'depth' => 2,
                                        'menu_id' => 'main-menu',
                                        'walker' => new wp_bootstrap_navwalker()
                                    )
                            ); ?>

                        </div>
                    
                    </div>
                
                </div>

            </div> <!-- .container -->
                
            
        </nav><!-- .site-navigation -->
        
        <div class="clearfix"></div>
        
        <div class="spacer"></div>
        
    </div><!-- .wrapper-navbar end -->