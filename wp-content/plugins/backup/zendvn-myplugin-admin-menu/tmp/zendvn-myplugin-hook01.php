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
add_action('wp_footer', 'zendvn_mp_footer2', 18);
add_action('wp_footer', 'zendvn_mp_new_data', 19);
add_action('wp_head',   'zendvn_mp_new_css');

function zendvn_mp_new_css() {
    $cssUrl     =   plugins_url('/css/abc.css', __FILE__);
    $css        =   '<link rel="stylesheet" type="text/css" media="all" href="'.$cssUrl.'" />';
    echo $css;
}

function zendvn_mp_new_data() {
    echo '<div>Welcom to the course Wordpress tutorial of <a href="http://www.zend.vn" target="__blank">ZendVN<a/></div>';
}

function zendvn_mp_footer2() {
    echo '<div>Hello World</div>';
}