<?php
/**
 * Template untuk menampilkan halaman error 404
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Educentrals
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! Halaman tidak ditemukan.', 'educentrals' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'Sepertinya halaman yang Anda cari tidak ada. Mungkin coba pencarian?', 'educentrals' ); ?></p>

					<?php get_search_form(); ?>

					<div class="error-suggestions">
						<div class="row">
							<div class="col">
								<h2><?php esc_html_e( 'Artikel Terbaru', 'educentrals' ); ?></h2>
								<ul>
									<?php
									$recent_posts = wp_get_recent_posts( array(
										'numberposts' => 5,
										'post_status' => 'publish',
									) );
									
									foreach ( $recent_posts as $recent ) {
										echo '<li><a href="' . esc_url( get_permalink( $recent['ID'] ) ) . '">' . esc_html( $recent['post_title'] ) . '</a></li>';
									}
									wp_reset_postdata();
									?>
								</ul>
							</div>
							
							<div class="col">
								<h2><?php esc_html_e( 'Kategori Populer', 'educentrals' ); ?></h2>
								<ul>
									<?php
									wp_list_categories( array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 5,
									) );
									?>
								</ul>
							</div>
						</div>
					</div>

					<div class="back-home">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
							<i class="fas fa-home"></i> <?php esc_html_e( 'Kembali ke Beranda', 'educentrals' ); ?>
						</a>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div><!-- .container -->
	</main><!-- #main -->

<?php
get_footer();