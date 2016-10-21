<?php
class Zendvn_Mp_SC_Main {
    
    private $_shortcode_name    =   'zendvn_mp_sc_options';
    
    private $_shortcode_option  =   array();
    
    public function __construct() {
        
        $defaultOption  =   array(
            'zendvn_mp_sc_date'     =>      true,
            'zendvn_mp_sc_titles'   =>      true
            
        );
        
        $this->_shortcode_option    =   get_option($this->_shortcode_name, $defaultOption);
       
        $this->date();
        
        $this->titles();
        
        //remove_shortcode('zendvn_mp_sc_date');
        
        //echo shortcode_exists('zendvn_mp_sc_date');
        
        // add_action('the_content', array($this, 'removeAllShortcodes'));
        
        add_action('the_content', array($this, 'get_shortcode_regex'));
    }
    
    public function removeAllShortcodes($content) {
        $content    =   strip_shortcodes($content);
        
        
        return $content;
    }
    
    public function date() {
        if($this->_shortcode_option['zendvn_mp_sc_date'] == true) {
            require_once ZENDVN_MP_SHORTCODES_DIR . '/date.php';
            new Zendvn_Mp_SC_Date();
        } else {
            add_shortcode('zendvn_mp_sc_date', '__return_false');
        }
    }
    
    public function titles() {
        if($this->_shortcode_option['zendvn_mp_sc_titles'] == true) {
            require_once ZENDVN_MP_SHORTCODES_DIR . '/titles.php';
            new Zendvn_Mp_Sc_Titles();
        } else {
            add_shortcode('zendvn_mp_sc_titles', '__return_false');
        }
    }
    
    public function get_shortcode_regex($content) {
        $pattern    =   '/'. get_shortcode_regex() . '/s';
        preg_match_all($pattern, $content, $matches);
        if(array_key_exists(2, $matches)) {
            $shortcodeArr   =   $matches[2];
        }
        echo '<pre>';
        print_r($shortcodeArr);
        echo '</pre>';
    }
    
}