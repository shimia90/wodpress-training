(function($) {
	
	$.fn.zendvnBtnMedia =	function(inputID){
		var backupSendToEditor  =   window.send_to_editor;
        this.click(function(){
            tb_show('', 'media-upload.php?type=image&TB_iframe=true');
            window.send_to_editor = function(html){
                imageURL    =   $(html).attr('src');
                $('#'+inputID).val(imageURL);
                tb_remove();
                window.send_to_editor   =   backupSendToEditor;
            }
            return false;
        });
	};
	
}(jQuery));

/*
<script>
    jQuery(document).ready(function($){
        var backupSendToEditor  =   window.send_to_editor;
        $(this).click(function(){
            tb_show('', 'media-upload.php?type=image&TB_iframe=true');
            window.send_to_editor = function(html){
                imageURL    =   $(html). attr('src');
                $('#'+inputID).val(imageURL);
                tb_remove();
                window.send_to_editor   =   backupSendToEditor;
            }
            return false;
        });
    });
</script>
*/