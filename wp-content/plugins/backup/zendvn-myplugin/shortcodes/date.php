<?php
class Zendvn_Mp_SC_Date {
    
    public function __construct() {
        add_shortcode('zendvn_mp_sc_date', array($this, 'show'));
    }
    
    public function show() {
        
        if(is_single()) {
            $postObj    =   get_post(get_the_ID());
            
            if(has_shortcode($postObj->post_content, 'zendvn_mp_sc_date') == true) {
                wp_enqueue_style('zendvn_mp_sc_date_css', ZENDVN_MP_CSS_URL . '/abc.css', array(), '1.0');
            }
            $str        =   '<div class="zendvn_mp_sc_date_css">';
            $str        .=   date('l jS \of F Y h:i:m');
            $str        .=   '</div>';
            return $str;
        }
    }
    
}