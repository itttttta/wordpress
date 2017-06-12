<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package couture
 */

?>

	</div><!-- #content -->
	<?php if ( true == get_theme_mod( 'instagram_switch', true ) ) :
	do_action('couture_ig');
	else: endif; 
	?>
	<footer id="colophon" class="site-footer footer" role="contentinfo">
	<div class="site-info col-1-1">
		<?php if( get_theme_mod('footer_text') ):

			echo esc_html(get_theme_mod('footer_text'));

			 else: ?>

			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'couture' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'couture' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'couture' ), 'Couture', '<a href="https://thepixeltribe.com/" rel="designer">Pixel Tribe</a>' ); ?>
			<?php endif; ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
