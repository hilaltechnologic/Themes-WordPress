<?php
/**
 * Menampilkan footer site
 *
 * @package Educentrals
 */

?>

<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="footer-widgets">
			<div class="row">
				<div class="col">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-1' ); ?>
					<?php else : ?>
						<div class="footer-widget">
							<h3 class="footer-widget-title"><?php esc_html_e( 'Tentang Kami', 'educentrals' ); ?></h3>
							<p><?php esc_html_e( 'Educentrals adalah platform pendidikan yang menyediakan berbagai konten edukasi berkualitas untuk membantu proses pembelajaran yang lebih efektif.', 'educentrals' ); ?></p>
						</div>
					<?php endif; ?>
				</div>
				
				<div class="col">
					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<?php dynamic_sidebar( 'footer-2' ); ?>
					<?php else : ?>
						<div class="footer-widget">
							<h3 class="footer-widget-title"><?php esc_html_e( 'Link Cepat', 'educentrals' ); ?></h3>
							<ul>
								<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Beranda', 'educentrals' ); ?></a></li>
								<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'Tentang Kami', 'educentrals' ); ?></a></li>
								<li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Blog', 'educentrals' ); ?></a></li>
								<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Kontak', 'educentrals' ); ?></a></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
				
				<div class="col">
					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<?php dynamic_sidebar( 'footer-3' ); ?>
					<?php else : ?>
						<div class="footer-widget">
							<h3 class="footer-widget-title"><?php esc_html_e( 'Kontak', 'educentrals' ); ?></h3>
							<ul>
								<li><i class="fas fa-map-marker-alt"></i> <?php esc_html_e( 'Jl. Pendidikan No. 123, Jakarta', 'educentrals' ); ?></li>
								<li><i class="fas fa-phone"></i> <?php esc_html_e( '+62 123 456 7890', 'educentrals' ); ?></li>
								<li><i class="fas fa-envelope"></i> <a href="mailto:info@educentrals.com">info@educentrals.com</a></li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
				
				<div class="col">
					<?php if ( is_active_sidebar( 'newsletter' ) ) : ?>
						<div class="newsletter-form">
							<?php dynamic_sidebar( 'newsletter' ); ?>
						</div>
					<?php else : ?>
						<div class="newsletter-form">
							<h3 class="newsletter-title"><?php esc_html_e( 'Berlangganan Newsletter', 'educentrals' ); ?></h3>
							<p><?php esc_html_e( 'Dapatkan update terbaru dan artikel menarik langsung ke email Anda.', 'educentrals' ); ?></p>
							<form action="#" method="post">
								<input type="email" name="email" placeholder="<?php esc_attr_e( 'Email Anda', 'educentrals' ); ?>" required>
								<button type="submit" class="btn btn-secondary"><?php esc_html_e( 'Berlangganan', 'educentrals' ); ?></button>
							</form>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		
		<div class="site-info">
			<?php if ( get_theme_mod( 'educentrals_footer_social', true ) ) : ?>
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
			<?php endif; ?>
			
			<div class="copyright">
				<?php
				$footer_copyright = get_theme_mod( 'educentrals_footer_copyright', sprintf( esc_html__( '© %1$s %2$s. Hak Cipta Dilindungi.', 'educentrals' ), date('Y'), get_bloginfo( 'name' ) ) );
				echo wp_kses_post( $footer_copyright );
				?>
			</div>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->

<?php if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) : ?>
	<script>
		jQuery(document).ready(function($) {
			$('.comment-reply-link').addClass('btn btn-sm btn-outline');
		});
	</script>
<?php endif; ?>

<a href="#" class="back-to-top">
	<i class="fas fa-arrow-up"></i>
</a>