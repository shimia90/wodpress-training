/**
 * 
 */
/*jQuery(document).ready(function($){
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
});*/
(function($) {
	$.fn.checkInput =	function(phpFunc, btnID) {
		$(this).blur(function(){
			var dataObj 	=	{
					'action'	: 	phpFunc,
					'value' 	: 	$(this).val(),
					'input_id' 	:	$(this).attr('id')
			};
			
			$.ajax({
				url: 		ajaxurl,
				type: 		'POST',
				data: 		dataObj,
				dataType: 	'json',
				beforeSend: function(){
					$("#"+ dataObj.input_id).next('span').remove();
					$("#"+ dataObj.input_id).after('<span>Checking...</span>');
				},
				success:  	function(data, status, jsXHR) {
					console.log(data);
					$("#"+ dataObj.input_id).next('span').remove();
					if(data.status == false) {
						$("#"+ dataObj.input_id).after('<span>' + data.errors.msg + '</span>');
						$("#"+ btnID).attr("disabled", "disabled");
					} else {
						$("#"+ dataObj.input_id).after('<span>OK</span>');
						$("#"+ btnID).removeAttr("disabled");
					}
				}
			});
		});
	};
}(jQuery));

jQuery(document).ready(function($){
	$("#zendvn_mp_st_ajax2_title").checkInput('zendvn_check_form2', 'btn_save_changes');
	$("#zendvn_mp_st_ajax2_email").checkInput('zendvn_check_form2', 'btn_save_changes');
	$("#zendvn_mp_st_ajax2_logo").checkInput('zendvn_check_form2', 'btn_save_changes');
});