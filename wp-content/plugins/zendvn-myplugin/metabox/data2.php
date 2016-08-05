<?php
class Zendvn_Mp_Mb_Data2 {
    
    private $_metabox_id    =   'zendvn-mp-mb-data';
    
    private $_metabox_name  =   'ZendVN MP Metabox data';
    
    private $_prefix_key    =   '_zendvn_mp_mb_data2_';
    
    private $_prefix_id     =   'zendvn-mp-mb-data2-';
    
    public function __construct() {
        
        add_action('add_meta_boxes', array($this, 'display'));
        
        add_action('save_post', array($this, 'save'));
        
    }
    
    private function create_key($value) {
        return $this->_prefix_key . $value;
    }
    
    private function create_id($value) {
        return $this->_prefix_id . $value;
    }
    
    public function display() {
        add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
        add_meta_box($this->_metabox_id, $this->_metabox_name, array($this, 'show'), 'post');
    }
    
    public function save($post_id) {
        
        
        $postVal    =   $_POST;
        update_post_meta($post_id, $this->create_key('title'), sanitize_text_field($postVal[$this->create_id('title')]));
        update_post_meta($post_id, $this->create_key('price'), sanitize_text_field($postVal[$this->create_id('price')]));
        update_post_meta($post_id, $this->create_key('author'), sanitize_text_field($postVal[$this->create_id('author')]));
        update_post_meta($post_id, $this->create_key('level'), sanitize_text_field($postVal[$this->create_id('level')]));
        update_post_meta($post_id, $this->create_key('profile'), strip_tags($postVal[$this->create_id('profile')]));
    }
    
    public function show($post) {
        $htmlObj    =   new ZendvnHtml();
        
        // Tao phan tu title
        echo '<div class="zendvn-mb-wrap">';
        $inputID        =   $this->create_id('title');
        $inputName      =   $this->create_id('title');
        $inputValue     =   get_post_meta($post->ID, $this->create_key('title'), true);
        $arr            =   array('size' => '25', 'id' => $inputID);
        echo '<p><label for="'.$inputID.'">'. translate('Title') .'</label>
                 '. $htmlObj->textbox($inputName, $inputValue, $arr) .'
              </p>';
        
        // Tao phan tu price
        $inputID        =   $this->create_id('price');
        $inputName      =   $this->create_id('price');
        $inputValue     =   get_post_meta($post->ID, $this->create_key('price'), true);
        $arr            =   array('size' => '25', 'id' => $inputID);
        echo '<p><label for="'.$inputID.'">'. translate('Price') .'</label>
                 '. $htmlObj->textbox($inputName, $inputValue, $arr) .'
              </p>';
        
        // Tao phan tu author
        $inputID        =   $this->create_id('author');
        $inputName      =   $this->create_id('author');
        $inputValue     =   get_post_meta($post->ID, $this->create_key('author'), true);
        $arr            =   array('size' => '25', 'id' => $inputID);
        echo '<p><label for="'.$inputID.'">'. translate('Author') .'</label>
                 '. $htmlObj->textbox($inputName, $inputValue, $arr) .'
              </p>';
        
        // Tao phan tu level
        $inputID        =   $this->create_id('level');
        $inputName      =   $this->create_id('level');
        $inputValue     =   get_post_meta($post->ID, $this->create_key('level'), true);
        $arr            =   array('id' => $inputID);
        
        $options['data']    =   array(
            'beginner'          =>      translate('Beginer'),
            'intermediate'      =>      translate('Intermediate'),
            'advanced'          =>      translate('Advanced')
        );
        
        echo '<p><label for="'.$inputID.'">'. translate('Level') .'</label>
                 '. $htmlObj->selectbox($inputName, $inputValue, $arr, $options) .'
              </p>';
        
        // Tao phan tu profile
        $inputID        =   $this->create_id('profile');
        $inputName      =   $this->create_id('profile');
        $inputValue     =   get_post_meta($post->ID, $this->create_key('profile'), true);
        $arr            =   array('id' => $inputID, 'rows' => 6, 'cols' => 60);
        echo '<p><label for="'.$inputID.'">'. translate('Profile') .'</label>
                 '. $htmlObj->textarea($inputName, $inputValue, $arr) .'
              </p>';
        
        echo '</div>';
        
    }
    
    public function add_css_file() {
        wp_register_style('zendvn_mp_mb_data', ZENDVN_MP_CSS_URL . '/mb-data.css', array(), '1.0');
        wp_enqueue_style('zendvn_mp_mb_data');
    }
    
}