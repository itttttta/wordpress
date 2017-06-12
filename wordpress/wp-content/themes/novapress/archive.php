<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header(); ?>

<div class="wrapper" id="archive-wrapper">
    
    <div  id="content" class="container">
        
    	    <div id="primary" class="content-area">
               
            <main id="main" class="site-main" role="main">

                <div class="row">
                    
                    <header class="page-header col-md-12">
                            <?php
                                the_archive_title( '<h1 class="page-title">', '</h1>' );
                                the_archive_description( '<div class="taxonomy-description">', '</div>' );
                            ?>
                    </header><!-- .page-header -->
                
                </div>
                
                <div class="row multi-columns-row">

                      <?php if ( have_posts() ) : ?>

                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'loop-templates/content', get_post_format() );
                            ?>

                        <?php endwhile; ?>

                        <?php else : ?>

                            <?php get_template_part( 'loop-templates/content', 'none' ); ?>

                        <?php endif; ?>
            
                </div>

                <?php the_posts_pagination(); ?>
            
            </main><!-- #main -->
                           
    	    </div><!-- #primary -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>