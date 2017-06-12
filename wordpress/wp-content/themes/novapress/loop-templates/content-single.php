<?php
/**
 * @package understrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

		<div class="entry-meta">

			<?php novapress_posted_on(); ?> <?php novapress_entry_footer(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->
    
	<div class="entry-content">

		<?php the_content(); ?>
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'novapress' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->