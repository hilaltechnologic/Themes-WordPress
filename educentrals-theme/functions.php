<?php
/**
 * Educentrals functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Educentrals
 */

if ( ! defined( 'EDUCENTRALS_VERSION' ) ) {
	// Ganti versi saat melakukan perubahan pada stylesheet.
	define( 'EDUCENTRALS_VERSION', '1.0.0' );
}

/**
 * Setup tema
 */
function educentrals_setup() {
	/*
	 * Aktifkan terjemahan.
	 * Terjemahan dapat disimpan di folder /languages/
	 */
	load_theme_textdomain( 'educentrals', get_template_directory() . '/languages' );

	// Tambahkan dukungan default title tag.
	add_theme_support( 'title-tag' );

	// Aktifkan dukungan untuk post thumbnails (featured images).
	add_theme_support( 'post-thumbnails' );

	// Ukuran gambar khusus
	add_image_size( 'educentrals-featured', 1200, 600, true );
	add_image_size( 'educentrals-thumbnail', 350, 250, true );

	// Daftarkan lokasi menu
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'educentrals' ),
			'menu-2' => esc_html__( 'Footer', 'educentrals' ),
		)
	);

	/*
	 * Aktifkan dukungan HTML5 untuk elemen-elemen berikut:
	 * search-form, comment-form, comment-list, gallery, caption, style, script.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Tambahkan dukungan untuk custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Tambahkan dukungan untuk custom background.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f7fafc',
		)
	);

	// Tambahkan dukungan untuk selective refresh widget.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Tambahkan dukungan untuk konten lebar (wide alignment).
	add_theme_support( 'align-wide' );

	// Tambahkan dukungan untuk blok warna.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => esc_html__( 'Primary', 'educentrals' ),
			'slug'  => 'primary',
			'color' => '#4A6FDC',
		),
		array(
			'name'  => esc_html__( 'Secondary', 'educentrals' ),
			'slug'  => 'secondary',
			'color' => '#FF9F43',
		),
		array(
			'name'  => esc_html__( 'Dark', 'educentrals' ),
			'slug'  => 'dark',
			'color' => '#2D3748',
		),
		array(
			'name'  => esc_html__( 'Light', 'educentrals' ),
			'slug'  => 'light',
			'color' => '#F7FAFC',
		),
	) );
}
add_action( 'after_setup_theme', 'educentrals_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function educentrals_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'educentrals_content_width', 1200 );
}
add_action( 'after_setup_theme', 'educentrals_content_width', 0 );

/**
 * Register widget area.
 */
function educentrals_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'educentrals' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Tambahkan widget di sini.', 'educentrals' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'educentrals' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Widget area untuk footer kolom 1.', 'educentrals' ),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer-widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'educentrals' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Widget area untuk footer kolom 2.', 'educentrals' ),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer-widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'educentrals' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Widget area untuk footer kolom 3.', 'educentrals' ),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer-widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Newsletter', 'educentrals' ),
			'id'            => 'newsletter',
			'description'   => esc_html__( 'Widget area untuk newsletter signup.', 'educentrals' ),
			'before_widget' => '<div id="%1$s" class="newsletter-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="newsletter-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'educentrals_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function educentrals_scripts() {
	wp_enqueue_style( 'educentrals-style', get_stylesheet_uri(), array(), EDUCENTRALS_VERSION );
	
	// Font Awesome untuk ikon
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0' );
	
	// Main JavaScript
	wp_enqueue_script( 'educentrals-navigation', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), EDUCENTRALS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'educentrals_scripts' );

/**
 * Custom template tags untuk tema ini.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions yang meningkatkan tema dengan berbagai fitur.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

/**
 * Excerpt length and "read more" text
 * 
 * Note: Fungsi ini dipindahkan ke inc/template-functions.php
 * dengan nama educentrals_custom_excerpt_length dan educentrals_custom_excerpt_more
 * untuk menghindari deklarasi ganda
 */

/**
 * Custom comment form fields
 */
