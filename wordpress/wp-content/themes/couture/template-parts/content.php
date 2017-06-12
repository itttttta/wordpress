<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Couture
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class='post-thumb'>
	<?php 	if ( has_post_thumbnail() ) { ?>
		
				<a href="<?php the_permalink();?>" >
				<?php the_post_thumbnail('couture-thumbnail'); ?>
				</a>
		
	<?php } else { ?>
	<img src="<?php echo esc_url( get_template_directory_uri() )?>/img/default-image.jpg" alt="<?php the_title_attribute(); ?>" />
	<?php } ?>
	</div>
	<header class="entry-header padded">


			<span class="cat"><?php couture_category(); ?></span>

			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );	?>
	</header><!-- .entry-header -->



	<footer class="entry-footer padded">
		<?php //couture_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
