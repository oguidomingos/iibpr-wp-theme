<?php
/**
 * Template Name: Blog / Notícias
 * Template Post Type: page
 *
 * Página /blog — listagem de posts com paginação.
 */
get_header(); ?>

<main id="main" class="site-main">

	<!-- Page Hero -->
	<section class="bg-gradient-to-br from-gray-800 to-gray-900 text-white py-20 px-4 md:px-8">
		<div class="max-w-4xl mx-auto text-center">
			<p class="section-label text-gray-400 mb-4">Conteúdo</p>
			<h1 class="text-4xl md:text-5xl font-extrabold mb-4">Blog &amp; Notícias</h1>
			<p class="text-xl opacity-75 max-w-2xl mx-auto">
				Artigos, pesquisas e novidades sobre Psicomotricidade Relacional.
			</p>
		</div>
	</section>

	<!-- Posts Grid -->
	<section class="py-20 px-4 md:px-8 bg-gray-50">
		<div class="max-w-6xl mx-auto">

			<?php
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$blog_query = new WP_Query( array(
				'post_type'      => 'post',
				'posts_per_page' => 9,
				'paged'          => $paged,
				'post_status'    => 'publish',
			) );
			?>

			<?php if ( $blog_query->have_posts() ) : ?>
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
				<article class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
					<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'medium', array(
							'class'   => 'w-full h-48 object-cover',
							'loading' => 'lazy',
						) ); ?>
					</a>
					<?php else : ?>
					<div class="h-48 bg-gradient-to-br from-purple-100 to-indigo-100 flex items-center justify-center">
						<span class="text-4xl" aria-hidden="true">📝</span>
					</div>
					<?php endif; ?>
					<div class="p-6">
						<p class="text-xs text-gray-400 mb-2"><?php echo get_the_date(); ?></p>
						<h2 class="text-lg font-bold text-gray-900 mb-2 leading-tight">
							<a href="<?php the_permalink(); ?>" class="hover:text-purple-700 transition-colors">
								<?php the_title(); ?>
							</a>
						</h2>
						<p class="text-gray-600 text-sm leading-relaxed mb-4">
							<?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
						</p>
						<a href="<?php the_permalink(); ?>"
						   class="text-purple-700 font-semibold text-sm hover:text-purple-900 transition-colors inline-flex items-center gap-1">
							Ler mais
							<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
						</a>
					</div>
				</article>
				<?php endwhile; ?>
			</div>

			<!-- Paginação -->
			<div class="mt-12 flex justify-center">
				<?php
				echo paginate_links( array(
					'total'   => $blog_query->max_num_pages,
					'current' => $paged,
					'format'  => '?paged=%#%',
					'prev_text' => '&laquo; Anterior',
					'next_text' => 'Próxima &raquo;',
				) );
				wp_reset_postdata();
				?>
			</div>

			<?php else : ?>
			<div class="text-center py-20">
				<p class="text-5xl mb-6" aria-hidden="true">📝</p>
				<h2 class="text-2xl font-bold text-gray-700 mb-3">Nenhum artigo publicado ainda</h2>
				<p class="text-gray-500">Em breve publicaremos conteúdo sobre Psicomotricidade Relacional.</p>
			</div>
			<?php endif; ?>

		</div>
	</section>

</main>

<?php get_footer(); ?>
