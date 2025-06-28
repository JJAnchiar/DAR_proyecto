<?php
/**
 * Plugin Name: Testimonios Personalizados
 * Description: Plugin para gestionar y mostrar testimonios por shortcode.
 * Version: 1.0
 * Author: Julian Anchia
 */

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'includes/testimonios-cpt.php';

function testimonios_enqueue_style() {
    wp_enqueue_style('testimonios-style', plugin_dir_url(__FILE__) . 'assets/style.css');
}
add_action('wp_enqueue_scripts', 'testimonios_enqueue_style');