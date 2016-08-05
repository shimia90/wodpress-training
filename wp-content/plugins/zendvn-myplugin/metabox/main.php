<?php
class Zendvn_Mp_Metabox_Main {
    
    private $_metabox_name      =   'zendvn_mp_mb_options';
    
    private $_metabox_option    =   array();
    
    public function __construct() {
        $defaultOption  =   array(
            'zendvn_mp_mb_simple'   =>  false,
            'zendvn-mp-mb-data'     =>  false,
            'zendvn-mp-mb-data2'     =>  true,
        );
        $this->_metabox_option      =       get_option($this->_metabox_name, $defaultOption);
        
        $this->simple();
        
        $this->data();
        
        $this->data2();
        
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
    
}