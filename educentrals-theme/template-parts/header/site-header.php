<?php
/**
 * Menampilkan header site
 *
 * @package Educentrals
 */

?>

<header id="masthead" class="site-header">
	<div class="container">
		<div class="site-header-inner">
			<?php get_template_part( 'template-parts/header/site-branding' ); ?>
			<?php get_template_part( 'template-parts/header/site-nav' ); ?>
			
			<?php if ( get_theme_mod( 'educentrals_header_search', true ) ) : ?>
			<div class="header-search">
				<button class="search-toggle" aria-expanded="false">
					<i class="fas fa-search"></i>
				</button>
				<div class="search-form-wrapper">
					<?php get_search_form(); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</header><!-- #masthead -->