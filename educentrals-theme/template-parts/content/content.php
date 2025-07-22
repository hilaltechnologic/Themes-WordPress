<?php
/**
 * Template part untuk menampilkan konten post di loop
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Educentrals
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'educentrals-thumbnail' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php
		the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) :
			?>
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
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="post-excerpt">
		<?php the_excerpt(); ?>
	</div><!-- .post-excerpt -->

	<footer class="entry-footer">
		<a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Baca Selengkapnya', 'educentrals' ); ?> <i class="fas fa-arrow-right"></i></a>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->