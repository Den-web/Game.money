<?php

/*
  Plugin Name: Image Slider (Lite)
  Plugin URI: http://www.ghozylab.com/plugins/
  Description: Image Slider (Lite) - Displaying your image as slider in post/page/widget/sidebar area with very easy.<a href="http://demo.ghozylab.com/plugins/easy-image-slider-plugin/pricing/" target="_blank"><strong> Upgrade to Pro Version Now</strong></a> and get a tons of awesome features.
  Author: GhozyLab, Inc.
  Version: 1.1.21
  Author URI: http://www.ghozylab.com/plugins/
 */

if (!defined('ABSPATH')) {
    die('Please do not load this file directly!');
}

/*
  |--------------------------------------------------------------------------
  | Requires Wordpress Version
  |--------------------------------------------------------------------------
 */

function ewic_wordpress_version() {
    global $wp_version;
    $plugin = plugin_basename(__FILE__);

    if (version_compare($wp_version, "3.5", "<")) {
        if (is_plugin_active($plugin)) {
            deactivate_plugins($plugin);
            wp_die("This plugin requires WordPress 3.5 or higher, and has been deactivated! Please upgrade WordPress and try again.<br /><br />Back to <a href='" . admin_url() . "'>WordPress admin</a>");
        }
    }
}

add_action('admin_init', 'ewic_wordpress_version');


/* ------------------------------------------------------------------------------- */
/*   MAIN DEFINES
  /*------------------------------------------------------------------------------- */

define('EWIC_API_URLCURL', 'https://secure.ghozylab.com/');
define('EWIC_API_URL', 'http://secure.ghozylab.com/');

if (!defined('EWIC_VERSION')) {
    define('EWIC_VERSION', '1.1.21');
}

if (!defined('EWIC_NAME')) {
    define('EWIC_NAME', 'Image Slider (Lite)');
}

// Pro Price
if (!defined('EWIC_PRO')) {
    define('EWIC_PRO', '20');
}

// Pro+
if (!defined('EWIC_PROPLUS')) {
    define('EWIC_PROPLUS', '27');
}

// Pro++ Price
if (!defined('EWIC_PROPLUSPLUS')) {
    define('EWIC_PROPLUSPLUS', '35');
}

// Dev Price
if (!defined('EWIC_DEV')) {
    define('EWIC_DEV', '99');
}

// plugin path
if (!defined('EWIC_PLUGIN_BASENAME'))
    define('EWIC_PLUGIN_BASENAME', plugin_basename(__FILE__));

if (!defined('EWIC_PLUGIN_NAME'))
    define('EWIC_PLUGIN_NAME', trim(dirname(EWIC_PLUGIN_BASENAME), '/'));

if (!defined('EWIC_PLUGIN_DIR'))
    define('EWIC_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . EWIC_PLUGIN_NAME . '/');

// plugin url
if (!defined('EWIC_URL')) {
    $en_plugin_url = substr(plugin_dir_url(__FILE__), 0, -1);
    define('EWIC_URL', $en_plugin_url);
}

define('EWIC_TIMTHUMB', plugins_url('inc/class/timthumb.php', __FILE__));



/* ------------------------------------------------------------------------------- */
/*   Load WP jQuery library
  /*------------------------------------------------------------------------------- */

function ewic_enqueue_scripts() {
    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }
}

if (!is_admin()) {
    add_action('init', 'ewic_enqueue_scripts');
}


/* ------------------------------------------------------------------------------- */
/*   I18N - LOCALIZATION
  /*------------------------------------------------------------------------------- */

