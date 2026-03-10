<?php
/**
 * IIBPR Theme — functions.php
 *
 * Bootstraps o tema: suporte a recursos do WordPress, enqueue de estilos/scripts,
 * registro de menus, widgets e imagem customizada no login.
 */

// Garante que não seja acessado diretamente.
defined( 'ABSPATH' ) || exit;

/* --------------------------------------------------
   1. SETUP DO TEMA
   -------------------------------------------------- */
function iibpr_theme_setup() {
    load_theme_textdomain( 'iibpr-theme', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style',
    ) );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );

    register_nav_menus( array(
        'primary' => esc_html__( 'Menu Principal', 'iibpr-theme' ),
        'footer'  => esc_html__( 'Menu Rodapé', 'iibpr-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'iibpr_theme_setup' );

/* --------------------------------------------------
   2. ENQUEUE DE ESTILOS E SCRIPTS
   -------------------------------------------------- */
function iibpr_scripts() {
    // Tailwind CSS compilado localmente
    wp_enqueue_style( 'iibpr-tailwind', get_template_directory_uri() . '/assets/css/app.css', array(), '2.1.0' );

    // Fontes Google — Inter
    wp_enqueue_style( 'iibpr-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap',
        array(), null
    );

    // Estilo principal do tema
    wp_enqueue_style( 'iibpr-style', get_stylesheet_uri(), array( 'iibpr-tailwind' ), '2.1.0' );

    // Script principal (carousel + mobile menu)
    wp_enqueue_script( 'iibpr-app', get_template_directory_uri() . '/assets/js/app.js', array(), '2.1.0', true );
}
add_action( 'wp_enqueue_scripts', 'iibpr_scripts' );

/**
 * JS inline para o carrossel e menu mobile.
 */
function iibpr_inline_js() {
    return "
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        var toggle = document.querySelector('.mobile-menu-toggle');
        var nav    = document.getElementById('site-navigation');
        if (toggle && nav) {
            toggle.addEventListener('click', function() {
                var isOpen = nav.classList.toggle('open');
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
            // Close on outside click
            document.addEventListener('click', function(e) {
                if (!toggle.contains(e.target) && !nav.contains(e.target)) {
                    nav.classList.remove('open');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // ---- Carrossel universal ----
        document.querySelectorAll('.carousel-wrapper').forEach(function(wrapper) {
            var track  = wrapper.querySelector('.carousel-track');
            var slides = wrapper.querySelectorAll('.carousel-slide');
            var prev   = wrapper.querySelector('.carousel-btn-prev');
            var next   = wrapper.querySelector('.carousel-btn-next');
            var dots   = wrapper.querySelectorAll('.carousel-dot');
            var current = 0;
            var total   = slides.length;
            if (!track || total === 0) return;

            function goTo(idx) {
                current = (idx + total) % total;
                track.style.transform = 'translateX(-' + (current * 100) + '%)';
                dots.forEach(function(d, i) {
                    d.classList.toggle('bg-purple-600', i === current);
                    d.classList.toggle('bg-gray-300',   i !== current);
                });
            }

            if (prev) prev.addEventListener('click', function() { goTo(current - 1); });
            if (next) next.addEventListener('click', function() { goTo(current + 1); });
            dots.forEach(function(d, i) { d.addEventListener('click', function() { goTo(i); }); });

            // Auto-play
            var interval = wrapper.dataset.autoplay ? parseInt(wrapper.dataset.autoplay) : 0;
            if (interval > 0) { setInterval(function() { goTo(current + 1); }, interval); }
        });
    });
    ";
}

/* --------------------------------------------------
   3. WIDGETS / SIDEBAR
   -------------------------------------------------- */
function iibpr_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Barra Lateral', 'iibpr-theme' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-lg font-bold mb-4 text-gray-800">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Rodapé — Coluna 1', 'iibpr-theme' ),
        'id'            => 'footer-1',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="text-sm font-semibold uppercase tracking-wider text-gray-400 mb-4">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'iibpr_widgets_init' );

/* --------------------------------------------------
   4. CUSTOMIZER
   -------------------------------------------------- */
require get_template_directory() . '/inc/customizer.php';

/* --------------------------------------------------
   5. HELPERS
   -------------------------------------------------- */
/**
 * Exibe ou retorna uma configuração do Customizer com fallback.
 */
if ( ! function_exists( 'iibpr_get' ) ) {
    function iibpr_get( $key, $default = '' ) {
        $val = get_theme_mod( $key, $default );
        return $val !== '' ? $val : $default;
    }
}
