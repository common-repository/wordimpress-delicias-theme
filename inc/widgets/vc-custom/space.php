<?php
/**
 *  Space Widget
 *
 * @description: Used to create custom spacing between elements
 * @since: 1.0
 * @created: 10/3/13
 */

function wordimpress_space_widget($atts, $content = null) {

    extract(shortcode_atts(array(
        'height' => 10,
    ), $atts));

    $output = '<div class="gap" style="line-height: ' . absint($height) . 'px; height: ' . absint($height) . 'px;"></div>';

    return $output;
}

add_shortcode('wordimpress_gap', 'wordimpress_space_widget');

vc_map(array(
    "name" => __("Space"),
    "base" => "wordimpress_gap",
    "icon" => "icon-wordimpress-space-icon",
    "class" => "wordimpress-spacing",
    "category" => __('Structure'),
    "params" => array(
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Spacing height"),
            "admin_label" => true,
            "param_name" => "height",
            "value" => "10",
            "description" => __("Use this widget to create custom spacing between rows. Values are in pixels.")
        )
    )
));
