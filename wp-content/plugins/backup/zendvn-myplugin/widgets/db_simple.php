<?php
class ZendvnMp_Widget_Db_Simple {
    
    public function __construct() {
        add_action('wp_dashboard_setup', array($this, 'zendvn_mp_widget_db'));
    }
    
    function zendvn_mp_widget_db() {
        wp_add_dashboard_widget('zendvn_mp_widget_db_simple', 'My Plugin Information', array($this, 'zendvn_mp_widget_db_simple_display'));
    }
    
    /* function zendvn_mp_widget_db_simple_display() {
        $wpQuery    =   new WP_Query('author=1');
        echo '<pre>';
        print_r($wpQuery);
        echo '</pre>';
        $lnkPost    =   '#';
        if($wpQuery->have_posts()) {
            echo '<ul>';
            while ($wpQuery->have_posts()) {
                $wpQuery->the_post();
                $lnkPost    =   admin_url(). 'post.php?post=' .get_the_ID() . '&action=edit';
                echo '<li><a href="'.$lnkPost.'">'.get_the_title().'</a></li>';
            }
            echo '</ul>';
            
        } else {
            echo '<p>No Post Found</p>';
        }
        wp_reset_postdata();
    } */
    
    /* function zendvn_mp_widget_db_simple_display() {
        $args       =   array(
            'author'    =>      1,
            'p'         =>      37
        );
        $wpQuery    =   new WP_Query($args);
        echo '<pre>';
        print_r($wpQuery);
        echo '</pre>';
        $lnkPost    =   '#';
        if(count($wpQuery->posts) > 0) {
            foreach($wpQuery->posts as $key => $value) {
                echo '<br />'. $value->post_title;
            }
        }
        
    } */
    
    function zendvn_mp_widget_db_simple_display() {
        $args       =   array(
            'cat'    =>      1,
            //'p'         =>      37
        );
        $wpQuery    =   new WP_Query($args);
        echo '<pre>';
        print_r($wpQuery->post_count);
        echo '</pre>';
        $lnkPost    =   '#';
        if(count($wpQuery->posts) > 0) {
            foreach($wpQuery->posts as $key => $value) {
                echo '<br />'. $value->post_title;
            }
        }
    
    }
    
}