<?php
/**
 * Educentrals Theme Customizer
 *
 * @package Educentrals
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function educentrals_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'educentrals_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'educentrals_customize_partial_blogdescription',
			)
		);
	}

	// Tambahkan panel untuk pengaturan tema
	$wp_customize->add_panel( 'educentrals_theme_options', array(
		'title'       => esc_html__( 'Pengaturan Tema Educentrals', 'educentrals' ),
		'description' => esc_html__( 'Pengaturan untuk tema Educentrals', 'educentrals' ),
		'priority'    => 130,
	) );

	// Tambahkan section untuk pengaturan warna
	$wp_customize->add_section( 'educentrals_colors', array(
		'title'       => esc_html__( 'Warna', 'educentrals' ),
		'description' => esc_html__( 'Pengaturan warna tema', 'educentrals' ),
		'panel'       => 'educentrals_theme_options',
		'priority'    => 10,
	) );

	// Warna Utama
	$wp_customize->add_setting( 'educentrals_primary_color', array(
		'default'           => '#4A6FDC',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'educentrals_primary_color', array(
		'label'       => esc_html__( 'Warna Utama', 'educentrals' ),
		'description' => esc_html__( 'Warna utama untuk tema', 'educentrals' ),
		'section'     => 'educentrals_colors',
		'settings'    => 'educentrals_primary_color',
	) ) );

	// Warna Sekunder
	$wp_customize->add_setting( 'educentrals_secondary_color', array(
		'default'           => '#FF9F43',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'educentrals_secondary_color', array(
		'label'       => esc_html__( 'Warna Sekunder', 'educentrals' ),
		'description' => esc_html__( 'Warna sekunder untuk tema', 'educentrals' ),
		'section'     => 'educentrals_colors',
		'settings'    => 'educentrals_secondary_color',
	) ) );

	// Tambahkan section untuk pengaturan header
	$wp_customize->add_section( 'educentrals_header', array(
		'title'       => esc_html__( 'Header', 'educentrals' ),
		'description' => esc_html__( 'Pengaturan header tema', 'educentrals' ),
		'panel'       => 'educentrals_theme_options',
		'priority'    => 20,
	) );

	// Tampilkan Sticky Header
	$wp_customize->add_setting( 'educentrals_sticky_header', array(
		'default'           => true,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_sticky_header', array(
		'label'       => esc_html__( 'Aktifkan Sticky Header', 'educentrals' ),
		'description' => esc_html__( 'Header akan tetap terlihat saat menggulir halaman', 'educentrals' ),
		'section'     => 'educentrals_header',
		'type'        => 'checkbox',
	) );

	// Tampilkan Search di Header
	$wp_customize->add_setting( 'educentrals_header_search', array(
		'default'           => true,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_header_search', array(
		'label'       => esc_html__( 'Tampilkan Form Pencarian di Header', 'educentrals' ),
		'section'     => 'educentrals_header',
		'type'        => 'checkbox',
	) );

	// Tambahkan section untuk pengaturan footer
	$wp_customize->add_section( 'educentrals_footer', array(
		'title'       => esc_html__( 'Footer', 'educentrals' ),
		'description' => esc_html__( 'Pengaturan footer tema', 'educentrals' ),
		'panel'       => 'educentrals_theme_options',
		'priority'    => 30,
	) );

	// Footer Copyright Text
	$wp_customize->add_setting( 'educentrals_footer_copyright', array(
		'default'           => sprintf( esc_html__( '© %1$s %2$s. Hak Cipta Dilindungi.', 'educentrals' ), date('Y'), get_bloginfo( 'name' ) ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'educentrals_footer_copyright', array(
		'label'       => esc_html__( 'Teks Copyright Footer', 'educentrals' ),
		'description' => esc_html__( 'Teks copyright yang ditampilkan di footer', 'educentrals' ),
		'section'     => 'educentrals_footer',
		'type'        => 'textarea',
	) );

	// Tampilkan Social Media di Footer
	$wp_customize->add_setting( 'educentrals_footer_social', array(
		'default'           => true,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_footer_social', array(
		'label'       => esc_html__( 'Tampilkan Social Media di Footer', 'educentrals' ),
		'section'     => 'educentrals_footer',
		'type'        => 'checkbox',
	) );

	// Tambahkan section untuk pengaturan social media
	$wp_customize->add_section( 'educentrals_social', array(
		'title'       => esc_html__( 'Social Media', 'educentrals' ),
		'description' => esc_html__( 'Pengaturan social media', 'educentrals' ),
		'panel'       => 'educentrals_theme_options',
		'priority'    => 40,
	) );

	// Facebook URL
	$wp_customize->add_setting( 'educentrals_facebook_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'educentrals_facebook_url', array(
		'label'       => esc_html__( 'Facebook URL', 'educentrals' ),
		'section'     => 'educentrals_social',
		'type'        => 'url',
	) );

	// Twitter URL
	$wp_customize->add_setting( 'educentrals_twitter_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'educentrals_twitter_url', array(
		'label'       => esc_html__( 'Twitter URL', 'educentrals' ),
		'section'     => 'educentrals_social',
		'type'        => 'url',
	) );

	// Instagram URL
	$wp_customize->add_setting( 'educentrals_instagram_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'educentrals_instagram_url', array(
		'label'       => esc_html__( 'Instagram URL', 'educentrals' ),
		'section'     => 'educentrals_social',
		'type'        => 'url',
	) );

	// YouTube URL
	$wp_customize->add_setting( 'educentrals_youtube_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'educentrals_youtube_url', array(
		'label'       => esc_html__( 'YouTube URL', 'educentrals' ),
		'section'     => 'educentrals_social',
		'type'        => 'url',
	) );

	// LinkedIn URL
	$wp_customize->add_setting( 'educentrals_linkedin_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'educentrals_linkedin_url', array(
		'label'       => esc_html__( 'LinkedIn URL', 'educentrals' ),
		'section'     => 'educentrals_social',
		'type'        => 'url',
	) );

	// Tambahkan section untuk pengaturan homepage
	$wp_customize->add_section( 'educentrals_homepage', array(
		'title'       => esc_html__( 'Homepage', 'educentrals' ),
		'description' => esc_html__( 'Pengaturan halaman depan', 'educentrals' ),
		'panel'       => 'educentrals_theme_options',
		'priority'    => 50,
	) );

	// Tampilkan Slider di Homepage
	$wp_customize->add_setting( 'educentrals_homepage_slider', array(
		'default'           => true,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_homepage_slider', array(
		'label'       => esc_html__( 'Tampilkan Slider di Homepage', 'educentrals' ),
		'section'     => 'educentrals_homepage',
		'type'        => 'checkbox',
	) );

	// Jumlah Post di Homepage
	$wp_customize->add_setting( 'educentrals_homepage_post_count', array(
		'default'           => 6,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'educentrals_homepage_post_count', array(
		'label'       => esc_html__( 'Jumlah Post di Homepage', 'educentrals' ),
		'section'     => 'educentrals_homepage',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'max'  => 20,
			'step' => 1,
		),
	) );

	// Tampilkan Featured Categories
	$wp_customize->add_setting( 'educentrals_homepage_featured_categories', array(
		'default'           => true,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_homepage_featured_categories', array(
		'label'       => esc_html__( 'Tampilkan Kategori Unggulan di Homepage', 'educentrals' ),
		'section'     => 'educentrals_homepage',
		'type'        => 'checkbox',
	) );

	// Tambahkan section untuk pengaturan blog
	$wp_customize->add_section( 'educentrals_blog', array(
		'title'       => esc_html__( 'Blog', 'educentrals' ),
		'description' => esc_html__( 'Pengaturan halaman blog', 'educentrals' ),
		'panel'       => 'educentrals_theme_options',
		'priority'    => 60,
	) );

	// Layout Blog
	$wp_customize->add_setting( 'educentrals_blog_layout', array(
		'default'           => 'right-sidebar',
		'sanitize_callback' => 'educentrals_sanitize_select',
	) );

	$wp_customize->add_control( 'educentrals_blog_layout', array(
		'label'       => esc_html__( 'Layout Blog', 'educentrals' ),
		'section'     => 'educentrals_blog',
		'type'        => 'select',
		'choices'     => array(
			'right-sidebar' => esc_html__( 'Sidebar Kanan', 'educentrals' ),
			'left-sidebar'  => esc_html__( 'Sidebar Kiri', 'educentrals' ),
			'no-sidebar'    => esc_html__( 'Tanpa Sidebar', 'educentrals' ),
		),
	) );

	// Tampilkan Meta Post
	$wp_customize->add_setting( 'educentrals_blog_meta', array(
		'default'           => true,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_blog_meta', array(
		'label'       => esc_html__( 'Tampilkan Meta Post (Tanggal, Penulis, dll)', 'educentrals' ),
		'section'     => 'educentrals_blog',
		'type'        => 'checkbox',
	) );

	// Tampilkan Featured Image
	$wp_customize->add_setting( 'educentrals_blog_featured_image', array(
		'default'           => true,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_blog_featured_image', array(
		'label'       => esc_html__( 'Tampilkan Featured Image', 'educentrals' ),
		'section'     => 'educentrals_blog',
		'type'        => 'checkbox',
	) );

	// Tampilkan Related Posts
	$wp_customize->add_setting( 'educentrals_blog_related_posts', array(
		'default'           => true,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_blog_related_posts', array(
		'label'       => esc_html__( 'Tampilkan Artikel Terkait di Single Post', 'educentrals' ),
		'section'     => 'educentrals_blog',
		'type'        => 'checkbox',
	) );

	// Tambahkan section untuk pengaturan typography
	$wp_customize->add_section( 'educentrals_typography', array(
		'title'       => esc_html__( 'Typography', 'educentrals' ),
		'description' => esc_html__( 'Pengaturan font dan typography', 'educentrals' ),
		'panel'       => 'educentrals_theme_options',
		'priority'    => 70,
	) );

	// Font Heading
	$wp_customize->add_setting( 'educentrals_heading_font', array(
		'default'           => 'Poppins',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'educentrals_heading_font', array(
		'label'       => esc_html__( 'Font Heading', 'educentrals' ),
		'description' => esc_html__( 'Font untuk heading (h1, h2, h3, dll)', 'educentrals' ),
		'section'     => 'educentrals_typography',
		'type'        => 'select',
		'choices'     => array(
			'Poppins'      => 'Poppins',
			'Roboto'       => 'Roboto',
			'Open Sans'    => 'Open Sans',
			'Montserrat'   => 'Montserrat',
			'Lato'         => 'Lato',
			'Raleway'      => 'Raleway',
			'Nunito'       => 'Nunito',
			'Playfair Display' => 'Playfair Display',
		),
	) );

	// Font Body
	$wp_customize->add_setting( 'educentrals_body_font', array(
		'default'           => 'Roboto',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'educentrals_body_font', array(
		'label'       => esc_html__( 'Font Body', 'educentrals' ),
		'description' => esc_html__( 'Font untuk teks body', 'educentrals' ),
		'section'     => 'educentrals_typography',
		'type'        => 'select',
		'choices'     => array(
			'Roboto'       => 'Roboto',
			'Poppins'      => 'Poppins',
			'Open Sans'    => 'Open Sans',
			'Montserrat'   => 'Montserrat',
			'Lato'         => 'Lato',
			'Raleway'      => 'Raleway',
			'Nunito'       => 'Nunito',
			'Source Sans Pro' => 'Source Sans Pro',
		),
	) );

	// Font Size Base
	$wp_customize->add_setting( 'educentrals_base_font_size', array(
		'default'           => '16',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'educentrals_base_font_size', array(
		'label'       => esc_html__( 'Ukuran Font Dasar (px)', 'educentrals' ),
		'section'     => 'educentrals_typography',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 12,
			'max'  => 24,
			'step' => 1,
		),
	) );

	// Tambahkan section untuk pengaturan performance
	$wp_customize->add_section( 'educentrals_performance', array(
		'title'       => esc_html__( 'Performance', 'educentrals' ),
		'description' => esc_html__( 'Pengaturan performa tema', 'educentrals' ),
		'panel'       => 'educentrals_theme_options',
		'priority'    => 80,
	) );

	// Aktifkan Lazy Loading
	$wp_customize->add_setting( 'educentrals_lazy_loading', array(
		'default'           => true,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_lazy_loading', array(
		'label'       => esc_html__( 'Aktifkan Lazy Loading untuk Gambar', 'educentrals' ),
		'description' => esc_html__( 'Meningkatkan performa dengan memuat gambar hanya saat dibutuhkan', 'educentrals' ),
		'section'     => 'educentrals_performance',
		'type'        => 'checkbox',
	) );

	// Minify CSS
	$wp_customize->add_setting( 'educentrals_minify_css', array(
		'default'           => false,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_minify_css', array(
		'label'       => esc_html__( 'Minify CSS', 'educentrals' ),
		'description' => esc_html__( 'Mengompres CSS untuk meningkatkan performa', 'educentrals' ),
		'section'     => 'educentrals_performance',
		'type'        => 'checkbox',
	) );

	// Preload Fonts
	$wp_customize->add_setting( 'educentrals_preload_fonts', array(
		'default'           => true,
		'sanitize_callback' => 'educentrals_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'educentrals_preload_fonts', array(
		'label'       => esc_html__( 'Preload Fonts', 'educentrals' ),
		'description' => esc_html__( 'Meningkatkan performa dengan preload font', 'educentrals' ),
		'section'     => 'educentrals_performance',
		'type'        => 'checkbox',
	) );
}
add_action( 'customize_register', 'educentrals_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function educentrals_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function educentrals_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function educentrals_customize_preview_js() {
	wp_enqueue_script( 'educentrals-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), EDUCENTRALS_VERSION, true );
}
add_action( 'customize_preview_init', 'educentrals_customize_preview_js' );

/**
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function educentrals_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitize select.
 *
 * @param string $input The select value.
 * @param object $setting The setting object.
 * @return string The sanitized value.
 */
