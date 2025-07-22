<?php
/**
 * Menampilkan navigasi antar post
 *
 * @package Educentrals
 */

$educentrals_prev = get_previous_post();
$educentrals_next = get_next_post();

if ( ! $educentrals_prev && ! $educentrals_next ) {
	return;
}
?>

<nav class="post-navigation">
	<h2 class="screen-reader-text"><?php esc_html_e( 'Navigasi Artikel', 'educentrals' ); ?></h2>
	<div class="nav-links">
		<?php if ( $educentrals_prev ) : ?>
			<div class="nav-previous">
				<a href="<?php echo esc_url( get_permalink( $educentrals_prev->ID ) ); ?>" rel="prev">
					<div class="nav-title-icon-wrapper">
						<i class="fas fa-chevron-left"></i>
					</div>
					<div class="nav-content">
						<span class="nav-subtitle"><?php esc_html_e( 'Artikel Sebelumnya', 'educentrals' ); ?></span>
						<span class="nav-title"><?php echo esc_html( get_the_title( $educentrals_prev->ID ) ); ?></span>
					</div>
				</a>
			</div>
		<?php endif; ?>

		<?php if ( $educentrals_next ) : ?>
			<div class="nav-next">
				<a href="<?php echo esc_url( get_permalink( $educentrals_next->ID ) ); ?>" rel="next">
					<div class="nav-content">
						<span class="nav-subtitle"><?php esc_html_e( 'Artikel Selanjutnya', 'educentrals' ); ?></span>
						<span class="nav-title"><?php echo esc_html( get_the_title( $educentrals_next->ID ) ); ?></span>
					</div>
					<div class="nav-title-icon-wrapper">
						<i class="fas fa-chevron-right"></i>
					</div>
				</a>
			</div>
		<?php endif; ?>
	</div>
</nav>