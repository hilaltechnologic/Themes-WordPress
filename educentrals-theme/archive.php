<?php
/**
 * Template untuk menampilkan halaman arsip
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

					<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->

						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
							?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="post-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'educentrals-thumbnail' ); ?>
										</a>
									</div>
								<?php endif; ?>

								<header class="entry-header">
									<?php
									the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

									if ( 'post' === get_post_type() ) :
										?>
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
											<span class="post-comments">
												<i class="far fa-comment"></i>
												<?php comments_popup_link( 
													esc_html__( 'Belum ada komentar', 'educentrals' ), 
													esc_html__( '1 Komentar', 'educentrals' ), 
													esc_html__( '% Komentar', 'educentrals' ) 
												); ?>
											</span>
										</div><!-- .post-meta -->
									<?php endif; ?>
								</header><!-- .entry-header -->

								<div class="post-excerpt">
									<?php the_excerpt(); ?>
								</div><!-- .post-excerpt -->
							</article><!-- #post-<?php the_ID(); ?> -->
							
						<?php
						endwhile;

						// Pagination
						educentrals_pagination();

					else :
						?>
						<div class="no-results">
							<h2><?php esc_html_e( 'Tidak ada artikel yang ditemukan', 'educentrals' ); ?></h2>
							<p><?php esc_html_e( 'Maaf, tidak ada artikel yang sesuai dengan pencarian Anda.', 'educentrals' ); ?></p>
							<?php get_search_form(); ?>
						</div>
						<?php
					endif;
					?>

				</div><!-- .content-area -->

				<?php get_sidebar(); ?>
			</div><!-- .row -->
		</div><!-- .container -->
	</main><!-- #main -->

<?php
get_footer();