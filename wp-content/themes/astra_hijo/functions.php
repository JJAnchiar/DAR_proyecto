<?php
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

function astra_hijo_enqueue_styles() {
    wp_enqueue_style(
        'astra-parent-style',
        get_template_directory_uri() . '/style.css'
    );
    wp_enqueue_style(
        'astra-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        [ 'astra-parent-style' ],
        wp_get_theme()->get( 'Version' )
    );
}
add_action('wp_enqueue_scripts', 'astra_hijo_enqueue_styles');

function astra_hijo_enqueue_scripts() {
    wp_enqueue_script(
        'astra-child-script', 
        get_stylesheet_directory_uri() . '/assets/js/scripts.js', 
        array('jquery'), 
        null, true
    );
}
add_action('wp_enqueue_scripts', 'astra_hijo_enqueue_scripts');


function astra_hijo_theme_menus() {
    register_nav_menus(
        array(
            'head-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
        )
    );
}
add_action('after_setup_theme', 'astra_hijo_theme_menus');

function astra_hijo_block_styles() {
  register_block_style('core/heading', [
    'name'  => 'titulo-personalizado',
    'label' => 'Título Destacado',
  ]);
  register_block_style('core/button', [
    'name'  => 'boton-personalizado',
    'label' => 'Botón Primario',
  ]);
  register_block_style('core/list', [
    'name'  => 'lista-coloreada',
    'label' => 'Lista Coloreada',
  ]);
}
add_action('init', 'astra_hijo_block_styles');