<?php
/**
 * Template Name: Catálogo de Cursos
 * Template Post Type: page
 *
 * Página /cursos — grade de cursos com filtros laterais.
 */
get_header(); ?>

<main id="main" class="site-main">

	<!-- Page Hero -->
	<section class="bg-gradient-to-br from-purple-700 via-indigo-700 to-teal-600 text-white py-20 px-4 md:px-8">
		<div class="max-w-4xl mx-auto text-center">
			<p class="section-label text-purple-200 mb-4">Formação</p>
			<h1 class="text-4xl md:text-5xl font-extrabold mb-4">Nossos Cursos</h1>
			<p class="text-xl opacity-85 max-w-2xl mx-auto">
				Formação especializada em Psicomotricidade Relacional — pós-graduação, seminários e cursos livres.
			</p>
		</div>
	</section>

	<!-- Cursos Grid -->
	<section class="py-20 px-4 md:px-8 bg-gray-50">
		<div class="max-w-6xl mx-auto">

			<!-- Filtros rápidos -->
			<div class="flex flex-wrap gap-3 mb-12 justify-center">
				<button class="filter-btn active px-5 py-2 rounded-full text-sm font-semibold border-2 border-purple-600 bg-purple-600 text-white transition-all" data-filter="all">Todos</button>
				<button class="filter-btn px-5 py-2 rounded-full text-sm font-semibold border-2 border-gray-300 text-gray-600 hover:border-purple-600 hover:text-purple-700 transition-all" data-filter="pos">Pós-Graduação</button>
				<button class="filter-btn px-5 py-2 rounded-full text-sm font-semibold border-2 border-gray-300 text-gray-600 hover:border-purple-600 hover:text-purple-700 transition-all" data-filter="seminario">Seminários</button>
				<button class="filter-btn px-5 py-2 rounded-full text-sm font-semibold border-2 border-gray-300 text-gray-600 hover:border-purple-600 hover:text-purple-700 transition-all" data-filter="livre">Cursos Livres</button>
			</div>

			<!-- Cursos via WP_Query -->
			<?php
			$args = array(
				'post_type'      => array( 'page', 'post' ),
				'posts_per_page' => 12,
				'meta_key'       => 'iibpr_course',
				'meta_value'     => '1',
			);
			$courses_query = new WP_Query( $args );

			// Fallback: exibe cursos estáticos do customizer
			$has_custom_courses = false;
			for ( $i = 1; $i <= 3; $i++ ) {
				if ( iibpr_get( "iibpr_course_{$i}_title" ) ) { $has_custom_courses = true; break; }
			}
			?>

			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php
				// Cursos do Customizer (fonte principal enquanto não há CPT configurado)
				$course_badges = array(
					1 => array( 'badge_bg' => 'bg-purple-100 text-purple-700', 'filter' => 'pos' ),
					2 => array( 'badge_bg' => 'bg-teal-100 text-teal-700',    'filter' => 'seminario' ),
					3 => array( 'badge_bg' => 'bg-amber-100 text-amber-700',  'filter' => 'livre' ),
				);
				for ( $i = 1; $i <= 3; $i++ ) :
					$title = iibpr_get( "iibpr_course_{$i}_title" );
					$badge = iibpr_get( "iibpr_course_{$i}_badge" );
					$hours = iibpr_get( "iibpr_course_{$i}_hours" );
					$desc  = iibpr_get( "iibpr_course_{$i}_desc" );
					$price = iibpr_get( "iibpr_course_{$i}_price" );
					$cta   = iibpr_get( "iibpr_course_{$i}_cta" );
					$url   = iibpr_get( "iibpr_course_{$i}_url" );
					$image = iibpr_get( "iibpr_course_{$i}_image" );
					if ( ! $title ) continue;
					$meta = $course_badges[$i];
				?>
				<article class="course-card flex flex-col" data-filter="<?php echo esc_attr( $meta['filter'] ); ?>">
					<?php if ( $image ) : ?>
					<div class="h-48 overflow-hidden rounded-t-2xl">
						<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>"
						     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
						     loading="lazy">
					</div>
					<?php else : ?>
					<div class="h-48 bg-gradient-to-br from-purple-500 via-indigo-500 to-teal-500 rounded-t-2xl flex items-center justify-center">
						<span class="text-5xl" aria-hidden="true">📚</span>
					</div>
					<?php endif; ?>
					<div class="p-6 flex flex-col flex-1">
						<div class="flex items-center justify-between mb-3">
							<?php if ( $badge ) : ?>
							<span class="course-card-badge <?php echo esc_attr( $meta['badge_bg'] ); ?>">
								<?php echo esc_html( $badge ); ?>
							</span>
							<?php endif; ?>
							<?php if ( $hours ) : ?>
							<span class="text-sm font-semibold text-gray-500"><?php echo esc_html( $hours ); ?></span>
							<?php endif; ?>
						</div>
						<h2 class="text-xl font-bold text-gray-900 mb-3"><?php echo esc_html( $title ); ?></h2>
						<p class="text-gray-600 text-sm leading-relaxed flex-1"><?php echo wp_kses_post( $desc ); ?></p>
						<div class="mt-6 flex items-center justify-between">
							<?php if ( $price ) : ?>
							<span class="text-2xl font-extrabold text-gray-900"><?php echo esc_html( $price ); ?></span>
							<?php else : ?>
							<span></span>
							<?php endif; ?>
							<?php if ( $cta && $url ) : ?>
							<a href="<?php echo esc_url( $url ); ?>" class="btn-primary text-sm py-2 px-5">
								<?php echo esc_html( $cta ); ?>
							</a>
							<?php endif; ?>
						</div>
					</div>
				</article>
				<?php endfor; ?>
			</div>

		</div>
	</section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var filterBtns = document.querySelectorAll('.filter-btn');
	var cards = document.querySelectorAll('[data-filter]');
	filterBtns.forEach(function(btn) {
		btn.addEventListener('click', function() {
			var filter = this.dataset.filter;
			filterBtns.forEach(function(b) {
				b.classList.remove('active', 'bg-purple-600', 'text-white', 'border-purple-600');
				b.classList.add('border-gray-300', 'text-gray-600');
			});
			this.classList.add('active', 'bg-purple-600', 'text-white', 'border-purple-600');
			this.classList.remove('border-gray-300', 'text-gray-600');
			cards.forEach(function(card) {
				card.style.display = (filter === 'all' || card.dataset.filter === filter) ? '' : 'none';
			});
		});
	});
});
</script>

<?php get_footer(); ?>
