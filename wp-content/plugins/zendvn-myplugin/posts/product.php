<?php
class Cp_Product {

    public function __construct() {
        add_action('init', array($this, 'create'));
        add_filter('pre_get_posts', array($this, 'show_home'));
        add_filter('template_include', array($this, 'load_template'));
    }

    public function create() {
        $labels     =   array(
            'name'                  =>      __('Books'),
            'singular_name'         =>      __('Book'),
            'menu_name'             =>      __('Book 123'),
            'name_admin_bar'        =>      __('ZBook'),
            'add_new'               =>      __('Add Book'),
            'add_new_item'          =>      __('Add New Book'),
            'search_items'          =>      __('Search Book'),
            'not_found'             =>      __('No Books found'),
            'not_found_in_trash'    =>      __('No Books found in Trash'),
            'view_item'             =>      __('View Book'),
            'edit_item'             =>      __('Edit Book')
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
            'taxonomies'        =>      array('book-category'),
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
        global $wp;
        if(is_single()) {
            if($wp->query_vars['post_type'] == 'zproduct') {
                $file = ZENDVN_MP_CP_DIR . '/templates/loop-zproduct.php';
                if(file_exists($file)) {
                    $template_file  =   $file;
                }
            }
        }

        if(is_archive()) {
            if($wp->query_vars['post_type'] == 'zproduct') {
                $file =     ZENDVN_MP_CP_DIR . '/templates/list-zproduct.php';
                if(file_exists($file)) {
                    $template_file  =   $file;
                }
            }
        }

        return $template_file;
    }

}