jQuery(document).ready(function($){
	var hash = window.location.hash;
	
	if(hash == ''){
		hash = "#tab1";
	}
	load_content(hash);
	//console.log(hash);
	
	$("#zendvn-mp-tabs a").click(function(e){
		hash = $(this).attr("href");
		load_content(hash);
	});
	
	function load_content(tab_name){
		var dataObj = {				
				"action": "zendvn_load_content",
				"tab": tab_name
			};
		console.log(dataObj);
		
		$.ajax({
			url		: ajaxurl,//admin-ajax.php?action=zendvn_check_form
			type	: "POST",
			data	: dataObj,
			dataType: "html",
			beforeSend: function(){
						$("#zendvn-mp-info").html("Content loading... ");
					},
			success	: function(data, status, jsXHR){
						$("#zendvn-mp-info").html(data);
					}
		});
	}
	
});