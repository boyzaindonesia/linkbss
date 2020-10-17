var $ = jQuery.noConflict();

$(window).load(function($) {

});

$(document).ready(function($) {

	var $winWidth = $(window).width();
	var $winHeight = $(window).height();

    // $(document).on('submit', 'form.ajax_process_orders', ajax_process_orders );

    $(document).on('submit', 'form.ajax_default', ajax_default );

	$(document).on('click touchstart', '.btn-preview-newsletter', function(e){
		e.preventDefault();
		// alert('a');
		// var newsletter_subject = $('input[name="newsletter_subject"]').val();
		// var newsletter_desc = $('textarea[name="newsletter_desc"]').html();

		// $('.newsletter_subject').html(newsletter_subject);
		// $('.newsletter_desc').html(newsletter_desc);
	});

    if ($.cookie('get_notif_status')) {
        append_notif_status($.cookie('get_notif_status'));
    }
	setTimeout(function(){
		get_notif_status();
	},1000);

	$(document).scroll(function(){
		var pos = $(window).scrollTop();

	});

	$(window).resize(function(){
		var $winWidth = $(window).width();
		var $winHeight = $(window).height();

	});

	/**
	* Ajax ajax_process_orders
	*/
	// function ajax_process_orders(e){
	// 	if (typeof e !== 'undefined') e.preventDefault();
	// 	var form = $(this);
	// 	var formAction = form.attr('action');
	// 	var oldTitleBtn = form.find('button[type="submit"]').html();

	// 	form.find('button[type="submit"]').attr('disabled','disabled').html('Please wait...');

	// 	$.ajax({
	// 		type: 'POST',
	// 		url: formAction,
	// 		data: form.serialize(),
	// 		async: false,
	// 		cache: false,
	// 		dataType: 'json',
	// 		beforeSend: function(){

	// 		},
	// 		success: function(data){
	// 			if(data.error == false){
	// 				// alert(data.msg);
	// 			    history.pushState("", document.title, window.location.pathname + window.location.search);
	// 				$('html,body').animate({ scrollTop: 0}, 300, function(){
	// 		            if(data.href == ''){
	// 		            	alert(data.msg);
	// 		            	window.location.reload(true);
	// 		            } else {
	// 						window.location = data.href;
	// 					}
	// 				});
	// 			} else {
	// 				alert(data.msg);
	// 	            // window.location.reload(true);
	// 			}
	// 		},
	// 		error: function(jqXHR){
	// 			var response = jqXHR.responseText;
	//             // console.log(jqXHR);
	// 			alert(response);
	// 		}
	// 	});

	// 	form.find('button[type="submit"]').removeAttr('disabled').html(oldTitleBtn);

	// 	return false;
	// }


	/**
	* Ajax ajax_default
	*/
	function ajax_default(e){
		if (typeof e !== 'undefined') e.preventDefault();
		var form = $(this);
		var formAction = form.attr('action');
		var oldTitleBtn = form.find('button[type="submit"]').html();

		form.find('button[type="submit"]').attr('disabled','disabled').html('Please wait...');

		$.ajax({
			type: 'POST',
			url: formAction,
			data: form.serialize(),
			async: false,
			cache: false,
			dataType: 'json',
			beforeSend: function(){

			},
			success: function(data){
				alert(data.msg);
	            window.location.reload(true);
			},
			error: function(jqXHR){
				var response = jqXHR.responseText;
	            // console.log(jqXHR);
				alert(response);
			}
		});

		form.find('button[type="submit"]').removeAttr('disabled').html(oldTitleBtn);

		return false;
	}

    $(document).on('change', '[data-province]', get_province_city );

});

function get_province_city(){
	var province = $('[data-province]');
	var thisVal  = $('option:selected', province).val();
	$('[data-city]').attr('data-id','');

    $.ajax({
		type: 'POST',
        url: MOD_URL+'ajax-function/get_province_city',
        data: {'thisVal':thisVal, 'thisAction':'check'},
		async: false,
		cache: false,
		dataType: 'json',
		beforeSend: function(){
			$('[data-city]').html('<option value="" selected>--- Pilih ---</option>');
		},
		success: function(data){
			$('[data-city]').append(data.result);

			setTimeout(function(){
				var thisId   = $('[data-city]').attr('data-id');
				if(thisId=='' || thisId==undefined || thisId=='undefined' ){ thisId = ''; }
				$('[data-city]').val(thisId);
			}, 200);
		},
		error: function(jqXHR){
			var response = jqXHR.responseText;
			alert(response);
		}
	});
}

function get_notif_status(){
	$.ajax({
		type: 'POST',
		url: MOD_URL+"admin/notif_update_produk/get_notif_status",
        data: {'thisAction':'get_count'},
		async: false,
		cache: false,
		dataType: 'json',
		beforeSend: function(){

		},
		success: function(data){
            append_notif_status(data.count);

            var expires_day = 365;
            $.cookie('get_notif_status', data.count, { expires: expires_day });
		},
		error: function(jqXHR){
			var response = jqXHR.responseText;
            // console.log(jqXHR);
			// alert(response);
		}
	});
}
function append_notif_status(count = 0){
	if(count != 0){
		$('.sidebar-menu li[data-id="notif_update_produk"] a').append('<span class="badge badge-warning span-sidebar">'+count+'</span>');
	}
}

