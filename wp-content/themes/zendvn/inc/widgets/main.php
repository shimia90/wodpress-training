<?php
class Zendvn_Theme_Widget_Main {
    
    private $_widget_options    =   array();
    
    
    public function __construct() {
        $this->_widget_options  =   array(
            'searchForm'        =>      true,
            'social'            =>      true,
            'tabs'               =>      true
        );
        
        foreach($this->_widget_options as $key => $val) {
            if($val == true) {
                add_action('widgets_init', array($this, $key));
            }
        }
        
    }
    
    public function searchForm() {
        require_once ZENDVN_THEME_WIDGET_DIR . '/searchForm.php';
        register_widget('Zendvn_Theme_Widget_SearchForm');
    }
    
    public function social() {
        require_once ZENDVN_THEME_WIDGET_DIR . '/social.php';
        register_widget('Zendvn_Theme_Widget_Social');
    }
    
    public function tabs() {
        require_once ZENDVN_THEME_WIDGET_DIR . '/tabs.php';
        register_widget('Zendvn_Theme_Widget_Tabs');
    }
    
}