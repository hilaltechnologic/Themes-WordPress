/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Primary color.
	wp.customize( 'educentrals_primary_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS
			var style = $( '#educentrals-custom-colors' ),
				css = style.html();
			
			css = css.replace( /--color-primary:.*?;/g, '--color-primary: ' + to + ';' );
			style.html( css );
		} );
	} );

	// Secondary color.
	wp.customize( 'educentrals_secondary_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS
			var style = $( '#educentrals-custom-colors' ),
				css = style.html();
			
			css = css.replace( /--color-secondary:.*?;/g, '--color-secondary: ' + to + ';' );
			style.html( css );
		} );
	} );

	// Footer copyright text.
	wp.customize( 'educentrals_footer_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.copyright' ).html( to );
		} );
	} );

	// Base font size.
	wp.customize( 'educentrals_base_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'html' ).css( 'font-size', to + 'px' );
		} );
	} );

	// Heading font.
	wp.customize( 'educentrals_heading_font', function( value ) {
		value.bind( function( to ) {
			// This would require reloading the page to apply the new font
			// For live preview, we'll just update the h1 element
			$( 'h1, h2, h3, h4, h5, h6' ).css( 'font-family', '"' + to + '", sans-serif' );
		} );
	} );

	// Body font.
	wp.customize( 'educentrals_body_font', function( value ) {
		value.bind( function( to ) {
			// This would require reloading the page to apply the new font
			// For live preview, we'll just update the body element
			$( 'body' ).css( 'font-family', '"' + to + '", sans-serif' );
		} );
	} );

	// Blog layout.
	wp.customize( 'educentrals_blog_layout', function( value ) {
		value.bind( function( to ) {
			// This would require reloading the page to apply the new layout
			// For live preview, we'll just add a class to the body
			$( 'body' ).removeClass( 'right-sidebar left-sidebar no-sidebar' ).addClass( to );
		} );
	} );

	// Sticky header.
	wp.customize( 'educentrals_sticky_header', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.site-header' ).css( {
					'position': 'sticky',
					'top': '0',
					'z-index': '1000'
				} );
				
				if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
					$( '.site-header' ).css( 'top', '32px' );
				}
			} else {
				$( '.site-header' ).css( {
					'position': 'relative',
					'top': 'auto'
				} );
			}
		} );
	} );

	// Header search.
	wp.customize( 'educentrals_header_search', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.header-search' ).show();
			} else {
				$( '.header-search' ).hide();
			}
		} );
	} );

	// Footer social.
	wp.customize( 'educentrals_footer_social', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.social-links' ).show();
			} else {
				$( '.social-links' ).hide();
			}
		} );
	} );

	// Blog meta.
	wp.customize( 'educentrals_blog_meta', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.post-meta' ).show();
			} else {
				$( '.post-meta' ).hide();
			}
		} );
	} );

	// Blog featured image.
	wp.customize( 'educentrals_blog_featured_image', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.post-thumbnail' ).show();
			} else {
				$( '.post-thumbnail' ).hide();
			}
		} );
	} );

} )( jQuery );