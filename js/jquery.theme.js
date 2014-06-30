// custom form elements
(function($) {
	$(function() {
		$('input[type="text"], input[type="radio"], select').styler();
	})
})(jQuery);

var mmenu = true;
$(document).ready(function() {
	// main menu hover
	$('.menu .menu-item-has-children').hover(
		function(){
			if (mmenu) {
				mmenu = false;
				$(this).find('.sub-menu').eq(0).animate({height: 'show'}, 300, function(){
					mmenu = true;
				});
			}
		},
		function(){
			$(this).find('.sub-menu').eq(0).animate({height: 'hide'}, 100);
		}
	);
	// login widget form
	$('.login-widget-form').submit(function(){
		var error = '';
		var lwu = $('.login-widget-form .lw-username').val();
		var lwp = $('.login-widget-form .lw-password').val();
		if (lwu == '') {
			error += 'ERROR: Username is empty.<br>';
		}
		if (lwp == '') {
			error += 'ERROR: Password is empty.<br>';
		}
		$('.login-widget-form .error').hide();
		if (error != '') {
			$('.login-widget-form .error').html(error).animate({height: 'show'}, 300);
			return false;
		}
		return true;
	});
	// image popup zoom
	$('.cpopup').colorbox();
});

function custom_door_submit() {
	var error = '';
	var name = trim($('.custom-door-form .cd-name').val());
	var phone = trim($('.custom-door-form .cd-phone').val());
	var email = trim($('.custom-door-form .cd-email').val());
	var width = trim($('.custom-door-form .cd-width').val());
	var height = trim($('.custom-door-form .cd-height').val());

	$('.custom-door-form .error-message').hide();
	$('.custom-door-form .error-message2').hide();
	$('.custom-door-form input').removeClass('req-error');

	if (name == '') {
		error += '.cd-name';
	}
	if (phone == '') {
		if (error != '') { error += ','; }
		error += '.cd-phone';
	}
	if (email == '') {
		if (error != '') { error += ','; }
		error += '.cd-email';
	} else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email)) {
		if (error != '') { error += ','; }
		error += '.cd-email';
	}
	if (width == '') {
		if (error != '') { error += ','; }
		error += '.cd-width';
	}
	if (height == '') {
		if (error != '') { error += ','; }
		error += '.cd-height';
	}
	if (error != '') {
		$('.custom-door-form .error-message').animate({height:'show'}, 300);
		$(error).addClass('req-error');
		return false;
	}
	$('.custom-door-form .cd-submit').attr('disabled', 'disabled');
	return true;
}

function trim(str) {
	if (str != 'undefined') {
		return str.replace(/^\s+|\s+$/g,"");
	} else {
		return '';
	}
}
