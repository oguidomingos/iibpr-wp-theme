<?php
/**
 * IIBPR Theme functions and definitions.
 */
function iibpr_theme_setup() {
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'iibpr-theme' ),
	) );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'iibpr_theme_setup' );

function iibpr_scripts() {
	// Tailwind CDN (prod: npm build)
	wp_enqueue_style( 'tailwind-css', 'https://cdn.tailwindcss.com', array(), '3.3.0' );
	wp_enqueue_style( 'iibpr-style', get_stylesheet_uri(), array(), '1.0.0' );
	// Google Fonts Inter
	wp_enqueue_style( 'iibpr-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'iibpr_scripts' );

// Customizer (dynamic categories later)
function iibpr_customize_register( $wp_customize ) {
	// Hero title, CTA price etc.
}
add_action( 'customize_register', 'iibpr_customize_register' );
