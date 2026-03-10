<?php
/**
 * IIBPR Theme Customizer
 *
 * Registra todas as opções editáveis via Painel > Aparência > Personalizar.
 */

function iibpr_customize_register( $wp_customize ) {

    /* =====================================================
       PAINEL: HERO
       ===================================================== */
    $wp_customize->add_panel( 'iibpr_hero_panel', array(
        'title'    => __( 'Hero Principal', 'iibpr-theme' ),
        'priority' => 30,
    ) );

    // --- Seção: Textos do Hero ---
    $wp_customize->add_section( 'iibpr_hero_texts', array(
        'title' => __( 'Textos do Hero', 'iibpr-theme' ),
        'panel' => 'iibpr_hero_panel',
    ) );

    $hero_texts = array(
        'iibpr_hero_tagline'    => array( 'label' => 'Slogan do Instituto',        'default' => 'Onde há movimento, há vida em relação!' ),
        'iibpr_hero_title'      => array( 'label' => 'Título Principal do Hero',   'default' => 'Inscrições Abertas para Formação em Psicomotricidade' ),
        'iibpr_hero_subtitle'   => array( 'label' => 'Subtítulo do Hero',          'default' => 'Especialização de 420h em parceria com o IESB, com instrutores reconhecidos nacional e internacionalmente.' ),
        'iibpr_hero_cta_label'  => array( 'label' => 'Texto do Botão CTA Principal', 'default' => 'Quero Garantir Minha Vaga' ),
        'iibpr_hero_cta_url'    => array( 'label' => 'URL do Botão CTA Principal',  'default' => '#inscricao' ),
        'iibpr_hero_secondary_label' => array( 'label' => 'Botão Secundário (texto)', 'default' => 'Conheça os Cursos' ),
        'iibpr_hero_secondary_url'   => array( 'label' => 'Botão Secundário (URL)',  'default' => '#cursos' ),
    );
    foreach ( $hero_texts as $id => $args ) {
        $wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'iibpr_hero_texts', 'type' => 'text' ) );
    }

    // --- Seção: Imagem do Hero ---
    $wp_customize->add_section( 'iibpr_hero_image', array(
        'title' => __( 'Imagem de Fundo do Hero', 'iibpr-theme' ),
        'panel' => 'iibpr_hero_panel',
    ) );
    $wp_customize->add_setting( 'iibpr_hero_bg_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'iibpr_hero_bg_image', array(
        'label'   => __( 'Imagem de Fundo', 'iibpr-theme' ),
        'section' => 'iibpr_hero_image',
    ) ) );

    /* =====================================================
       PAINEL: SOBRE O INSTITUTO
       ===================================================== */
    $wp_customize->add_panel( 'iibpr_about_panel', array(
        'title'    => __( 'Sobre o Instituto', 'iibpr-theme' ),
        'priority' => 40,
    ) );

    $wp_customize->add_section( 'iibpr_about_section', array(
        'title' => __( 'Textos "Sobre"', 'iibpr-theme' ),
        'panel' => 'iibpr_about_panel',
    ) );

    $about_fields = array(
        'iibpr_about_label'   => array( 'label' => 'Label da seção',  'default' => 'Sobre o Instituto', 'type' => 'text' ),
        'iibpr_about_title'   => array( 'label' => 'Título da seção', 'default' => 'Alcance Saúde — Integral e Relacional', 'type' => 'text' ),
        'iibpr_about_text'    => array( 'label' => 'Parágrafo intro',  'default' => 'O Instituto IIBPR tem como missão promover a saúde física, mental e social por meio do desenvolvimento humano integral via psicomotricidade relacional.', 'type' => 'textarea' ),
    );
    foreach ( $about_fields as $id => $args ) {
        $wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'iibpr_about_section', 'type' => $args['type'] ) );
    }

    // 3 Pilares
    for ( $i = 1; $i <= 3; $i++ ) {
        $defaults = array(
            1 => array( 'title' => 'Psicomotricidade', 'text' => 'Estudo do ser humano através do movimento corporal e das relações internas e externas.', 'icon' => '🧠' ),
            2 => array( 'title' => 'Relacional',        'text' => 'O ser humano como ser de relação que necessita de conexões humanas vitais.',           'icon' => '🤝' ),
            3 => array( 'title' => 'Psicodinâmica',     'text' => 'Conflitos internos enraizados na infância, trabalhados por intervenção psicocorporal.',  'icon' => '🌱' ),
        );
        $wp_customize->add_section( "iibpr_pillar_{$i}", array(
            'title' => "Pilar {$i}", 'panel' => 'iibpr_about_panel',
        ) );
        $wp_customize->add_setting( "iibpr_pillar_{$i}_icon",  array( 'default' => $defaults[$i]['icon'], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "iibpr_pillar_{$i}_icon",  array( 'label' => 'Emoji / ícone', 'section' => "iibpr_pillar_{$i}", 'type' => 'text' ) );
        $wp_customize->add_setting( "iibpr_pillar_{$i}_title", array( 'default' => $defaults[$i]['title'], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "iibpr_pillar_{$i}_title", array( 'label' => 'Título', 'section' => "iibpr_pillar_{$i}", 'type' => 'text' ) );
        $wp_customize->add_setting( "iibpr_pillar_{$i}_text",  array( 'default' => $defaults[$i]['text'], 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( "iibpr_pillar_{$i}_text",  array( 'label' => 'Descrição', 'section' => "iibpr_pillar_{$i}", 'type' => 'textarea' ) );
    }

    /* =====================================================
       PAINEL: CURSOS
       ===================================================== */
    $wp_customize->add_panel( 'iibpr_courses_panel', array(
        'title'    => __( 'Cursos em Destaque', 'iibpr-theme' ),
        'priority' => 50,
    ) );

    $course_defaults = array(
        1 => array(
            'title' => 'Pós-Graduação em Psicomotricidade',
            'badge' => 'Destaque',
            'hours' => '420h',
            'desc'  => 'Formação completa teórica e prática em parceria com o IESB.',
            'price' => '',
            'cta'   => 'Saiba Mais',
            'url'   => '#inscricao',
            'color' => 'purple',
        ),
        2 => array(
            'title' => 'Seminário Teórico e Didático I',
            'badge' => 'Online',
            'hours' => '20h',
            'desc'  => 'Certificado + e-book + textos científicos. Transmissão via Zoom.',
            'price' => 'R$ 69,90',
            'cta'   => 'Inscreva-se',
            'url'   => '#inscricao',
            'color' => 'teal',
        ),
        3 => array(
            'title' => 'Curso Básico de Grafomotricidade',
            'badge' => 'Especialista',
            'hours' => '20h',
            'desc'  => 'Com a Dra. Ana Rita Matias. Foco em análise da escrita e intervenção.',
            'price' => '',
            'cta'   => 'Saiba Mais',
            'url'   => '#inscricao',
            'color' => 'gold',
        ),
    );

    for ( $i = 1; $i <= 3; $i++ ) {
        $d = $course_defaults[$i];
        $wp_customize->add_section( "iibpr_course_{$i}", array(
            'title' => "Curso {$i}", 'panel' => 'iibpr_courses_panel',
        ) );
        foreach ( array(
            "iibpr_course_{$i}_title" => array( 'label' => 'Título',       'default' => $d['title'], 'type' => 'text' ),
            "iibpr_course_{$i}_badge" => array( 'label' => 'Badge/Etiqueta','default' => $d['badge'], 'type' => 'text' ),
            "iibpr_course_{$i}_hours" => array( 'label' => 'Carga horária', 'default' => $d['hours'], 'type' => 'text' ),
            "iibpr_course_{$i}_desc"  => array( 'label' => 'Descrição',     'default' => $d['desc'],  'type' => 'textarea' ),
            "iibpr_course_{$i}_price" => array( 'label' => 'Preço (deixe vazio para ocultar)', 'default' => $d['price'], 'type' => 'text' ),
            "iibpr_course_{$i}_cta"   => array( 'label' => 'Texto do botão','default' => $d['cta'],   'type' => 'text' ),
            "iibpr_course_{$i}_url"   => array( 'label' => 'URL do botão',  'default' => $d['url'],   'type' => 'text' ),
        ) as $setting_id => $setting_args ) {
            $wp_customize->add_setting( $setting_id, array( 'default' => $setting_args['default'], 'sanitize_callback' => 'wp_kses_post' ) );
            $wp_customize->add_control( $setting_id, array( 'label' => $setting_args['label'], 'section' => "iibpr_course_{$i}", 'type' => $setting_args['type'] ) );
        }
        $wp_customize->add_setting( "iibpr_course_{$i}_image", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "iibpr_course_{$i}_image", array(
            'label' => 'Imagem do curso', 'section' => "iibpr_course_{$i}",
        ) ) );
    }

    /* =====================================================
       PAINEL: EVENTOS
       ===================================================== */
    $wp_customize->add_panel( 'iibpr_events_panel', array(
        'title'    => __( 'Eventos em Destaque', 'iibpr-theme' ),
        'priority' => 55,
    ) );

    $event_defaults = array(
        1 => array(
            'title' => 'Seminário Teórico e Didático I',
            'date'  => '22 de Março, 2026 — Online (Zoom)',
            'type'  => 'Seminário Online',
            'desc'  => 'Certificado 20h + e-book + textos científicos. Transmissão ao vivo via Zoom com gravação disponível.',
            'url'   => '#inscricao',
        ),
        2 => array(
            'title' => 'Formação em Psicomotricidade Relacional',
            'date'  => 'Abril–Dezembro 2026 — Presencial + Online',
            'type'  => 'Pós-Graduação 420h',
            'desc'  => 'Formação completa em parceria com o IESB. Módulos teóricos + práticos + supervisão.',
            'url'   => '#inscricao',
        ),
        3 => array(
            'title' => 'Curso de Grafomotricidade com Dra. Ana Rita Matias',
            'date'  => 'Maio 2026 — Online',
            'type'  => 'Curso Especialista',
            'desc'  => 'Análise da escrita, diagnóstico e intervenção grafomotora para professores e psicólogos.',
            'url'   => '#inscricao',
        ),
    );

    for ( $i = 1; $i <= 3; $i++ ) {
        $d = $event_defaults[$i];
        $wp_customize->add_section( "iibpr_event_{$i}", array(
            'title' => "Evento {$i}", 'panel' => 'iibpr_events_panel',
        ) );
        foreach ( array(
            "iibpr_event_{$i}_title" => array( 'label' => 'Título do Evento',  'default' => $d['title'], 'type' => 'text' ),
            "iibpr_event_{$i}_date"  => array( 'label' => 'Data / Modalidade', 'default' => $d['date'],  'type' => 'text' ),
            "iibpr_event_{$i}_type"  => array( 'label' => 'Tipo (badge)',       'default' => $d['type'],  'type' => 'text' ),
            "iibpr_event_{$i}_desc"  => array( 'label' => 'Descrição',         'default' => $d['desc'],  'type' => 'textarea' ),
            "iibpr_event_{$i}_url"   => array( 'label' => 'URL "Saiba mais"',  'default' => $d['url'],   'type' => 'text' ),
        ) as $sid => $sargs ) {
            $wp_customize->add_setting( $sid, array( 'default' => $sargs['default'], 'sanitize_callback' => 'wp_kses_post' ) );
            $wp_customize->add_control( $sid, array( 'label' => $sargs['label'], 'section' => "iibpr_event_{$i}", 'type' => $sargs['type'] ) );
        }
    }

    /* =====================================================
       PAINEL: DEPOIMENTOS (Carrossel)
       ===================================================== */
    $wp_customize->add_panel( 'iibpr_testimonials_panel', array(
        'title'    => __( 'Depoimentos (Carrossel)', 'iibpr-theme' ),
        'priority' => 60,
    ) );

    $testimonial_defaults = array(
        1 => array( 'quote' => 'A psicomotricidade relacional transformou minha relação com o meu corpo e com o outro. Uma experiência única de autodescoberta.', 'author' => 'Ana Paula S.' ),
        2 => array( 'quote' => 'O curso me deu ferramentas práticas para trabalhar com crianças de forma lúdica e profunda. Recomendo muito!',               'author' => 'Carlos M.' ),
        3 => array( 'quote' => 'Através da formação encontrei um caminho de cura emocional e desenvolvimento profissional ao mesmo tempo.',                   'author' => 'Fernanda L.' ),
        4 => array( 'quote' => 'A metodologia do IIBPR é singular. Une ciência, sensibilidade e prática de um jeito que realmente faz diferença.',           'author' => 'Rodrigo K.' ),
    );

    for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_section( "iibpr_testimonial_{$i}", array(
            'title' => "Depoimento {$i}", 'panel' => 'iibpr_testimonials_panel',
        ) );
        $wp_customize->add_setting( "iibpr_testimonial_{$i}_quote",  array( 'default' => $testimonial_defaults[$i]['quote'], 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( "iibpr_testimonial_{$i}_quote",  array( 'label' => 'Depoimento', 'section' => "iibpr_testimonial_{$i}", 'type' => 'textarea' ) );
        $wp_customize->add_setting( "iibpr_testimonial_{$i}_author", array( 'default' => $testimonial_defaults[$i]['author'], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "iibpr_testimonial_{$i}_author", array( 'label' => 'Autor', 'section' => "iibpr_testimonial_{$i}", 'type' => 'text' ) );
    }

    /* =====================================================
       PAINEL: CTA / INSCRIÇÃO
       ===================================================== */
    $wp_customize->add_panel( 'iibpr_cta_panel', array(
        'title'    => __( 'Seção CTA / Inscrição', 'iibpr-theme' ),
        'priority' => 70,
    ) );
    $wp_customize->add_section( 'iibpr_cta_section', array(
        'title' => 'CTA Final', 'panel' => 'iibpr_cta_panel',
    ) );
    $cta_fields = array(
        'iibpr_cta_title'     => array( 'label' => 'Título',           'default' => 'Invista no Seu Desenvolvimento Profissional', 'type' => 'text' ),
        'iibpr_cta_subtitle'  => array( 'label' => 'Subtítulo',        'default' => 'Certificado + e-book + textos científicos. Transmissão Zoom.', 'type' => 'textarea' ),
        'iibpr_cta_price'     => array( 'label' => 'Preço em destaque','default' => 'A partir de R$ 69,90', 'type' => 'text' ),
        'iibpr_cta_btn_label' => array( 'label' => 'Texto do Botão',   'default' => 'Agende Agora via WhatsApp', 'type' => 'text' ),
        'iibpr_cta_btn_url'   => array( 'label' => 'URL do Botão',     'default' => 'https://wa.me/5561991572149', 'type' => 'text' ),
        'iibpr_cta_btn2_label'=> array( 'label' => 'Botão 2 (texto)',  'default' => 'Enviar Email', 'type' => 'text' ),
        'iibpr_cta_btn2_url'  => array( 'label' => 'Botão 2 (URL)',    'default' => 'mailto:contato@institutoibpr.org.br', 'type' => 'text' ),
    );
    foreach ( $cta_fields as $id => $args ) {
        $wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'iibpr_cta_section', 'type' => $args['type'] ) );
    }

    /* =====================================================
       PAINEL: RODAPÉ
       ===================================================== */
    $wp_customize->add_panel( 'iibpr_footer_panel', array(
        'title'    => __( 'Rodapé', 'iibpr-theme' ),
        'priority' => 80,
    ) );
    $wp_customize->add_section( 'iibpr_footer_section', array(
        'title' => 'Informações do Rodapé', 'panel' => 'iibpr_footer_panel',
    ) );
    $footer_fields = array(
        'iibpr_footer_tagline'    => array( 'label' => 'Tagline do Rodapé',     'default' => 'Onde há movimento, há vida em relação!' ),
        'iibpr_footer_email'      => array( 'label' => 'Email',                 'default' => 'contato@institutoibpr.org.br' ),
        'iibpr_footer_whatsapp_br'=> array( 'label' => 'WhatsApp Brasil',       'default' => '+55 (61) 99157-2149' ),
        'iibpr_footer_whatsapp_pt'=> array( 'label' => 'WhatsApp Portugal',     'default' => '+351 913 126 662' ),
        'iibpr_footer_instagram'  => array( 'label' => 'URL Instagram',         'default' => 'https://instagram.com/iibpr_psicomotricidade' ),
        'iibpr_footer_facebook'   => array( 'label' => 'URL Facebook',          'default' => 'https://facebook.com/iibpr' ),
        'iibpr_footer_copyright'  => array( 'label' => 'Texto Copyright',       'default' => '© ' . date('Y') . ' Instituto IIBPR. Todos os direitos reservados.' ),
    );
    foreach ( $footer_fields as $id => $args ) {
        $wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'iibpr_footer_section', 'type' => 'text' ) );
    }

    /* =====================================================
       PAINEL: IDENTIDADE VISUAL
       ===================================================== */
    $wp_customize->add_panel( 'iibpr_brand_panel', array(
        'title'    => __( 'Identidade Visual', 'iibpr-theme' ),
        'priority' => 20,
    ) );
    $wp_customize->add_section( 'iibpr_brand_section', array(
        'title' => 'Cores e Logo', 'panel' => 'iibpr_brand_panel',
    ) );
    $wp_customize->add_setting( 'iibpr_logo', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'iibpr_logo', array(
        'label' => 'Logo do Instituto', 'section' => 'iibpr_brand_section',
    ) ) );
    $wp_customize->add_setting( 'iibpr_color_primary', array( 'default' => '#5B21B6', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'iibpr_color_primary', array(
        'label' => 'Cor Primária (roxo)', 'section' => 'iibpr_brand_section',
    ) ) );
    $wp_customize->add_setting( 'iibpr_color_secondary', array( 'default' => '#0D9488', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'iibpr_color_secondary', array(
        'label' => 'Cor Secundária (verde-azul)', 'section' => 'iibpr_brand_section',
    ) ) );
}
add_action( 'customize_register', 'iibpr_customize_register' );


