<?php
/**
 * Menampilkan navigasi utama site
 *
 * @package Educentrals
 */

?>

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