<?php
class Zendvn_Mp_CT_BookCategory{
	
	public function __construct(){
		//echo '<br/>' . __METHOD__;
		add_action('init',array($this,'create'));
	}
	
	public function create(){
		
		$labels = array(
				'name'				=> 'Book categories',
				'singular' 			=> 'Book category',
				'menu_name'			=> 'Categories',
				//'all_items'		=> chua xac dinh
				//'view_item'		=> chua xac dinh
				'edit_item'			=> 'Edit book category',
				'update_item'		=> 'Update book categor',
				'add_new_item'		=> 'Add new Book category',
				//'new_item_name'	=> chua xac dinh
				//'parent_item'		=> chua xac dinh
				//'parent_item_colon'	=> chua xac dinh
				'search_items'		=> 'Search book categories',
				'popular_items'		=> 'Book categories are using',
				'separate_items_with_commas' => 'Separate tags with commas 123',
				'choose_from_most_used' => 'Choose from the most used tags 123',
				'not_found'			=> 'No book category found',
		
				);
		$args = array(
					'labels' 				=> $labels,
					'public'				=> true,
					//'show_ui'				=> false,
					//'show_in_nav_menus'	=> false,
					'show_tagcloud'			=> true,
					'hierarchical'			=> true,
					'show_admin_column'		=> false,
					'query_var'				=> true,
					'rewrite'				=> array('slug' => 'book-cat'),
				);
		register_taxonomy('book-category', 'zproduct',$args);
	}
	
	
}