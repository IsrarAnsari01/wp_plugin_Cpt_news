<?php

/**
 * Plugin Name
 *
 * @author            IA
 * @copyright         2021 IA or CodeX
 * @license           GPL-2.0
 *
 * @wordpress-plugin
 * Plugin Name:       IA-CPT-NEWS
 * Plugin URI:        https://example.com/plugin-name
 * Description:       Simple Post like and Dislike system
 * Version:           1.0.0
 * Author:            IA
 * Author URI:        https://example.com
 * Text Domain:       wpia-Like
 * License:           GPL2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 */
// Block user to access it directly
if (!defined('WPINC')) {
    die;
}
// Define Constant
if (!defined("IA_ PLUGIN_VERSION")) {
    define("IA_ PLUGIN_VERSION", "1.0.0");
}
// Define constant for directory
if (!defined("IA_PLUGIN_DIR")) {
    define("IA_PLUGIN_DIR", plugin_dir_url(__FILE__));
}
require plugin_dir_path(__FILE__) . "./inc/cpt.php";
require plugin_dir_path(__FILE__) . "./inc/custom_metaBox.php";
require plugin_dir_path(__FILE__) . "./inc/custom_taxonomy.php";
// require plugin_dir_path(__FILE__) . "./assets/custom_taxonomy_2.php";
// require plugin_dir_path(__FILE__) . "./assets/cpt-p-widgets.php";
require plugin_dir_path(__FILE__) . "./inc/cpt-w-widgets.php";
require plugin_dir_path(__FILE__) . "./inc/access-news.php";
if (!defined("WPIA_PLUGIN_DIR_AJAX")) {
    define("WPIA_PLUGIN_DIR_AJAX", plugin_dir_url(__FILE__));
}
if (!function_exists("wpia_filter_using_ajax")) {

    function wpajax_plugin_scripts()
    {
        // echo WPIA_PLUGIN_DIR_AJAX . 'assets/js/main.js';
        // syntax
        // wp_enqueue_script(uniqueName, filePath, dependencies, footerMeLoadKrnaHaiYaNi)
        // wp_enqueue_style(uniqueName, filePath)
        // Css
        // wp_enqueue_style('wpajax-css', WPIA_PLUGIN_DIR_AJAX . 'assets/css/style.css');
        wp_enqueue_script('wpajax-js', WPIA_PLUGIN_DIR_AJAX . 'assets/js/main.js', array('jquery'), rand(), false);
        wp_enqueue_script('wpajax-js', WPIA_PLUGIN_DIR_AJAX . 'assets/js/ajax.js', NUll, rand(), true);
        // wp_enqueue_script('wpajax-ajax', WPIA_PLUGIN_DIR_AJAX . 'assets/js/ajax.js', array('jquery'), rand(), true);
        wp_localize_script(
            'wpajax-js',
            'ajax_object',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'siteUrl' => get_site_url(),
                // "nonce" => wp_create_nonce('wp_rest'),
            )
        );
    }
}
// Custom Form submission
if (!function_exists("wpia_submitForm")) {

    function wpia_submitForm()
    {
        wp_enqueue_script('submit_News', WPIA_PLUGIN_DIR_AJAX . 'assets/js/ajax.js', NUll, rand(), true);
        wp_localize_script(
            'submit_News',
            'submit_News_obj',
            array(
                "nonce" => wp_create_nonce('wp_rest'),
                'siteUrl' => get_site_url(),
            )
        );
    }
}
require plugin_dir_path(__FILE__) . "inc/filterUsingAjax.php";
require plugin_dir_path(__FILE__) . "inc/ajaxCallBack.php";
require plugin_dir_path(__FILE__) . "inc/addPostThroughRestApi.php";
// require plugin_dir_path(__FILE__) . "inc/createPost.php";
require plugin_dir_path(__FILE__) . "inc/class_rest.php";