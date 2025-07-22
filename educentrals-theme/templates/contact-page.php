<?php
/**
 * Template Name: Halaman Kontak
 * Template Post Type: page
 *
 * Template untuk halaman kontak dengan form kontak
 *
 * @package Educentrals
 */

get_header();
?>

	<main id="primary" class="site-main contact-page">
		<div class="container">
			<?php
			while ( have_posts() ) :
				the_post();
			?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class('contact-page-content'); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="page-thumbnail">
							<?php the_post_thumbnail( 'educentrals-featured' ); ?>
						</div>
					<?php endif; ?>

					<div class="page-content">
						<?php the_content(); ?>
					</div><!-- .page-content -->

					<div class="contact-container">
						<div class="row">
							<div class="col">
								<div class="contact-info">
									<h3><?php esc_html_e( 'Informasi Kontak', 'educentrals' ); ?></h3>
									
									<div class="contact-item">
										<div class="contact-icon">
											<i class="fas fa-map-marker-alt"></i>
										</div>
										<div class="contact-text">
											<h4><?php esc_html_e( 'Alamat', 'educentrals' ); ?></h4>
											<p><?php echo esc_html( get_theme_mod( 'educentrals_contact_address', 'Jl. Pendidikan No. 123, Jakarta' ) ); ?></p>
										</div>
									</div>
									
									<div class="contact-item">
										<div class="contact-icon">
											<i class="fas fa-phone"></i>
										</div>
										<div class="contact-text">
											<h4><?php esc_html_e( 'Telepon', 'educentrals' ); ?></h4>
											<p><?php echo esc_html( get_theme_mod( 'educentrals_contact_phone', '+62 123 456 7890' ) ); ?></p>
										</div>
									</div>
									
									<div class="contact-item">
										<div class="contact-icon">
											<i class="fas fa-envelope"></i>
										</div>
										<div class="contact-text">
											<h4><?php esc_html_e( 'Email', 'educentrals' ); ?></h4>
											<p><a href="mailto:<?php echo esc_attr( get_theme_mod( 'educentrals_contact_email', 'info@educentrals.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'educentrals_contact_email', 'info@educentrals.com' ) ); ?></a></p>
										</div>
									</div>
									
									<div class="contact-item">
										<div class="contact-icon">
											<i class="fas fa-clock"></i>
										</div>
										<div class="contact-text">
											<h4><?php esc_html_e( 'Jam Operasional', 'educentrals' ); ?></h4>
											<p><?php echo esc_html( get_theme_mod( 'educentrals_contact_hours', 'Senin - Jumat: 08:00 - 17:00' ) ); ?></p>
										</div>
									</div>
									
									<?php if ( get_theme_mod( 'educentrals_footer_social', true ) ) : ?>
										<div class="contact-social">
											<h4><?php esc_html_e( 'Ikuti Kami', 'educentrals' ); ?></h4>
											<div class="social-links">
												<?php if ( $facebook = get_theme_mod( 'educentrals_facebook_url' ) ) : ?>
													<a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
												<?php endif; ?>
												
												<?php if ( $twitter = get_theme_mod( 'educentrals_twitter_url' ) ) : ?>
													<a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
												<?php endif; ?>
												
												<?php if ( $instagram = get_theme_mod( 'educentrals_instagram_url' ) ) : ?>
													<a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
												<?php endif; ?>
												
												<?php if ( $youtube = get_theme_mod( 'educentrals_youtube_url' ) ) : ?>
													<a href="<?php echo esc_url( $youtube ); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
												<?php endif; ?>
												
												<?php if ( $linkedin = get_theme_mod( 'educentrals_linkedin_url' ) ) : ?>
													<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
												<?php endif; ?>
												
												<?php if ( ! $facebook && ! $twitter && ! $instagram && ! $youtube && ! $linkedin ) : ?>
													<a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
													<a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
													<a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
													<a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
							
							<div class="col">
								<div class="contact-form">
									<h3><?php esc_html_e( 'Kirim Pesan', 'educentrals' ); ?></h3>
									
									<?php
									// Cek apakah plugin Contact Form 7 aktif
									if ( function_exists( 'wpcf7_contact_form' ) ) {
										// Tampilkan form kontak dari Contact Form 7 jika ada
										$contact_form_id = get_post_meta( get_the_ID(), '_contact_form_id', true );
										
										if ( $contact_form_id ) {
											echo do_shortcode( '[contact-form-7 id="' . esc_attr( $contact_form_id ) . '"]' );
										} else {
											// Tampilkan pesan jika tidak ada form yang dipilih
											echo '<div class="alert alert-info">' . esc_html__( 'Silakan pilih form kontak di pengaturan halaman.', 'educentrals' ) . '</div>';
										}
									} else {
										// Tampilkan form kontak default jika Contact Form 7 tidak aktif
										?>
										<form id="contact-form" class="default-contact-form" action="#" method="post">
											<div class="form-group">
												<label for="name"><?php esc_html_e( 'Nama', 'educentrals' ); ?> <span class="required">*</span></label>
												<input type="text" id="name" name="name" class="form-control" required>
											</div>
											
											<div class="form-group">
												<label for="email"><?php esc_html_e( 'Email', 'educentrals' ); ?> <span class="required">*</span></label>
												<input type="email" id="email" name="email" class="form-control" required>
											</div>
											
											<div class="form-group">
												<label for="subject"><?php esc_html_e( 'Subjek', 'educentrals' ); ?> <span class="required">*</span></label>
												<input type="text" id="subject" name="subject" class="form-control" required>
											</div>
											
											<div class="form-group">
												<label for="message"><?php esc_html_e( 'Pesan', 'educentrals' ); ?> <span class="required">*</span></label>
												<textarea id="message" name="message" class="form-control" rows="5" required></textarea>
											</div>
											
											<div class="form-group">
												<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Kirim Pesan', 'educentrals' ); ?></button>
											</div>
										</form>
										
										<div class="form-message"></div>
										
										<script>
											jQuery(document).ready(function($) {
												$('#contact-form').on('submit', function(e) {
													e.preventDefault();
													
													// Di sini Anda bisa menambahkan kode untuk mengirim form
													// Untuk demo, kita hanya tampilkan pesan sukses
													$('.form-message').html('<div class="alert alert-success"><?php esc_html_e( 'Terima kasih! Pesan Anda telah dikirim.', 'educentrals' ); ?></div>');
													$(this).find('input, textarea').val('');
												});
											});
										</script>
										<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
					
					<?php if ( $map_embed = get_post_meta( get_the_ID(), '_contact_map_embed', true ) ) : ?>
						<div class="contact-map">
							<h3><?php esc_html_e( 'Lokasi Kami', 'educentrals' ); ?></h3>
							<div class="map-container">
								<?php echo $map_embed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						</div>
					<?php endif; ?>
				</article><!-- #post-<?php the_ID(); ?> -->
				
			<?php endwhile; ?>
		</div><!-- .container -->
	</main><!-- #main -->

<?php
get_footer();