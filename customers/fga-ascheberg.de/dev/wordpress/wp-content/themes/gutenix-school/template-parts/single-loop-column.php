<?php
/**
 * Template part for displaying single post content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gutenix
 */

while (have_posts()) : the_post();

    do_action('gutenix_before_single_post');

    $classes = implode(' ', get_post_class());

    echo '<article id="post-' . esc_attr(get_the_ID()) . '" class="22' . esc_attr($classes) . '">';

    ?>
    <div class="content-column-wrap">
        <div class="content-column-main">
            <?php the_content(); ?>
        </div>
        <div class="content-column-list">
            <?php do_action('gutenix_school_after_column_content') ?>
        </div>
    </div>

    <?php

    echo '</article>';

    do_action('gutenix_after_single_post');

endwhile; // End of the loop.
