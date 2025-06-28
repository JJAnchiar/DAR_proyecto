<?php
if (!defined('ABSPATH')) exit;

add_action('elementor/widgets/widgets_registered', function () {
    if (!class_exists('\Elementor\Widget_Base')) return;

    class FAQ_Box_Widget extends \Elementor\Widget_Base
    {
        public function get_name()
        {
            return 'faq-box';
        }

        public function get_title()
        {
            return __('Caja de Pregunta', 'tm7200-elementor');
        }

        public function get_icon()
        {
            return 'eicon-posts-ticker';
        }

        public function get_categories()
        {
            return ['tm7200'];
        }

        protected function _register_controls()
        {
            $this->start_controls_section('content_section', [
                'label' => __('Contenido', 'tm7200-elementor'),
            ]);

            $this->add_control('pregunta', [
                'label' => __('Pregunta', 'tm7200-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('¿Cuál es el horario de atención?', 'tm7200-elementor'),
            ]);

            $this->add_control('respuesta', [
                'label' => __('Respuesta', 'tm7200-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Nuestro horario de atención es de lunes a viernes de 8am a 6pm.', 'tm7200-elementor'),
            ]);

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display();
            ?>
            <div class="tm7200-faq-box">
                <div class="faq-pregunta" onclick="this.nextElementSibling.classList.toggle('activo')">
                    <strong><?php echo esc_html($settings['pregunta']); ?></strong>
                </div>
                <div class="faq-respuesta" style="display:none;">
                    <p><?php echo esc_html($settings['respuesta']); ?></p>
                </div>
            </div>
            <style>
                .tm7200-faq-box {
                    border: 1px solid #ccc;
                    border-radius: 6px;
                    padding: 10px;
                    margin-bottom: 10px;
                }
                .tm7200-faq-box .faq-pregunta {
                    cursor: pointer;
                    background: #0f172a;
                    padding: 8px;
                    font-weight: bold;
                }
                .tm7200-faq-box .faq-respuesta.activo {
                    display: block !important;
                    padding: 8px;
                    background: #0177d7;
                }
            </style>
            <?php
        }
    }

    \Elementor\Plugin::instance()->widgets_manager->register(new FAQ_Box_Widget());
});