<?php

function shortcode_testimonios() {
    $query = new WP_Query(['post_type' => 'testimonios']);
    $output = '<div class="testimonios-carousel">';
    while ($query->have_posts()) {
        $query->the_post();
        $output .= '<div class="testimonio-card">';
        if (has_post_thumbnail()) {
            $output .= get_the_post_thumbnail(get_the_ID(), 'thumbnail', ['class' => 'testimonio-img']);
        }
        $output .= '<div class="testimonio-contenido">' . get_the_content() . '</div>';
        $output .= '<h5 class="testimonio-nombre">' . get_the_title() . '</h5>';
        $output .= '</div>';
    }
    wp_reset_postdata();
    $output .= '</div>';
    return $output;
}

function registrar_cpt_testimonios() {
    $labels = array(
        'name' => 'Testimonios',
        'singular_name' => 'Testimonio',
        'add_new' => 'Agregar nuevo',
        'add_new_item' => 'Agregar nuevo testimonio',
        'edit_item' => 'Editar testimonio',
        'new_item' => 'Nuevo testimonio',
        'view_item' => 'Ver testimonio',
        'search_items' => 'Buscar testimonios',
        'not_found' => 'No se encontraron testimonios',
        'menu_name' => 'Testimonios',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('testimonios', $args);
}

add_action('init', 'registrar_cpt_testimonios');
add_shortcode('testimonios', 'shortcode_testimonios');