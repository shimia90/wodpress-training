<?php
class Zendvn_Mp_Cp_Product{
	
	public function __construct(){
		//echo '<br/>' . __METHOD__;
		add_action('init', array($this,'create'));
		add_filter('pre_get_posts', array($this,'show_home'));
		
		add_filter('template_include', array($this,'load_template'));
	}
	
	public  function load_template($template_file){
		global $wp;
		/* echo __FUNCTION__;
		echo '<br/>' . $template_file;
		echo '<br/>' . $wp->query_vars['post_type'];
		echo '<br/>' . is_archive(); */
		/* echo '<pre>';
		print_r($wp);
		echo '</pre>'; */
		if(is_single()){
			
			if(isset($wp->query_vars['post_type']) && $wp->query_vars['post_type'] == 'zproduct'){
				$file = ZENDVN_MP_CP_DIR . '/templates/loop-zproduct.php';
				if(file_exists($file)){
					$template_file = $file;
				}
			}
		}
		
		if(is_archive()){
				
			if(isset($wp->query_vars['post_type']) && $wp->query_vars['post_type'] == 'zproduct'){
				$file = ZENDVN_MP_CP_DIR . '/templates/list-zproduct.php';
				if(file_exists($file)){
					$template_file = $file;
				}
			}
		}
		
		return $template_file;
	}
	
	public function show_home($query){
		
		if(is_home() && $query->is_main_query()){
			$query->set('post_type',array('post','zproduct'));
		}
		
		return $query;
	}
	
	public function create(){
		
		$labels = array(
					'name' 				=> __('Books'),
					'singular_name' 	=> __('Book'),
					'menu_name'			=> __('ZBook'),
					'name_admin_bar' 	=> __('ZBook'),
					'add_new'			=> __('Add Book'),
					'add_new_item'		=> __('Add New Book'),
					'search_items' 		=> __('Search Book'),
					'not_found'			=> __('No products found.'),
					'not_found_in_trash'=> __('No products found in Trash'),
					'view_item' 		=> __('View product'),
					'edit_item'			=> __('Edit product'),
				);
		$args = array(
				'labels'               => $labels,
				'description'          => 'Hiển thị nội dung mô tả về phần Custom Post',
				'public'               => true,
 				'hierarchical'         => true,
// 				'exclude_from_search'  => null, //public
// 				'publicly_queryable'   => null, //public
// 				'show_ui'              => null, //public
// 				'show_in_menu'         => null, 
 				'show_in_nav_menus'    => true, //public
 				'show_in_admin_bar'    => true, //public
 				'menu_position'        => 5,
 				'menu_icon'            => ZENDVN_MP_IMAGES_URL . '/icon-setting16x16.png',
 				'capability_type'      => 'post',
// 				'capabilities'         => array(),
// 				'map_meta_cap'         => null,
 				'supports'             => array('title' ,'editor','author','thumbnail','excerpt','trackbacks' ,'custom-fields' ,'comments','revisions' ,'page-attributes','post-formats'),
// 				'register_meta_box_cb' => null,
 				'taxonomies'           => array('book-category'),
 				'has_archive'          => true,
 				'rewrite'              => array('slug'=>'zproduct'),
// 				'query_var'            => true,
// 				'can_export'           => true,
// 				'delete_with_user'     => null,
// 				'_builtin'             => false,
 				'_edit_link'           => 'post.php?post=%d',
		);
		
		register_post_type('zproduct',$args);
	}
}