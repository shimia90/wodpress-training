<?php
class Cp_Product {
    
    public function __construct() {
        add_action('init', array($this, 'create'));
        add_filter('pre_get_posts', array($this, 'show_home'));
        add_filter('template_include', array($this, 'load_template'));
    }
    
    public function create() {
        $labels     =   array(
            'name'                  =>      __('Products'),
            'singular_name'         =>      __('Product'),
            'menu_name'             =>      __('Product 123'),
            'name_admin_bar'        =>      __('ZProduct'),
            'add_new'               =>      __('Add Product'),
            'add_new_item'          =>      __('Add New Product'),
            'search_items'          =>      __('Search Product'),
            'not_found'             =>      __('No products found'),
            'not_found_in_trash'    =>      __('No products found in Trash'),
            'view_item'             =>      __('View Product')
        );
        
        $args       =   array(
            'labels'            =>      $labels,
            'description'       =>      __('This is the description about this post type'),
            'public'            =>      true,
            'hierarchical'      =>      true,
            'show_in_nav_menus' =>      true,
            'menu_icon'         =>      ZENDVN_MP_IMAGES_URL . '/icon-setting16x16.png',
            'capability_type'   =>      'post',
            'supports'          =>      array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats'),
            'has_archive'       =>      true,
            'rewrite'           =>      array('slug' => 'zproduct'),
            '_edit_link'        =>      'post.php?post=%d'
        );
        register_post_type('zproduct', $args);
    }
    
    public function show_home($query) {
        if(is_home() && $query->is_main_query()) {
            $query->set('post_type', array('post', 'zproduct'));
        }
        return $query;
    }
    
    public function load_template($template_file) {
        if(is_single()) {
            global $wp;
            
            if($wp->query_vars['post_type'] == 'zproduct') {
                echo locate_template('loop-zproduct.php');
            }
        }
        return $template_file;
    }
    
}