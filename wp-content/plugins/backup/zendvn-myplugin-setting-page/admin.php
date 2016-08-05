<?php
require_once ZENDVN_MP_PLUGIN_DIR . '/includes/support.php';
class ZendvnMpAdmin {
    
    private $_menuSlug = 'zendvn-mp-my-setting';
    
    public function __construct() {
        add_action('admin_menu', array($this, 'settingMenu'));
        
        add_action('admin_init', array($this, 'register_setting_and_fields'));
        
    }
    
    public function settingMenu() {
        add_menu_page('My Setting Title', 'My Settings', 'manage_options', $this->_menuSlug, array($this, 'settingPage'), 'dashicons-wordpress');
    }
    
    public function settingPage() {
        require_once ZENDVN_MP_PLUGIN_VIEW_DIR . '/setting-page.php';
    }
    
    public function register_setting_and_fields() {
        
        register_setting($this->_prefix . 'options', 'zendvn_mp_name', array($this, 'validate_setting'));
        
        $mainSection    =   'zendvn_mp_main_section';
        
        $extSection     =   'zendvn_mp_ext_section';
        
        // Add Setting Sectionn
        add_settings_section($mainSection, 'Main Settings', array($this, 'main_section_view'), $this->_menuSlug);
        
        add_settings_field('zendvn_mp_new_title', 'Site Title', array($this, 'new_title_input'), $this->_menuSlug, $mainSection);
        add_settings_field('zendvn_mp_new_title2', 'Site Title 2', array($this, 'new_title_input2'), $this->_menuSlug, $extSection);
        
        add_settings_section($extSection, 'Ext Settings', array($this, 'main_section_view'), $this->_menuSlug);
    }
    
    public function main_section_view() {
        
    }
    
    public function new_title_input() {
        echo '<input type="text" name="zendvn_mp_name[zendvn_mp_new_title]" value="" />';
    }
    
    public function new_title_input2() {
        echo '<input type="text" name="zendvn_mp_name[zendvn_mp_new_title2]" value="" />';
    }
    
}