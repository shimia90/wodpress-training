<?php
class Zendvn_Mp_Mb_Editor{
	
	private $_meta_box_id = 'zend-mp-mb-editor';
	
	private $_prefix_key  = '_zend_mp_mb_editor_';
	
	private $_prefix_id = 'zend-mp-mb-editor-';
	
	public function __construct(){
		add_action('add_meta_boxes', array($this,'create'));
		
		add_action('save_post', array($this,'save'));
		//echo '<br/>' . __METHOD__;
	}
	
	public function create(){
		add_action('admin_enqueue_scripts', array($this,'add_css_file'));
		//echo '<br/>' . __METHOD__;
		add_meta_box($this->_meta_box_id, 'My Editor', array($this,'display'),'post');
	}
	
	private function create_key($val){
		return $this->_prefix_key . $val;
	}
	

	private function create_id($val){
		return $this->_prefix_id . $val;
	}
	
	
	public function save($post_id){
		
		$postVal = $_POST;
		
		if(!isset($postVal[$this->_meta_box_id . '-nonce'])) return $post_id;
		
		if(!wp_verify_nonce($postVal[$this->_meta_box_id . '-nonce'],$this->_meta_box_id))  return $post_id;
		
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		
		if(!current_user_can('edit_post', $post_id)) return $post_id;
		
		$arrData = array(
					'content' 	=> wp_filter_post_kses($postVal[$this->create_id('content')])
				);
		foreach ($arrData as $key => $val){
			update_post_meta($post_id, $this->create_key($key),$val);
		}		
		
		//die();
	}
	
	public function display($post){
		/* echo '<pre>';
		print_r($post);
		echo '</pre>'; */
		wp_nonce_field($this->_meta_box_id,$this->_meta_box_id . '-nonce');
		echo '<div class="zendvn-mb-wrap">';
		echo '<p><b><i>' . translate('Xin vui lòng nhập đầy đủ thông tin vào các ô sau') . ':</i></b></p>';
		
		$inputID 		= $this->create_id('content');
		$inputValue 	= get_post_meta($post->ID,$this->create_key('content'),true);
		$options = array(
				'wpautop'           => false,
				'media_buttons'     => false,
				'default_editor'    => '',
				'drag_drop_upload'  => true,
				'textarea_name'     => $inputID,
				'textarea_rows'     => 8,
				'tabindex'          => '',
				'tabfocus_elements' => ':prev,:next',
				'editor_css'        => '',//style
				'editor_class'      => '',//class
				'teeny'             => false,
				'dfw'               => false,
				'tinymce'           => true,
				'quicktags'         => false
		);
		
		echo '<p>';
		wp_editor($inputValue, $inputID,$options);
		echo '</p>';
		
		echo '</div>';
	}
	
	public function add_css_file(){
		wp_register_style('zendvn_mp_mb_data', ZENDVN_MP_CSS_URL . '/mb-data.css', array(),'1.0');
		wp_enqueue_style('zendvn_mp_mb_data');
	}
}








