<?php
/*
Plugin Name: Blog Description
Plugin URI: http://zend.vn/
Description: A Plugin to show description on blog page and manage in admin dashboard
Version: 3.1.10
Author: Thanh Nguyen
Author URI: http://automattic.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: blog-description
*/
define('ZENDVN_MP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ZENDVN_MP_CSS_URL', ZENDVN_MP_PLUGIN_URL . 'css');
define('ZENDVN_MP_JS_URL', ZENDVN_MP_PLUGIN_URL . 'js');
define('ZENDVN_MP_IMAGES_URL', ZENDVN_MP_PLUGIN_URL . 'images');

define('ZENDVN_MP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ZENDVN_MP_PLUGIN_VIEW_DIR', ZENDVN_MP_PLUGIN_DIR . 'views');
define('ZENDVN_MP_INCLUDES_DIR', ZENDVN_MP_PLUGIN_DIR . 'includes');
define('ZENDVN_MP_WIDGET_DIR', ZENDVN_MP_PLUGIN_DIR . 'widgets');

if(!is_admin()) {
    //require_once ZENDVN_MP_PLUGIN_DIR . 'public.php';
    //new ZendvnMp();
    
    
    function showBlogDescription() {
        $blogDescription    =   get_option('zendvn_mp_name', array());
        $blogDescription    =   $blogDescription['zendvn_mp_new_title'];
        echo $blogDescription;
    }
    add_action('show_blog_description', 'showBlogDescription');
    
} else {
    require_once ZENDVN_MP_PLUGIN_DIR . 'admin.php';
    require_once ZENDVN_MP_INCLUDES_DIR . '/html.php';
    new ZendvnMpAdmin();
}