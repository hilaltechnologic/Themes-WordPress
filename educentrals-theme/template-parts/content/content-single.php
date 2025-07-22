<?php
/**
 * Template part untuk menampilkan konten artikel tunggal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Educentrals
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>

		<div class="post-meta">
			<span class="post-date">
				<i class="far fa-calendar-alt"></i>
				<?php echo get_the_date(); ?>
			</span>
			<span class="post-author">
				<i class="far fa-user"></i>
				<?php the_author_posts_link(); ?>
			</span>
			<?php if ( has_category() ) : ?>
				<span class="post-categories">
					<i class="far fa-folder-open"></i>
					<?php the_category( ', ' ); ?>
				</span>
			<?php endif; ?>
			<?php if ( has_tag() ) : ?>
				<span class="post-tags">
					<i class="fas fa-tags"></i>
					<?php the_tags( '', ', ', '' ); ?>
				</span>
			<?php endif; ?>
			<span class="post-comments">
				<i class="far fa-comment"></i>
				<?php comments_popup_link( 
					esc_html__( 'Belum ada komentar', 'educentrals' ), 
					esc_html__( '1 Komentar', 'educentrals' ), 
					esc_html__( '% Komentar', 'educentrals' ) 
				); ?>
			</span>
			<?php if ( function_exists( 'educentrals_reading_time' ) ) : ?>
				<?php educentrals_reading_time(); ?>
			<?php endif; ?>
		</div><!-- .post-meta -->
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'educentrals-featured' ); ?>
		</div>
	<?php endif; ?>

	<div class="post-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'educentrals' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Halaman:', 'educentrals' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .post-content -->

	<footer class="entry-footer">
		<?php if ( function_exists( 'educentrals_social_sharing' ) ) : ?>
			<?php educentrals_social_sharing(); ?>
		<?php endif; ?>
		
		<?php if ( function_exists( 'educentrals_author_bio' ) ) : ?>
			<?php educentrals_author_bio(); ?>
		<?php endif; ?>
		
		<?php
		// Tampilkan navigasi artikel sebelumnya/selanjutnya
		get_template_part( 'template-parts/navigation/navigation', 'main' );
		?>
		
		<?php if ( function_exists( 'educentrals_related_posts' ) && get_theme_mod( 'educentrals_blog_related_posts', true ) ) : ?>
			<?php educentrals_related_posts(); ?>
		<?php endif; ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->