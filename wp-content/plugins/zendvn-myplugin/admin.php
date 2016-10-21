<?php
require_once ZENDVN_MP_PLUGIN_DIR . '/includes/support.php';

class ZendvnMpAdmin{	
	
	public function __construct(){		
		//$this->ajaxPage2();
	}
	

	public function tabsPage(){
		require_once ZENDVN_MP_SETTING_DIR . '/tabs.php';
		new Zendvn_Mp_Setting_Tabs();
	}
	

	public function ajaxPage(){
		require_once ZENDVN_MP_SETTING_DIR . '/ajax.php';
		new Zendvn_Mp_Setting_Ajax();
	}
	
	public function ajaxPage2(){
		require_once ZENDVN_MP_SETTING_DIR . '/ajax2.php';
		new Zendvn_Mp_Setting_Ajax2();
	}
}