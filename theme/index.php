<?php
/**
 * The main template file
 *
 * @package iibpr_main
 */

get_header();
?>

	<section id="primary">
		<main id="main">

		<?php
		if ( have_posts() ) {

			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="entry-header">
					<h1 class="entry-title"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content/content' );
			}

			iibpr_main_the_posts_navigation();

		} else {

			get_template_part( 'template-parts/content/content', 'none' );

		}
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
