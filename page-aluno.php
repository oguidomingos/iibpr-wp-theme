<?php
/**
 * Template Name: Área do Aluno
 * Template Post Type: page
 *
 * Página /aluno — dashboard do aluno (login gate + placeholder LMS).
 * Integração completa com Moodle/WooCommerce será implementada na fase 2.
 */
get_header(); ?>

<main id="main" class="site-main">

	<?php if ( is_user_logged_in() ) :
		$current_user = wp_get_current_user();
	?>

	<!-- Dashboard do Aluno (usuário logado) -->
	<section class="py-20 px-4 md:px-8 bg-gray-50 min-h-screen">
		<div class="max-w-5xl mx-auto">

			<!-- Saudação -->
			<div class="flex items-center justify-between mb-12 flex-wrap gap-4">
				<div>
					<h1 class="text-3xl font-extrabold text-gray-900">
						Olá, <?php echo esc_html( $current_user->display_name ); ?>!
					</h1>
					<p class="text-gray-500 mt-1">Bem-vindo à sua área de formação.</p>
				</div>
				<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"
				   class="text-sm text-gray-500 hover:text-red-600 transition-colors border border-gray-300 px-4 py-2 rounded-full">
					Sair
				</a>
			</div>

			<!-- Cards rápidos -->
			<div class="grid md:grid-cols-3 gap-6 mb-12">
				<div class="bg-white rounded-2xl p-6 shadow-sm border border-purple-100">
					<div class="text-3xl mb-3" aria-hidden="true">📚</div>
					<h2 class="text-lg font-bold text-gray-900">Meus Cursos</h2>
					<p class="text-gray-500 text-sm mt-1">Acesse o conteúdo das suas matrículas.</p>
					<a href="#cursos-aluno" class="text-purple-700 font-semibold text-sm mt-3 inline-block hover:underline">Ver cursos →</a>
				</div>
				<div class="bg-white rounded-2xl p-6 shadow-sm border border-teal-100">
					<div class="text-3xl mb-3" aria-hidden="true">🏆</div>
					<h2 class="text-lg font-bold text-gray-900">Certificados</h2>
					<p class="text-gray-500 text-sm mt-1">Baixe seus certificados de conclusão.</p>
					<a href="#certs" class="text-teal-700 font-semibold text-sm mt-3 inline-block hover:underline">Ver certificados →</a>
				</div>
				<div class="bg-white rounded-2xl p-6 shadow-sm border border-amber-100">
					<div class="text-3xl mb-3" aria-hidden="true">📅</div>
					<h2 class="text-lg font-bold text-gray-900">Próximos Eventos</h2>
					<p class="text-gray-500 text-sm mt-1">Eventos e aulas ao vivo agendadas.</p>
					<a href="<?php echo esc_url( site_url( '/eventos' ) ); ?>" class="text-amber-700 font-semibold text-sm mt-3 inline-block hover:underline">Ver agenda →</a>
				</div>
			</div>

			<!-- Placeholder Moodle -->
			<div id="cursos-aluno" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
				<h2 class="text-xl font-bold text-gray-800 mb-4">Conteúdo dos Cursos</h2>
				<div class="bg-indigo-50 rounded-xl p-6 text-center">
					<p class="text-4xl mb-3" aria-hidden="true">🔜</p>
					<p class="text-gray-700 font-medium">Plataforma de aulas em implementação</p>
					<p class="text-gray-500 text-sm mt-2">
						A integração com o LMS (Moodle) será ativada em breve.<br>
						Enquanto isso, acesse os materiais pelo link enviado no e-mail de confirmação.
					</p>
				</div>
			</div>

		</div>
	</section>

	<?php else : ?>

	<!-- Login Gate (usuário não logado) -->
	<section class="min-h-screen py-20 px-4 md:px-8 bg-gray-50 flex items-center">
		<div class="max-w-md mx-auto w-full">

			<div class="text-center mb-8">
				<div class="text-5xl mb-4" aria-hidden="true">🎓</div>
				<h1 class="text-3xl font-extrabold text-gray-900">Área do Aluno</h1>
				<p class="text-gray-500 mt-2">Faça login para acessar seus cursos e materiais.</p>
			</div>

			<div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
				<?php
				wp_login_form( array(
					'label_username' => 'E-mail',
					'label_password' => 'Senha',
					'label_remember' => 'Lembrar-me',
					'label_log_in'   => 'Entrar',
					'redirect'       => site_url( '/aluno' ),
				) );
				?>
				<p class="text-center text-sm text-gray-500 mt-6">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="text-purple-700 hover:underline">
						Esqueci minha senha
					</a>
				</p>
			</div>

			<p class="text-center text-sm text-gray-500 mt-6">
				Ainda não é aluno?
				<a href="<?php echo esc_url( iibpr_get( 'iibpr_hero_cta_url', '#inscricao' ) ?: site_url( '/#inscricao' ) ); ?>"
				   class="text-purple-700 font-semibold hover:underline">
					Inscreva-se agora
				</a>
			</p>

		</div>
	</section>

	<?php endif; ?>

</main>

<?php get_footer(); ?>