function educentrals_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    $req       = get_option( 'require_name_email' );
    $aria_req  = ( $req ? " aria-required='true'" : '' );

    $fields['author'] = '<div class="comment-form-author"><label for="author">' . esc_html__( 'Nama', 'educentrals' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>';
    
    $fields['email'] = '<div class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'educentrals' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>';
    
    $fields['url'] = '<div class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'educentrals' ) . '</label><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>';

    return $fields;
}
add_filter( 'comment_form_default_fields', 'educentrals_comment_form_fields' );

/**
 * Custom comment form defaults
 * 
 * Note: Fungsi ini dipindahkan ke inc/template-functions.php
 * untuk menghindari deklarasi ganda
 */

/**
 * Custom body classes
 * 
 * Note: Fungsi ini dipindahkan ke inc/template-functions.php
 * untuk menghindari deklarasi ganda
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 * 
 * Note: Fungsi ini dipindahkan ke inc/template-functions.php
 * untuk menghindari deklarasi ganda
 */

/**
 * Register Custom Post Type untuk Slider
 */
function educentrals_register_slider_post_type() {
    $labels = array(
        'name'                  => _x( 'Sliders', 'Post Type General Name', 'educentrals' ),
        'singular_name'         => _x( 'Slider', 'Post Type Singular Name', 'educentrals' ),
        'menu_name'             => __( 'Sliders', 'educentrals' ),
        'name_admin_bar'        => __( 'Slider', 'educentrals' ),
        'archives'              => __( 'Slider Archives', 'educentrals' ),
        'attributes'            => __( 'Slider Attributes', 'educentrals' ),
        'parent_item_colon'     => __( 'Parent Slider:', 'educentrals' ),
        'all_items'             => __( 'All Sliders', 'educentrals' ),
        'add_new_item'          => __( 'Add New Slider', 'educentrals' ),
        'add_new'               => __( 'Add New', 'educentrals' ),
        'new_item'              => __( 'New Slider', 'educentrals' ),
        'edit_item'             => __( 'Edit Slider', 'educentrals' ),
        'update_item'           => __( 'Update Slider', 'educentrals' ),
        'view_item'             => __( 'View Slider', 'educentrals' ),
        'view_items'            => __( 'View Sliders', 'educentrals' ),
        'search_items'          => __( 'Search Slider', 'educentrals' ),
        'not_found'             => __( 'Not found', 'educentrals' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'educentrals' ),
        'featured_image'        => __( 'Slider Image', 'educentrals' ),
        'set_featured_image'    => __( 'Set slider image', 'educentrals' ),
        'remove_featured_image' => __( 'Remove slider image', 'educentrals' ),
        'use_featured_image'    => __( 'Use as slider image', 'educentrals' ),
        'insert_into_item'      => __( 'Insert into slider', 'educentrals' ),
        'uploaded_to_this_item' => __( 'Uploaded to this slider', 'educentrals' ),
        'items_list'            => __( 'Sliders list', 'educentrals' ),
        'items_list_navigation' => __( 'Sliders list navigation', 'educentrals' ),
        'filter_items_list'     => __( 'Filter sliders list', 'educentrals' ),
    );
    $args = array(
        'label'                 => __( 'Slider', 'educentrals' ),
        'description'           => __( 'Hero Slider Items', 'educentrals' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-images-alt2',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'slider', $args );
}
add_action( 'init', 'educentrals_register_slider_post_type', 0 );

/**
 * Add meta box untuk slider
 */
function educentrals_slider_meta_boxes() {
    add_meta_box(
        'slider_meta_box',
        __( 'Slider Options', 'educentrals' ),
        'educentrals_slider_meta_box_callback',
        'slider',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'educentrals_slider_meta_boxes' );

/**
 * Meta box callback
 */
function educentrals_slider_meta_box_callback( $post ) {
    wp_nonce_field( 'educentrals_slider_meta_box', 'educentrals_slider_meta_box_nonce' );
    
    $button_text = get_post_meta( $post->ID, '_slider_button_text', true );
    $button_url = get_post_meta( $post->ID, '_slider_button_url', true );
    
    ?>
    <p>
        <label for="slider_button_text"><?php _e( 'Button Text', 'educentrals' ); ?></label>
        <input type="text" id="slider_button_text" name="slider_button_text" value="<?php echo esc_attr( $button_text ); ?>" class="widefat">
    </p>
    <p>
        <label for="slider_button_url"><?php _e( 'Button URL', 'educentrals' ); ?></label>
        <input type="url" id="slider_button_url" name="slider_button_url" value="<?php echo esc_url( $button_url ); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Save meta box data
 */
function educentrals_save_slider_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['educentrals_slider_meta_box_nonce'] ) ) {
        return;
    }
    
    if ( ! wp_verify_nonce( $_POST['educentrals_slider_meta_box_nonce'], 'educentrals_slider_meta_box' ) ) {
        return;
    }
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( isset( $_POST['post_type'] ) && 'slider' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    
    if ( ! isset( $_POST['slider_button_text'] ) || ! isset( $_POST['slider_button_url'] ) ) {
        return;
    }
    
    $button_text = sanitize_text_field( $_POST['slider_button_text'] );
    $button_url = esc_url_raw( $_POST['slider_button_url'] );
    
    update_post_meta( $post_id, '_slider_button_text', $button_text );
    update_post_meta( $post_id, '_slider_button_url', $button_url );
}
add_action( 'save_post', 'educentrals_save_slider_meta_box_data' );

/**
 * Function untuk mendapatkan slider
 */
function educentrals_get_sliders() {
    $args = array(
        'post_type'      => 'slider',
        'posts_per_page' => 5,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    return new WP_Query( $args );
}

/**
 * Fungsi untuk menampilkan pagination
 */
function educentrals_pagination() {
    global $wp_query;
    
    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }
    
    $big = 999999999; // need an unlikely integer
    
    $links = paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => '<i class="fas fa-chevron-left"></i>',
        'next_text' => '<i class="fas fa-chevron-right"></i>',
        'type'      => 'list',
        'end_size'  => 3,
        'mid_size'  => 3
    ) );
    
    echo '<div class="pagination">' . $links . '</div>';
}

