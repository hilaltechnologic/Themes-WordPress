<?php
/**
 * Footer template untuk tema Educentrals
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
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
				<div class="social-links">
					<a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
					<a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
					<a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
					<a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
				</div>
				
				<div class="copyright">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( '© %1$s %2$s. Hak Cipta Dilindungi.', 'educentrals' ), date('Y'), get_bloginfo( 'name' ) );
					?>
				</div>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNavigation = document.querySelector('.main-navigation');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            mainNavigation.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', mainNavigation.classList.contains('active'));
        });
    }
    
    // Hero Slider
    const sliderDots = document.querySelectorAll('.slider-dot');
    const sliderItems = document.querySelectorAll('.slider-item');
    
    if (sliderDots.length > 0) {
        sliderDots.forEach(dot => {
            dot.addEventListener('click', function() {
                const slideIndex = this.getAttribute('data-slide');
                
                // Remove active class from all dots and slides
                sliderDots.forEach(d => d.classList.remove('active'));
                sliderItems.forEach(item => item.classList.remove('active'));
                
                // Add active class to current dot and slide
                this.classList.add('active');
                document.querySelector(`.slider-item[data-slide="${slideIndex}"]`).classList.add('active');
            });
        });
        
        // Auto rotate slides every 5 seconds
        let currentSlide = 1;
        const totalSlides = sliderDots.length;
        
        setInterval(() => {
            currentSlide = currentSlide >= totalSlides ? 1 : currentSlide + 1;
            
            // Remove active class from all dots and slides
            sliderDots.forEach(d => d.classList.remove('active'));
            sliderItems.forEach(item => item.classList.remove('active'));
            
            // Add active class to current dot and slide
            document.querySelector(`.slider-dot[data-slide="${currentSlide}"]`).classList.add('active');
            document.querySelector(`.slider-item[data-slide="${currentSlide}"]`).classList.add('active');
        }, 5000);
    }
});
</script>

</body>
</html>