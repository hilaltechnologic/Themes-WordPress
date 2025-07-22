<?php
/**
 * Template part untuk menampilkan pesan ketika tidak ada konten yang ditemukan
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Educentrals
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Tidak Ada Konten', 'educentrals' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Siap untuk membuat artikel pertama Anda? <a href="%1$s">Mulai di sini</a>.', 'educentrals' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Maaf, tidak ada hasil yang sesuai dengan kata kunci pencarian Anda. Silakan coba dengan kata kunci yang berbeda.', 'educentrals' ); ?></p>
			
			<div class="search-suggestions">
				<h3><?php esc_html_e( 'Saran Pencarian:', 'educentrals' ); ?></h3>
				<ul>
					<li><?php esc_html_e( 'Periksa ejaan kata kunci Anda', 'educentrals' ); ?></li>
					<li><?php esc_html_e( 'Gunakan kata kunci yang lebih umum', 'educentrals' ); ?></li>
					<li><?php esc_html_e( 'Coba kata kunci yang berbeda', 'educentrals' ); ?></li>
					<li><?php esc_html_e( 'Gunakan kata kunci yang lebih sedikit', 'educentrals' ); ?></li>
				</ul>
			</div>
			
			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'Sepertinya kami tidak dapat menemukan apa yang Anda cari. Mungkin pencarian dapat membantu.', 'educentrals' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
		
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
		
		<div class="categories">
			<h3><?php esc_html_e( 'Kategori:', 'educentrals' ); ?></h3>
			<ul>
				<?php
				wp_list_categories( array(
					'orderby'    => 'count',
					'order'      => 'DESC',
					'show_count' => 1,
					'title_li'   => '',
					'number'     => 10,
				) );
				?>
			</ul>
		</div>
	</div><!-- .page-content -->
</section><!-- .no-results -->