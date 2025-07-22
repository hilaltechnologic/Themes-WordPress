<?php
/**
 * Menampilkan branding site (logo dan judul)
 *
 * @package Educentrals
 */

?>

<div class="site-branding">
	<?php
	if ( has_custom_logo() ) :
		the_custom_logo();
	else :
		?>
		<div class="site-title-wrapper">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
			
			<?php
			$educentrals_description = get_bloginfo( 'description', 'display' );
			if ( $educentrals_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $educentrals_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div><!-- .site-branding -->