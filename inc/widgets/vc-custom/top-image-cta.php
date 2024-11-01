<?php
/**
 *  Top Widget w/ Text and CTA
 *
 * @description:
 * @since:
 */


function wordimpress_top_widget_func($atts, $content = null) {

    extract(shortcode_atts(array(
        'title' => '',
        'image' => '',
        'img_size' => 'full',
        'text' => '',
        'color' => 'wpb_button',
        'size' => '',
        'icon' => 'none',
        'target' => '_self',
        'href' => '',
        'btn_title' => __('Text on the button', "js_composer"),
        'btn_el_class' => 'btn-depth',
        'el_class' => ''
    ), $atts));


    $img_id = preg_replace('/[^\d]/', '', $image);
    $img = wpb_getImageBySize(array('attach_id' => $img_id, 'thumb_size' => $img_size));

    //If no image show placeholder
    if ($img == NULL) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" /> <small>' . __('This is image placeholder, edit your page to replace it.', 'js_composer') . '</small>';
    //Gather complete image string
    $image_string = '<div class="wpb_top_img">' . $img['thumbnail'] . '</div>';
    $image_src = $img["p_img_large"][0];

    $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_top_image wpb_content_element ' . $el_class);


    if ($target == 'same' || $target == '_self') {
        $target = '';
    }
    $target = ($target != '') ? ' target="' . $target . '"' : '';

    //Button Variable Logic
    $color = ($color != '') ? ' wpb_' . $color : '';
    $size = ($size != '' && $size != 'wpb_regularsize') ? ' wpb_' . $size : ' ' . $size;
    $icon = ($icon != '' && $icon != 'none') ? ' ' . $icon : '';
    $i_icon = ($icon != '') ? ' <i class="icon"> </i>' : '';
    $btn_class = 'wpb_button ' . $color . $size . $icon . ' ' . $btn_el_class;

    $output = "\n\t" . '<div class="' . $css_class . '">';
    $output .= "\n\t\t" . '<div class="wpb_wrapper cta-widget">';
    $output .= '<div class="cta-img-wrap"><a href="' . $href . '" class="cta-link grow"><img src="' . $image_src . '" alt="' . $title . '"></a></div>';
    $output .= '<div class="cta-interior">';
    $output .= "\n\t\t\t" . wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_top_image_heading'));
    $output .= "\n\t\t\t" . wpautop($text);
    if ($href != '') {
        $btnInner = '<span class="' . $btn_class . '">' . $btn_title . $i_icon . '</span>';
        $output .= '<a class="wpb_top_img_btn wpb_button_a" title="' . $title . '" href="' . $href . '"' . $target . '>' . $btnInner . '</a>';
    } else {
        $output .= '<button class="wpb_top_img_btn ' . $btn_class . '">' . $title . $i_icon . '</button>';
    }
    $output .= "</div>";

    $output .= "\n\t\t" . '</div>';
    $output .= "\n\t" . '</div>';

    return $output;

}

add_shortcode('wordimpress_img_cta', 'wordimpress_top_widget_func');

/* Single image */
wpb_map(array(
    "name" => __("Top Image CTA Widget", "delicias"),
    "base" => "wordimpress_img_cta",
    "icon" => "icon-wordimpress-top-img",
    "category" => __('Content', 'js_composer'),
    "params" => array(

        array(
            "type" => "attach_image",
            "heading" => __("Image", "js_composer"),
            "param_name" => "image",
            "value" => "",
            "description" => __('Upload or select one image from the media library. The image should be sized properly for your column spacing.', 'js_composer')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Image size", "js_composer"),
            "param_name" => "img_size",
            "value" => "350x260",
            "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "js_composer")
        ),
        $add_css_animation,
        array(
            "type" => "textfield",
            "heading" => __("Widget title", "js_composer"),
            "param_name" => "title",
            "description" => __("Provide a title for this widget. Leave blank if no title is preferred.", "js_composer")
        ),
        array(
            "type" => "textarea",
            "heading" => __("Text", "js_composer"),
            "param_name" => "text",
            "description" => __("This text will display below the main widget title above.", "js_composer"),
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Text on the button", "js_composer"),
            "holder" => "button",
            "class" => "wpb_button",
            "param_name" => "btn_title",
            "value" => __("Text on the button", "js_composer"),
            "description" => __("Text on the button.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("URL (Link)", "js_composer"),
            "param_name" => "href",
            "description" => __("Button link.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Target", "js_composer"),
            "param_name" => "target",
            "value" => $target_arr,
            "dependency" => Array('element' => "href", 'not_empty' => true)
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Color", "js_composer"),
            "param_name" => "color",
            "value" => $colors_arr,
            "description" => __("Button color.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Icon", "js_composer"),
            "param_name" => "icon",
            "value" => $icons_arr,
            "description" => __("Button icon.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Size", "js_composer"),
            "param_name" => "size",
            "value" => $size_arr,
            "description" => __("Button size.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name for button", "js_composer"),
            "param_name" => "btn_el_class",
            "value" => "btn-depth",
            "description" => __("If you would like to custom style the button add a class name here.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )

    )
));