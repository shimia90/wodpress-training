<?php
require_once ZENDVN_MP_PLUGIN_DIR . '/includes/support.php';
class ZendvnMp{
	
	public function __construct(){
		//echo '<br/>' . __METHOD__;
		//=====================================================
		//Hiển thị các Action đang thực thi trong Hook
		//=====================================================
		add_action('wp_footer', array($this,'showFunction'));				
		
	}
		
	//=====================================================
	//Hiển thị các Action đang thực thi trong Hook
	//=====================================================
	public function showFunction(){
		ZendvnMpSupport::showFunc('widget_title');
	}	
	
}