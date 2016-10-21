<?php
class Zendvn_Mp_Mb_Editor {
    
    private $_metabox_id    =   'zendvn-mp-mb-editor';
    
    private $_metabox_name  =   'ZendVN MP Metabox Editor';
    
    private $_prefix_key    =   '_zendvn_mp_mb_editor_';
    
    private $_prefix_id     =   'zendvn-mp-mb-editor-';
    
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
            'content'         =>      wp_filter_post_kses($postVal[$this->create_id('content')]),
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
            $inputValue     =   get_post_meta($post->ID, $this->create_key('content'), true);
            $inputID        =   $this->create_id('content');
            
            $options        =   array(
    			'wpautop'             => true,
    			'media_buttons'       => true,
    			'default_editor'      => '',
    			'drag_drop_upload'    => false,
    			'textarea_name'       => $inputID,
    			'textarea_rows'       => 20,
    			'tabindex'            => '',
    			'tabfocus_elements'   => ':prev,:next',
    			'editor_css'          => '',
    			'editor_class'        => '',
    			'teeny'               => false,
    			'dfw'                 => false,
    			'_content_editor_dfw' => false,
    			'tinymce'             => true,
    			'quicktags'           => true
    		);
            
            echo '<p>' . wp_editor($inputValue, $inputID, $options) . '</p>';
        echo '</div>';
        
    }
    
    public function add_css_file() {
        wp_register_style('zendvn_mp_mb_data', ZENDVN_MP_CSS_URL . '/mb-data.css', array(), '1.0');
        wp_enqueue_style('zendvn_mp_mb_data');
    }
    
}