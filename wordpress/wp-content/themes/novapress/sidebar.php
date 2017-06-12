<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="col-md-4 widget-area" role="complementary">
    
<!--    --><?php //get_template_part('widget-templates/sidebar-adspot'); ?>
<!---->
<!--	--><?php //dynamic_sidebar( 'sidebar-1' ); ?>
<!--    <p>hello side bar</p>-->
    <?php if (function_exists('get_most_viewed')): ?>
        <ul>
            <?php get_most_viewed(); ?>
            <p>hello </p>
        </ul>
    <?php endif; ?>
</div><!-- #secondary -->