/**
 * Fungsi untuk menampilkan breadcrumbs
 */
function educentrals_breadcrumbs() {
    // Jangan tampilkan di halaman depan
    if ( is_front_page() ) {
        return;
    }
    
    echo '<div class="breadcrumbs">';
    echo '<div class="container">';
    
    echo '<a href="' . esc_url( home_url() ) . '">' . esc_html__( 'Beranda', 'educentrals' ) . '</a>';
    
    if ( is_category() || is_single() ) {
        echo ' <span class="separator">/</span> ';
        
        if ( is_single() ) {
            the_category( ' <span class="separator">/</span> ' );
            echo ' <span class="separator">/</span> ';
            the_title();
        } else {
            single_cat_title();
        }
    } elseif ( is_page() ) {
        echo ' <span class="separator">/</span> ';
        echo the_title();
    } elseif ( is_search() ) {
        echo ' <span class="separator">/</span> ';
        echo esc_html__( 'Hasil pencarian untuk: ', 'educentrals' ) . get_search_query();
    } elseif ( is_tag() ) {
        echo ' <span class="separator">/</span> ';
        echo esc_html__( 'Tag: ', 'educentrals' );
        single_tag_title();
    } elseif ( is_author() ) {
        echo ' <span class="separator">/</span> ';
        echo esc_html__( 'Arsip Penulis', 'educentrals' );
    } elseif ( is_archive() ) {
        echo ' <span class="separator">/</span> ';
        
        if ( is_day() ) {
            echo esc_html__( 'Arsip Harian: ', 'educentrals' ) . get_the_date();
        } elseif ( is_month() ) {
            echo esc_html__( 'Arsip Bulanan: ', 'educentrals' ) . get_the_date( 'F Y' );
        } elseif ( is_year() ) {
            echo esc_html__( 'Arsip Tahunan: ', 'educentrals' ) . get_the_date( 'Y' );
        } else {
            echo esc_html__( 'Arsip', 'educentrals' );
        }
    }
    
    echo '</div>';
    echo '</div>';
}