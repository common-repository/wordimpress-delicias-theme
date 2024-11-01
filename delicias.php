<?php
/**
 *  Delicias Theme Functions
 *
 * @description: Delicias theme functionality
 * @since: 1.0
 */


define('DELICIAS_THEME_URI', $templateURL);
define('DELICIAS_THEME_DIR', $templateDir);
define('DELICIAS_PLUGIN_NAME', 'wordimpress-delicias-theme');

/**
 * Advanced Custom Fields
 */
include_once(get_template_directory() . '/lib/plugins/add-ons/acf-repeater/acf-repeater.php');
include_once(get_template_directory() . '/lib/plugins/add-ons/acf-gallery/acf-gallery.php');
include_once(get_template_directory() . '/lib/plugins/add-ons/acf-options-page/acf-options-page.php');
include_once(get_template_directory() . '/lib/plugins/add-ons/acf-location-field/acf-location.php');
$devEnviron = 'http://delicias.dev';
if ($devEnviron !== home_url()) {
    require_once (dirname(__FILE__) . '/inc/options.php'); // Custom functions
}


/**
 * Visual Composer Include
 */

if (!class_exists('WPBakeryVisualComposerAbstract')) {
    $dir = get_template_directory() . '/lib/plugins/js_composer';

    $composer_settings = Array(
        'APP_ROOT' => $dir . '',
        'WP_ROOT' => dirname(dirname(dirname($dir))) . '/',
        'APP_DIR' => 'lib/plugins/js_composer',
        'CONFIG' => $dir . '/config/',
        'ASSETS_DIR' => '/assets/',
        'COMPOSER' => $dir . '/composer/',
        'COMPOSER_LIB' => $dir . '/composer/lib/',
        'SHORTCODES_LIB' => $dir . '/composer/lib/shortcodes/',
        'USER_DIR_NAME' => 'vc_templates', /* Path relative to your current theme, where VC should look for new shortcode templates */

        //for which content types Visual Composer should be enabled by default
        'default_post_types' => Array('page')
    );

    require_once ($dir . '/js_composer.php');
    $wpVC_setup->init($composer_settings);
}


/**
 * Custom Visual Composer Widgets
 */

if (class_exists('WPBakeryVisualComposerAbstract')) {

    require_once(dirname(__FILE__) . '/inc/widgets/vc-custom/top-image-cta.php'); // Top Image Call to Action Widget
    require_once(dirname(__FILE__) . '/inc/widgets/vc-custom/fixed-background-text-overlay.php'); //Fixed background text overlay widget
    require_once(dirname(__FILE__) . '/inc/widgets/vc-custom/menu-carousel.php'); //Menu Items Carousel
    require_once(dirname(__FILE__) . '/inc/widgets/vc-custom/custom-shortcode.php'); //Menu Items Carousel
    require_once(dirname(__FILE__) . '/inc/widgets/vc-custom/space.php'); //Custom Gap Widget
    require_once(dirname(__FILE__) . '/inc/widgets/vc-custom/space-negative.php'); //Custom Gap Widget

    if (!function_exists('js_composer_admin_css')) {
        function js_composer_admin_css($hook) {
            //custom CSS for JS composer admin end
            wp_enqueue_style('', plugins_url(DELICIAS_PLUGIN_NAME.'/inc/css/js-composer-custom.css', dirname(__FILE__)));
        }
    }

    add_action('admin_enqueue_scripts', 'js_composer_admin_css', 15);
}


/**
 * Custom Post Types and Taxonomy Classes
 * https://github.com/beaucharman/wordpress-custom-post-types
 * https://github.com/beaucharman/wordpress-custom-taxonomies
 */

require_once (dirname(__FILE__) . '/classes/custom-post-type.php'); // Custom functions
require_once (dirname(__FILE__) . '/classes/custom-taxonomy.php'); // Custom functions


/**
 * Delicias Custom Post Types
 */


//Menu Items
$name = 'menu';

