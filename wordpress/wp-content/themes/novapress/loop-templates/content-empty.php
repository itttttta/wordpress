<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package understrap
 */
?>

	<?php the_content(); ?>

	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'novapress' ),
			'after'  => '</div>',
		) );
	?>

