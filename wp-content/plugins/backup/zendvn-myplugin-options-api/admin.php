<?php
require_once ZENDVN_MP_PLUGIN_DIR . '/includes/support.php';
class ZendvnMpAdmin {
    
    public function __construct() {
        add_action('admin_init', array($this, 'update_option3'));
        
    }
    
    public function add_new_option() {
        $prefix     =   'zendvn_mp';
        add_option($prefix . '_wp_version', '4.0', '', 'yes');
        add_option($prefix . '_plugin_version', '1.0', '', 'no');
    }
    
    public function add_array_option() {
        $prefix     =   'zendvn_mp';
        $arrOption  =   array(
            'course'    =>  'Wordpress 4.x',
            'author'    =>  'ZendVN group',
            'website'   =>  'www.zend.vn'
        );
        add_option($prefix . '_wp_course', $arrOption, '', 'yes');
    }
    
    public function get_options() {
        $prefix     =   'zendvn_mp';
        $tmp    =   get_option($prefix . '_wp_version1', '3.0');
        
        $arrOption  =   array(
            'course'    =>  'Wordpress 4.x',
            'author'    =>  'ZendVN group',
            'website'   =>  'www.zend.vn'
        );
        $tmp    =   get_option($prefix . '_wp_course', $arrOption);
        
    }
    
    public function update_options() {
        $prefix     =   'zendvn_mp';
        update_option($prefix . '_wp_version', '5.0');
        
        $arrOption  =   array(
            'course'    =>  'Wordpress 4.5',
            'author'    =>  'ZendVN group',
            'website'   =>  'www.zend.vn'
        );
        update_option($prefix . '_wp_course', $arrOption);
    }
    
    public function update_options2() {
        $prefix     =   'zendvn_mp';
        $old_option     =   get_option($prefix . '_wp_course');
        $old_option['course']   =   'Wordpress 6';
        update_option($prefix . '_wp_course', $old_option);
    }
    
    public function delete_option() {
        $prefix     =   'zendvn_mp';
        delete_option($prefix . '_wp_version');
        delete_option($prefix . '_wp_course');
    }
    
    /*
     * Update Autoload column
     */
    public function update_autoload() {
        $prefix     =   'zendvn_mp';
        $old_option     =       get_option($prefix . '_wp_plugin_version');
        delete_option($prefix . '_wp_plugin_version');
        add_option($prefix . '_wp_plugin_version', $old_option, '', 'yes');
    }
    
    public function update_option3() {
        $prefix     =   'zendvn_mp';
        $old_option     =       get_option($prefix . '_wp_plugin_version');
        update_option($prefix . '_wp_plugin_version2', '2.0');
    }
}