$labels = array(
    'label_singular' => 'Menu Item',
    'label_plural' => 'Menu Items',
    'menu_label' => 'Menu Items'
);

$options = array(
    'description' => 'Display Menus',
    'public' => true,
    'publicly_queryable' => false,
    'show_ui' => true,
    'exclude_from_search' => true,
    'menu_position' => 20,
    'menu_icon' => get_bloginfo('template_url') . '/assets/img/menu.png',
    'hierarchical' => false,
    'supports' => array('title'),
    'taxonomies' => array('menu-category'),
    'has_archive' => false,
    'query_var' => false,
    'rewrite' => false
);

$help = array(
    array(
        'message' => ''
    ),
    array(
        'context' => 'edit',
        'message' => ''
    )
);
$locationPostType = new LT3_Custom_Post_Type($name, $labels, $options, $help);


/**
 * Menu Taxonomy
 */
$name = 'menu-category';

// The post type/s that the taxonomy is connected to.
// String or array
$post_type = 'menu';

// optional
$labels = array(
    'label_singular' => 'Category',
    'label_plural' => 'Categories',
    'menu_label' => 'Categories'
);

$options = array(
    'public' => true,
    'show_ui' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => true,
    'hierarchical' => true,
    'update_count_callback' => null,
    'query_var' => true,
    'rewrite' => true,
    'capabilities' => array(),
    'sort' => null
);

$help = '';

$industry = new LT3_Custom_Taxonomy($name, $post_type, $labels, $options, $help);

/**
 * Staff Post Type
 */

// required
$name = 'staff';

// optional
$labels = array(
    'label_singular' => 'Staff',
    'label_plural' => 'Staff',
    'menu_label' => 'Staff'
);

$options = array(
    'description' => 'Display Staff',
    'public' => true,
    'publicly_queryable' => false,
    'show_ui' => true,
    'exclude_from_search' => true,
    'menu_position' => 20,
    'menu_icon' => get_bloginfo('template_url') . '/assets/img/staff.png',
    'hierarchical' => false,
    'supports' => array('title', 'excerpt'),
    'taxonomies' => array('staff-category'),
    'has_archive' => false,
    'query_var' => false,
    'rewrite' => false
);

$help = array(
    array(
        'message' => ''
    ),
    array(
        'context' => 'edit',
        'message' => ''
    )
);
$staffPostType = new LT3_Custom_Post_Type($name, $labels, $options, $help);


/**
 * Staff Taxonomy
 */
$name = 'staff-category';

// The post type/s that the taxonomy is connected to.
// String or array
$post_type = 'staff';

// optional
$labels = array(
    'label_singular' => 'Category',
    'label_plural' => 'Categories',
    'menu_label' => 'Categories'
);

$options = array(
    'public' => true,
    'show_ui' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => true,
    'hierarchical' => true,
    'update_count_callback' => null,
    'query_var' => true,
    'rewrite' => true,
    'capabilities' => array(),
    'sort' => null
);

$help = '';

$industry = new LT3_Custom_Taxonomy($name, $post_type, $labels, $options, $help);


/**
 * Testimonials Post Type
 */

// required
$name = 'testimonials';

// optional
$labels = array(
    'label_singular' => 'Testimonial',
    'label_plural' => 'Testimonials',
    'menu_label' => 'Testimonials'
);

$options = array(
    'description' => 'Display Testimonials',
    'public' => true,
    'publicly_queryable' => false,
    'show_ui' => true,
    'exclude_from_search' => true,
    'menu_position' => 20,
    'menu_icon' => get_bloginfo('template_url') . '/assets/img/chat.png',
    'hierarchical' => false,
    'supports' => array('title', 'excerpt'),
    'has_archive' => false,
    'query_var' => false,
    'rewrite' => false
);

$help = array(
    array(
        'message' => ''
    ),
    array(
        'context' => 'edit',
        'message' => ''
    )
);
$staffPostType = new LT3_Custom_Post_Type($name, $labels, $options, $help);


