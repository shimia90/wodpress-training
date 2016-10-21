<?php
require_once ZENDVN_MP_PLUGIN_DIR . '/includes/support.php';

class ZendvnMpAdmin{
	
	private $_menuSlug = 'zendvn-mp-my-setting';
	
	private $_setting_options;
	
	public function __construct(){
		//echo '<br>' . __METHOD__;
		
		$this->_setting_options = get_option('zendvn_mp_name',array());
				
		add_action('admin_menu', array($this,'settingMenu'));
		
		add_action('admin_init', array($this,'register_setting_and_fields'));
		
		
	}

	public function register_setting_and_fields(){
		
		register_setting('zendvn_mp_options', 'zendvn_mp_name', array($this,'validate_setting'));
		
		//MAIN SETTING
		$mainSection = 'zendvn_mp_main_section';
		add_settings_section($mainSection, "Main setting", 
							array($this,'main_section_view'), $this->_menuSlug);

		add_settings_field('zendvn_mp_new_title', 'Site title', array($this,'create_form'), 
							$this->_menuSlug,$mainSection,array('name'=>'new_title_input'));	

		add_settings_field('zendvn_mp_logo', 'Logo:', array($this,'create_form'),
							 $this->_menuSlug,$mainSection, array('name'=>'logo_input'));

		/* $tmp = get_settings_errors( $this->_menuSlug);
		echo '<pre>';
		print_r($tmp);
		echo '</pre>'; */
	}
	
	public function create_form($args){
				
		if($args['name']== 'new_title_input'){
			echo '<input type="text" name="zendvn_mp_name[zendvn_mp_new_title]"
						value="' . $this->_setting_options['zendvn_mp_new_title'] . '"/>';
			echo '<p class="description">Nhập vào một chuỗi không quá 20 ký tự</p>';
		}
		
		if($args['name']== 'logo_input'){
			echo '<input type="file" name="zendvn_mp_logo" />';
			echo '<p class="description">Chỉ được phép upload các tập tin có định dang JPG - PNG - GIF</p>';
			if(!empty( $this->_setting_options['zendvn_mp_logo'])){
				echo "<img src='" . $this->_setting_options['zendvn_mp_logo'] . "' width='200' />";
			}
		}
	}
	
	//===============================================
	//Kiem tra cac dieu kien truoc khi luu du lieu vao database
	//===============================================
	public function validate_setting($data_input){
		
		//Mang chua cac thong bao loi cua form
		$errors = array();
		
		if($this->stringMaxValidate($data_input['zendvn_mp_new_title'], 20) == false){
			$errors['zendvn_mp_new_title'] = "Site title: Chuoi dai qua so ky tu da qui dinh";
		}
		
		if(!empty($_FILES['zendvn_mp_logo']['name'])){
			if($this->fileExtionsValidate($_FILES['zendvn_mp_logo']['name'], "JPG|PNG|GIF") == false){
				$errors['zendvn_mp_logo'] = "Logo: Khong dung voi dinh dang da qui dinh";
			}else{
				if(!empty($this->_setting_options['zendvn_mp_logo_path'])){
					@unlink($this->_setting_options['zendvn_mp_logo_path']);
				}
					
				$override = array('test_form'=>false);
				$fileInfo = wp_handle_upload($_FILES['zendvn_mp_logo'],$override);
				$data_input['zendvn_mp_logo'] 		= $fileInfo['url'];
				$data_input['zendvn_mp_logo_path'] 	= $fileInfo['file'];
			}
		}else{
			$data_input['zendvn_mp_logo'] 		= $this->_setting_options['zendvn_mp_logo'];
			$data_input['zendvn_mp_logo_path'] 	= $this->_setting_options['zendvn_mp_logo_path'];
		}
		
		if(count($errors)>0){
			$data_input = $this->_setting_options;
			$strErrors = '';
			foreach ($errors as $key => $val){
				$strErrors .= $val . '<br/>';
			}
			
			add_settings_error($this->_menuSlug, 'my-setting', $strErrors,'error');
		}else{
			add_settings_error($this->_menuSlug, 'my-setting', 'Cap nhat du lieu thanh cong','updated');
		}
		//die();
		return $data_input;
	}
	
	//===============================================
	//Kiem tra chieu chieu dai cua chuoi
	//===============================================
	private function stringMaxValidate($val, $max){
		$flag = false;
		
		$str = trim($val);
		if(strlen($str) <= $max){
			$flag = true;
		}
		
		return $flag;
	}
	
	//===============================================
	//Kiem tra phần mở rộng của file
	//===============================================
	private function fileExtionsValidate($file_name, $file_type){
		$flag = false;
		
		$pattern = '/^.*\.('. strtolower($file_type) . ')$/i'; //$file_type = JPG|PNG|GIF
		if(preg_match($pattern, strtolower($file_name)) == 1){
			$flag = true;
		}
		
		return $flag;
	}
	
	public function main_section_view(){
		
	}
	
	public function settingMenu(){
		
		add_menu_page(	
						'My Setting title', 
						'My Setting', 
						'manage_options', 
						$this->_menuSlug, 
						array($this,'settingPage')
					);
		/* add_options_page(
					'My Setting title',
					'My Setting',
					'manage_options',
					$this->_menuSlug,
					array($this,'settingPage')
					); */
	}
	
	public function settingPage(){
		require_once ZENDVN_MP_VIEWS_DIR . '/setting-page.php';
	}
}