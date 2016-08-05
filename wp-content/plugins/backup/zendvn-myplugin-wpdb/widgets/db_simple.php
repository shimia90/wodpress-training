<?php
class ZendvnMp_Widget_Db_Simple {
    
    public function __construct() {
        add_action('wp_dashboard_setup', array($this, 'zendvn_mp_widget_db'));
    }
    
    function zendvn_mp_widget_db() {
        wp_add_dashboard_widget('zendvn_mp_widget_db_simple', 'My Plugin Information', array($this, 'zendvn_mp_widget_db_simple_display'));
    }
    
    function zendvn_mp_widget_db_simple_display() {
        echo 'Day la khoa hoc lap trinh WP 4x';
        echo '<ul>';
        echo '<li>contact: training@zend.vn</li>';
        echo '</ul>';
    }
    
}