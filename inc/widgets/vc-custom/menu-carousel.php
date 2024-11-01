<?php
/**
 *  Posts Carousel
 *
 * @description: An flexicarousel to display post items
 * @since: 1.0
 */


function wordimpress_menu_carousel($atts, $content = null) {

    extract(shortcode_atts(array(
        'title' => '',
        'text' => '',
        'posts_in' => '',
        'grid_posttypes' => '',
        'grid_link' => '',
        'grid_link_target' => '',
        'show_excerpt' => '',

    ), $atts));

    ob_start();
    wordimpress_menu_carousel_output($atts);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;


}

add_shortcode('wordimpress_menu_item_carousel', 'wordimpress_menu_carousel');

/* Single image */
wpb_map(array(
    "name" => __("Posts Carousel", "delicias"),
    "base" => "wordimpress_menu_item_carousel",
    "icon" => "icon-wordimpress-carousel",
    "class" => "wordimpress-carousel",
    "category" => __('Content', 'js_composer'),
    "params" => array(

        array(
            "type" => "textfield",
            "heading" => __("Widget title", "js_composer"),
            "param_name" => "title",
            "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Columns count", "js_composer"),
            "param_name" => "grid_columns_count",
            "value" => array(5, 4, 3, 2, 1),
            "admin_label" => true,
            "description" => __("Select columns count.", "js_composer")
        ),
        array(
            "type" => "posttypes",
            "heading" => __("Post types", "js_composer"),
            "param_name" => "grid_posttypes",
            "description" => __("Select post types to populate posts from.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("IDs", "js_composer"),
            "param_name" => "posts_in",
            "description" => __('Fill this field with post IDs separated by commas (,). If none are provided the latest posts from the post type will be displayed.', "js_composer")
        ),
        array(
            "type" => 'checkbox',
            "heading" => __("Output post excerpt?", "js_composer"),
            "param_name" => "show_excerpt",
            "description" => __("If selected, the post excerpt will be displayed after the post title.", "js_composer"),
            "value" => Array(__("Yes", "js_composer") => true)
        ),

        array(
            "type" => "dropdown",
            "heading" => __("Link", "js_composer"),
            "param_name" => "grid_link",
            "value" => array(__("Link to post", "js_composer") => "link_post", __("Link to bigger image", "js_composer") => "link_image", __("Thumbnail to bigger image, title to post", "js_composer") => "link_image_post", __("No link", "js_composer") => "link_no"),
            "description" => __("Link type.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Link target", "js_composer"),
            "param_name" => "grid_link_target",
            "value" => $target_arr,
            "dependency" => Array('element' => "grid_link", 'value' => array('link_post', 'link_image_post'))
        ),

    )
));

function wordimpress_menu_carousel_output($atts) {
    $postType = 'menu';
    if (!empty($atts['grid_posttypes'])) {
        $postType = $atts['grid_posttypes'];
    }
    if (!empty($atts['posts_in'])) {
        $post__in = explode(",", $atts['posts_in']);
        $args = array(
            'post_type' => $postType,
            'posts_per_page' => 16,
            'post__in' => $post__in

        );
    } else {
        $args = array(
            'post_type' => $postType,
            'posts_per_page' => 16
        );
    }

    // The Query
    $the_query = new WP_Query($args);
    $linkTarget = "";

    //Handle Variables
    $grid_link = empty($atts['grid_link']) ? '' : $atts['grid_link'];
    $grid_link_target = empty($atts['grid_link_target']) ? '' : $atts['grid_link_target'];
    $show_excerpt = empty($atts['show_excerpt']) ? '' : $atts['show_excerpt'];


    if ($grid_link_target == '_blank') {
        $linkTarget = " target='_blank' ";
    }
    ?>

    <?php // The Loop
    if ($the_query->have_posts()) : ?>

        <div class="flexi-carousel-wrap">

            <h3 class="flexi-carousel-heading"><?php echo $atts['title']; ?></h3>

            <ul class="flexi-carousel menu-carousel">

                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <li class="carousel-item">

                        <div class="flexi-inner">
                            <?php
                            $postType = get_post_type(get_the_ID());
                            $itemImage = get_field('item_image');

                            if ($grid_link == 'link_post') {
                            ?>
                            <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo get_the_title(); ?>"<?php echo $linkTarget; ?>>
                                <?php } elseif ($grid_link == 'link_image') { ?>
                                <a href="<?php echo $itemImage['sizes']['large']; ?>" title="<?php echo get_the_title(); ?>" rel="gallery" class="fancybox">
                                    <?php
                                    }

                                    $itemDescription = get_field('item_description');
                                    if ($postType == 'staff' || $postType == 'testimonials' || empty($itemImage)) {
                                        $itemImage = get_field('_thumbnail_id');
                                    }

                                    if (empty($itemDescription)) {
                                        $itemDescription = get_the_excerpt();
                                    }
                                    ?>
                                    <?php
                                    //Image
                                    if ($grid_link == 'link_image_post' && !empty($itemImage)) {
                                        ?>
                                        <div class="carousel-img-wrap">
                                            <a href="<?php echo $itemImage['sizes']['large']; ?>" title="<?php echo get_the_title(); ?>" rel="gallery" class="fancybox"><img src="<?php echo $itemImage['sizes']['medium']; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>"/></a>
                                        </div>
                                    <?php } elseif (!empty($itemImage)) { ?>
                                        <div class="carousel-img-wrap">
                                            <img src="<?php echo $itemImage['sizes']['medium']; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>"/>
                                        </div>
                                    <?php } ?>

                                    <div class="flexi-content">

                                        <?php
                                        //Image
                                        if ($grid_link == 'link_image_post') {
                                            ?>
                                            <h4 class="flexi-item-heading">
                                                <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo get_the_title(); ?>"<?php echo $linkTarget; ?>><?php echo get_the_title(); ?></a>
                                            </h4>
                                        <?php } else { ?>
                                            <h4 class="flexi-item-heading"><?php echo get_the_title(); ?></h4>
                                        <?php } ?>

                                        <?php if ($show_excerpt == '1') { ?>
                                            <div class="flexi-description"><?php echo wpautop($itemDescription); ?></div>
                                        <?php } ?>
                                    </div>

                                    <?php
                                    //Close Link Wrap
                                    if ($grid_link == 'link_post' || $grid_link == 'link_image') {
                                    ?>
                                </a>
                            <?php } ?>
                        </div>
                    </li>
                <?php endwhile;  ?>

            </ul>

            <script type="text/javascript">
                (function ($) {
                    'use strict';
                    $(window).load(function () {
                        $(".flexi-carousel").flexisel({
                            visibleItems: <?php echo $atts['grid_columns_count']; ?>,
                            autoPlay: true,
                            autoPlaySpeed: 5000,
                            enableResponsiveBreakpoints: true,
                            responsiveBreakpoints: {
                                portrait: {
                                    changePoint: 480,
                                    visibleItems: 1
                                },
                                landscape: {
                                    changePoint: 640,
                                    visibleItems: 2
                                },
                                tablet: {
                                    changePoint: 960,
                                    visibleItems: 3
                                }
                            }
                        });


                        $('.nbs-flexisel-container').addClass('clearfix');
                        $('.nbs-flexisel-nav-left').html('<i class="icon-chevron-left"></i>').addClass('transition');
                        $('.nbs-flexisel-nav-right').html('<i class="icon-chevron-right"></i>').addClass('transition');

                    });
                })(jQuery);
            </script>

        </div><!--/.flexi-carousel-wrap -->
    <?php  endif;
    // Reset Post Data
    wp_reset_postdata(); ?>


<?php


}