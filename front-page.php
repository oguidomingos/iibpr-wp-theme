<?php
/**
 * Front Page — template principal da landing page do IIBPR.
 * Todo o conteúdo vem do Customizer (Painel > Aparência > Personalizar).
 */
get_header(); ?>

<main id="main" class="site-main">

	<!-- =====================================================
	     1. HERO
	     ===================================================== -->
	<section id="home" class="iibpr-hero min-h-screen flex items-center py-20 px-4 md:px-8"
	         <?php
	         $bg = iibpr_get( 'iibpr_hero_bg_image' );
	         if ( $bg ) : ?>
	         style="background-image: linear-gradient(135deg, rgba(30,27,75,0.88) 0%, rgba(91,33,182,0.80) 60%, rgba(13,148,136,0.75) 100%), url('<?php echo esc_url( $bg ); ?>'); background-size: cover; background-position: center;"
	         <?php endif; ?>>
		<div class="max-w-5xl mx-auto text-center text-white w-full">

			<!-- Tagline -->
			<div class="inline-block bg-white/20 backdrop-blur px-4 py-1 rounded-full text-sm font-medium mb-6 tracking-wide">
				<?php echo esc_html( iibpr_get( 'iibpr_hero_tagline', 'Onde há movimento, há vida em relação!' ) ); ?>
			</div>

			<!-- Título -->
			<h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
				<?php echo wp_kses_post( iibpr_get( 'iibpr_hero_title', 'Inscrições Abertas para Formação em Psicomotricidade' ) ); ?>
			</h1>

			<!-- Subtítulo -->
			<p class="text-xl md:text-2xl opacity-85 mb-10 max-w-2xl mx-auto">
				<?php echo wp_kses_post( iibpr_get( 'iibpr_hero_subtitle', 'Especialização de 420h em parceria com o IESB.' ) ); ?>
			</p>

			<!-- CTAs -->
			<div class="flex flex-col sm:flex-row gap-4 justify-center">
				<?php
				$cta_label = iibpr_get( 'iibpr_hero_cta_label', 'Quero Garantir Minha Vaga' );
				$cta_url   = iibpr_get( 'iibpr_hero_cta_url', '#inscricao' );
				?>
				<a href="<?php echo esc_url( $cta_url ); ?>" class="btn-primary text-center">
					<?php echo esc_html( $cta_label ); ?>
				</a>
				<?php
				$sec_label = iibpr_get( 'iibpr_hero_secondary_label', 'Conheça os Cursos' );
				$sec_url   = iibpr_get( 'iibpr_hero_secondary_url', '#cursos' );
				if ( $sec_label ) : ?>
				<a href="<?php echo esc_url( $sec_url ); ?>"
				   class="border-2 border-white/70 text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-white/10 transition-all text-center">
					<?php echo esc_html( $sec_label ); ?>
				</a>
				<?php endif; ?>
			</div>

			<!-- Scroll arrow -->
			<div class="mt-16 animate-bounce">
				<a href="#cursos" class="text-white/50 hover:text-white transition-colors" aria-label="Rolar para baixo">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
					</svg>
				</a>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     2. CURSOS EM DESTAQUE (Carrossel / Grid)
	     ===================================================== -->
	<section id="cursos" class="py-20 px-4 md:px-8 bg-gray-50">
		<div class="max-w-6xl mx-auto">

			<div class="text-center mb-14">
				<p class="section-label">Formação</p>
				<h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">Cursos em Destaque</h2>
			</div>

			<!-- Carrossel mobile / grid desktop -->
			<div class="carousel-wrapper" data-autoplay="0">
				<div class="carousel-track md:grid md:grid-cols-3 md:gap-8">
					<?php
					$course_colors = array(
						1 => array( 'badge_bg' => 'bg-purple-100 text-purple-700', 'btn_class' => 'btn-primary',   'hours_color' => 'text-purple-600' ),
						2 => array( 'badge_bg' => 'bg-teal-100 text-teal-700',    'btn_class' => 'btn-secondary',  'hours_color' => 'text-teal-600' ),
						3 => array( 'badge_bg' => 'bg-amber-100 text-amber-700',  'btn_class' => 'btn-secondary',  'hours_color' => 'text-amber-600' ),
					);
					for ( $i = 1; $i <= 3; $i++ ) :
						$title  = iibpr_get( "iibpr_course_{$i}_title" );
						$badge  = iibpr_get( "iibpr_course_{$i}_badge" );
						$hours  = iibpr_get( "iibpr_course_{$i}_hours" );
						$desc   = iibpr_get( "iibpr_course_{$i}_desc" );
						$price  = iibpr_get( "iibpr_course_{$i}_price" );
						$cta    = iibpr_get( "iibpr_course_{$i}_cta" );
						$url    = iibpr_get( "iibpr_course_{$i}_url" );
						$image  = iibpr_get( "iibpr_course_{$i}_image" );
						$colors = $course_colors[$i];
					?>
					<div class="carousel-slide">
						<article class="course-card h-full flex flex-col mx-2 md:mx-0">
							<?php if ( $image ) : ?>
							<div class="h-48 overflow-hidden">
								<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>"
								     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
							</div>
							<?php else : ?>
							<div class="h-48 bg-gradient-to-br from-purple-500 via-indigo-500 to-teal-500 flex items-center justify-center">
								<span class="text-5xl">📚</span>
							</div>
							<?php endif; ?>

							<div class="p-6 flex flex-col flex-1">
								<div class="flex items-center justify-between mb-3">
									<?php if ( $badge ) : ?>
									<span class="course-card-badge <?php echo esc_attr( $colors['badge_bg'] ); ?>">
										<?php echo esc_html( $badge ); ?>
									</span>
									<?php endif; ?>
									<?php if ( $hours ) : ?>
									<span class="text-sm font-semibold <?php echo esc_attr( $colors['hours_color'] ); ?>">
										<?php echo esc_html( $hours ); ?>
									</span>
									<?php endif; ?>
								</div>

								<h3 class="text-xl font-bold text-gray-900 mb-3"><?php echo esc_html( $title ); ?></h3>
								<p class="text-gray-600 text-sm leading-relaxed flex-1"><?php echo wp_kses_post( $desc ); ?></p>

								<div class="mt-6 flex items-center justify-between">
									<?php if ( $price ) : ?>
									<span class="text-2xl font-extrabold text-gray-900"><?php echo esc_html( $price ); ?></span>
									<?php else : ?>
									<span></span>
									<?php endif; ?>
									<?php if ( $cta && $url ) : ?>
									<a href="<?php echo esc_url( $url ); ?>"
									   class="<?php echo esc_attr( $colors['btn_class'] ); ?> text-sm py-2 px-5">
										<?php echo esc_html( $cta ); ?>
									</a>
									<?php endif; ?>
								</div>
							</div>
						</article>
					</div>
					<?php endfor; ?>
				</div>

				<!-- Carousel buttons (visible on mobile) -->
				<button class="carousel-btn carousel-btn-prev md:hidden" aria-label="Anterior">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
					</svg>
				</button>
				<button class="carousel-btn carousel-btn-next md:hidden" aria-label="Próximo">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
				</button>
			</div>

			<!-- Carousel dots (mobile) -->
			<div class="flex justify-center gap-2 mt-6 md:hidden">
				<?php for ( $i = 0; $i < 3; $i++ ) : ?>
				<button class="carousel-dot w-2.5 h-2.5 rounded-full <?php echo $i === 0 ? 'bg-purple-600' : 'bg-gray-300'; ?>"
				        aria-label="Slide <?php echo $i + 1; ?>"></button>
				<?php endfor; ?>
			</div>

		</div>
	</section>

	<!-- =====================================================
	     3. SOBRE O INSTITUTO / 3 PILARES
	     ===================================================== -->
	<section id="sobre" class="py-20 px-4 md:px-8 bg-white">
		<div class="max-w-6xl mx-auto">

			<div class="text-center mb-14">
				<p class="section-label"><?php echo esc_html( iibpr_get( 'iibpr_about_label', 'Sobre o Instituto' ) ); ?></p>
				<h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">
					<?php echo wp_kses_post( iibpr_get( 'iibpr_about_title', 'Alcance Saúde — Integral e Relacional' ) ); ?>
				</h2>
				<p class="max-w-2xl mx-auto text-gray-600 text-lg mt-4">
					<?php echo wp_kses_post( iibpr_get( 'iibpr_about_text', '' ) ); ?>
				</p>
			</div>

			<!-- 3 pilares -->
			<div class="grid md:grid-cols-3 gap-8">
				<?php for ( $i = 1; $i <= 3; $i++ ) :
					$icon  = iibpr_get( "iibpr_pillar_{$i}_icon" );
					$title = iibpr_get( "iibpr_pillar_{$i}_title" );
					$text  = iibpr_get( "iibpr_pillar_{$i}_text" );
				?>
				<div class="pillar-card">
					<?php if ( $icon ) : ?>
					<div class="text-4xl mb-4"><?php echo esc_html( $icon ); ?></div>
					<?php endif; ?>
					<h3 class="text-xl font-bold text-gray-900 mb-3"><?php echo esc_html( $title ); ?></h3>
					<p class="text-gray-600 leading-relaxed"><?php echo wp_kses_post( $text ); ?></p>
				</div>
				<?php endfor; ?>
			</div>

		</div>
	</section>

	<!-- =====================================================
	     4. EVENTOS EM DESTAQUE
	     ===================================================== -->
	<section id="eventos" class="py-20 px-4 md:px-8 bg-indigo-50">
		<div class="max-w-6xl mx-auto">

			<div class="text-center mb-14">
				<p class="section-label">Agenda</p>
				<h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">Próximos Eventos</h2>
				<p class="text-gray-500 mt-3 max-w-xl mx-auto">Seminários, workshops e formações presenciais e online.</p>
			</div>

			<div class="grid md:grid-cols-3 gap-8">
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
						<h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo esc_html( $ev_title ); ?></h3>
						<?php if ( $ev_date ) : ?>
						<p class="text-sm text-purple-600 font-medium mb-3 flex items-center gap-1">
							<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
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
						   class="text-purple-700 font-semibold text-sm hover:text-purple-900 transition-colors inline-flex items-center gap-1">
							Saiba mais
							<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
						</a>
						<?php endif; ?>
					</div>
				</article>
				<?php endfor; ?>
			</div>

			<div class="text-center mt-12">
				<a href="<?php echo esc_url( site_url( '/eventos' ) ); ?>" class="btn-secondary">
					Ver Todos os Eventos
				</a>
			</div>

		</div>
	</section>

	<!-- =====================================================
	     5. DEPOIMENTOS (Carrossel automático)
	     ===================================================== -->
	<section id="depoimentos" class="py-20 px-4 md:px-8 bg-gray-50">
		<div class="max-w-4xl mx-auto">

			<div class="text-center mb-14">
				<p class="section-label">Histórias</p>
				<h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">O que dizem nossos alunos</h2>
			</div>

			<div class="carousel-wrapper" data-autoplay="5000">
				<div class="carousel-track">
					<?php for ( $i = 1; $i <= 4; $i++ ) :
						$quote  = iibpr_get( "iibpr_testimonial_{$i}_quote" );
						$author = iibpr_get( "iibpr_testimonial_{$i}_author" );
						if ( ! $quote ) continue;
					?>
					<div class="carousel-slide px-2">
						<blockquote class="testimonial-card">
							<svg class="w-8 h-8 text-purple-300 mb-4" fill="currentColor" viewBox="0 0 24 24">
								<path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
							</svg>
							<p class="text-gray-700 text-lg leading-relaxed mb-6"><?php echo wp_kses_post( $quote ); ?></p>
							<footer class="font-semibold text-gray-900">— <?php echo esc_html( $author ); ?></footer>
						</blockquote>
					</div>
					<?php endfor; ?>
				</div>

				<button class="carousel-btn carousel-btn-prev" aria-label="Anterior">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
					</svg>
				</button>
				<button class="carousel-btn carousel-btn-next" aria-label="Próximo">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
				</button>
			</div>

			<!-- Dots -->
			<div class="flex justify-center gap-2 mt-6">
				<?php for ( $i = 0; $i < 4; $i++ ) : ?>
				<button class="carousel-dot w-2.5 h-2.5 rounded-full <?php echo $i === 0 ? 'bg-purple-600' : 'bg-gray-300'; ?>"
				        aria-label="Depoimento <?php echo $i + 1; ?>"></button>
				<?php endfor; ?>
			</div>

		</div>
	</section>

	<!-- =====================================================
	     6. CTA FINAL / INSCRIÇÃO
	     ===================================================== -->
	<section id="inscricao" class="py-24 px-4 md:px-8 bg-gradient-to-br from-purple-700 via-indigo-700 to-teal-600 text-white text-center">
		<div class="max-w-3xl mx-auto">

			<p class="section-label text-purple-200 mb-4">Inscrições Abertas</p>
			<h2 class="text-3xl md:text-5xl font-extrabold mb-6">
				<?php echo wp_kses_post( iibpr_get( 'iibpr_cta_title', 'Invista no Seu Desenvolvimento Profissional' ) ); ?>
			</h2>
			<p class="text-xl opacity-85 mb-8 max-w-xl mx-auto">
				<?php echo wp_kses_post( iibpr_get( 'iibpr_cta_subtitle', 'Certificado + e-book + textos científicos. Transmissão Zoom.' ) ); ?>
			</p>

			<?php $price = iibpr_get( 'iibpr_cta_price', 'A partir de R$ 69,90' ); if ( $price ) : ?>
			<div class="text-4xl font-extrabold mb-10">
				<?php echo esc_html( $price ); ?>
			</div>
			<?php endif; ?>

			<div class="flex flex-col sm:flex-row gap-4 justify-center">
				<?php
				$btn_label = iibpr_get( 'iibpr_cta_btn_label', 'Agende Agora via WhatsApp' );
				$btn_url   = iibpr_get( 'iibpr_cta_btn_url', '#' );
				?>
				<a href="<?php echo esc_url( $btn_url ); ?>" target="_blank" rel="noopener"
				   class="bg-white text-purple-700 px-10 py-4 rounded-full text-lg font-bold hover:bg-gray-100 shadow-2xl transition-all hover:-translate-y-1">
					<?php echo esc_html( $btn_label ); ?>
				</a>
				<?php
				$btn2_label = iibpr_get( 'iibpr_cta_btn2_label', 'Enviar Email' );
				$btn2_url   = iibpr_get( 'iibpr_cta_btn2_url', '#' );
				if ( $btn2_label ) : ?>
				<a href="<?php echo esc_url( $btn2_url ); ?>"
				   class="border-2 border-white/70 text-white px-10 py-4 rounded-full text-lg font-semibold hover:bg-white/10 transition-all text-center">
					<?php echo esc_html( $btn2_label ); ?>
				</a>
				<?php endif; ?>
			</div>

		</div>
	</section>

</main><!-- #main -->

<?php get_footer(); ?>
