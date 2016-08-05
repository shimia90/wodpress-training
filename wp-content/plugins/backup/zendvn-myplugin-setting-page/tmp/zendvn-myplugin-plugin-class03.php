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
ZendvnMp::init();

class ZendvnMp {
    
    public static function init() {
        add_action('wp_footer', array(__CLASS__, 'newFooter'));
        add_action('wp_footer', array(__CLASS__, 'newFooter2'));
    }
    
    public function newFooter() {
        echo '<div>Hello World</div>';
    }
    
    public function newFooter2() {
        echo '<div>Hello World 2</div>';
    }
    
}