<?php
if (!defined('ABSPATH')) exit;

add_action('elementor/init', function () {

    class Page_Views_Widget extends \Elementor\Widget_Base
    {
        public function get_name()
        {
            return 'page-views-widget';
        }

        public function get_title()
        {
            return __('Contador de Visitas', 'tm7200-elementor');
        }

        public function get_icon()
        {
            return 'eicon-counter';
        }

        public function get_categories()
        {
            return ['tm7200'];
        }

        protected function _register_controls()
        {
            $this->start_controls_section('section_content', [
                'label' => __('Contenido', 'tm7200-elementor'),
            ]);

            $this->add_control('label', [
                'label' => __('Etiqueta', 'tm7200-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Visitas:', 'tm7200-elementor'),
            ]);

            $this->end_controls_section();
        }

        protected function render()
        {
            if (!is_singular()) return;

            $post_id = get_the_ID();
            $views = get_post_meta($post_id, '_page_views', true);
            $views = $views ? intval($views) : 0;

            echo '<div class="page-views-widget">';
            echo '<strong>' . esc_html($this->get_settings('label')) . '</strong> ' . esc_html($views);
            echo '</div>';
        }
    }

    add_action('elementor/widgets/widgets_registered', function () {
        \Elementor\Plugin::instance()->widgets_manager->register(new Page_Views_Widget());
    });
});