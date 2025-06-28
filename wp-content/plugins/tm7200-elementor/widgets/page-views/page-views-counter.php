<?php
if (!defined('ABSPATH')) exit;

add_action('wp', function () {
    if (is_singular()) {
        $post_id = get_the_ID();
        $views = get_post_meta($post_id, '_page_views', true);
        $views = $views ? intval($views) : 0;
        update_post_meta($post_id, '_page_views', $views + 1);
    }
});