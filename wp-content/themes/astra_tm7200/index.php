<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if (astra_page_layout() === 'left-sidebar') { ?>

	<?php get_sidebar(); ?>

<?php } ?>

<div id="primary" <?php astra_primary_class(); ?>>

	<?php astra_primary_content_top(); ?>

	<div class="entries">
		<?php
		$args = [
			'post_type' => 'post',
			'post_status' => 'publish',
			// 'posts_per_page' => 10,
			// 'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
		];
		$query = new WP_Query($args);

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
		?>
				<!-- <a href="<?php //the_permalink(); 
								?>">
					<?php //the_post_thumbnail('thumbnail'); 
					?>
				</a> -->
				<a class="entry" href="<?php the_permalink(); ?>">
					<?php
					echo '<h2>' . get_the_title() . '</h2>';
					echo '<p>' . get_the_excerpt() . '</p>';
					?>
				</a>
		<?php
			}
			wp_reset_postdata();
		} else {
			echo '<p>No posts found</p>';
		}
		?>
	</div>

	<?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if (astra_page_layout() === 'right-sidebar') { ?>

	<?php get_sidebar(); ?>

<?php } ?>

<?php get_footer(); ?>