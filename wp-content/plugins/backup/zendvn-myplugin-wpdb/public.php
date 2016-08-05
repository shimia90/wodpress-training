<?php
require_once ZENDVN_MP_PLUGIN_DIR . '/includes/support.php';
class ZendvnMp {
    
    public function __construct() {
        echo '<br />'. __METHOD__;
        /**
         * add_filter('the_title', array($this, 'theTitle'));
         */
        //add_filter('the_title', array($this, 'theTitle'));
        
        /**
         * add_filter('the_title', array($this, 'theTitle2'), 10, 2);
         */
        //add_filter('the_title', array($this, 'theTitle2'), 10, 2);
        
        /**
         * add_filter('the_title', array($this, 'theTitle3'));
         */
        //add_filter('the_title', array($this, 'theTitle3'));
        
        //add_action('wp_footer', array($this, 'showFunction'));
        
        //add_filter('the_content', array($this, 'changeContent'));
        
        /*
         * add_filter('the_content', array($this, 'changeContent2'), 10, 1);
         */
        //add_filter('the_content', array($this, 'changeContent2'), 10, 1);
        
        //add_filter('the_content', array($this, 'changeContent3'), 10, 1);
        
        add_action('wp_footer', array($this, 'showFunction'));
        
        remove_filter('the_content', 'convert_smilies');
        
        add_filter('the_title',  array($this, 'changeString'));
        add_filter('the_content', array($this, 'changeString'));
        
    }
    
    public function theTitle() {
        $str    =   'Change the title of post';
        return $str;
    }
    
    public function theTitle2($title, $id) {
        if($id == 1) {
            $title  =   str_replace('Hello', 'Xin Chao', $title);
        }
        return $title;
    }
    
    public function showFunction() {
        ZendvnMpSupport::showFunc();   
    }
    
    public function changeContent($content) {
        $content    .=  'This post is written by Zendvn';
        return $content;
    }
    
    public function changeContent2($content) {
        $content    =   str_replace('WordPress', '<a href="http://zend.vn">WP</a>', $content);
        return $content;
    }
    
    public function changeContent3($content) {
        global $post;
        if($post->post_type == 'page') {
            $content    .=  'This post is written by Zendvn';
        }
        return $content;
    }
    
    public function changeString($text) {
        if(current_filter() == 'the_title') {
            if(!is_page()) {
                $text   .=  ' - My Title';
            }
        }
        
        if(current_filter() == 'the_content') {
            $text   =  str_replace('example', 'vi du', $text);
        }
        
        return $text;
    }
    
}