function ewic_lang_init() {
    load_plugin_textdomain('easywic', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

add_action('init', 'ewic_lang_init');


/* ------------------------------------------------------------------------------- */
/* Put Admin css file
  /*------------------------------------------------------------------------------- */

function ewic_admin_stylesheet() {
    wp_enqueue_style('ewic_admin_styles', plugins_url('inc/css/admin.css', __FILE__));
}

add_action('admin_print_styles', 'ewic_admin_stylesheet');

/* ------------------------------------------------------------------------------- */
/*   Registers custom post type
  /*------------------------------------------------------------------------------- */

function ewic_post_type() {
    $labels = array(
        'name' => _x('Image Slider', 'post type general name'),
        'singular_name' => _x('Image Slider', 'post type singular name'),
        'add_new' => __('Add New Slider', 'easywic'),
        'add_new_item' => __('Slider Item', 'easywic'),
        'edit_item' => __('Edit Slider', 'easywic'),
        'new_item' => __('New Slider', 'easywic'),
        'view_item' => __('View Slider', 'easywic'),
        'search_items' => __('Search Slider', 'easywic'),
        'not_found' => __('No Slider Found', 'easywic'),
        'not_found_in_trash' => __('No Slider Found In Trash', 'easywic'),
        'parent_item_colon' => __('Parent Slider', 'easywic'),
        'menu_name' => __('Image Slider', 'easywic')
    );

    $taxonomies = array();
    $supports = array('title');

    $post_type_args = array(
        'labels' => $labels,
        'singular_label' => __('Easy Slider', 'easywic'),
        'public' => false,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'rewrite' => array('slug' => 'easyimagesldr', 'with_front' => false),
        'supports' => $supports,
        'menu_position' => 20,
        'menu_icon' => plugins_url('inc/images/ewic-cp-icon.png', __FILE__),
        'taxonomies' => $taxonomies
    );

    register_post_type('easyimageslider', $post_type_args);
}

add_action('init', 'ewic_post_type');


/* ------------------------------------------------------------------------------- */
/*  Rename Sub Menu
  /*------------------------------------------------------------------------------- */

function ewic_rename_submenu() {
    global $submenu;
    $submenu['edit.php?post_type=easyimageslider'][5][0] = __('Sliders', 'easywic');
}

add_action('admin_menu', 'ewic_rename_submenu');


/* ------------------------------------------------------------------------------- */
/*   Executing shortcode inside sidebar/widget
  /*------------------------------------------------------------------------------- */
add_filter('widget_text', 'do_shortcode', 11);


/* ------------------------------------------------------------------------------- */
/*   Hide & Disabled View, Quick Edit and Preview Button
  /*------------------------------------------------------------------------------- */

function ewic_remove_row_actions($actions) {
    global $post;
    if ($post->post_type == 'easyimageslider') {
        unset($actions['view']);
        unset($actions['inline hide-if-no-js']);
    }
    return $actions;
}

if (is_admin()) {
    add_filter('post_row_actions', 'ewic_remove_row_actions', 10, 2);
}

/* -------------------------------------------------------------------------------- */
/*  Add Custom Columns for Slider Review Page @since 1.1.11
  /*-------------------------------------------------------------------------------- */
add_filter('manage_edit-easyimageslider_columns', 'easyimageslider_edit_columns');

function easyimageslider_edit_columns($easyimageslider_columns) {
    $easyimageslider_columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => _x('Title', 'column name', 'easywic'),
        'ewic_imgcnt' => __('Total Image', 'easywic'),
        'ewic_sc' => __('Shortcode', 'easywic'),
        'ewic_id' => __('ID', 'easywic'),
        'ewic_preview' => __('Preview', 'easywic')
    );
    unset($columns['Date']);
    return $easyimageslider_columns;
}

function easyimageslider_columns_edit_columns_list($easyimageslider_columns, $post_id) {

    if (is_array(get_post_meta($post_id, 'ewic_meta_select_images', true))) {
        $ittl = array_filter(get_post_meta($post_id, 'ewic_meta_select_images', true));
        $ittl = count($ittl);
    } else {
        $ittl = '0';
    }

    switch ($easyimageslider_columns) {

        case 'ewic_imgcnt':

            echo $ittl . ' image(s)';

            break;

        case 'ewic_id':

            echo $post_id;

            break;

        case 'ewic_sc':

            echo '<span class="ewic-scode-block">[espro-slider id=' . $post_id . ']</span>';

            break;

        case 'ewic_preview':

            echo '<a class="button ewicprev" onClick="alert(\'This feature only available in Pro Version.\')">&nbsp;Preview&nbsp;</a>';
            break;

        default:
            break;
    }
}

add_filter('manage_posts_custom_column', 'easyimageslider_columns_edit_columns_list', 10, 2);


/* ------------------------------------------------------------------------------- */
/*  All Includes
  /*------------------------------------------------------------------------------- */

include_once( dirname(__FILE__) . '/inc/functions/ewic-functions.php' );
include_once( dirname(__FILE__) . '/inc/ewic-tinymce.php' );
include_once( dirname(__FILE__) . '/inc/ewic-metaboxes.php' );
include_once( dirname(__FILE__) . '/inc/ewic-widget.php' );
include_once( dirname(__FILE__) . '/inc/ewic-shortcode.php' );

/* ------------------------------------------------------------------------------- */
/*   Featured Plugins Page
  /*------------------------------------------------------------------------------- */
if (is_admin()) {

    include_once( dirname(__FILE__) . '/inc/pages/ewic-freeplugins.php' );
    include_once( dirname(__FILE__) . '/inc/pages/ewic-featured.php' );
    include_once( dirname(__FILE__) . '/inc/pages/ewic-pricing.php' );
    include_once( dirname(__FILE__) . '/inc/pages/ewic-settings.php' );
    include_once( dirname(__FILE__) . '/inc/pages/ewic-addons.php' );
    include_once( dirname(__FILE__) . '/inc/ewic-notice.php' );
    include_once( dirname(__FILE__) . '/inc/pages/ewic-welcome.php' );
}


/* ------------------------------------------------------------------------------- */
/*   Redirect to What's New Page
  /*------------------------------------------------------------------------------- */

function ewic_plugin_activate() {

    add_option('activatedewic', 'ewic-activate');
}

register_activation_hook(__FILE__, 'ewic_plugin_activate');


/* ------------------------------------------------------------------------------- */
/*   Auto Update
  /*------------------------------------------------------------------------------- */
$ewic_auto_updt = get_option("ewic-settings-automatic_update");

switch ($ewic_auto_updt) {

    case 'active':
        if (!wp_next_scheduled("ewic_auto_update")) {
            wp_schedule_event(time(), "daily", "ewic_auto_update");
        }
        add_action("ewic_auto_update", "plugin_ewic_auto_update");
        break;

    case 'inactive':
        wp_clear_scheduled_hook("ewic_auto_update");
        break;

    case '':
        wp_clear_scheduled_hook("ewic_auto_update");
        update_option("ewic-settings-automatic_update", 'active');
        break;
}

function plugin_ewic_auto_update() {
    try {
        require_once( ABSPATH . "wp-admin/includes/class-wp-upgrader.php" );
        require_once( ABSPATH . "wp-admin/includes/misc.php" );
        define("FS_METHOD", "direct");
        require_once( ABSPATH . "wp-includes/update.php" );
        require_once( ABSPATH . "wp-admin/includes/file.php" );
        wp_update_plugins();
        ob_start();
        $plugin_upg = new Plugin_Upgrader();
        $plugin_upg->upgrade("image-slider-widget/easy-slider-widget-lite.php");
        $output = @ob_get_contents();
        @ob_end_clean();
    } catch (Exception $e) {
        
    }
}

?>