<?php
/**
 *  Space Widget
 *
 * @description: Used to create custom spacing between elements
 * @since: 1.2.6
 * @created: 10/12/13
 */

function wordimpress_neg_space_widget($atts, $content = null) {

    extract(shortcode_atts(array(
        'height' => 0,
    ), $atts));

    $output = '<div class="gap gap-negative" style="height: 0; line-height:0; margin-top: -' . absint($height) . 'px;"></div>';

    return $output;
}

add_shortcode('wordimpress_gap_neg', 'wordimpress_neg_space_widget');

vc_map(array(
    "name" => __("Negative Space"),
    "base" => "wordimpress_gap_neg",
    "icon" => "icon-wordimpress-space-neg-icon",
    "class" => "wordimpress-spacing",
    "category" => __('Structure'),
    "params" => array(
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Negative spacing height"),
            "admin_label" => true,
            "param_name" => "height",
            "value" => "10",
            "description" => __("Use this widget to remove spacing between rows. Values are in pixels.")
        )
    )
));
