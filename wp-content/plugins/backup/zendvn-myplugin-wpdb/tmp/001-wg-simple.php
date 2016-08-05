<?php
class Zendvn_Mp_Widget_Simple extends WP_Widget {
    
    public function __construct() {
        
        $id_base    =   'Zendvn-Mp-Widget-Simple';
        $name       =   "Abc Simple Widget";
        $widget_options     =   array(
            'classname'     =>  'zendvn-mp-wg-css-simple',
            'description'   =>  'Day la mot Widget don gian'
        );
        $control_options    =   array(
            'width'     =>  '250px',
        );
        parent::__construct($id_base, $name, $widget_options, $control_options);
        //add_action('wp_head', array($this, addCss));
        
        add_action('wp_enqueue_scripts', array($this, 'addFileCss'));
    }
    
    /* public function addCss() {
        $output     =   '<style>.zendvn-mp-wg-css-simple { background-color: #f1f1f1; border: 1px solid #000; padding: 5px; } </style>';
        echo $output;
    } */
    
    public function addCss() {
        
    }
    
    public function addFileCss() {
        wp_enqueue_style('wg-simple', ZENDVN_MP_CSS_URL . '/wg-simple.css', array(), '1.0', 'all');
        wp_register_style('wg-simple-01', ZENDVN_MP_CSS_URL . '/wg-simple-01.css', array(), '1.0', 'all');
        wp_enqueue_style('wg-simple-01');
        
        global $wp_styles;
        echo '<pre>';
        print_r($wp_styles);
        echo '</pre>';
    }
    
    public function form($instance) {
        $htmlObj        =   new ZendvnHtml();
        // Tao phan tu Title
        $inputID        =   $this->get_field_id('title');
        $inputName      =   $this->get_field_name('title');
        $inputValue     =   $instance['title'];
        $arr    =   array( 'class'     =>  'widefat', 'id'        =>  $inputID );
        $xhtml  =   '<p><label for="'.$inputID.'">'.translate('Title').'</label>
                    '.$htmlObj->textbox($inputName, $inputValue, $arr).'
                    </p>';
        
        // Tao phan tu Movie
        $inputID        =   $this->get_field_id('movie');
        $inputName      =   $this->get_field_name('movie');
        $inputValue     =   $instance['movie'];
        $arr    =   array( 'class'     =>  'widefat', 'id'        =>  $inputID );
        $xhtml  .=   '<p><label for="'.$inputID.'">'.translate('Movie').'</label>
                    '.$htmlObj->textbox($inputName, $inputValue, $arr).'
                    </p>';
        echo $xhtml;
    }
    
    public function update($new_instance, $old_instance) {
        
        $instance   =   $old_instance;
        $instance['title']  =   strip_tags($new_instance['title']);
        $instance['movie']  =   strip_tags($new_instance['movie']);
        
        return $instance;
    }
    
    public function widget($args , $instance) {
        
        extract($args);
        $title  =   apply_filters('widget_title', $instance['title']);
        $title  =   (empty($title)) ? 'Abc Simple' : $title;
        
        $movie  =   (empty($instance['movie'])) ? '&nbsp;' : $instance['movie']; 
        
        echo $before_widget;
            echo $before_title . $title . $after_title;
        
            echo '<ul>';
            echo '<li>Fav Movie: '.$instance['movie'].'</li>';
            echo '</ul>';
        echo $after_widget;
    }
    
}