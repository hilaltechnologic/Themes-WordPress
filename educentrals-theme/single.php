<?php
/**
 * Template untuk menampilkan artikel tunggal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

					<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
						<header class="entry-header">
							<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>

							<div class="post-meta">
								<span class="post-date">
									<i class="far fa-calendar-alt"></i>
									<?php echo get_the_date(); ?>
								</span>
								<span class="post-author">
									<i class="far fa-user"></i>
									<?php the_author_posts_link(); ?>
								</span>
								<?php if ( has_category() ) : ?>
									<span class="post-categories">
										<i class="far fa-folder-open"></i>
										<?php the_category( ', ' ); ?>
									</span>
								<?php endif; ?>
								<?php if ( has_tag() ) : ?>
									<span class="post-tags">
										<i class="fas fa-tags"></i>
										<?php the_tags( '', ', ', '' ); ?>
									</span>
								<?php endif; ?>
								<span class="post-comments">
									<i class="far fa-comment"></i>
									<?php comments_popup_link( 
										esc_html__( 'Belum ada komentar', 'educentrals' ), 
										esc_html__( '1 Komentar', 'educentrals' ), 
										esc_html__( '% Komentar', 'educentrals' ) 
									); ?>
								</span>
							</div><!-- .post-meta -->
						</header><!-- .entry-header -->

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="post-thumbnail">
								<?php the_post_thumbnail( 'educentrals-featured' ); ?>
							</div>
						<?php endif; ?>

						<div class="post-content">
							<?php
							the_content(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'educentrals' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									wp_kses_post( get_the_title() )
								)
							);

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Halaman:', 'educentrals' ),
									'after'  => '</div>',
								)
							);
							?>
						</div><!-- .post-content -->

						<footer class="entry-footer">
							<?php
							// Tampilkan informasi penulis jika diaktifkan
							$author_bio = get_the_author_meta( 'description' );
							if ( $author_bio ) :
							?>
							<div class="author-bio">
								<div class="author-avatar">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
								</div>
								<div class="author-info">
									<h3 class="author-title"><?php printf( esc_html__( 'Tentang %s', 'educentrals' ), get_the_author() ); ?></h3>
									<div class="author-description">
										<?php echo wpautop( $author_bio ); ?>
									</div>
									<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
										<?php printf( esc_html__( 'Lihat semua artikel oleh %s', 'educentrals' ), get_the_author() ); ?>
									</a>
								</div>
							</div>
							<?php endif; ?>

							<?php
							// Tampilkan navigasi artikel sebelumnya/selanjutnya
							the_post_navigation(
								array(
									'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Artikel Sebelumnya:', 'educentrals' ) . '</span> <span class="nav-title">%title</span>',
									'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Artikel Selanjutnya:', 'educentrals' ) . '</span> <span class="nav-title">%title</span>',
								)
							);
							?>
						</footer><!-- .entry-footer -->
					</article><!-- #post-<?php the_ID(); ?> -->

					<?php
						// Jika komentar terbuka atau sudah ada komentar, tampilkan area komentar
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</div><!-- .content-area -->

				<?php get_sidebar(); ?>
			</div><!-- .row -->
		</div><!-- .container -->
	</main><!-- #main -->

<?php
get_footer();