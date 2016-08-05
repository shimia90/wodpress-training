<div class="wrap">
	<h2>My Settings</h2>
	<p>Input Description For Blog Page</p>
	<?php settings_errors( $this->_menuSlug, false, false );?>
	<form method="post" action="options.php" id="zendvn-mp-form-setting" enctype="multipart/form-data">
		<?php settings_fields('zendvn-mp-options'); ?>
		<?php echo do_settings_sections($this->_menuSlug); ?>
		<p class="submit">
			<input type="submit" name="submit" value="Save change"  class="button button-primary" >
		</p>
	</form>
</div>