/**
 * Add Class to Gravity Forms Submit Button
 */

function form_submit_button($button, $form) {
    return '<input type="submit" class="btn btn-large btn-depth gform-submit btn-primary" id="gform_submit_button_' . $form['id'] . '" value="' . $form['button']['text'] . '">';
}

add_filter('gform_submit_button', 'form_submit_button', 10, 2);

/**
 * Prevent Custom Menu widgets from multiple depths
 * http://wordpress.stackexchange.com/questions/53950/add-a-custom-walkter-to-a-menu-created-in-a-widget
 */
function mytheme_custom_menu_widget_depth($args) {

    if (is_dynamic_sidebar() && $args['theme_location'] !== 'primary_navigation') {
        $args['depth'] = -1;
    }

    return $args;


}

add_filter('wp_nav_menu_args', 'mytheme_custom_menu_widget_depth');

/*
 * Handy Filter to Return Custom Base.php for menu template
 * @source: https://groups.google.com/forum/#!topic/roots-theme/4Oxg4z1InYE
 */

add_filter('roots_wrap_base', 'roots_wrap_base_contact');

function roots_wrap_base_contact($templates) {
    if (is_page_template('template-menu-pages.php') || is_page_template('template-menu-booklet.php') || is_page_template('template-contact.php') || is_page_template('template-directions.php')) {
        return 'base-full.php';
    }
    return $templates;
}

/**
 * Customize Menu Relationship Field
 */

add_filter('acf/fields/relationship/result', 'acf_relationship_result', 10, 2);

function acf_relationship_result($html, $post) {
    // vars
    $image = get_field('item_image', $post->ID);
    $new = '';
    // new html
    if ($image) {
        $new = '<div style="width:26px; height:26px; background:#F9F9F9; border:#E1E1E1 solid 1px; float:left; margin:-3px 5px 2px 0;">';
        if ($image) {
            $new .= '<img src="' . $image['sizes']['thumbnail'] . '" width="25" height="25" />';
        }
        $new .= '</div>';
    }

    $term_list = wp_get_post_terms($post->ID, 'menu-category', array("fields" => "names"));

    if ($term_list) {

        $terms = '<div style="width:100%; float:none; clear:both; background:#F3F3F3;color:#6D6D6D;padding: 3px 5px; margin:2px 0 0;">Categorized: ';
        $counter = 0;
        foreach ($term_list as $term) {
            $counter++;
            if ($counter > 1) {
                $terms .= ", ";
            }
            $terms .= $term;


        }
        $terms .= '</div>';

    }


    return $new . $html . $terms;
}


/**
 * Pagination w/o Plugin
 */


