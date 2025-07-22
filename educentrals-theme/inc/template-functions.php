<?php
/**
 * Functions yang meningkatkan tema dengan berbagai fitur
 *
 * @package Educentrals
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function educentrals_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	} else {
		$classes[] = 'has-sidebar';
	}
	
	// Add class for different page types
	if ( is_front_page() ) {
		$classes[] = 'home-page';
	} elseif ( is_archive() || is_home() || is_search() ) {
		$classes[] = 'archive-page';
	} elseif ( is_singular( 'post' ) ) {
		$classes[] = 'single-post-page';
	} elseif ( is_page() ) {
		$classes[] = 'static-page';
	}

	return $classes;
}
add_filter( 'body_class', 'educentrals_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function educentrals_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'educentrals_pingback_header' );

/**
 * Menambahkan class pada link di menu navigasi
 */
function educentrals_add_menu_link_class( $atts, $item, $args ) {
	if ( property_exists( $args, 'link_class' ) ) {
		$atts['class'] = $args->link_class;
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'educentrals_add_menu_link_class', 1, 3 );

/**
 * Menambahkan class pada item di menu navigasi
 */
function educentrals_add_menu_list_item_class( $classes, $item, $args ) {
	if ( property_exists( $args, 'list_item_class' ) ) {
		$classes[] = $args->list_item_class;
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'educentrals_add_menu_list_item_class', 1, 3 );

/**
 * Mengubah panjang excerpt
 */
function educentrals_custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'educentrals_custom_excerpt_length', 999 );

/**
 * Mengubah akhiran excerpt
 */
function educentrals_custom_excerpt_more( $more ) {
	return '... <a class="read-more" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Baca Selengkapnya', 'educentrals' ) . ' <i class="fas fa-arrow-right"></i></a>';
}
add_filter( 'excerpt_more', 'educentrals_custom_excerpt_more' );

/**
 * Menambahkan class pada form pencarian
 */
function educentrals_search_form_classes( $html ) {
	$html = str_replace( 'class="search-form"', 'class="search-form search-form-custom"', $html );
	$html = str_replace( 'class="search-submit"', 'class="search-submit btn btn-primary"', $html );
	return $html;
}
add_filter( 'get_search_form', 'educentrals_search_form_classes' );

/**
 * Menambahkan class pada tombol kirim komentar
 */
function educentrals_comment_form_submit_button( $submit_button ) {
	$submit_button = str_replace( 'class="submit"', 'class="submit btn btn-primary"', $submit_button );
	return $submit_button;
}
add_filter( 'comment_form_submit_button', 'educentrals_comment_form_submit_button' );

/**
 * Menambahkan class pada field input komentar
 */
function educentrals_comment_form_default_fields( $fields ) {
	$fields['author'] = str_replace( '<input', '<input class="form-control"', $fields['author'] );
	$fields['email'] = str_replace( '<input', '<input class="form-control"', $fields['email'] );
	$fields['url'] = str_replace( '<input', '<input class="form-control"', $fields['url'] );
	return $fields;
}
add_filter( 'comment_form_default_fields', 'educentrals_comment_form_default_fields' );

/**
 * Menambahkan class pada textarea komentar
 */
function educentrals_comment_form_defaults( $defaults ) {
	$defaults['comment_field'] = str_replace( '<textarea', '<textarea class="form-control"', $defaults['comment_field'] );
	return $defaults;
}
add_filter( 'comment_form_defaults', 'educentrals_comment_form_defaults' );

/**
 * Menambahkan post view counter
 */
function educentrals_set_post_views( $post_id ) {
	$count_key = 'post_views_count';
	$count = get_post_meta( $post_id, $count_key, true );
	
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $post_id, $count_key );
		add_post_meta( $post_id, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $post_id, $count_key, $count );
	}
}

function educentrals_track_post_views( $post_id ) {
	// Jangan track post views di admin area
	if ( ! is_admin() ) {
		if ( is_single() ) {
			educentrals_set_post_views( get_the_ID() );
		}
	}
}
add_action( 'wp_head', 'educentrals_track_post_views' );

/**
 * Menampilkan jumlah post views
 */
function educentrals_get_post_views( $post_id ) {
	$count_key = 'post_views_count';
	$count = get_post_meta( $post_id, $count_key, true );
	
	if ( $count == '' ) {
		delete_post_meta( $post_id, $count_key );
		add_post_meta( $post_id, $count_key, '0' );
		return '0 ' . esc_html__( 'Dilihat', 'educentrals' );
	}
	
	return $count . ' ' . esc_html__( 'Dilihat', 'educentrals' );
}

/**
 * Menambahkan kolom post views di admin
 */
function educentrals_posts_column_views( $columns ) {
	$columns['post_views'] = esc_html__( 'Views', 'educentrals' );
	return $columns;
}
add_filter( 'manage_posts_columns', 'educentrals_posts_column_views' );

/**
 * Menampilkan jumlah post views di kolom admin
 */
function educentrals_posts_custom_column_views( $column ) {
	if ( $column === 'post_views' ) {
		echo educentrals_get_post_views( get_the_ID() );
	}
}
add_action( 'manage_posts_custom_column', 'educentrals_posts_custom_column_views' );

/**
 * Menambahkan schema markup untuk SEO
 */
