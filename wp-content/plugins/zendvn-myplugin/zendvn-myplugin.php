<?php
/*
Plugin Name: ZendVN My Plugin
Plugin URI: http://zend.vn/
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="http://akismet.com/get/">Sign up for an Akismet plan</a> to get an API key, and 3) Go to your Akismet configuration page, and save your API key.
Version: 3.1.10
Author: Thanh Nguyen
Author URI: http://automattic.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: zendvn-myplugin
*/
define('ZENDVN_MP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ZENDVN_MP_CSS_URL', ZENDVN_MP_PLUGIN_URL . 'css');
define('ZENDVN_MP_JS_URL', ZENDVN_MP_PLUGIN_URL . 'js');
define('ZENDVN_MP_IMAGES_URL', ZENDVN_MP_PLUGIN_URL . 'images');

define('ZENDVN_MP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ZENDVN_MP_PLUGIN_VIEW_DIR', ZENDVN_MP_PLUGIN_DIR . 'views');
define('ZENDVN_MP_INCLUDES_DIR', ZENDVN_MP_PLUGIN_DIR . 'includes');
define('ZENDVN_MP_WIDGET_DIR', ZENDVN_MP_PLUGIN_DIR . 'widgets');
define('ZENDVN_MP_SHORTCODES_DIR', ZENDVN_MP_PLUGIN_DIR . 'shortcodes');
define('ZENDVN_MP_METABOX_DIR', ZENDVN_MP_PLUGIN_DIR . 'metabox');
define('ZENDVN_MP_SETTING_DIR', ZENDVN_MP_PLUGIN_DIR . 'settings');
define('ZENDVN_MP_CP_DIR', ZENDVN_MP_PLUGIN_DIR . 'posts');

if(!is_admin()) {
    //require_once ZENDVN_MP_PLUGIN_DIR . 'public.php';
    //new ZendvnMp();
    
    require_once ZENDVN_MP_METABOX_DIR . '/main.php';
    
} else {
    require_once ZENDVN_MP_PLUGIN_DIR . 'admin.php';
    require_once ZENDVN_MP_INCLUDES_DIR . '/html.php';
    require_once ZENDVN_MP_WIDGET_DIR . '/db_simple.php';
    new ZendvnMpAdmin();
    new ZendvnMp_Widget_Db_Simple();
    
    
    require_once ZENDVN_MP_METABOX_DIR . '/main.php';
    new Zendvn_Mp_Metabox_Main();
}

require_once ZENDVN_MP_WIDGET_DIR . '/simple.php';

require_once ZENDVN_MP_CP_DIR . '/product.php';
new Cp_Product();


add_action('widgets_init', 'zendvn_mp_widget_simple');
function zendvn_mp_widget_simple() {
    register_widget('Zendvn_Mp_Widget_Simple');
}

require_once ZENDVN_MP_WIDGET_DIR . '/last_post.php';

function last_post_widget_init() {
    register_widget('Zendvn_Mp_Widget_Last_Post');
}
add_action('widgets_init', 'last_post_widget_init');

require_once ZENDVN_MP_SHORTCODES_DIR . '/main.php';
new Zendvn_Mp_SC_Main();

/* add_action('widgets_init', 'Zendvn_Widget_Remove');
function Zendvn_Widget_Remove() {
    unregister_widget('Zendvn_Mp_Widget_Simple');
    unregister_widget('WP_Widget_Search');
} */