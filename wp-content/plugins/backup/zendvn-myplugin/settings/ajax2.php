<?php
class Zendvn_Mp_Setting_Ajax2 {
    
    // 
    private $_menu_slug         =   'zendvn-mp-st-ajax2';
    
    //
    private $_option_name       =   'zendvn_mp_st_ajax2';
    
    //
    private $_setting_options; 
    
    public function __construct() {
        
        $this->_setting_options     =   get_option($this->_option_name, array());
        
        add_action('admin_menu', array($this, 'settingMenu'));
        
        add_action('admin_init', array($this, 'register_settings_and_fields'));
        
    }
    
    public function settingMenu() {
        add_menu_page('My Settings 2', 'My Settings 2', 'manage_options', $this->_menu_slug, array($this, 'display'));
    }
    
    public function display() {
        require_once ZENDVN_MP_PLUGIN_VIEW_DIR . '/setting-page-ajax2.php';
    }
    
    public function register_settings_and_fields() {
        
        // Ajax
        add_action('admin_enqueue_scripts', array($this, 'add_js_file'));
        add_action('wp_ajax_zendvn_check_form2', array($this, 'zendvn_check_form2'));
        
        register_setting($this->_menu_slug, $this->_option_name, array($this, 'validate_settings'));
        
        // Main Section
        $mainSection     =   'zendvn_mp_main_section';
        add_settings_section($mainSection, 'Main Settings', array($this, 'main_section_view'), $this->_menu_slug);
        
        add_settings_field($this->create_id('title'), 'Title', array($this, 'create_form'), $this->_menu_slug, $mainSection, array('name' => 'title'));
        
        add_settings_field($this->create_id('email'), 'Email', array($this, 'create_form'), $this->_menu_slug, $mainSection, array('name' => 'email'));
        
        add_settings_field($this->create_id('logo'), 'Logo', array($this, 'create_form'), $this->_menu_slug, $mainSection, array('name' => 'logo'));
        
    }
    
    public function zendvn_check_form2() {
        
        $postVal    =   $_POST;
        $errors     =   array();
        
        if(!empty($postVal) && $postVal['input_id'] == 'zendvn_mp_st_ajax2_title') {
            if($this->stringMaxValidate($postVal['value'], 20) == false) {
                $errors['msg']  =   'This string is more than 20 characters';
            }
        }
        
        if(!empty($postVal) && $postVal['input_id'] == 'zendvn_mp_st_ajax2_email') {
            if(!filter_var($postVal['value'], FILTER_VALIDATE_EMAIL)) {
                $errors['msg']  =   'Email invalid';
            }
        }
        
        if(!empty($postVal) && $postVal['input_id'] == 'zendvn_mp_st_ajax2_logo') {
            if($this->fileExtionsValidate($postVal['value'], "JPG|PNG|GIF") == false) {
                $errors['msg']  =   'Extension invalid';
            }
            
        }
        
        $msg    =   array();
        if(count($errors) > 0) {
            $msg['status']  =   false;
            $msg['errors']  =   $errors;
        } else {
            $msg['status']  =   true;
        }
        echo json_encode($msg);
        die();
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
        
        if($args['name'] == 'email') {
        
            // Create title
            $inputID        =   $this->create_id('email');
            $inputaName     =   $this->create_name('email');
            $inputValue     =   @$this->_setting_options['email'];
            $arr            =   array('size' => '25', 'id' => $inputID);
            $html      =   $htmlObj->textbox($inputaName, $inputValue, $arr);
            echo $html;
        
        }
        
        if($args['name'] == 'logo') {
        
            // Create title
            $inputID        =   $this->create_id('logo');
            $inputaName     =   $this->create_name('logo');
            $inputValue     =   '';
            $arr            =   array('size' => '25', 'id' => $inputID);
            $html      =   $htmlObj->fileupload($inputaName, $inputValue, $arr);
            echo $html;
        
        }
    }
    
    public function main_section_view() {
        
    }
    
    private function fileExtionsValidate($file_name, $file_type){
        $flag = false;
    
        $pattern = '/^.*\.('. strtolower($file_type) . ')$/i'; //$file_type = JPG|PNG|GIF
        if(preg_match($pattern, strtolower($file_name)) == 1){
            $flag = true;
        }
    
        return $flag;
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
    
    public function add_js_file() {
        wp_register_script($this->_menu_slug, ZENDVN_MP_JS_URL . '/ajax2.js', array('jquery'), '1.0');
        wp_enqueue_script($this->_menu_slug);
    }
    
    
}