<?php
if (!defined('ABSPATH')) exit;

function register_lightbox_image_scripts()
{
    // wp_register_script('lightbox2-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js', [], '2.11.4', true);
    // wp_register_style('lightbox2-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css', [], '2.11.4');

    wp_register_style('lightbox-image-styles', plugins_url('../widgets/image-lightbox/image-lightbox.css', dirname(__FILE__)), [], '1.0.0');
}

add_action('wp_enqueue_scripts', 'register_lightbox_image_scripts');
add_action('elementor/editor/after_enqueue_scripts', 'register_lightbox_image_scripts');

add_action('elementor/init', function () {
    class Lightbox_Image_Widget extends \Elementor\Widget_Base
    {
        public function get_name()
        {
            return 'lightbox-image';
        }

        public function get_title()
        {
            return __('Image with Lightbox', 'tm7200-elementor');
        }

        public function get_icon()
        {
            return 'eicon-image';
        }

        public function get_categories()
        {
            return ['tm7200'];
        }

        public function get_script_depends()
        {
            return ['lightgbox-lib-js'];
        }

        public function get_style_depends()
        {
            return ['lightbox-lib-css', 'lightbox-image-styles'];
        }

        protected function _register_controls()
        {
            $this->start_controls_section('content_section', [
                'label' => __('Image', 'tm7200-elementor'),
            ]);

            $this->add_control('image', [
                'label' => __('Choose Image', 'tm7200-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
            ]);

            $this->add_control('caption', [
                'label' => __('Caption', 'tm7200-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]);

            $this->add_control('image_width', [
                'label' => __('Width (px or %)', 'tm7200-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '100%',
            ]);

            $this->add_control('image_height', [
                'label' => __('Height (px, %, etc)', 'tm7200-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'auto',
            ]);

            $this->add_control('object_fit', [
                'label' => __('Object Fit', 'tm7200-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'cover' => __('Cover', 'tm7200-elementor'),
                    'contain' => __('Contain', 'tm7200-elementor'),
                    'fill' => __('Fill', 'tm7200-elementor'),
                    'none' => __('None', 'tm7200-elementor'),
                    'scale-down' => __('Scale Down', 'tm7200-elementor'),
                ],
                'default' => 'cover',
            ]);


            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display();
            $image_url = esc_url($settings['image']['url']);
            $caption = esc_attr($settings['caption']);
?>

            <div class="lightbox-image-widget">
                <a href="<?php echo $image_url; ?>" data-lightbox="lightbox-group" data-title="<?php echo $caption; ?>">
                    <img src="<?php echo $image_url; ?>" alt=""
                        style="
                        width: <?php echo esc_attr($settings['image_width']); ?>;
                        height: <?php echo esc_attr($settings['image_height']); ?>;
                        object-fit: <?php echo esc_attr($settings['object_fit']); ?>;
                        display: block;
                        ">
                </a>
                <?php if (!empty($caption)): ?>
                    <div class="caption"><?php echo esc_html($caption); ?></div>
                <?php endif; ?>
            </div>

<?php
        }
    }

    add_action('elementor/widgets/widgets_registered', function () {
        \Elementor\Plugin::instance()->widgets_manager->register(new Lightbox_Image_Widget());
    });
});
