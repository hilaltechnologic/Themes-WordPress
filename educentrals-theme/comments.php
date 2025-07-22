<?php
/**
 * Template untuk menampilkan komentar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Educentrals
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$educentrals_comment_count = get_comments_number();
			if ( '1' === $educentrals_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'Satu komentar pada &ldquo;%1$s&rdquo;', 'educentrals' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s komentar pada &ldquo;%2$s&rdquo;', '%1$s komentar pada &ldquo;%2$s&rdquo;', $educentrals_comment_count, 'comments title', 'educentrals' ) ),
					number_format_i18n( $educentrals_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 60,
					'reply_text' => esc_html__( 'Balas', 'educentrals' ),
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Komentar ditutup.', 'educentrals' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	// Custom comment form
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$html_req = ( $req ? " required='required'" : '' );
	
	$fields = array(
		'author' => '<div class="comment-form-author"><label for="author">' . esc_html__( 'Nama', 'educentrals' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $html_req . ' /></div>',
		'email'  => '<div class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'educentrals' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $html_req . ' /></div>',
		'url'    => '<div class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'educentrals' ) . '</label><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></div>',
		'cookies' => '<div class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . ( empty( $commenter['comment_author_email'] ) ? '' : 'checked="checked"' ) . ' /><label for="wp-comment-cookies-consent">' . esc_html__( 'Simpan nama, email, dan website saya di browser ini untuk komentar saya berikutnya.', 'educentrals' ) . '</label></div>',
	);
	
	$comments_args = array(
		'fields'               => $fields,
		'comment_field'        => '<div class="comment-form-comment"><label for="comment">' . esc_html__( 'Komentar', 'educentrals' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required="required"></textarea></div>',
		'title_reply'          => esc_html__( 'Tinggalkan Komentar', 'educentrals' ),
		'title_reply_to'       => esc_html__( 'Balas ke %s', 'educentrals' ),
		'cancel_reply_link'    => esc_html__( 'Batal Balas', 'educentrals' ),
		'label_submit'         => esc_html__( 'Kirim Komentar', 'educentrals' ),
		'class_submit'         => 'btn btn-primary',
		'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
		'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . esc_html__( 'Alamat email Anda tidak akan dipublikasikan.', 'educentrals' ) . '</span> ' . ( $req ? '<span class="required-field-message">' . esc_html__( 'Bidang yang wajib diisi ditandai *', 'educentrals' ) . '</span>' : '' ) . '</p>',
	);
	
	comment_form( $comments_args );
	?>

</div><!-- #comments -->