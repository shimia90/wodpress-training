<?php
/*
Plugin Name: ZendVN My Plugin
Plugin URI: http://zend.vn/
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="http://akismet.com/get/">Sign up for an Akismet plan</a> to get an API key, and 3) Go to your Akismet configuration page, and save your API key.
Version: 3.1.10
Author: Thanh Nguyen
Author URI: http://automattic.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: akismet
*/
register_activation_hook(__FILE__, 'zendvn_mp_active');

echo '<h1>Hello World</h1>';

/**
 * Ex 01
 */
/* function zendvn_mp_active() {
    $zendvn_mp_version  =   '1.0';
    add_option('zendvn_mp_version', $zendvn_mp_version, '', 'yes');
} */

/**
 * Ex 02
 */
/* function zendvn_mp_active() {
    $zendvn_mp_options  =   array(
        'course'        =>      'Wordpress Tutorial',
        'author'        =>      'ZendVN Group',
        'website'       =>      'www.zend.vn'
    );
    add_option('zendvn_mp_options', $zendvn_mp_options, '', 'yes');
} */
 
/**
 * 
 */
function zendvn_mp_active() {
    global $wpdb;
    $table_name     =   $wpdb->prefix . 'zendvn_mp_test';
    if($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $sql = "CREATE TABLE `" . $table_name . "` (
		`myid` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
		`my_name` varchar(50) DEFAULT NULL,
		PRIMARY KEY (`myid`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
}