function educentrals_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Generate inline CSS for customizer options.
 */
function educentrals_customizer_css() {
	$primary_color = get_theme_mod( 'educentrals_primary_color', '#4A6FDC' );
	$secondary_color = get_theme_mod( 'educentrals_secondary_color', '#FF9F43' );
	$heading_font = get_theme_mod( 'educentrals_heading_font', 'Poppins' );
	$body_font = get_theme_mod( 'educentrals_body_font', 'Roboto' );
	$base_font_size = get_theme_mod( 'educentrals_base_font_size', '16' );

	$custom_css = "
		:root {
			--color-primary: {$primary_color};
			--color-primary-dark: " . educentrals_adjust_brightness( $primary_color, -20 ) . ";
			--color-primary-light: " . educentrals_adjust_brightness( $primary_color, 20 ) . ";
			--color-secondary: {$secondary_color};
			--color-secondary-dark: " . educentrals_adjust_brightness( $secondary_color, -20 ) . ";
			--color-secondary-light: " . educentrals_adjust_brightness( $secondary_color, 20 ) . ";
			--font-heading: '{$heading_font}', sans-serif;
			--font-body: '{$body_font}', sans-serif;
		}
		
		html {
			font-size: {$base_font_size}px;
		}
		
		body {
			font-family: var(--font-body);
		}
		
		h1, h2, h3, h4, h5, h6 {
			font-family: var(--font-heading);
		}
	";

	// Blog layout
	$blog_layout = get_theme_mod( 'educentrals_blog_layout', 'right-sidebar' );
	
	if ( $blog_layout === 'left-sidebar' ) {
		$custom_css .= "
			@media (min-width: 768px) {
				.content-area {
					order: 2;
				}
				.widget-area {
					order: 1;
					padding-right: var(--spacing-xl);
					padding-left: 0;
				}
			}
		";
	} elseif ( $blog_layout === 'no-sidebar' ) {
		$custom_css .= "
			.content-area {
				flex: 0 0 100%;
				max-width: 100%;
			}
			.widget-area {
				display: none;
			}
		";
	}

	// Sticky header
	if ( get_theme_mod( 'educentrals_sticky_header', true ) ) {
		$custom_css .= "
			.site-header {
				position: sticky;
				top: 0;
				z-index: 1000;
			}
			
			.admin-bar .site-header {
				top: 32px;
			}
			
			@media (max-width: 782px) {
				.admin-bar .site-header {
					top: 46px;
				}
			}
		";
	}

	// Output custom CSS
	wp_add_inline_style( 'educentrals-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'educentrals_customizer_css' );

/**
 * Adjust brightness of a color.
 *
 * @param string $hex The hex color.
 * @param int $steps The brightness adjustment.
 * @return string The adjusted hex color.
 */
function educentrals_adjust_brightness( $hex, $steps ) {
	// Remove # if present
	$hex = ltrim( $hex, '#' );
	
	// Convert to RGB
	$r = hexdec( substr( $hex, 0, 2 ) );
	$g = hexdec( substr( $hex, 2, 2 ) );
	$b = hexdec( substr( $hex, 4, 2 ) );
	
	// Adjust brightness
	$r = max( 0, min( 255, $r + $steps ) );
	$g = max( 0, min( 255, $g + $steps ) );
	$b = max( 0, min( 255, $b + $steps ) );
	
	// Convert back to hex
	return '#' . sprintf( '%02x%02x%02x', $r, $g, $b );
}

/**
 * Enqueue Google Fonts.
 */
function educentrals_google_fonts() {
	$heading_font = get_theme_mod( 'educentrals_heading_font', 'Poppins' );
	$body_font = get_theme_mod( 'educentrals_body_font', 'Roboto' );
	
	$fonts = array();
	
	if ( $heading_font !== 'default' ) {
		$fonts[] = $heading_font . ':300,400,500,600,700';
	}
	
	if ( $body_font !== 'default' && $body_font !== $heading_font ) {
		$fonts[] = $body_font . ':300,400,500,700';
	}
	
	if ( ! empty( $fonts ) ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'display' => 'swap',
		), 'https://fonts.googleapis.com/css2' );
		
		// Preload fonts if enabled
		if ( get_theme_mod( 'educentrals_preload_fonts', true ) ) {
			echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
			echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
			echo '<link rel="preload" as="style" href="' . esc_url( $fonts_url ) . '">';
			wp_enqueue_style( 'educentrals-google-fonts', $fonts_url, array(), null );
		} else {
			wp_enqueue_style( 'educentrals-google-fonts', $fonts_url, array(), null );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'educentrals_google_fonts' );