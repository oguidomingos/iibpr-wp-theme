<?php
/**
 * Template Name: Sobre o Instituto
 * Template Post Type: page
 *
 * Página /sobre — história, missão e equipe do IIBPR.
 */
get_header(); ?>

<main id="main" class="site-main">

	<!-- Hero -->
	<section class="bg-gradient-to-br from-purple-700 to-indigo-800 text-white py-20 px-4 md:px-8">
		<div class="max-w-4xl mx-auto text-center">
			<p class="section-label text-purple-200 mb-4">Institucional</p>
			<h1 class="text-4xl md:text-5xl font-extrabold mb-4">Sobre o IIBPR</h1>
			<p class="text-xl opacity-85 max-w-2xl mx-auto">
				<?php echo wp_kses_post( iibpr_get( 'iibpr_about_text', 'Instituto brasileiro de referência em Psicomotricidade Relacional, com mais de 20 anos formando profissionais de saúde e educação.' ) ); ?>
			</p>
		</div>
	</section>

	<!-- Missão / Pilares -->
	<section class="py-20 px-4 md:px-8 bg-white">
		<div class="max-w-6xl mx-auto">
			<div class="text-center mb-14">
				<p class="section-label">Nossa Proposta</p>
				<h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">
					<?php echo wp_kses_post( iibpr_get( 'iibpr_about_title', 'Alcance Saúde — Integral e Relacional' ) ); ?>
				</h2>
			</div>
			<div class="grid md:grid-cols-3 gap-8">
				<?php for ( $i = 1; $i <= 3; $i++ ) :
					$icon  = iibpr_get( "iibpr_pillar_{$i}_icon" );
					$title = iibpr_get( "iibpr_pillar_{$i}_title" );
					$text  = iibpr_get( "iibpr_pillar_{$i}_text" );
				?>
				<div class="pillar-card">
					<?php if ( $icon ) : ?>
					<div class="text-4xl mb-4" aria-hidden="true"><?php echo esc_html( $icon ); ?></div>
					<?php endif; ?>
					<h3 class="text-xl font-bold text-gray-900 mb-3"><?php echo esc_html( $title ); ?></h3>
					<p class="text-gray-600 leading-relaxed"><?php echo wp_kses_post( $text ); ?></p>
				</div>
				<?php endfor; ?>
			</div>
		</div>
	</section>

	<!-- Números -->
	<section class="py-20 px-4 md:px-8 bg-purple-700 text-white">
		<div class="max-w-5xl mx-auto grid md:grid-cols-4 gap-8 text-center">
			<?php
			$stats = array(
				array( 'number' => '+20', 'label' => 'Anos de experiência' ),
				array( 'number' => '1.500+', 'label' => 'Alunos formados' ),
				array( 'number' => '5', 'label' => 'Países atendidos' ),
				array( 'number' => '420h', 'label' => 'Pós-graduação' ),
			);
			foreach ( $stats as $stat ) : ?>
			<div>
				<div class="text-4xl font-extrabold"><?php echo esc_html( $stat['number'] ); ?></div>
				<div class="text-purple-200 mt-1 text-sm"><?php echo esc_html( $stat['label'] ); ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- CTA -->
	<section class="py-16 px-4 md:px-8 bg-gray-50 text-center">
		<div class="max-w-xl mx-auto">
			<h2 class="text-2xl font-extrabold text-gray-900 mb-4">Junte-se à nossa comunidade</h2>
			<p class="text-gray-600 mb-8">Inscreva-se em nossos cursos e faça parte de uma rede de profissionais comprometidos com o desenvolvimento humano.</p>
			<a href="<?php echo esc_url( site_url( '/cursos' ) ); ?>" class="btn-primary mr-3">Ver Cursos</a>
			<a href="<?php echo esc_url( iibpr_get( 'iibpr_cta_btn_url', '#' ) ); ?>" target="_blank" rel="noopener"
			   class="btn-secondary">Fale Conosco</a>
		</div>
	</section>

</main>

<?php get_footer(); ?>
