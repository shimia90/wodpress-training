<?php
require_once ZENDVN_MP_PLUGIN_DIR . '/includes/support.php';
class ZendvnMpAdmin {

    private $_menuSlug = 'zendvn-mp-my-setting';

    public function __construct() {
        //add_action('admin_menu', array($this, 'settingMenu'));

        //add_action('admin_init', array($this, 'register_setting_and_fields'));

        //$this->ajaxPage();
        $this->ajaxPage2();

        $this->tabsPage();

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

        //add_settings_field('zendvn_mp_new_title', 'Site Title', array($this, 'new_title_input'), $this->_menuSlug, $mainSection);
       // add_settings_field('zendvn_mp_new_title2', 'Site Title 2', array($this, 'new_title_input2'), $this->_menuSlug, $extSection);

       // add_settings_section($extSection, 'Ext Settings', array($this, 'main_section_view'), $this->_menuSlug);
    }

    public function main_section_view() {

    }

    public function new_title_input() {
        $htmlObj    =   new ZendvnHtml();

        $attr       =   array(
            'id'        =>      'zendvn_mp_new_logo',
            'class'     =>      'abc',

        );
        echo $htmlObj->fileupload('zendvn_mp_name[zendvn_mp_new_logo]', '', $attr );

        /* $attr       =   array(
            'id'        =>      'zendvn_mp_new_title',
            'class'     =>      'abc',
            'style'     =>      'width: 300px;',
            'onClick'   =>      'alert(\'Hello\');'

        );
        echo $htmlObj->textbox('zendvn_mp_name[zendvn_mp_new_title]', '', $attr ); */
        //echo '<input type="text" name="zendvn_mp_name[zendvn_mp_new_title]" value="" />';
    }

    public function new_title_input2() {
        echo '<input type="text" name="zendvn_mp_name[zendvn_mp_new_title2]" value="" />';
    }



    public function tabsPage() {
        require_once ZENDVN_MP_SETTING_DIR . '/tabs.php';
        new Zendvn_Mp_Setting_Tabs();
    }

    public function ajaxPage() {
        require_once ZENDVN_MP_SETTING_DIR . '/ajax.php';
        new Zendvn_Mp_Setting_Ajax();
    }

    public function ajaxPage2() {
        require_once ZENDVN_MP_SETTING_DIR . '/ajax2.php';
        new Zendvn_Mp_Setting_Ajax2();
    }

}