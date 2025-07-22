<?php
/**
 * Template Name: Full Width
 * Template Post Type: page, post
 *
 * Template untuk menampilkan halaman tanpa sidebar dengan lebar penuh
 *
 * @package Educentrals
 */

get_header();
?>

	<main id="primary" class="site-main full-width">
		<div class="container">
			<?php
			while ( have_posts() ) :
				the_post();

				if ( is_page() ) {
					get_template_part( 'template-parts/content/content', 'page' );
				} else {
					get_template_part( 'template-parts/content/content', 'single' );
				}

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div><!-- .container -->
	</main><!-- #main -->

<?php
get_footer();