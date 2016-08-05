<div class="wrap">
	<h2>My Settings</h2>
	<p>This is a page that show all my settings</p>
	<form method="post" action="options.php" id="zendvn-mp-form-setting" enctype="multipart/form-data">
		<?php settings_fields('zendvn-mp-options'); ?>
		<?php echo do_settings_sections($this->_menuSlug); ?>
	</form>
</div>
