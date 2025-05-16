<?php
/**
 * Template Name: Canvas
 * Template Post Type: mp-event
 */
get_header();
?>

    <main id="primary" class="site-main canvas">

        <?php
        while ( have_posts() ) :
            the_post();

            do_action( 'gutenix_before_single_post' );

            $classes = implode( ' ', get_post_class() );

            echo '<article id="post-' . esc_attr( get_the_ID() ) . '" class="' . esc_attr( $classes ) . '">';

            the_content();

            echo '</article>';

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->

<?php
get_footer();