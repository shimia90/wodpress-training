<div class="wrap">
	<h2>My Settings</h2>
	<p>This is a page that show all my settings</p>
	<form method="post" action="options.php" id="zendvn-mp-form-setting" enctype="multipart/form-data">
		<?php settings_fields('zendvn-mp-options'); ?>
		<?php echo do_settings_sections($this->_menuSlug); ?>
		<?php 
		  global $wpdb;
		  echo $table  =   $wpdb->prefix . 'zendvn_mp_article';
		  $query      =       "SELECT * FROM `{$table}` WHERE `status` = 1";
		  
		  // Vd1
		  /* $output     =   ARRAY_N;
		  $info       =   $wpdb->get_row($query, $output, 1 ); */
		  
		  //Vd2
		  /* $output     =   OBJECT;
		  $info       =   $wpdb->get_col($query, 1 ); */
		  
		  //Vd3
		  /* $output     =   OBJECT;
		  $info       =   $wpdb->get_results($query, $output ); */
		  
		  //Vd4
		  /* $data       =   array(
	          'title'     =>      'This is a text',
		      'picture'   =>      'xyz.jpg',
		      'content'   =>      'This is content',
		      'status'    =>      1
		      
		  );
		  $format     =   array('%s', '%s', '%s', '%d');
		  $info       =   $wpdb->insert($table, $data, $format ); */
		  
		  //Vd5
		  /* $data       =   array(
		      'id'        =>      22,
		      'title'     =>      'This is a text 123',
		      'picture'   =>      'xyz123.jpg',
		      'content'   =>      'This is content 123',
		      'status'    =>      0
		  
		  );
		  $format     =   array('%d','%s', '%s', '%s', '%d');
		  $info       =   $wpdb->replace($table, $data, $format ); */
		  
		  //Vd6
		  /* $data       =   array(
		      'title'     =>      'This is a text 246',
		      'picture'   =>      'xyz246.jpg',
		      'content'   =>      'This is content 246',
		      'status'    =>      1
		  
		  );
		  $where          =   array('id' => 22);
		  $format         =   array('%s', '%s', '%s', '%d');
		  $where_format   =   array('%d');
		  $info       =   $wpdb->replace($table, $data, $format ); */
		  
		  //Vd7
		  /* $where          =   array('id' => 22);
		  $format         =   array('%s', '%s', '%s', '%d');
		  $where_format   =   array('%d');
		  $info       =   $wpdb->delete($table, $where, $where_format ); */
		  
		  //Vd8
		  $title          =   'This is a test 2';
		  $picture        =   'abc2.png';
		  $content        =   'This is a content 2';
		  $status         =   0;
		  
		  $query          =   "INSERT INTO `{$table}` (`title`, `picture`, `content`, `status`) VALUES (%s, %s, %s, %d)";
		  $info           =   $wpdb->prepare($query, $title, $picture, $content, $status);
		  $wpdb->query($info);
		  
		  echo '<pre>';
		  print_r($info);
		  echo '</pre>';
		?>
	</form>
</div>
