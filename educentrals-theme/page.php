<?php
/**
 * Template untuk menampilkan halaman statis
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Educentrals
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<div class="row">
				<div class="content-area col">

					<?php
					while ( have_posts() ) :
						the_post();
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
						<header class="entry-header">
							<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
						</header><!-- .entry-header -->

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="page-thumbnail">
								<?php the_post_thumbnail( 'educentrals-featured' ); ?>
							</div>
						<?php endif; ?>

						<div class="page-content">
							<?php
							the_content();

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Halaman:', 'educentrals' ),
									'after'  => '</div>',
								)
							);
							?>
						</div><!-- .page-content -->

						<?php if ( get_edit_post_link() ) : ?>
							<footer class="entry-footer">
								<?php
								edit_post_link(
									sprintf(
										wp_kses(
											/* translators: %s: Name of current post. Only visible to screen readers */
											__( 'Edit <span class="screen-reader-text">%s</span>', 'educentrals' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										wp_kses_post( get_the_title() )
									),
									'<span class="edit-link">',
									'</span>'
								);
								?>
							</footer><!-- .entry-footer -->
						<?php endif; ?>
					</article><!-- #post-<?php the_ID(); ?> -->

					<?php
						// Jika komentar terbuka atau sudah ada komentar, tampilkan area komentar
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</div><!-- .content-area -->

				<?php 
				// Tampilkan sidebar hanya jika halaman tidak menggunakan template full-width
				if ( ! is_page_template( 'templates/full-width.php' ) ) :
					get_sidebar();
				endif;
				?>
			</div><!-- .row -->
		</div><!-- .container -->
	</main><!-- #main -->

<?php
get_footer();