/**
 * Helper para pegar setting do customizer com fallback para default.
 */
function iibpr_get( $setting_id ) {
    $defaults = array(
        'iibpr_hero_tagline'    => 'Onde há movimento, há vida em relação!',
        'iibpr_hero_title'      => 'Inscrições Abertas para Formação em Psicomotricidade',
        'iibpr_hero_subtitle'   => 'Especialização de 420h em parceria com o IESB.',
        'iibpr_hero_cta_label'  => 'Quero Garantir Minha Vaga',
        'iibpr_hero_cta_url'    => '#inscricao',
        'iibpr_hero_secondary_label' => 'Conheça os Cursos',
        'iibpr_hero_secondary_url'   => '#cursos',
        'iibpr_color_primary'   => '#5B21B6',
        'iibpr_color_secondary' => '#0D9488',
    );
    $val = get_theme_mod( $setting_id );
    if ( $val !== '' && $val !== false ) return $val;
    return isset( $defaults[$setting_id] ) ? $defaults[$setting_id] : '';
}


/**
 * Injeta as cores dinâmicas do customizer via inline CSS.
 */
function iibpr_dynamic_styles() {
    $primary   = sanitize_hex_color( get_theme_mod( 'iibpr_color_primary',   '#5B21B6' ) );
    $secondary = sanitize_hex_color( get_theme_mod( 'iibpr_color_secondary', '#0D9488' ) );
    echo "<style>
        :root {
            --iibpr-purple: {$primary};
            --iibpr-teal:   {$secondary};
        }
    </style>\n";
}
add_action( 'wp_head', 'iibpr_dynamic_styles' );
