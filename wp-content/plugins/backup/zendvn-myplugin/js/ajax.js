/**
 * 
 */
jQuery(document).ready(function($){
	$("#zendvn_mp_st_ajax_title").blur(function(){
		var dataObj 	=	{
			'action': 'zendvn_check_form',
			'value' : $(this).val()
		};
		
		$.ajax({
			url: 		ajaxurl,
			type: 		'POST',
			data: 		dataObj,
			dataType: 	'json',
			success:  	function(data, status, jsXHR) {
				console.log(data);
				$("#zendvn_mp_st_ajax_title").next('span').remove();
				if(data.status == false) {
					$("#zendvn_mp_st_ajax_title").after('<span>' + data.errors.zendvn_mp_st_ajax_title + '</span>');
					$("#btn_save_changes").attr("disabled", "disabled");
				} else {
					$("#zendvn_mp_st_ajax_title").after('<span>OK</span>');
					$("#btn_save_changes").removeAttr("disabled");
				}
			}
		});
	});
});