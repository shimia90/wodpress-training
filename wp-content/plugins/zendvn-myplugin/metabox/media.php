<?php
class Zendvn_Mp_Mb_Media {
    
    private $_metabox_id    =   'zendvn-mp-mb-media';
    
    private $_metabox_name  =   'ZendVN MP Metabox Media';
    
    private $_prefix_key    =   '_zendvn_mp_mb_media_';
    
    private $_prefix_id     =   'zendvn-mp-mb-media-';
    
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
        add_action('admin_enqueue_scripts', array($this, 'add_js_file'));
    }
    
    public function save($post_id) {
        
        
        $postVal    =   $_POST;
        if(!isset($postVal[$this->_metabox_id . '-nonce'])) return $post_id;
        
        if(!wp_verify_nonce($postVal[$this->_metabox_id . '-nonce'], $this->_metabox_id)) return $post_id;
        
        // Prevent Autosave metabox
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
        
        if(!current_user_can('edit_post', $post_id)) return $post_id;
        
        $arrData    =   array(
            'file'         =>      esc_url($postVal[$this->create_id('file')]),
        );
        
        foreach($arrData as $key => $value) {
            update_post_meta($post_id, $this->create_key($key), $value);
        }

    }
    
    public function show($post) {
        $htmlObj    =   new ZendvnHtml();
        
        wp_nonce_field($this->_metabox_id, $this->_metabox_id . '-nonce');
        
        // 
        echo '<div class="zendvn-mb-wrap">';
            // Tao phan tu Button
            echo '<div class="zendvn-mb-wrap">';
            $inputID        =   $this->create_id('button');
            $inputName      =   $this->create_id('button');
            $inputValue     =   translate('Media Library Image');
            $arr            =   array('class' => 'button-secondary', 'id' => $inputID);
            $options        =   array('type' => 'button');
            $btnMedia       =   $htmlObj->button($inputName, $inputValue, $arr, $options);
        
            // Tao phan tu File
            echo '<div class="zendvn-mb-wrap">';
            $inputID        =   $this->create_id('file');
            $inputName      =   $this->create_id('file');
            $inputValue     =   get_post_meta($post->ID, $this->create_key('file'), true);
            $arr            =   array('size' => '40', 'id' => $inputID);
            $html           =   $htmlObj->label(translate('File')) . $htmlObj->textbox($inputName, $inputValue, $arr) . ' ' .  $btnMedia;
            echo $htmlObj->pTag($html);
            
            echo $htmlObj->btn_media_script($this->create_id('button'), $this->create_id('file'));
            
        echo '</div>';
        
    }
    
    /**
     * 
     * @param unknown $button_id zendvn-mp-mb-media-button
     * @param unknown $input_id zendvn-mp-mb-media-file
     */
    public function add_js_file() {
       wp_register_script('zendvn_mp_mb_btn_media', ZENDVN_MP_JS_URL . '/zendvn-media-button.js', array('jquery', 'media-upload', 'thickbox'), '1.0');
       wp_enqueue_script('zendvn_mp_mb_btn_media');
    }
    
    public function add_css_file() {
        wp_register_style('zendvn_mp_mb_data', ZENDVN_MP_CSS_URL . '/mb-data.css', array(), '1.0');
        wp_enqueue_style('zendvn_mp_mb_data');
    }
    
}