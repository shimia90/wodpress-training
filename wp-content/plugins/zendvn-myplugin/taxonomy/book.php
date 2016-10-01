<?php
class Zendvn_Mp_CT_BookCategory {

    public function __construct() {
        add_action('init', array($this, 'create'));
    }

    public function create() {
        $labels     =   array(
            'name'                          =>      'Book Categories',
            'singular'                      =>      'Book Category',
            'menu_name'                     =>      'Categories',
            //'all_items'
            //'view_item'
            'edit_item'                     =>      'Edit Book Category',
            'update_item'                   =>      'Update Book Category',
            'add_new_item'                  =>      'Add New Book Category',
            //'new_item_name'
            //'parent_item'
            //'parent_item_colon'
            'search_items'                  =>      'Search Book Category',
            'popular_items'                 =>      'Book Categories are using',
            'seperate_items_with_commas'    =>      '123',
            'choose_from_most_used'         =>      'abc',
            'not_found'                     =>      'No Book Category Found'
        );

        $args   =   array(
            'labels'                =>      $labels,
            'public'                =>      true,
            'show_ui'               =>      true,
            'show_in_nav_menus'     =>      true,
            'show_tagcloud'         =>      true,
            'hierarchical'          =>      true,
            'show_admin_column'     =>      true,
            'rewrite'               =>      array('slug' =>     'book-cat')

        );
        register_taxonomy('book-category', 'zproduct', $args);
    }

}