<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header(); ?>
<div class="wrapper" id="single-wrapper">
    
    <div  id="content" class="container">

        <div class="row">
        
            <div id="primary" class="<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?> content-area">
                
                <main id="main" class="site-main" role="main">

                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        // Include the single post content template.
                        get_template_part( 'loop-templates/content', 'single' );

                        if ( is_singular( 'attachment' ) ) {
                            // Parent post navigation.
                            the_post_navigation( array(
                                'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'novapress'),
                            ) );
                        } elseif ( is_singular( 'post' ) ) {
                            // Previous/next post navigation.
                            the_post_navigation( array(
//                                'next_text' => 'Next Article', 'novapress',
//                                'prev_text' => 'Previous Article', 'novapress',
                                'next_text' => '上一篇', 'novapress',
                                'prev_text' => '下一篇', 'novapress',
                            ) );
                        }

                        // If comments are open or we have at least one comment, load up the comment template.
//                        if ( comments_open() || get_comments_number() ) {
//                            comments_template();
//                        }

                        // End of the loop.
                    endwhile;
                    ?>

                </main><!-- #main -->
                
            </div><!-- #primary -->
            
        <?php get_template_part('sidebar'); ?>

        </div><!-- .row -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>
