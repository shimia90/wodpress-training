<?php
class Zendvn_Theme_Widget_Social extends WP_Widget {
    
      public function __construct() {
        
        $id_base    =   'zendvn-theme-widget-social';
        $name       =   "Zendvn Social";
        $widget_options     =   array(
            'classname'     =>  'widget_wpex_social_widget',
            'description'   =>  'Widget Social'
        );
        $control_options    =   array(
            'width'     =>  '250px',
        );
        parent::__construct($id_base, $name, $widget_options, $control_options);

    }
    
    public function form($instance) {
        $htmlObj        =   new ZendvnHtml();
        // Tao phan tu Social
        $inputID        =   $this->get_field_id('social');
        $inputName      =   $this->get_field_name('social');
        $inputValue     =   @$instance['social'];
        $arr            =   array( 'class'     =>  'widefat', 'id'        =>  $inputID );
        $html           =      $htmlObj->label(translate('Title'), array('for' => $inputID))
                                    . $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
        
        // Tao phan tu Content
        $inputID        =   $this->get_field_id('content');
        $inputName      =   $this->get_field_name('content');
        $inputValue     =   @$instance['content'];
        $arr            =   array( 'class'     =>  'widefat', 'id'        =>  $inputID );
        $html           =      $htmlObj->label(translate('Content'), array('for' => $inputID))
        . $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
        
        // Tao phan tu Twitter
        $inputID        =   $this->get_field_id('twitter');
        $inputName      =   $this->get_field_name('twitter');
        $inputValue     =   @$instance['twitter'];
        $arr            =   array( 'class'     =>  'widefat', 'id'        =>  $inputID );
        $html           =      $htmlObj->label(translate('Twitter Link'), array('for' => $inputID))
        . $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
        
        // Tao phan tu Facebook
        $inputID        =   $this->get_field_id('facebook');
        $inputName      =   $this->get_field_name('facebook');
        $inputValue     =   @$instance['facebook'];
        $arr            =   array( 'class'     =>  'widefat', 'id'        =>  $inputID );
        $html           =      $htmlObj->label(translate('Facebook Link'), array('for' => $inputID))
        . $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
        
        // Tao phan tu Google Plus
        $inputID        =   $this->get_field_id('google-plus');
        $inputName      =   $this->get_field_name('google-plus');
        $inputValue     =   @$instance['google-plus'];
        $arr            =   array( 'class'     =>  'widefat', 'id'        =>  $inputID );
        $html           =      $htmlObj->label(translate('Google Plus Link'), array('for' => $inputID))
        . $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
        
        // Tao phan tu Dribbble
        $inputID        =   $this->get_field_id('dribbble');
        $inputName      =   $this->get_field_name('dribbble');
        $inputValue     =   @$instance['dribbble'];
        $arr            =   array( 'class'     =>  'widefat', 'id'        =>  $inputID );
        $html           =      $htmlObj->label(translate('Dribbble Link'), array('for' => $inputID))
        . $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
        
        // Tao phan tu RSS
        $inputID        =   $this->get_field_id('rss');
        $inputName      =   $this->get_field_name('rss');
        $inputValue     =   @$instance['rss'];
        $arr            =   array( 'class'     =>  'widefat', 'id'        =>  $inputID );
        $html           =      $htmlObj->label(translate('RSS Link'), array('for' => $inputID))
        . $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
        
    }
    
    public function update($new_instance, $old_instance) {
        
        $instance   =   $old_instance;
        $instance['social']  =   strip_tags($new_instance['social']);
        $instance['content']  =   strip_tags($new_instance['content']);
        $instance['twitter']  =   strip_tags($new_instance['twitter']);
        $instance['facebook']  =   strip_tags($new_instance['facebook']);
        $instance['google-plus']  =   strip_tags($new_instance['google-plus']);
        $instance['dribbble']  =   strip_tags($new_instance['dribbble']);
        $instance['rss']  =   strip_tags($new_instance['rss']);
        
        
        return $instance;
    }
    
    public function widget($args , $instance) {
        extract($args);
        $title          =   apply_filters('widget_title', $instance['social']);
        
        echo $before_widget;
        if(!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        
        require_once ZENDVN_THEME_WIDGET_DIR . '/html/social.php';
        
        echo $after_widget;
    }

}