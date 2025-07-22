<?php
/**
 * Template untuk menampilkan sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Educentrals
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	
	<?php if ( ! is_active_sidebar( 'sidebar-1' ) ) : ?>
		<!-- Widget Default jika tidak ada widget yang ditambahkan -->
		<section class="widget widget_search">
			<h2 class="widget-title"><?php esc_html_e( 'Pencarian', 'educentrals' ); ?></h2>
			<?php get_search_form(); ?>
		</section>
		
		<section class="widget widget_categories">
			<h2 class="widget-title"><?php esc_html_e( 'Kategori', 'educentrals' ); ?></h2>
			<ul>
				<?php wp_list_categories( array(
					'title_li' => '',
					'number'   => 10,
				) ); ?>
			</ul>
		</section>
		
		<section class="widget widget_recent_entries">
			<h2 class="widget-title"><?php esc_html_e( 'Artikel Terbaru', 'educentrals' ); ?></h2>
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
		</section>
		
		<section class="widget widget_tag_cloud">
			<h2 class="widget-title"><?php esc_html_e( 'Tag', 'educentrals' ); ?></h2>
			<div class="tagcloud">
				<?php wp_tag_cloud( array(
					'number'  => 20,
					'orderby' => 'count',
					'order'   => 'DESC',
				) ); ?>
			</div>
		</section>
		
		<section class="widget widget_archive">
			<h2 class="widget-title"><?php esc_html_e( 'Arsip', 'educentrals' ); ?></h2>
			<ul>
				<?php wp_get_archives( array(
					'type'  => 'monthly',
					'limit' => 12,
				) ); ?>
			</ul>
		</section>
	<?php endif; ?>
	
	<!-- Newsletter Widget -->
	<?php if ( ! is_active_sidebar( 'newsletter' ) ) : ?>
		<section class="widget newsletter-widget">
			<div class="newsletter-form">
				<h3 class="newsletter-title"><?php esc_html_e( 'Berlangganan Newsletter', 'educentrals' ); ?></h3>
				<p><?php esc_html_e( 'Dapatkan update terbaru dan artikel menarik langsung ke email Anda.', 'educentrals' ); ?></p>
				<form action="#" method="post">
					<input type="email" name="email" placeholder="<?php esc_attr_e( 'Email Anda', 'educentrals' ); ?>" required>
					<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Berlangganan', 'educentrals' ); ?></button>
				</form>
			</div>
		</section>
	<?php else : ?>
		<section class="widget newsletter-widget">
			<div class="newsletter-form">
				<?php dynamic_sidebar( 'newsletter' ); ?>
			</div>
		</section>
	<?php endif; ?>
</aside><!-- #secondary -->