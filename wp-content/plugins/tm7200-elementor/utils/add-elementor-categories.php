<?php

function add_elementor_widget_categories($elements_manager)
{
    $elements_manager->add_category(
        'tm7200',
        [
            'title' => esc_html__('TM7200 Widgets', 'tm7200-elementor'),
            'icon' => 'fa fa-plug',
        ]
    );

}
add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');