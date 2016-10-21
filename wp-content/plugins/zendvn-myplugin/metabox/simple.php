<?php
class Zendvn_Mp_Mb_Simple{
	
	public function __construct(){
		add_action('add_meta_boxes', array($this,'create'));
		
	}
	
	public function create(){
		echo '<br/>' . __METHOD__;
		add_meta_box('zend-mp-mb-simple', 'My Custom Meta box', array($this,'display'),'post');
	}
	
	public function display(){
		echo '<p>Welcome to my meta box!</p>';
	}
}