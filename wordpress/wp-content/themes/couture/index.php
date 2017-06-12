<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package couture
 */

get_header(); ?>


    <div id="primary" class="content-area grid">
        <main id="main" class="site-main masonry" role="main">
        <div class="grid-sizer"></div>

        <?php
        if (have_posts() ) :


            /* Start the Loop */
            while ( have_posts() ) : the_post();?>

                <div class="masonry-col col-3-12"><?php
                get_template_part( 'template-parts/content', get_post_format() ); ?>
                </div>
                <?php 

            endwhile;



        else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>

        </main><!-- #main -->
<div class="col-1-1">
           <?php the_posts_pagination( array( 'mid_size' => 4 ) ); ?>
</div>
    </div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php
get_footer();
