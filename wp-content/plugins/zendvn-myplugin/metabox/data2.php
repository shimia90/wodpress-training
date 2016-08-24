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
        if(!isset($postVal[$this->_metabox_id . '-nonce'])) return $post_id;
        
        if(!wp_verify_nonce($postVal[$this->_metabox_id . '-nonce'], $this->_metabox_id)) return $post_id;
        
        // Prevent Autosave metabox
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
        
        if(!current_user_can('edit_post', $post_id)) return $post_id;
        
        $arrData    =   array(
            'title'         =>      sanitize_text_field($postVal[$this->create_id('title')]),
            'price'         =>      sanitize_text_field($postVal[$this->create_id('price')]),
            'author'        =>      sanitize_text_field($postVal[$this->create_id('author')]),
            'level'         =>      sanitize_text_field($postVal[$this->create_id('level')]),
            'profile'       =>      sanitize_text_field($postVal[$this->create_id('profile')]),
        );
        
        foreach($arrData as $key => $value) {
            update_post_meta($post_id, $this->create_key($key), $value);
        }

    }
    
    public function show($post) {
        $htmlObj    =   new ZendvnHtml();
        
        wp_nonce_field($this->_metabox_id, $this->_metabox_id . '-nonce');
        
        // Tao phan tu title
        echo '<div class="zendvn-mb-wrap">';
        $inputID        =   $this->create_id('title');
        $inputName      =   $this->create_id('title');
        $inputValue     =   get_post_meta($post->ID, $this->create_key('title'), true);
        $arr            =   array('size' => '25', 'id' => $inputID);
        $html           =   $htmlObj->label(translate('Title')) . $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
        
        // Tao phan tu price
        $inputID        =   $this->create_id('price');
        $inputName      =   $this->create_id('price');
        $inputValue     =   get_post_meta($post->ID, $this->create_key('price'), true);
        $arr            =   array('size' => '25', 'id' => $inputID);
        $html           =   $htmlObj->label(translate('Price')). $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
        
        
        // Tao phan tu author
        $inputID        =   $this->create_id('author');
        $inputName      =   $this->create_id('author');
        $inputValue     =   get_post_meta($post->ID, $this->create_key('author'), true);
        $arr            =   array('size' => '25', 'id' => $inputID);
        $html           =   $htmlObj->label(translate('Author')) . $htmlObj->textbox($inputName, $inputValue, $arr);
        echo $htmlObj->pTag($html);
        
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
        
        $html           =   $htmlObj->label(translate('Level')) . $htmlObj->selectbox($inputName, $inputValue, $arr, $options) ;
        
        echo $htmlObj->pTag($html);
        
        // Tao phan tu profile
        $inputID        =   $this->create_id('profile');
        $inputName      =   $this->create_id('profile');
        $inputValue     =   get_post_meta($post->ID, $this->create_key('profile'), true);
        $arr            =   array('id' => $inputID, 'rows' => 6, 'cols' => 60);
        
        $html           =   $htmlObj->label(translate('Profile')) . $htmlObj->textarea($inputName, $inputValue, $arr);
        
        echo $htmlObj->pTag($html);
        
        echo '</div>';
        
    }
    
    public function add_css_file() {
        wp_register_style('zendvn_mp_mb_data', ZENDVN_MP_CSS_URL . '/mb-data.css', array(), '1.0');
        wp_enqueue_style('zendvn_mp_mb_data');
    }
    
}