<?php
class Zendvn_Mp_Setting_Tabs {

    //
    private $_menu_slug         =   'zendvn-mp-st-tabs';

    public function __construct() {

        add_action('admin_menu', array($this, 'settingMenu'));

        add_action('wp_ajax_zendvn_load_content', array($this, 'zendvn_load_content'));

    }

    public function settingMenu() {

        if($_GET['page'] == 'zendvn-mp-st-tabs') {
            add_action('admin_enqueue_scripts', array($this, 'add_js_file'));
            add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
        }

        add_menu_page('My Tabs', 'My Tabs', 'manage_options', $this->_menu_slug, array($this, 'display'));
    }

    public function display() {
        require_once ZENDVN_MP_PLUGIN_VIEW_DIR . '/setting-tabs.php';
    }



    public function zendvn_load_content() {
        echo '<h3 style="font-weight: bold; color: red;">' .  __METHOD__  . '</h3>';
        die();
    }

    public function add_js_file() {
        wp_register_script($this->_menu_slug, ZENDVN_MP_JS_URL . '/tabs.js', array('jquery'), '1.0');
        wp_enqueue_script($this->_menu_slug);
    }

    public function add_css_file() {

        wp_register_style($this->_menu_slug, ZENDVN_MP_CSS_URL . '/tab-ajax.css', array(), '1.0');
        wp_enqueue_style($this->_menu_slug);

    }

}