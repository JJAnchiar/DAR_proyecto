<?php
if (!defined('ABSPATH')) exit;


function register_image_carousel_scripts()
{
    wp_register_script('image-carousel-script', plugins_url('../widgets/image-carousel/image-carousel.js', dirname(__FILE__)), ['jquery'], '1.0.0', true);
    wp_register_style('image-carousel-styles', plugins_url('../widgets/image-carousel/image-carousel.css', dirname(__FILE__)), [], '1.0.0', 'all');
}

add_action('wp_enqueue_scripts', 'register_image_carousel_scripts');
add_action('elementor/editor/after_enqueue_scripts', 'register_image_carousel_scripts');

add_action('elementor/init', function () {
    class Image_Carousel extends \Elementor\Widget_Base {
        public function get_name() {
            return 'image-carousel';
        }

        public function get_title() {
            return __('Image Carousel', 'plugin-domain');
        }

        public function get_icon() {
            return 'eicon-slider-push';
        }

        public function get_categories() {
            return ['tm7200'];
        }

        public function get_script_depends() {
            return ['swiper', 'image-carousel-script'];
        }

        public function get_style_depends() {
            return ['swiper', 'image-carousel-styles'];
        }

        protected function _register_controls() {
            $this->start_controls_section('content_section', [
                'label' => __('Slides', 'plugin-domain'),
            ]);

            $repeater = new \Elementor\Repeater();

            $repeater->add_control('image', [
                'label' => __('Image', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
            ]);

            $repeater->add_control('caption', [
                'label' => __('Caption', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]);

            $this->add_control('slides', [
                'label' => __('Carousel Items', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ caption }}}',
            ]);

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();
            $carousel_id = 'image-carousel-' . uniqid();
            ?>

            <div id="<?php echo esc_attr($carousel_id); ?>" class="image-carousel swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['slides'] as $slide): ?>
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url($slide['image']['url']); ?>" alt="">
                            <?php if (!empty($slide['caption'])): ?>
                                <div class="caption"><?php echo esc_html($slide['caption']); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <?php
        }
    }

    add_action('elementor/widgets/widgets_registered', function () {
        \Elementor\Plugin::instance()->widgets_manager->register(new Image_Carousel());
    });
});
