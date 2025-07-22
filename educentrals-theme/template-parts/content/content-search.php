<?php
/**
 * Template part untuk menampilkan hasil pencarian
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Educentrals
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-result'); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
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
		</div><!-- .post-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'educentrals-thumbnail' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="post-excerpt">
		<?php the_excerpt(); ?>
	</div><!-- .post-excerpt -->

	<footer class="entry-footer">
		<?php
		$post_type = get_post_type();
		$post_type_obj = get_post_type_object( $post_type );
		?>
		<span class="post-type">
			<i class="fas fa-file"></i>
			<?php echo esc_html( $post_type_obj->labels->singular_name ); ?>
		</span>

		<a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Baca Selengkapnya', 'educentrals' ); ?> <i class="fas fa-arrow-right"></i></a>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->