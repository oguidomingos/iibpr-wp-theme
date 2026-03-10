<?php
/**
 * Template Name: Eventos
 * Template Post Type: page
 *
 * Página /eventos — listagem de eventos e seminários.
 */
get_header(); ?>

<main id="main" class="site-main">

	<!-- Page Hero -->
	<section class="bg-gradient-to-br from-indigo-700 via-purple-700 to-teal-600 text-white py-20 px-4 md:px-8">
		<div class="max-w-4xl mx-auto text-center">
			<p class="section-label text-indigo-200 mb-4">Agenda</p>
			<h1 class="text-4xl md:text-5xl font-extrabold mb-4">Eventos &amp; Seminários</h1>
			<p class="text-xl opacity-85 max-w-2xl mx-auto">
				Formações ao vivo, workshops, seminários e eventos presenciais do Instituto IIBPR.
			</p>
		</div>
	</section>

	<!-- Eventos Grid -->
	<section class="py-20 px-4 md:px-8 bg-white">
		<div class="max-w-6xl mx-auto">

			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php for ( $i = 1; $i <= 3; $i++ ) :
					$ev_title = iibpr_get( "iibpr_event_{$i}_title" );
					$ev_date  = iibpr_get( "iibpr_event_{$i}_date" );
					$ev_type  = iibpr_get( "iibpr_event_{$i}_type" );
					$ev_desc  = iibpr_get( "iibpr_event_{$i}_desc" );
					$ev_url   = iibpr_get( "iibpr_event_{$i}_url" );
					if ( ! $ev_title ) continue;
				?>
				<article class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden border border-indigo-100">
					<div class="h-2 bg-gradient-to-r from-purple-600 to-teal-500"></div>
					<div class="p-6">
						<?php if ( $ev_type ) : ?>
						<span class="inline-block bg-purple-100 text-purple-700 text-xs font-semibold px-3 py-1 rounded-full mb-3">
							<?php echo esc_html( $ev_type ); ?>
						</span>
						<?php endif; ?>
						<h2 class="text-lg font-bold text-gray-900 mb-2"><?php echo esc_html( $ev_title ); ?></h2>
						<?php if ( $ev_date ) : ?>
						<p class="text-sm text-purple-600 font-medium mb-3 flex items-center gap-1">
							<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
							</svg>
							<?php echo esc_html( $ev_date ); ?>
						</p>
						<?php endif; ?>
						<?php if ( $ev_desc ) : ?>
						<p class="text-gray-600 text-sm leading-relaxed mb-4"><?php echo wp_kses_post( $ev_desc ); ?></p>
						<?php endif; ?>
						<?php if ( $ev_url ) : ?>
						<a href="<?php echo esc_url( $ev_url ); ?>"
						   class="btn-primary text-sm py-2 px-5 inline-block">
							Inscreva-se
						</a>
						<?php endif; ?>
					</div>
				</article>
				<?php endfor; ?>
			</div>

			<!-- Eventos Passados -->
			<div class="mt-20">
				<h2 class="text-2xl font-bold text-gray-700 mb-8 text-center">Eventos Realizados</h2>
				<div class="grid md:grid-cols-2 gap-6">
					<?php
					$past_events = array(
						array( 'year' => '2024', 'title' => 'Seminário Psicomotricidade e Aprendizagem', 'type' => 'Seminário Online' ),
						array( 'year' => '2023', 'title' => 'Workshop Corpo e Movimento', 'type' => 'Presencial — Brasília' ),
						array( 'year' => '2023', 'title' => 'Módulo 3 — Formação Anual', 'type' => 'Presencial + Online' ),
						array( 'year' => '2022', 'title' => 'Congresso IIBPR de Psicomotricidade', 'type' => 'Online' ),
					);
					foreach ( $past_events as $ev ) : ?>
					<div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
						<span class="text-3xl font-extrabold text-gray-300 leading-none"><?php echo esc_html( $ev['year'] ); ?></span>
						<div>
							<p class="font-semibold text-gray-800"><?php echo esc_html( $ev['title'] ); ?></p>
							<p class="text-sm text-gray-500"><?php echo esc_html( $ev['type'] ); ?></p>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
	</section>

</main>

<?php get_footer(); ?>
