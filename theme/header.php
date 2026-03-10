<?php
/**
 * The header for our theme
 *
 * @package iibpr_main
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'antialiased' ); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">
	<a href="#content" class="sr-only"><?php esc_html_e( 'Skip to content', 'iibpr_main' ); ?></a>

	<!-- ========== HEADER / NAV ========== -->
	<header id="masthead" class="site-header">
		<div class="max-w-7xl mx-auto px-4 md:px-8 py-4 flex justify-between items-center">

			<!-- Logo / Branding -->
			<div class="site-branding flex items-center gap-3">
				<?php
				$logo_url = iibpr_get( 'iibpr_logo' );
				if ( $logo_url ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-10 w-auto">
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"
					   class="text-2xl font-extrabold gradient-text no-underline">IIBPR</a>
				<?php endif; ?>
				<span class="hidden md:block text-xs text-gray-500 max-w-xs leading-tight">
					<?php echo esc_html( iibpr_get( 'iibpr_hero_tagline', 'Psicomotricidade Relacional' ) ); ?>
				</span>
			</div>

			<!-- Mobile toggle -->
			<button class="mobile-menu-toggle text-gray-600 hover:text-purple-700 focus:outline-none" aria-label="Menu">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
				</svg>
			</button>

			<!-- Navigation -->
			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Menu Principal', 'iibpr_main' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'fallback_cb'    => 'iibpr_fallback_menu',
				) );
				?>
				<a href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D/', '', iibpr_get( 'iibpr_footer_whatsapp_br', '5561991572149' ) ) ); ?>"
				   target="_blank" rel="noopener"
				   class="btn-primary text-sm py-2 px-5 ml-4">
					Fale Conosco
				</a>
			</nav>

		</div>
	</header><!-- #masthead -->

	<div id="content">

<?php
/**
 * Fallback menu.
 */
function iibpr_fallback_menu() {
	echo '<ul id="primary-menu">
		<li><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>
		<li><a href="#cursos">Cursos</a></li>
		<li><a href="#sobre">Sobre</a></li>
		<li><a href="#depoimentos">Depoimentos</a></li>
		<li><a href="#inscricao">Inscrição</a></li>
	</ul>';
}
