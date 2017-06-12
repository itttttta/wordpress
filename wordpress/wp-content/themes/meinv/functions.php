<?php
/**
 * Created by PhpStorm.
 * User: wangda
 * Date: 2017/6/9
 * Time: 上午10:26
 */



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
//function hello_world() {
//    // 单行注释
//    // 再注释一行
//    echo "<p>Hello Function!</p>";
//}
//add_action( 'wp_enqueue_scripts', 'hello_world' );



function meinv_setup() {
    wp_register_style( 'style', get_template_directory_uri().'/style.css');
//    wp_enqueue_style('style',get_stylesheet_uri());
}
add_action( 'after_setup_theme', 'meinv_setup' );

function meinv_scripts(){
    wp_enqueue_style( 'meinv-style', get_stylesheet_uri() );
}
add_action('wp_enqueue_scripts','meinv_scripts');
/*

*注册css 文件

*/
//wp_register_style( 'style', get_template_directory_uri().'/style.css',false,25);
/*

* 缩略图

*/

function dm_the_thumbnail() {

    global $post;

    // 判断该文章是否设置的缩略图，如果有则直接显示

    if ( has_post_thumbnail() ) {

        echo '<a href="'.get_permalink().'" title="阅读全文">';

        the_post_thumbnail('thumbnail');

        echo '</a>';

    } else { //如果文章没有设置缩略图，则查找文章内是否包含图片

        $content = $post->post_content;

        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);

        $n = count($strResult[1]);

        if($n > 0){ // 如果文章内包含有图片，就用第一张图片做为缩略图

            echo '<a href="'.get_permalink().'" title="阅读全文"><img src="'.$strResult[1][0].'" alt="缩略图" /></a>';

        }else { // 如果文章内没有图片，则用默认的图片。

            echo '<a href="'.get_permalink().'" title="阅读全文"><img src="'.get_bloginfo('template_url').'/imgs/default_thumbnail.jpg" alt="缩略图" /></a>';

        }

    }

}
//add_action( 'after_setup_theme', 'dm_the_thumbnail' );
