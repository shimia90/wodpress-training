<?php
class Zendvn_Mp_Widget_Last_Post extends WP_Widget {
    
    private $_cache_name    =   'zendvn_mp_wg_last_post_caching';
    
    public function __construct() {
        
        $id_base        =   'zendvn-mp-widget-last-post';
        $name           =   'Abc Last Post';
        $widget_option  =   array(
            'classname'     =>      'zendvn-mp-wg-css-last-post',
            'descriptuon'   =>      'Hien thi nhung bai viet (post) moi nhat',
        );
        $control_options    =   array('width'   =>  '250px');
        parent::__construct($id_base, $name, $widget_option, $control_options);
        
    }
    
    public function widget($args, $instance) {
        
        
        extract($args);
        
        $title      =   apply_filters('widget_title', $instance['title']);
        $title      =   (empty($title)) ? 'Last Post' : $title;
        $format     =   (empty($instance['format'])) ? 'standard' : $instance['format'];
        $items      =   (empty($instance['items'])) ? '5' : $instance['items'];
        $ordering   =   (empty($instance['ordering'])) ? 'DESC' : $instance['ordering'];
        
        $caching    =   get_transient($this->_cache_name);
        
        if($caching == false) {
            echo '<strong>Khong su dung cache</strong>';
            $args       =   array(
                'post_type'             =>      'post',
                'order'                 =>      $ordering,
                'orderby'               =>      'ID',
                'posts_per_page'        =>      $items,
                'post_status'           =>      'publish',
                'ignore_sticky_posts'   =>      true
            );
            
            if($format != 'standard') {
                $tax_query      =   array(
                    array(
                        'field'     =>      'slug',
                        'terms'     =>      'post-format-'. $format,
                        'taxonomy'  =>      'post_format',
                        'operator'  =>      'IN'
                    )
                );
            
                $args['tax_query']  =   $tax_query;
            }
            
            $wp_query   =   new WP_Query($args);
            set_transient($this->_cache_name, $wp_query, 3 * MINUTE_IN_SECONDS);
        } else {
            echo '<strong>Su dung cache</strong>'; 
            $wp_query   =   $caching;
        }  
        
        if($wp_query->have_posts()) {
            echo '<ul>';
            while($wp_query->have_posts()) {
                $wp_query->the_post();
                echo '<li><a href="'. get_the_permalink() .'">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        }
        
    }
    
    public function update($new_instance, $old_instance) {
        
        $instance   =   $old_instance;
        $instance['title']  =   strip_tags($new_instance['title']);
        $instance['format']  =   strip_tags($new_instance['format']);
        $instance['items']  =   strip_tags($new_instance['items']);
        $instance['ordering']  =   strip_tags($new_instance['ordering']);
        
        delete_transient($this->_cache_name);
        
        return $instance;
    }
    
    public function form($instance) {
        $htmlObj    =   new ZendvnHtml();
        
        // Tao phan tu title
        $inputID        =   $this->get_field_id('title');
        $inputName      =   $this->get_field_name('title');
        $inputValue     =   @$instance['title'];
        $arr            =   array('class' => 'widefat', 'id'    =>  $inputID);
        echo '<p><label for="'.$inputID.'">'.translate('Title').'</label>
               '.$htmlObj->textbox($inputName, $inputValue, $arr).'     
              </p>';
        
        
        
        $tmp    =   get_theme_support('post-formats');
        $tmp    =   $tmp[0];       
        
        // Tao phan tu Format
        $inputID            =   $this->get_field_id('format');
        $inputName          =   $this->get_field_name('format');
        $inputValue         =   @$instance['format'];
        $arr                =   array('class' => 'widefat', 'id'    =>  $inputID);
        $options['data']    =  array('standard' => 'Standard');
        for($i = 0 ; $i < count($tmp); $i++) {
            $options['data'][$tmp[$i]] = ucfirst($tmp[$i]);
        }
        echo '<p><label for="'.$inputID.'">'.translate('Format').'</label>
               '.$htmlObj->selectbox($inputName, $inputValue, $arr, $options).'     
              </p>';       
        
        // Tao phan tu Items
        $inputID        =   $this->get_field_id('items');
        $inputName      =   $this->get_field_name('items');
        $inputValue     =   @$instance['items'];
        $arr            =   array('class' => 'widefat', 'id'    =>  $inputID);
        echo '<p><label for="'.$inputID.'">'.translate('Numnber of items').'</label>
               '.$htmlObj->textbox($inputName, $inputValue, $arr).'
              </p>';
        
        // Tao phan tu Ordering
        $inputID        =   $this->get_field_id('ordering');
        $inputName      =   $this->get_field_name('ordering');
        $inputValue     =   @$instance['ordering'];
        $arr            =   array('class' => 'widefat', 'id'    =>  $inputID);
        
        $options['data']    =   array(
            'asc'       =>      'ASC (a-z)',
            'desc'      =>      'DESC (z-a)'
        );
        echo '<p><label for="'.$inputID.'">'.translate('Odering by ID').'</label>
               '.$htmlObj->selectbox($inputName, $inputValue, $arr, $options).'
              </p>';
        
    }
    
}