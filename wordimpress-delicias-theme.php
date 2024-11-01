<?php
/*
Plugin Name: WordImpress Delicias Theme
Plugin URI: http://wordimpress.com/
Description: Custom functionality for the WordImpress Delicias restaurant theme.
Version: 1.2.8
Author: Devin Walker
Author URI: http://wordimpress.com/
License: GPLv2
*/

$theme = wp_get_theme();
$templateDir = get_template_directory();
$templateURL = get_bloginfo('template_url');
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/**
 * Check for Plugin Dependants
 * @Description: Checks to see if Delicias is active as parent/child theme
 */
if ($theme->Parent() == true && $theme->Parent()->get('Name') !== "Delicias" || $theme->Parent() == false && $theme['Name'] !== "Delicias") {

    add_action('admin_init', 'my_plugin_deactivate');
    add_action('admin_notices', 'my_plugin_admin_notice');

    function my_plugin_deactivate() {
        deactivate_plugins(plugin_basename(__FILE__));
    }

    function my_plugin_admin_notice() {
        echo '<div class="updated"><p>The <strong>WordImpress Delicias Theme</strong> plugin requires the <strong><a href="http://themeforest.net/item/delicias-modern-restaurant-theme/5683039" target="_blank" title="The Delicias Theme">Delicias theme</a></strong> and <strong><a href="wordpress.org/plugins/advanced-custom-fields/" target="_blank" title="Advanced Custom Fields">Advanced Custom Fields</a></strong> plugin to be <em>activated</em> to function properly.</p></div>';
        if (isset($_GET['activate']))
            unset($_GET['activate']);
    }

}
/**
 * Include functions
 */
elseif(is_plugin_active('advanced-custom-fields/acf.php') == true && function_exists('get_field')) {

    include('delicias.php');

}