function educentrals_schema_markup() {
	// Schema untuk website
	$schema = array(
		'@context'  => 'https://schema.org',
		'@type'     => 'WebSite',
		'name'      => get_bloginfo( 'name' ),
		'url'       => home_url(),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => home_url( '/?s={search_term_string}' ),
			'query-input' => 'required name=search_term_string',
		),
	);
	
	// Schema untuk artikel jika di halaman single post
	if ( is_single() && 'post' === get_post_type() ) {
		$schema = array(
			'@context'  => 'https://schema.org',
			'@type'     => 'Article',
			'headline'  => get_the_title(),
			'url'       => get_permalink(),
			'datePublished' => get_the_date( 'c' ),
			'dateModified'  => get_the_modified_date( 'c' ),
			'author'    => array(
				'@type' => 'Person',
				'name'  => get_the_author(),
			),
			'publisher' => array(
				'@type' => 'Organization',
				'name'  => get_bloginfo( 'name' ),
				'logo'  => array(
					'@type'  => 'ImageObject',
					'url'    => get_site_icon_url(),
				),
			),
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => get_permalink(),
			),
		);
		
		// Tambahkan featured image jika ada
		if ( has_post_thumbnail() ) {
			$schema['image'] = array(
				'@type'  => 'ImageObject',
				'url'    => get_the_post_thumbnail_url( null, 'full' ),
				'width'  => 1200,
				'height' => 628,
			);
		}
	}
	
	// Schema untuk halaman
	if ( is_page() ) {
		$schema = array(
			'@context'  => 'https://schema.org',
			'@type'     => 'WebPage',
			'name'      => get_the_title(),
			'url'       => get_permalink(),
			'datePublished' => get_the_date( 'c' ),
			'dateModified'  => get_the_modified_date( 'c' ),
			'description'   => get_the_excerpt(),
		);
	}
	
	// Output schema markup
	echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>';
}
add_action( 'wp_head', 'educentrals_schema_markup' );

/**
 * Menambahkan custom dashboard widget
 */
function educentrals_dashboard_widget() {
	wp_add_dashboard_widget(
		'educentrals_dashboard_widget',
		esc_html__( 'Educentrals Theme Info', 'educentrals' ),
		'educentrals_dashboard_widget_function'
	);
}
add_action( 'wp_dashboard_setup', 'educentrals_dashboard_widget' );

/**
 * Fungsi untuk menampilkan konten dashboard widget
 */
function educentrals_dashboard_widget_function() {
	echo '<h3>' . esc_html__( 'Selamat datang di Tema Educentrals!', 'educentrals' ) . '</h3>';
	echo '<p>' . esc_html__( 'Tema ini dirancang khusus untuk website pendidikan dan blog edukasi.', 'educentrals' ) . '</p>';
	echo '<p>' . esc_html__( 'Untuk mengatur tema ini, silakan kunjungi:', 'educentrals' ) . '</p>';
	echo '<ul>';
	echo '<li><a href="' . esc_url( admin_url( 'customize.php' ) ) . '">' . esc_html__( 'Customizer', 'educentrals' ) . '</a></li>';
	echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Menu', 'educentrals' ) . '</a></li>';
	echo '<li><a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">' . esc_html__( 'Widget', 'educentrals' ) . '</a></li>';
	echo '</ul>';
}

/**
 * Menambahkan custom login page style
 */
function educentrals_custom_login_style() {
	?>
	<style type="text/css">
		body.login {
			background-color: #f7fafc;
		}
		.login h1 a {
			background-image: url(<?php echo esc_url( get_site_icon_url() ); ?>);
			background-size: contain;
			width: 100px;
			height: 100px;
		}
		.login form {
			border-radius: 5px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}
		.login .button-primary {
			background-color: #4A6FDC;
			border-color: #3A5BC0;
		}
		.login .button-primary:hover, .login .button-primary:focus {
			background-color: #3A5BC0;
			border-color: #2A4BB0;
		}
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'educentrals_custom_login_style' );

/**
 * Mengubah URL logo login page
 */
function educentrals_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'educentrals_login_logo_url' );

/**
 * Mengubah title logo login page
 */
function educentrals_login_logo_url_title() {
	return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'educentrals_login_logo_url_title' );

/**
 * Menambahkan custom admin footer text
 */
function educentrals_admin_footer_text( $text ) {
	$text = sprintf(
		/* translators: %s: Theme name. */
		esc_html__( 'Terima kasih telah menggunakan tema %s!', 'educentrals' ),
		'<a href="' . esc_url( home_url() ) . '" target="_blank">Educentrals</a>'
	);
	return $text;
}
add_filter( 'admin_footer_text', 'educentrals_admin_footer_text' );

/**
 * Menambahkan custom favicon
 */
function educentrals_favicon() {
	if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
		return;
	}
	
	echo '<link rel="shortcut icon" href="' . esc_url( get_template_directory_uri() ) . '/assets/images/favicon.ico" />';
}
add_action( 'wp_head', 'educentrals_favicon' );

/**
 * Menambahkan custom image sizes
 */
function educentrals_add_image_sizes() {
	add_image_size( 'educentrals-featured', 1200, 600, true );
	add_image_size( 'educentrals-thumbnail', 350, 250, true );
	add_image_size( 'educentrals-slider', 1600, 800, true );
}
add_action( 'after_setup_theme', 'educentrals_add_image_sizes' );

/**
 * Menambahkan custom image sizes ke dropdown media uploader
 */
function educentrals_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'educentrals-featured' => esc_html__( 'Featured Image (1200x600)', 'educentrals' ),
		'educentrals-thumbnail' => esc_html__( 'Thumbnail (350x250)', 'educentrals' ),
		'educentrals-slider' => esc_html__( 'Slider Image (1600x800)', 'educentrals' ),
	) );
}
add_filter( 'image_size_names_choose', 'educentrals_custom_image_sizes' );