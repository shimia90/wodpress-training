<?php
class Zendvn_Mp_Metabox_Main {
    
    private $_metabox_name      =   'zendvn_mp_mb_options';
    
    private $_metabox_option    =   array();
    
    public function __construct() {
        $defaultOption  =   array(
            'zendvn_mp_mb_simple'       =>  false,
            'zendvn-mp-mb-data'         =>  false,
            'zendvn-mp-mb-data2'        =>  true,
            'zendvn-mp-mb-editor'       =>  false,
            'zendvn-mp-mb-media'        =>  false,
        );
        $this->_metabox_option      =       get_option($this->_metabox_name, $defaultOption);
        
        $this->simple();
        
        $this->data();
        
        $this->data2();
        
        $this->editor();
        
        $this->media();
    }
    
    public function simple() {
        if($this->_metabox_option['zendvn_mp_mb_simple'] == true) {
            require_once ZENDVN_MP_METABOX_DIR . '/simple.php';
            new Zendvn_Mp_Mb_Simple();
        }
    }
    
    public function data() {
        if($this->_metabox_option['zendvn-mp-mb-data'] == true) {
            require_once ZENDVN_MP_METABOX_DIR . '/data.php';
            new Zendvn_Mp_Mb_Data();
        }
    }
    
    public function data2() {
        if($this->_metabox_option['zendvn-mp-mb-data2'] == true) {
            require_once ZENDVN_MP_METABOX_DIR . '/data2.php';
            new Zendvn_Mp_Mb_Data2();
        }
    }
    
    public function media() {
        if($this->_metabox_option['zendvn-mp-mb-media'] == true) {
            require_once ZENDVN_MP_METABOX_DIR . '/media.php';
            new Zendvn_Mp_Mb_Media();
        }
    }
    
    public function editor() {
        if($this->_metabox_option['zendvn-mp-mb-editor'] == true) {
            require_once ZENDVN_MP_METABOX_DIR . '/editor.php';
            new Zendvn_Mp_Mb_Editor();
        }
    }
    
}