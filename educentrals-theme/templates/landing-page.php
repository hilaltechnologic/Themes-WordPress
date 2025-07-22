<?php
/**
 * Template Name: Landing Page
 * Template Post Type: page
 *
 * Template untuk halaman landing dengan layout khusus
 *
 * @package Educentrals
 */

get_header();
?>

	<main id="primary" class="site-main landing-page">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class('landing-page-content'); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="landing-hero" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>);">
						<div class="container">
							<div class="landing-hero-content">
								<h1 class="landing-title"><?php the_title(); ?></h1>
								<?php if ( $subtitle = get_post_meta( get_the_ID(), '_landing_subtitle', true ) ) : ?>
									<p class="landing-subtitle"><?php echo esc_html( $subtitle ); ?></p>
								<?php endif; ?>
								
								<?php if ( $button_text = get_post_meta( get_the_ID(), '_landing_button_text', true ) ) : ?>
									<div class="landing-cta">
										<a href="<?php echo esc_url( get_post_meta( get_the_ID(), '_landing_button_url', true ) ); ?>" class="btn btn-primary btn-lg"><?php echo esc_html( $button_text ); ?></a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php else : ?>
					<header class="entry-header">
						<div class="container">
							<?php the_title( '<h1 class="landing-title">', '</h1>' ); ?>
							<?php if ( $subtitle = get_post_meta( get_the_ID(), '_landing_subtitle', true ) ) : ?>
								<p class="landing-subtitle"><?php echo esc_html( $subtitle ); ?></p>
							<?php endif; ?>
						</div>
					</header>
				<?php endif; ?>

				<div class="landing-content">
					<div class="container">
						<?php the_content(); ?>
					</div>
				</div>
			</article>

		<?php endwhile; ?>
	</main><!-- #main -->

<?php
get_footer();