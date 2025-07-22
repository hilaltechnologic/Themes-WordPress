<?php
/**
 * Header template untuk tema Educentrals
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Educentrals
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'educentrals' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="site-header-inner">
				<div class="site-branding">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					else :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
						$educentrals_description = get_bloginfo( 'description', 'display' );
						if ( $educentrals_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo $educentrals_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<i class="fas fa-bars"></i>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'main-menu',
							'container'      => false,
							'fallback_cb'    => function() {
								echo '<ul class="main-menu">';
								echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Buat Menu', 'educentrals' ) . '</a></li>';
								echo '</ul>';
							},
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->

	<?php
	// Tampilkan breadcrumbs kecuali di halaman depan
	if ( ! is_front_page() ) {
		educentrals_breadcrumbs();
	}
	?>

	<?php
	// Tampilkan slider hanya di halaman depan
	if ( is_front_page() ) :
		$slider_query = educentrals_get_sliders();
		if ( $slider_query->have_posts() ) :
	?>
	<section class="hero-section">
		<div class="container">
			<div class="hero-slider">
				<?php
				$slide_count = 0;
				while ( $slider_query->have_posts() ) :
					$slider_query->the_post();
					$slide_count++;
					$button_text = get_post_meta( get_the_ID(), '_slider_button_text', true );
					$button_url = get_post_meta( get_the_ID(), '_slider_button_url', true );
					$active_class = ( $slide_count === 1 ) ? ' active' : '';
				?>
				<div class="slider-item<?php echo esc_attr( $active_class ); ?>" data-slide="<?php echo esc_attr( $slide_count ); ?>">
					<div class="row">
						<div class="col hero-content">
							<h2 class="hero-title"><?php the_title(); ?></h2>
							<div class="hero-description">
								<?php the_content(); ?>
							</div>
							<?php if ( ! empty( $button_text ) && ! empty( $button_url ) ) : ?>
							<div class="hero-buttons">
								<a href="<?php echo esc_url( $button_url ); ?>" class="btn btn-secondary"><?php echo esc_html( $button_text ); ?></a>
							</div>
							<?php endif; ?>
						</div>
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="col">
							<div class="hero-image">
								<?php the_post_thumbnail( 'large' ); ?>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php
				endwhile;
				wp_reset_postdata();
				?>

				<?php if ( $slide_count > 1 ) : ?>
				<div class="slider-nav">
					<?php for ( $i = 1; $i <= $slide_count; $i++ ) : ?>
					<div class="slider-dot<?php echo ( $i === 1 ) ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $i ); ?>"></div>
					<?php endfor; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
		endif;
	endif;
	?>