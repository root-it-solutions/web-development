<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gutenix
 */
?>

<?php do_action( 'gutenix_before_loop_post' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="posts-list__item-content clear">
		
		<?php
			// Get elements
			$elements = apply_filters( 'gutenix_posts_list_order', array( 'title', 'meta', 'featured_image', 'excerpt', 'entry_footer' ) );

			// Loop through elements
			foreach ( $elements as $element ) {

				// Title
				if ( 'title' == $element ) { ?>
					
					<header class="entry-header"><?php
						the_title( '<h2 class="entry-title">' . gutenix_get_sticky_label() . '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					?></header><!-- .entry-header -->

				<?php }

				// Meta
				if ( 'meta' == $element ) {

					if ( 'post' === get_post_type() ) :
					gutenix_entry_meta(
						array(
							'divider' => '<span class="meta-divider">&#8226;</span>',
						),
						array(
							'gutenix_post_cats'     => array(),
							'gutenix_posted_by'     => array(),
							'gutenix_posted_on'     => array(),
							'gutenix_post_comments' => array(),
						)
					);
					endif;

				}



				// Content
				if ( 'excerpt' == $element ) {
					
					gutenix_post_excerpt();

				}

				// Read more button
				if ( 'entry_footer' == $element ) {

					gutenix_entry_meta(
						array(
							'before' => '<footer class="entry-footer">',
							'after'  => '</footer><!-- .entry-footer -->',
						),
						array(
							'gutenix_post_tags'   => array(),
							'gutenix_post_button' => array(),
						)
					);
				}

			}
		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
