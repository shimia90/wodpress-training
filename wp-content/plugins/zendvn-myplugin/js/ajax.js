jQuery(document).ready(function($){
	$("#zendvn_mp_st_ajax_title").blur(function(e){
		
		var dataObj = {				
				"action": "zendvn_check_form",
				"value": $(this).val()
			};
		console.log(dataObj);
		
		$.ajax({
			url		: ajaxurl,//admin-ajax.php?action=zendvn_check_form
			type	: "POST",
			data	: dataObj,
			dataType: "json",
			success	: function(data, status, jsXHR){
						console.log(data);
						$("#zendvn_mp_st_ajax_title").next().remove();
						if(data.status == false){
							$("#btn-save-change").attr('disabled','disabled');
							$("#zendvn_mp_st_ajax_title")
								.after('<span>' + data.errors.zendvn_mp_st_ajax_title + '</span>');
						}else{
							$("#btn-save-change").removeAttr('disabled');
							$("#zendvn_mp_st_ajax_title")
								.after('<span>OK</span>');
						}
					}
		});
		
	});
});