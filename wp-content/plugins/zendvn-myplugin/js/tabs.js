jQuery(document).ready(function($){

	function load_content(tab_name) {
			var dataObj 	=	{
				'action': 'zendvn_load_content',
				'value' : tab_name
			};
			console.log(dataObj);
			$.ajax({
				url: 		ajaxurl,
				type: 		'POST',
				data: 		dataObj,
				dataType: 	'html',
				beforeSend: function() {
					$("#zendvn-mp-info").html('Content loading...');
				},
				success:  function(data, status, jsXHR) {
					$("#zendvn-mp-info").html(data);
				}
			});
	}

	var hash 	=	window.location.hash;

	if(hash == '') {
		hash 	=	"#tab1";
	}
	load_content(hash);

	$("#zendvn-mp-tabs a").click(function(){
			hash =	$(this).attr('href');
			load_content(hash);
	});



});