<?php
/*
Plugin Name: Simple Info Widget
Plugin URI: http://wordpress.org/extend/plugins/open-table-widget/
Description: Easily display business information
Version: 1.0
Author: Devin Walker
Author URI: http://imdev.in/
License: GPLv2
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; version 2 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


define( 'SIW_PLUGIN_NAME', 'simple-info-widget');
define( 'SIW_PLUGIN_NAME_PLUGIN', 'simple-info-widget/simple-info-widget.php');
define( 'SIW_PLUGIN_PATH', WP_PLUGIN_DIR.'/'.SIW_PLUGIN_NAME);
define( 'SIW_PLUGIN_URL', WP_PLUGIN_URL.'/'.SIW_PLUGIN_NAME);


/**
 * Localize the Plugin for Other Languages
 */
load_plugin_textdomain('siw' , false, dirname( plugin_basename(__FILE__) ) . '/languages/' );


/**
 * Get the Widget
 */
if(!class_exists('Simple_Info_Widget')) {
    require 'widget.php';
}
