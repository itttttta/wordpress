<?php
/**
 * understrap functions and definitions
 *
 * @package understrap
 */

/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 *
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom comments.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
* Load custom WordPress nav walker.
*/
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
* Load WooCommerce functions.
*/
require get_template_directory() . '/inc/woocommerce.php';

/**
* TGM Plugin Activation.
*/
require get_template_directory() . '/inc/tgm-plugin-activation.php';

/**
* Upgrade Notice
*/
require get_template_directory() . '/inc/upgrade/class-customize.php';

/**
* Theme welcome page
*/
require get_template_directory() . '/inc/welcome/theme-welcome.php';

/*

* 缩略图

*/

function dm_the_thumbnail() {

    global $post;

    // 判断该文章是否设置的缩略图，如果有则直接显示

    if ( has_post_thumbnail() ) {

        echo '<a href="'.get_permalink().'" title="阅读全文">';

        the_post_thumbnail( $post->ID, 'novapress-square',array('class'=>'img-responsive'));

        echo '</a>';

    } else { //如果文章没有设置缩略图，则查找文章内是否包含图片

        $content = $post->post_content;

        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);

        $n = count($strResult[1]);

        if($n > 0){ // 如果文章内包含有图片，就用第一张图片做为缩略图

            echo '<a href="'.get_permalink().'" title="阅读全文"><img src="'.$strResult[1][0].'" alt="缩略图" style="width: 60%;height: auto"/></a>';

        }else { // 如果文章内没有图片，则用默认的图片。

            echo '<a href="'.get_permalink().'" title="阅读全文"><img src="'.get_bloginfo('template_url').'/imgs/default_thumbnail.jpg" alt="缩略图" /></a>';

        }

    }

}
add_action( 'after_setup_theme', 'dm_the_thumbnail' );


//每页显示文章数
function blog_posts_per_page($query) {
    if (is_home()) {
        $query->set('posts_per_page', 12);
    }
    if (is_category()) {
        $query->set('posts_per_page', 20);
    }
    if (is_tag()) {
        $query->set('posts_per_page', 30);
    } //endif
} //function

add_action('pre_get_posts', 'blog_posts_per_page');


//取得文章的阅读次数
function post_views($before = '点击 ', $after = ' 次', $echo = 1)
{
    global $post;
    $post_ID = $post->ID;
    $views = (int)get_post_meta($post_ID, 'views', true);
    if ($echo) echo $before, number_format($views), $after;
    else return $views;
}
function record_visitors()
{
    if (is_singular()) {
        global $post;
        $post_ID = $post->ID;
        if($post_ID) {
            $post_views = (int)get_post_meta($post_ID, 'views', true);
            if(!update_post_meta($post_ID, 'views', ($post_views+1))) {
                add_post_meta($post_ID, 'views', 1, true);
            }
        }
    }
}
add_action('wp_head', 'record_visitors');