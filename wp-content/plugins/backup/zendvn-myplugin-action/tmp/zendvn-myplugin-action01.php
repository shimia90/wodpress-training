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

add_action('wp_head', 'zendvn_mp_new_css');

function zendvn_mp_new_css() {
    $cssUrl     =       plugins_url('css/abc.css', __FILE__);
    $css        =       '<link rel="stylesheet" type="text/css" href="'.$cssUrl.'" />';
    echo $css;
}

remove_action('wp_head', 'zendvn_mp_new_css');

//remove_all_actions($tag);

echo has_action('wp_head', 'rsd_link');