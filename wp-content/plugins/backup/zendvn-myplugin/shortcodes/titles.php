<?php
class Zendvn_Mp_Sc_Titles {
    
    public function __construct() {
        
        add_shortcode('zendvn_mp_sc_titles', array($this, 'show'));
        
    }
    
    public function show($attr) {
        if(is_single()) {
           
            
            $pairs  =   array(
                'ids'       =>      '27',
                'title'     =>      'Default Title'
            );
            $attr   =   shortcode_atts($pairs, $attr, 'zendvn_mp_sc_titles');
            extract($attr);
            $xhtml  =   '<div class="title"><b><i>'.$title.'</i></b></div>';
            
            $ids    =   explode(',', $ids);
            
            if(count($ids) > 0) {
                $args   =   array(
                    'post_type'             =>      'post',
                    'post__in'              =>      $ids,
                    'post_status'           =>      'publish',
                    'ignore_sticky_posts'   =>      true
                );
                $wpQuery    =   new WP_Query($args);
                if($wpQuery->have_posts()) {
                    $xhtml  .=  '<ul>';
                        while($wpQuery->have_posts()) {
                            $wpQuery->the_post();
                            $xhtml  .=  '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                        }
                        wp_reset_postdata();
                    $xhtml  .=  '</ul>';
                }
            }
            
        }
        
        return $xhtml;
    }
    
}