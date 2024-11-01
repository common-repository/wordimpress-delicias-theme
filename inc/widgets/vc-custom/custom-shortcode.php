<?php
/**
 *  Custom Shortcode for VC
 *
 * @description: Provide any shortcode to display in a visual composer area
 * @since:
 */
// don't load directly
if (!defined('ABSPATH')) die('-1');


function custom_vc_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'shortcode' => ''
    ), $atts));


    ob_start();
    wordimpress_custom_vc_shortcode_output($atts);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;


}

add_shortcode('custom-vc-shortcode', 'custom_vc_shortcode');

/*
register" our custom shortcode within Visual Composer interface.
*/
wpb_map(array(
    "name" => __("Custom VC Shortcode", 'vc_extend'),
    "base" => "custom-vc-shortcode",
    "icon" => "icon-wordimpress-shortcode",
    "category" => __('Content', 'js_composer'),
    "params" => array(
        array(
            "type" => "textarea_raw_html",
            "holder" => "div",
            "heading" => __("Custom Shortcode", 'vc_extend'),
            "param_name" => "shortcode",
            "description" => __("Enter in your custom shortcode below.", 'vc_extend')
        ),
    )
));

function wordimpress_custom_vc_shortcode_output($atts) {

    $shortcode = rawurldecode(base64_decode(strip_tags($atts['shortcode'])));
    echo do_shortcode($shortcode);

}