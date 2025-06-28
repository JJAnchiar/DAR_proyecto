<?php
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

use function ElementorDeps\DI\add;

function astra_tm7200_enqueue_styles() {
    // Enqueue the parent theme stylesheet
    wp_enqueue_style('astra-parent-style', get_template_directory_uri() . '/style.css');
    
    // Enqueue the child theme stylesheet
    wp_enqueue_style(
        'astra-child-style', 
        get_stylesheet_directory_uri() . '/assets/css/styles.css',
        ['astra-parent-style']
    );
}
add_action('wp_enqueue_scripts', 'astra_tm7200_enqueue_styles');


function astra_tm7200_enqueue_scripts() {
    // Enqueue the child theme script
    wp_enqueue_script(
        'astra-child-script', 
        get_stylesheet_directory_uri() . '/assets/js/scripts.js', 
        array('jquery'), 
        null, true
    );
}
add_action('wp_enqueue_scripts', 'astra_tm7200_enqueue_scripts');


function astra_tm7200_theme_menus() {
    register_nav_menus(
        array(
            'head-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
        )
    );
}
add_action('after_setup_theme', 'astra_tm7200_theme_menus');