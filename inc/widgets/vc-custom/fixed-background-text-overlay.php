<?php
/**
 *  Fixed Background Text Overlay
 *
 * @description: A fixed background text widget
 * @since: 1.0
 */


function wordimpress_bg_overlay($atts, $content = null)
{

    extract(shortcode_atts(array(
        'title' => '',
        'image' => '',
        'img_size' => 'full',
        'text' => '',
        'el_class' => '',
    ), $atts));

    $image_array = wp_get_attachment_image_src($image, 'full');
    $image_src = $image_array[0];

    $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class);

    $output = "\n\t" . '<div class="fixed-bg-wrapper clearfix wpb_content_element ' . $css_class . '"><div class="fixed-bg-inner" style="background: url(\'' . $image_src . '\') fixed center top #333;background-size:cover;"><div class="container"><div class="fixed-bg-text-wrap">';
    $output .= "<h3>". $title . "</h3>";
    $output .= wpautop($text);
    $output .= "\n\t" . '</div>';
    $output .= "\n\t" . '</div>';
    $output .= "\n\t" . '</div>';
    $output .= "\n\t" . '</div>';

    return $output;

}

add_shortcode('wordimpress_bg_txt_overlay', 'wordimpress_bg_overlay');

/* Single image */
wpb_map(array(
    "name" => __("Fixed Background Text Overlay", "delicias"),
    "base" => "wordimpress_bg_txt_overlay",
    "icon" => "icon-wordimpress-background",
    "category" => __('Content', 'js_composer'),
    "params" => array(

        array(
            "type" => "attach_image",
            "heading" => __("Image", "js_composer"),
            "param_name" => "image",
            "value" => "",
            "description" => __('Upload or select a large image as the background.', 'js_composer')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Heading", "js_composer"),
            "param_name" => "title",
            "description" => __("Provide a title for this widget. Leave blank if no title is preferred.", "js_composer")
        ),
        array(
            "type" => "textarea",
            "heading" => __("Text", "js_composer"),
            "param_name" => "text",
            "description" => __("Provide text for this widget. This content will below the title above.", "js_composer"),
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )

    )
));