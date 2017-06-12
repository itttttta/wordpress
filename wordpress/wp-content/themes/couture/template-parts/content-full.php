<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package couture
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class='single-post-thumb'>
    <?php 	if ( has_post_thumbnail() ) { ?>

                <?php the_post_thumbnail('full'); ?>


    <?php } ?>

    <header class="entry-header padded">

        <?php
        if ( is_single() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php couture_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
    </header><!-- .entry-header -->
    </div>
    <div class="entry-content padded">
        <?php
            the_content( sprintf(
                /* translators: %s: Name of current post. */
                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'couture' ), array( 'span' => array( 'class' => array() ) ) ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'couture' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer padded">
        <?php //couture_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
