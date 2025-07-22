<?php
/**
 * Custom template tags untuk tema ini
 *
 * @package Educentrals
 */

if ( ! function_exists( 'educentrals_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function educentrals_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'educentrals' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'educentrals_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function educentrals_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'educentrals' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'educentrals_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function educentrals_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'educentrals' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><i class="far fa-folder-open"></i> ' . esc_html__( 'Posted in %1$s', 'educentrals' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'educentrals' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links"><i class="fas fa-tags"></i> ' . esc_html__( 'Tagged %1$s', 'educentrals' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="far fa-comment"></i> ';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'educentrals' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'educentrals' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link"><i class="fas fa-edit"></i> ',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'educentrals_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function educentrals_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Display estimated reading time for a post.
 */
function educentrals_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // Asumsi 200 kata per menit

    if ( $reading_time == 1 ) {
        $reading_time_text = esc_html__( '1 menit membaca', 'educentrals' );
    } else {
        $reading_time_text = sprintf( esc_html__( '%d menit membaca', 'educentrals' ), $reading_time );
    }

    echo '<span class="reading-time"><i class="far fa-clock"></i> ' . $reading_time_text . '</span>';
}

/**
 * Display social sharing buttons.
 */
function educentrals_social_sharing() {
    $post_url = urlencode( get_permalink() );
    $post_title = urlencode( get_the_title() );
    $post_thumbnail = urlencode( get_the_post_thumbnail_url( get_the_ID(), 'full' ) );

    // Get sharing URLs
    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url;
    $twitter_url = 'https://twitter.com/intent/tweet?url=' . $post_url . '&text=' . $post_title;
    $linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $post_url . '&title=' . $post_title;
    $whatsapp_url = 'https://api.whatsapp.com/send?text=' . $post_title . ' ' . $post_url;
    $pinterest_url = 'https://pinterest.com/pin/create/button/?url=' . $post_url . '&media=' . $post_thumbnail . '&description=' . $post_title;

    // Output sharing buttons
    ?>
    <div class="social-sharing">
        <h4><?php esc_html_e( 'Bagikan:', 'educentrals' ); ?></h4>
        <ul class="share-buttons">
            <li><a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="nofollow" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" rel="nofollow" class="twitter"><i class="fab fa-twitter"></i></a></li>
            <li><a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="nofollow" class="linkedin"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="nofollow" class="whatsapp"><i class="fab fa-whatsapp"></i></a></li>
            <li><a href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank" rel="nofollow" class="pinterest"><i class="fab fa-pinterest-p"></i></a></li>
        </ul>
    </div>
    <?php
}

/**
 * Display related posts based on categories.
 */
function educentrals_related_posts() {
    $current_post_id = get_the_ID();
    $categories = get_the_category( $current_post_id );
    
    if ( $categories ) {
        $category_ids = array();
        foreach ( $categories as $category ) {
            $category_ids[] = $category->term_id;
        }
        
        $args = array(
            'category__in'      => $category_ids,
            'post__not_in'      => array( $current_post_id ),
            'posts_per_page'    => 3,
            'orderby'           => 'rand',
        );
        
        $related_query = new WP_Query( $args );
        
        if ( $related_query->have_posts() ) {
            ?>
            <div class="related-posts">
                <h3><?php esc_html_e( 'Artikel Terkait', 'educentrals' ); ?></h3>
                <div class="row">
                    <?php
                    while ( $related_query->have_posts() ) {
                        $related_query->the_post();
                        ?>
                        <div class="col">
                            <article class="related-post">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'educentrals-thumbnail' ); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="post-meta">
                                    <span class="post-date"><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                                </div>
                            </article>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    }
}

/**
 * Display post author bio.
 */
function educentrals_author_bio() {
    $author_id = get_the_author_meta( 'ID' );
    $author_bio = get_the_author_meta( 'description', $author_id );
    
    if ( ! empty( $author_bio ) ) {
        ?>
        <div class="author-bio">
            <div class="author-avatar">
                <?php echo get_avatar( $author_id, 80 ); ?>
            </div>
            <div class="author-info">
                <h3 class="author-title"><?php printf( esc_html__( 'Tentang %s', 'educentrals' ), get_the_author() ); ?></h3>
                <div class="author-description">
                    <?php echo wpautop( $author_bio ); ?>
                </div>
                <a class="author-link" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
                    <?php printf( esc_html__( 'Lihat semua artikel oleh %s', 'educentrals' ), get_the_author() ); ?>
                </a>
            </div>
        </div>
        <?php
    }
}