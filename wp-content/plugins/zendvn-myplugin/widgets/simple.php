<?php
class Zendvn_Mp_Widget_Simple extends WP_Widget {

	public function __construct() {
		
		$id_base = 'zendvn-mp-widget-simple';
		$name	= 'Abc Simple widget';
		$widget_options = array(
					'classname' => 'zendvn-mp-wg-css-simple',
					'description' => 'Day la mot Widget đơn gian'
				);
		$control_options = array('width'=>'250px');
		parent::__construct($id_base, $name,$widget_options, $control_options);
	

	}	
		
	public function widget( $args, $instance ) {
		
		extract($args);				
				
		$title = apply_filters('widget_title', $instance['title']);
		$title = (empty($title))? 'Abc simple': $title;
		$movie = (empty($instance['movie']))? '&nbsp;':$instance['movie'];
		$song = (empty($instance['song']))? '&nbsp;':$instance['song'];
		$css = (empty($instance['css']))? '':$instance['css'];
		//echo $css;
		$classname = $this->widget_options['classname'];
	//	echo '<br/>' . $classname;
		$before_widget = str_replace($classname, $classname . ' ' . $css, $before_widget);
		echo $before_widget;
		echo $before_title . $title . $after_title;		
		echo '<ul>';
		echo '<li>Fav Movie: ' . $movie . '</li>';
		echo '<li>Fav Song: ' . $song . '</li>';
		echo '</ul>';
		echo $after_widget;
	}
	
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['movie'] = strip_tags($new_instance['movie']);
		$instance['song'] = strip_tags($new_instance['song']);
		$instance['css'] = strip_tags($new_instance['css']);
		
		return $instance;
	}
	
	public function form( $instance ) {
		
			/* echo '<pre>';
			print_r($instance);
			echo '</pre>'; */
			$htmlObj =  new ZendvnHtml();
			
			//Tao phan tu chua Title
			$inputID 	= $this->get_field_id('title');
			$inputName 	= $this->get_field_name('title');
			$inputValue = @$instance['title'];
			$arr = array('class' =>'widefat','id' => $inputID);			
			echo '<p><label for="' . $inputID . '">' . translate('Title') . '</label>'
				  . $htmlObj->textbox($inputName,$inputValue,$arr) 
				  . '</p>';
			
			//Tao phan tu chua Movie
			$inputID 	= $this->get_field_id('movie');
			$inputName 	= $this->get_field_name('movie');
			$inputValue = @$instance['movie'];
			$arr = array('class' =>'widefat','id' => $inputID);
			echo '<p><label for="' . $inputID . '">' . translate('Movie') . '</label>'
			. $htmlObj->textbox($inputName,$inputValue,$arr)
			. '</p>';
			
			//Tao phan tu chua Song
			$inputID 	= $this->get_field_id('song');
			$inputName 	= $this->get_field_name('song');
			$inputValue = @$instance['song'];
			$arr = array('class' =>'widefat','id' => $inputID);
			echo '<p><label for="' . $inputID . '">' . translate('Song') . '</label>'
			. $htmlObj->textbox($inputName,$inputValue,$arr)
			. '</p>';
		
			//Tao phan tu chua CSS
			$inputID 	= $this->get_field_id('css');
			$inputName 	= $this->get_field_name('css');
			$inputValue = @$instance['css'];
			$arr = array('class' =>'widefat','id' => $inputID);
			echo '<p><label for="' . $inputID . '">' . translate('Css class') . '</label>'
			. $htmlObj->textbox($inputName,$inputValue,$arr)
			. '</p>';
	}
	

}
