<?php
/**
 * Template untuk menampilkan hasil pencarian
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
							<h1 class="page-title">
								<?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Hasil Pencarian untuk: %s', 'educentrals' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h1>
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
							<h2><?php esc_html_e( 'Tidak ada hasil yang ditemukan', 'educentrals' ); ?></h2>
							<p><?php esc_html_e( 'Maaf, tidak ada artikel yang sesuai dengan pencarian Anda. Silakan coba dengan kata kunci lain.', 'educentrals' ); ?></p>
							<?php get_search_form(); ?>
							
							<div class="search-suggestions">
								<h3><?php esc_html_e( 'Saran Pencarian:', 'educentrals' ); ?></h3>
								<ul>
									<li><?php esc_html_e( 'Periksa ejaan kata kunci Anda', 'educentrals' ); ?></li>
									<li><?php esc_html_e( 'Gunakan kata kunci yang lebih umum', 'educentrals' ); ?></li>
									<li><?php esc_html_e( 'Coba kata kunci yang berbeda', 'educentrals' ); ?></li>
									<li><?php esc_html_e( 'Gunakan kata kunci yang lebih sedikit', 'educentrals' ); ?></li>
								</ul>
							</div>
							
							<div class="popular-posts">
								<h3><?php esc_html_e( 'Artikel Populer:', 'educentrals' ); ?></h3>
								<ul>
									<?php
									$popular_posts = new WP_Query( array(
										'posts_per_page' => 5,
										'meta_key'       => 'post_views_count',
										'orderby'        => 'meta_value_num',
										'order'          => 'DESC',
									) );
									
									if ( $popular_posts->have_posts() ) :
										while ( $popular_posts->have_posts() ) :
											$popular_posts->the_post();
											echo '<li><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></li>';
										endwhile;
										wp_reset_postdata();
									else :
										// Jika tidak ada post views, tampilkan post terbaru
										$recent_posts = wp_get_recent_posts( array(
											'numberposts' => 5,
											'post_status' => 'publish',
										) );
										
										foreach ( $recent_posts as $recent ) {
											echo '<li><a href="' . esc_url( get_permalink( $recent['ID'] ) ) . '">' . esc_html( $recent['post_title'] ) . '</a></li>';
										}
										wp_reset_postdata();
									endif;
									?>
								</ul>
							</div>
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