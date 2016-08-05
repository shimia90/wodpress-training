<?php
require_once ZENDVN_MP_PLUGIN_DIR . '/includes/support.php';
class ZendvnMpAdmin {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'settingMenu'));
        //add_action('admin_menu', array($this, 'removeMenu'));
    }
    
    /**
     * Them sub menu vao dashboard cua WP Menus
     */
    /* public function settingMenu() {
        $menuPrefix     =   'zendvn-mp-my-setting';
        add_dashboard_page('My Setting Title', 'My Settings', 'manage_options', $menuPrefix, array($this, 'settingPage'));
    } */
    
    /* public function settingPage() {
        echo '<h1>My Setting</h1>';
    } */
    
    /**
     * Them mot nhom menu moi vao he thong menu
     */
    public function settingMenu() {
        $menuPrefix     =   'zendvn-mp-my-setting';
        add_menu_page('My Setting Title', 'My Settings', 'manage_options', $menuPrefix, array($this, 'settingPage'), ZENDVN_MP_PLUGIN_URL . '/images/icon-setting16x16.png', 3);
        add_submenu_page($menuPrefix, 'About Title', 'About', 'manage_options', $menuPrefix . '-about', array($this, 'aboutPage'));   
    }
    
    public function settingPage() {
        require_once ZENDVN_MP_PLUGIN_DIR . '/views/setting-page.php';
    }
    
    public function aboutPage() {
        echo '<h1>'.__METHOD__.'</h1>';
    }
    
    public function removeMenu() {
        $menuSlug   =   'zendvn-mp-my-setting';
        //remove_menu_page($menuSlug);
        remove_submenu_page('edit.php', 'post-new.php');
    }
}