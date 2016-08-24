<div class="wrap">
	<h2>My Setting</h2>
	
	<?php settings_errors($this->_menu_slug, false, false); ?>
	
	<p>This is page that show my settings</p>
	<form action="options.php" method="post" id="<?php echo $this->_menu_slug; ?>" enctype="multipart/form-data">
		<?php echo settings_fields($this->_menu_slug); ?>
		<?php echo do_settings_sections($this->_menu_slug); ?>
		
		<p class="submit">
			<input type="submit" name="submit" value="Save Changes" class="button button-primary" />
		</p>
		
	</form>
</div>