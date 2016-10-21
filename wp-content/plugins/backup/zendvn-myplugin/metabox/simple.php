<?php
class Zendvn_Mp_Mb_Simple {
    
    private $_metabox_id        =   'zendvn-mp-mb-simple';
    
    private $_metabox_title     =   'My Custom Metabox';
    
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'create'));
    }
    
    public function create() {
        add_meta_box($this->_metabox_id, $this->_metabox_title, array($this, 'display'), 'post');
    }
    
    public function display() {
        echo '<p>Welcome to my metabox !</p>';
    }
    
}