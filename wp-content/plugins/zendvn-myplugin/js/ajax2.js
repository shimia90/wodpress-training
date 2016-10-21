(function($){
	$.fn.checkInput = function(phpFunc,btnID){
		$(this).blur(function(e){
			var dataObj = {				
					"action"	: phpFunc,
					 "value"	: $(this).val(),
					 "inputID"	: $(this).attr("id")
				};			
			console.log(dataObj);
			
			var inputID = "#" + dataObj.inputID;
			$.ajax({
				url		: ajaxurl,//admin-ajax.php?action=zendvn_check_form
				type	: "POST",
				data	: dataObj,
				dataType: "json",
				beforeSend: function(){
							$(inputID).next('span').remove();
							$(inputID).after('<span>Checking ...</span>');
						},
				success	: function(data, status, jsXHR){
							
							console.log(data);
							$(inputID).next('span').remove();
							if(data.status == false){
								$("#" + btnID).attr('disabled','disabled');
								$(inputID)
									.after('<span>' + data.errors.msg + '</span>');
							}else{
								$("#" + btnID).removeAttr('disabled');
								$(inputID)
									.after('<span>OK</span>');
							}
						}
			});
		});
	};
}(jQuery));

jQuery(document).ready(function($){
	$("#zendvn_mp_st_ajax2_title").checkInput("zendvn_check_form2","btn-save-change");
	$("#zendvn_mp_st_ajax2_email").checkInput("zendvn_check_form2","btn-save-change");
	$("#zendvn_mp_st_ajax2_logo").checkInput("zendvn_check_form2","btn-save-change");
});













