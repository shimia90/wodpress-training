<?php
class Zendvn_Theme_Widget_SearchForm extends WP_Widget {
    
      public function __construct() {
        
        $id_base    =   'zendvn-theme-widget-search-form';
        $name       =   "Zendvn Search Form";
        $widget_options     =   array(
            'classname'     =>  'widget_search',
            'description'   =>  'Widget Search Form Customize'
        );
        $control_options    =   array(
            'width'     =>  '250px',
        );
        parent::__construct($id_base, $name, $widget_options, $control_options);
        //add_action('wp_head', array($this, addCss));
        
        add_action('wp_enqueue_scripts', array($this, 'addCss'));

    }
    
    /* public function addCss() {
        $output     =   '<style>.zendvn-mp-wg-css-simple { background-color: #f1f1f1; border: 1px solid #000; padding: 5px; } </style>';
        echo $output;
    } */
    
    public function addCss() {
        wp_register_style('wg-simple-02', ZENDVN_MP_CSS_URL . '/wg-simple-02.css', array(), '1.0', 'all');
        wp_enqueue_style('wg-simple-02');
    }
    
    public function addFileCss() {
        wp_enqueue_style('wg-simple', ZENDVN_MP_CSS_URL . '/wg-simple.css', array(), '1.0', 'all');
        wp_register_style('wg-simple-01', ZENDVN_MP_CSS_URL . '/wg-simple-01.css', array(), '1.0', 'all');
        wp_enqueue_style('wg-simple-01');
    }
    
    public function addJs() {
        
    }
    
    public function form($instance) {
        $htmlObj        =   new ZendvnHtml();
        // Tao phan tu Title
        $inputID        =   $this->get_field_id('title');
        $inputName      =   $this->get_field_name('title');
        $inputValue     =   @$instance['title'];
        $arr            =   array( 'class'     =>  'widefat', 'id'        =>  $inputID );
        $html           =      $htmlObj->label(translate('Title'), array('for' => $inputID))
                                    . $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
    }
    
    public function update($new_instance, $old_instance) {
        
        $instance   =   $old_instance;
        $instance['title']  =   strip_tags($new_instance['title']);
        
        return $instance;
    }
    
    public function widget($args , $instance) {
        extract($args);
        $title          =   apply_filters('widget_title', $instance['title']);
        
        echo $before_widget;
        if(!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        
        require_once ZENDVN_THEME_WIDGET_DIR . '/html/searchForm.php';
        
        echo $after_widget;
    }

}