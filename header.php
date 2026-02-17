<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header py-4 px-4 md:px-8 bg-white shadow-md">
		<div class="max-w-6xl mx-auto flex justify-between items-center">
			<div class="site-branding">
				<h1 class="text-2xl font-bold text-purple-600">IIBPR</h1>
			</div>
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav>
		</div>
	</header>
