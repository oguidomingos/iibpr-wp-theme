<?php
/**
 * IIBPR Psicomotricidade — functions.php
 *
 * Merged from _tw blank theme structure + IIBPR customisations.
 *
 * @package iibpr_main
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'IIBPR_MAIN_VERSION' ) ) {
	define( 'IIBPR_MAIN_VERSION', '2.0.0' );
}

if ( ! defined( 'IIBPR_MAIN_TYPOGRAPHY_CLASSES' ) ) {
	define(
		'IIBPR_MAIN_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

/* --------------------------------------------------
   1. SETUP DO TEMA
   -------------------------------------------------- */
if ( ! function_exists( 'iibpr_main_setup' ) ) :
	function iibpr_main_setup() {
		load_theme_textdomain( 'iibpr_main', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 240,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		register_nav_menus( array(
			'menu-1' => __( 'Primary', 'iibpr_main' ),
			'menu-2' => __( 'Footer Menu', 'iibpr_main' ),
		) );

		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list',
			'gallery', 'caption', 'style', 'script',
		) );

		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style-editor.css' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'iibpr_main_setup' );

/* --------------------------------------------------
   2. WIDGETS / SIDEBAR
   -------------------------------------------------- */
function iibpr_main_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer', 'iibpr_main' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'iibpr_main' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Rodapé — Coluna 1', 'iibpr_main' ),
		'id'            => 'footer-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="text-sm font-semibold uppercase tracking-wider text-gray-400 mb-4">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'iibpr_main_widgets_init' );

/* --------------------------------------------------
   3. ENQUEUE — SCRIPTS & STYLES
   -------------------------------------------------- */
function iibpr_main_scripts() {
	wp_enqueue_style( 'iibpr_main-style', get_stylesheet_uri(), array(), IIBPR_MAIN_VERSION );
	wp_enqueue_script( 'iibpr_main-script', get_template_directory_uri() . '/js/script.min.js', array(), IIBPR_MAIN_VERSION, true );

	// Google Fonts — Inter
	wp_enqueue_style( 'iibpr-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap',
		array(), null
	);

	// JS logic is in javascript/script.js → compiled to theme/js/script.min.js via esbuild.
	// Run: npm run build (or npm run start for watch mode).

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'iibpr_main_scripts' );

/* --------------------------------------------------
   4. BLOCK EDITOR
   -------------------------------------------------- */
function iibpr_main_enqueue_block_editor_script() {
	$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if (
		$current_screen &&
		$current_screen->is_block_editor() &&
		'widgets' !== $current_screen->id
	) {
		wp_enqueue_script(
			'iibpr_main-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array( 'wp-blocks', 'wp-edit-post' ),
			IIBPR_MAIN_VERSION,
			true
		);
		wp_add_inline_script( 'iibpr_main-editor', "tailwindTypographyClasses = '" . esc_attr( IIBPR_MAIN_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'iibpr_main_enqueue_block_editor_script' );

function iibpr_main_tinymce_add_class( $settings ) {
	$settings['body_class'] = IIBPR_MAIN_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'iibpr_main_tinymce_add_class' );

function iibpr_main_modify_heading_levels( $args, $block_type ) {
	if ( 'core/heading' !== $block_type ) {
		return $args;
	}
	$args['attributes']['levelOptions']['default'] = array( 2, 3, 4 );
	return $args;
}
add_filter( 'register_block_type_args', 'iibpr_main_modify_heading_levels', 10, 2 );

/* --------------------------------------------------
   5. CUSTOMIZER (IIBPR settings)
   -------------------------------------------------- */
require get_template_directory() . '/inc/customizer.php';

/* --------------------------------------------------
   6. TEMPLATE TAGS & FUNCTIONS (from _tw)
   -------------------------------------------------- */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

/* --------------------------------------------------
   7. HELPERS
   -------------------------------------------------- */
if ( ! function_exists( 'iibpr_get' ) ) {
	function iibpr_get( $key, $default = '' ) {
		$val = get_theme_mod( $key, $default );
		return $val !== '' ? $val : $default;
	}
}