function page_navi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ($numposts <= $posts_per_page) {
        return;
    }
    if (empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start = floor($pages_to_show_minus_1 / 2);
    $half_page_end = ceil($pages_to_show_minus_1 / 2);
    $start_page = $paged - $half_page_start;
    if ($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if (($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if ($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if ($start_page <= 0) {
        $start_page = 1;
    }
    echo $before . '<nav class="page-navigation"><ol class="clearfix  btn-group">' . "";
    if ($start_page >= 2 && $pages_to_show < $max_page) {
        $first_page_text = "First";
        echo '<a href="' . get_pagenum_link() . '" title="' . $first_page_text . '">' . $first_page_text . '</a>';
    }
    if ($paged != 1) {
        echo '<li class="bpn-prev-link btn btn-depth">';
        previous_posts_link('<i class="icon-chevron-left"></i>');
        echo '</li>';
    }
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $paged) {
            echo '<li class="btn-current btn btn-depth btn-disabled">' . $i . '</li>';
        } else {
            echo '<li class="btn btn-depth"><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
        }
    }
    if ($end_page != $paged) {
        echo '<li class="bpn-next-link btn btn-depth">';
        next_posts_link('<i class="icon-chevron-right"></i>');
        echo '</li>';
    }

    if ($end_page < $max_page) {
        $last_page_text = "Last";
        echo '<li class="bpn-last-page-link btn btn-depth"><a href="' . get_pagenum_link($max_page) . '" title="' . $last_page_text . '">' . $last_page_text . '</a></li>';
    }
    echo '</ol></nav>' . $after . "";
}

/**
 * Deregister post type support
 */

add_action('init', 'my_deregister_post_types');
function my_deregister_post_types() {
    if (function_exists('get_field')) {

        if (get_field('disable_staff', 'options') == 'Yes') {
            unregister_post_type('staff');
        }
        if (get_field('disable_testimonials', 'options') == 'Yes') {
            unregister_post_type('testimonials');
        }
    }
}

if (!function_exists('unregister_post_type')) :
    function unregister_post_type($post_type) {
        global $wp_post_types;
        if (isset($wp_post_types[$post_type])) {
            unset($wp_post_types[$post_type]);
            return true;
        }
        return false;
    }
endif;

/**
 * Front End Deregister Unnecessary JS/CSS Files
 */
add_action('wp_print_styles', 'my_deregister_styles', 1);

function my_deregister_styles() {
    wp_deregister_style('js_composer_front');
    wp_deregister_style('prettyphoto');
    wp_deregister_script('prettyphoto');
}

/**
 * Custom Backend Scripts
 */
add_action('admin_enqueue_scripts', 'delicias_custom_register_admin_scripts');

function delicias_custom_register_admin_scripts() {

    //Fix for Easy Fancybox Users
    wp_enqueue_script('jquery_easing_for_layerslider', plugins_url('/wordimpress-delicias-theme/inc/js/jquery-easing-1.3.js', dirname(__FILE__)), array('jquery'));

}




/**
 * Deregister post type support
 */

add_action('init', 'my_register_widgets');
function my_register_widgets() {

    $topHatToggle = get_field('enable_slide_down', 'option');

    if ($topHatToggle === 'Yes') {

        register_sidebar(array(
            'name' => __('Top Hat Widget 1', 'roots'),
            'id' => 'top-hat-widget-1',
            'before_widget' => '<section class="widget %1$s %2$s">',
            'after_widget' => '</div></section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3><div class="widget-inner">',
        ));

        register_sidebar(array(
            'name' => __('Top Hat Widget 2', 'roots'),
            'id' => 'top-hat-widget-2',
            'before_widget' => '<section class="widget %1$s %2$s">',
            'after_widget' => '</div></section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3><div class="widget-inner">',
        ));

        register_sidebar(array(
            'name' => __('Top Hat Widget 3', 'roots'),
            'id' => 'top-hat-widget-3',
            'before_widget' => '<section class="widget %1$s %2$s">',
            'after_widget' => '</div></section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3><div class="widget-inner">',
        ));


    }

}

/*
 * Get Simple Info Widget
 */
if (!class_exists('Simple_Info_Widget')) {
    require_once(dirname(__FILE__) . '/inc/widgets/simple-info-widget/simple-info-widget.php');
}


/*
 * Add IDs to Menu Items
 */

add_filter('manage_menu_posts_columns', 'posts_columns_id', 5);
add_action('manage_menu_posts_custom_column', 'posts_custom_id_columns', 5, 2);

function posts_columns_id($defaults) {
    $defaults['wps_post_id'] = __('ID');
    $defaults['wps_post_thumbnail'] = __('Thumbnail');
    return $defaults;
}

function posts_custom_id_columns($column_name, $id) {
    if ($column_name === 'wps_post_id') {
        echo "<input type='text' value='" . $id . "' readonly style='float:left;width:80px;'/>";
    } elseif ($column_name == 'wps_post_thumbnail') {
        $image = get_field('item_image', $id);
        echo "<img src=" . $image['sizes']['thumbnail'] . " width='100' height='100' />";

    }
}