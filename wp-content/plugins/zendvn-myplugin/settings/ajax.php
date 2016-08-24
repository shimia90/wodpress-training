<?php
class Zendvn_Mp_Setting_Ajax {
    
    // 
    private $_menu_slug         =   'zendvn-mp-st-ajax';
    
    //
    private $_option_name       =   'zendvn_mp_st_ajax';
    
    //
    private $_setting_options; 
    
    public function __construct() {
        
        $this->_setting_options     =   get_option($this->_option_name, array());
        
        add_action('admin_menu', array($this, 'settingMenu'));
        
        add_action('admin_init', array($this, 'register_settings_and_fields'));
        
    }
    
    public function settingMenu() {
        add_menu_page('My Settings', 'My Settings', 'manage_options', $this->_menu_slug, array($this, 'display'));
    }
    
    public function display() {
        require_once ZENDVN_MP_PLUGIN_VIEW_DIR . '/setting-page-ajax.php';
    }
    
    public function register_settings_and_fields() {
        register_setting($this->_menu_slug, $this->_option_name, array($this, 'validate_settings'));
        
        // Main Section
        $mainSection     =   'zendvn_mp_main_section';
        add_settings_section($mainSection, 'Main Settings', array($this, 'main_section_view'), $this->_menu_slug);
        
        add_settings_field($this->create_id('title'), 'Title', array($this, 'create_form'), $this->_menu_slug, $mainSection, array('name' => 'title'));
        
    }
    
    private function create_id($val) {
        return $this->_option_name . '_' . $val;           
    }
    
    private function create_name($val) {
        return $this->_option_name . '[' . $val . ']';
    }
    
    public function create_form($args) {
        
        require_once ZENDVN_MP_INCLUDES_DIR . '/html.php';
        $htmlObj    =   new ZendvnHtml();
        
        if($args['name'] == 'title') {
            
            // Create title
            $inputID        =   $this->create_id('title');
            $inputaName     =   $this->create_name('title');
            $inputValue     =   @$this->_setting_options['title'];
            $arr            =   array('size' => '25', 'id' => $inputID);
            $html      =   $htmlObj->textbox($inputaName, $inputValue, $arr);
            echo $html . $htmlObj->pTag('Input a string that not than 20 character', array('class' => 'description'));
            
        }
    }
    
    public function main_section_view() {
        
    }
    
    private function stringMaxValidate($val, $max) {
        $flag   =   false;
    
        $str    =   trim($val);
        if(strlen($str) <= $max) {
            $flag   =   true;
        }
    
        return $flag;
    }
    
    public function validate_settings($data_input) {
        
        $errors     =   array();
        
        if($this->stringMaxValidate($data_input['title'], 20) == false) {
            $errors['title']     =  'Site title: not than 20 character'   ;
        }
        
        if(count($errors) > 0) {
            $data_input     =   $this->_setting_options;
            $strErrors      =   '';
            foreach($errors as $key => $val) {
                $strErrors  .=  $val . '<br />';
            }
            add_settings_error($this->_menu_slug, 'my-setting', $strErrors, 'error');
        } else {
            add_settings_error($this->_menu_slug, 'my-setting', 'Update Successful', 'updated');
        }
        
        return $data_input;
    }
    
    
}