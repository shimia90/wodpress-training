<?php
class Zendvn_Mp_Mb_Data {
    
    private $_metabox_id    =   'zendvn-mp-mb-data';
    
    private $_metabox_name  =   'ZendVN MP Metabox data';
    
    public function __construct() {
        
        add_action('add_meta_boxes', array($this, 'display'));
        
        add_action('save_post', array($this, 'save'));
        
    }
    
    public function display() {
        add_action('admin_enqueue_scripts', array($this, 'add_css_file'));
        add_meta_box($this->_metabox_id, $this->_metabox_name, array($this, 'show'), 'zproduct');
    }
    
    public function save($post_id) {
        echo '<pre>';
        print_r($post_id);
        echo '</pre>';
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        
        $postVal    =   $_POST;
        update_post_meta($post_id, '_zendvn_mp_mb_data_title', sanitize_text_field($postVal['zendvn-mp-mb-data-title']));
        update_post_meta($post_id, '_zendvn_mp_mb_data_price', sanitize_text_field($postVal['zendvn-mp-mb-data-price']));
        update_post_meta($post_id, '_zendvn_mp_mb_data_author', sanitize_text_field($postVal['zendvn-mp-mb-data-author']));
        update_post_meta($post_id, '_zendvn_mp_mb_data_level', sanitize_text_field($postVal['zendvn-mp-mb-data-level']));
        update_post_meta($post_id, '_zendvn_mp_mb_data_profile', strip_tags($postVal['zendvn-mp-mb-data-profile']));
    }
    
    public function show($post) {
        $htmlObj    =   new ZendvnHtml();
        
        // Tao phan tu title
        echo '<div class="zendvn-mb-wrap">';
        $inputID        =   'zendvn-mp-mb-data-title';
        $inputName      =   'zendvn-mp-mb-data-title';
        $inputValue     =   get_post_meta($post->ID, '_zendvn_mp_mb_data_title', true);
        $arr            =   array('size' => '25', 'id' => $inputID);
        echo '<p><label for="'.$inputID.'">'. translate('Title') .'</label>
                 '. $htmlObj->textbox($inputName, $inputValue, $arr) .'
              </p>';
        
        // Tao phan tu price
        $inputID        =   'zendvn-mp-mb-data-price';
        $inputName      =   'zendvn-mp-mb-data-price';
        $inputValue     =   get_post_meta($post->ID, '_zendvn_mp_mb_data_price', true);
        $arr            =   array('size' => '25', 'id' => $inputID);
        echo '<p><label for="'.$inputID.'">'. translate('Price') .'</label>
                 '. $htmlObj->textbox($inputName, $inputValue, $arr) .'
              </p>';
        
        // Tao phan tu author
        $inputID        =   'zendvn-mp-mb-data-author';
        $inputName      =   'zendvn-mp-mb-data-author';
        $inputValue     =   get_post_meta($post->ID, '_zendvn_mp_mb_data_author', true);
        $arr            =   array('size' => '25', 'id' => $inputID);
        echo '<p><label for="'.$inputID.'">'. translate('Author') .'</label>
                 '. $htmlObj->textbox($inputName, $inputValue, $arr) .'
              </p>';
        
        // Tao phan tu level
        $inputID        =   'zendvn-mp-mb-data-level';
        $inputName      =   'zendvn-mp-mb-data-level';
        $inputValue     =   get_post_meta($post->ID, '_zendvn_mp_mb_data_level', true);
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
        $inputID        =   'zendvn-mp-mb-data-profile';
        $inputName      =   'zendvn-mp-mb-data-profile';
        $inputValue     =   get_post_meta($post->ID, '_zendvn_mp_mb_data_profile', true);
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