<?php
/**
 * Plugin Name:       Tm7200 Elementor
 * Description:       Widgets de elementor personalizados.
 * Version:           1.0.0
 * Author:            Julian Anchia
 * Text Domain:       drjuliananchia
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function tm7200_elementor_register_scripts()
{

	wp_register_script('swiper-script', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '6.8.4', true);
    wp_register_style('swiper-styles', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), '6.8.4');

    wp_register_script('lightbox-lib-js', plugin_dir_url('/assets/libraries/lightbox.js'), ['jquery'], '2.11.5', true);
    wp_register_style('lightbox-lib-css',  plugin_dir_url('/assets/libraries/lightbox.css'), array(), '2.11.5');

}
add_action('wp_enqueue_scripts', 'tm7200_elementor_register_scripts');
add_action('elementor/editor/after_enqueue_scripts', 'tm7200_elementor_register_scripts');


require_once plugin_dir_path(__FILE__) . '/utils/add-elementor-categories.php';

require_once plugin_dir_path(__FILE__) . '/widgets/page-views/page-views-widget.php';
require_once plugin_dir_path(__FILE__) . '/widgets/page-views/page-views-counter.php';

require_once plugin_dir_path(__FILE__) . '/widgets/faq-box/faq-box-widget.php';

use Elementor\Widget_Base;
require_once plugin_dir_path(__FILE__) . '/widgets/image-carousel/image-carousel.php';
require_once plugin_dir_path(__FILE__) . '/widgets/lightbox-image/lightbox-image.php';