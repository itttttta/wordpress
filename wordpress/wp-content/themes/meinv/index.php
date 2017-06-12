<?php
/**
 * Created by PhpStorm.
 * User: wangda
 * Date: 2017/6/7
 * Time: 下午5:56
 */
?>
<?php get_header(); ?>
<!---->
<!---->
<!---->
<?php //if (have_posts()) : while (have_posts()) : the_post(); ?>
<!--    <h3 class="title"><a href="--><?php //the_permalink(); ?><!--" rel="bookmark">--><?php //the_title(); ?><!--</a></h3>-->
<!--    <div class='post-thumb' href="javascript:ResizeImages">-->
<!--        --><?php //dm_the_thumbnail(); ?>
<!--    </div>-->
<?php //endwhile; ?>
<?php //else : ?>
<!--    输出找不到文章提示-->
<?php //endif; ?>
<!---->

<p class="text" >hello wangda</p>

<?php get_footer(); ?>
