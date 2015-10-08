// Google ISOGRAM code
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-45487332-1', 'auto');
ga('require', 'displayfeatures');
ga('send', 'pageview');

function te(a, b, c) {
	ga('send', 'event', a, b, c);
}
// The Facebook
window.fbAsyncInit = function() {
	FB.init({
		appId      : '865812323452284',
		xfbml      : true,
		version    : 'v2.1'
	});
};
	
(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_CA/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
} (document, 'script', 'facebook-jssdk'));

// Snow plugin
(function($){
	
	$.fn.snow = function(options){
	
			var $flake 			= $('<div class="flake" />').css({'position': 'absolute', 'z-index': '10', 'top': '-100px'}).html('&#10052;'),
				documentHeight 	= $('#home-header').height(),
				documentWidth	= $('#home-header').width(),
				defaults		= {
									minSize		: 10,
									maxSize		: 20,
									newOn		: 500,
									flakeColor	: "#FFFFFF"
								},
				options			= $.extend({}, defaults, options);
				
			
			var interval		= setInterval( function(){
				var startPositionLeft 	= Math.random() * documentWidth - 100,
				 	startOpacity		= 0.5 + Math.random(),
					sizeFlake			= options.minSize + Math.random() * options.maxSize,
					endPositionTop		= documentHeight - 40,
					endPositionLeft		= startPositionLeft - 100 + Math.random() * 200,
					durationFall		= documentHeight * 10 + Math.random() * 5000;
				$flake
					.clone()
					.appendTo('body')
					.css(
						{
							left: startPositionLeft,
							opacity: startOpacity,
							'font-size': sizeFlake,
							color: options.flakeColor
						}
					)
					.animate(
						{
							top: endPositionTop,
							left: endPositionLeft,
							opacity: 0.2
						},
						durationFall,
						'linear',
						function() {
							$(this).remove();
						}
					);
			}, options.newOn);
	
	};
	
})(jQuery);

// Forward to Entry Page
function forward_to_entry(p_slug, c_slug) {
	window.location.replace(forward_url+p_slug+"/"+c_slug);
}

// Validate email, duh
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

// Set the fancy form errors
function set_error(obj) {	
	obj.siblings('p').removeClass('invisible');
	obj.parent().parent().addClass('has-error');
}

// Clear the fancy form errors
function clear_error(obj) {
	obj.siblings('p').addClass('invisible');
	obj.parent().parent().removeClass('has-error');
}

function facebook_share_pixel() {
	
	(function() {
	var _fbq = window._fbq || (window._fbq = []);
	if (!_fbq.loaded) {
	var fbds = document.createElement('script');
	fbds.async = true;
	fbds.src = '//connect.facebook.net/en_US/fbds.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(fbds, s);
	_fbq.loaded = true;
	}
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', '6019730980066', {'value':'0.01','currency':'CAD'}]);

}

$(function() {
	
	var iphone = (window.screen.height <= 600);
	
	// *********** LET IT SNOW **************** //
	if ($('#home-header').length && !iphone) {
		$.fn.snow({ minSize: 30, maxSize: 100, flakeColor: '#eaf9fb' });
	}
	
	if (iphone) {
		$('#home-header').height('460px');
		$('#snowy-hill p').css('font-size', '13px');
	}
	
	// ***** LET THE COLOR BUTTONS WORK ****** //
	$('.color-btn').tooltip();
	
	$('.color-btn').on('click', function() {
		te(product_slug, 'color-change', $(this).attr('data-color'));
		if (color_slug !== $(this).attr('data-color')) {
			var new_color_btn = $(this);
			color_slug = $(this).attr('data-color');
			color_image_slug = $(this).attr('data-image');
			color_name = $(this).attr('data-colorname');
			$('#product-img').fadeOut(300, function(){
				$('#product-img').attr('src', new_color_btn.attr('data-newimage'));
				$('#product-img').load(function() {
					$('#product-img').fadeIn(300);	
				});
			});
		}
	});
	
	// ******** LET THE FACEBOOK SHARE ****** //
	$('#share-facebook').on('click', function() {
		te(product_slug, 'facebook', '');
		facebook_share_pixel();
		var share_url = base_url+product_slug+"/"+color_slug+lang;
		console.log(share_url);
		FB.ui({
			method: 'share',
			href: share_url,
		}, function(response){
			console.log(response);
			forward_to_entry(product_slug, color_slug);
		});
		//window.location.replace();
	});
	
	$('#share-twitter').on('click', function() {
		te(product_slug, 'twitter', '');
		facebook_share_pixel();
		var share_url = base_url+product_slug+"/"+color_slug+lang;
		var twtLink = 'https://twitter.com/intent/tweet?text='+encodeURIComponent(tw_share)+'&url='+encodeURIComponent(share_url);
		window.open(twtLink);
		forward_to_entry(product_slug, color_slug);
	});
	
	$('#share-pinterest').on('click', function() {
		te(product_slug, 'pinterest', '');
		facebook_share_pixel();
		var share_url = base_url+product_slug+"/"+color_slug+lang;
		var media_url = media_base_url+product_slug+"/share/"+color_image_slug+'.jpg';
		var description = pin_share.replace('[[COLOR]]', color_name);
		var pinlink = 'http://pinterest.com/pin/create/button/?url='+encodeURIComponent(share_url)+'&media='+encodeURIComponent(media_url)+'&description='+encodeURIComponent(description);
		window.open(pinlink);
		forward_to_entry(product_slug, color_slug);
	});
	
	$('#share-mail').on('click', function() {
		facebook_share_pixel();
		te(product_slug, 'email', '');
	});
	
	$('select#input_product_id').on('change', function() {
		if ($(this).val() > 0) {
			var product_slug = "#"+$('option:selected', this).attr('data-slug');
			$('#input_color_id').html($(product_slug).html());
			$('#input_color_id').removeAttr('disabled');
		} else {
			$('#input_color_id').html('');
			$('#input_color_id').prop('disabled', 'disabled');
		}
	});
	
	$('#send_btn').on('click', function(e) {
		te(product_slug, 'email', 'send');
		$('#email_alert').addClass('hidden');
		var itsgood = true;
		if ($('#input_youremail').val() === "" || !validateEmail($('#input_youremail').val())) { itsgood = false; $('#input_youremail').parent().addClass('has-error'); }
		else { $('#input_youremail').parent().removeClass('has-error'); }
		if ($('#input_friendemail').val() === "" || !validateEmail($('#input_friendemail').val())) { itsgood = false; $('#input_friendemail').parent().addClass('has-error'); }
		else { $('#input_friendemail').parent().removeClass('has-error'); }
		if ($('#input_yourname').val() === "" ) { itsgood = false; $('#input_yourname').parent().addClass('has-error'); }
		else { $('#input_yourname').parent().removeClass('has-error'); }
		if ($('#input_friendname').val() === "") { itsgood = false; $('#input_friendname').parent().addClass('has-error'); }
		else { $('#input_friendname').parent().removeClass('has-error'); }
		
		if (itsgood) {
			$.ajax({
				type: "POST",
				url: '/share/mailshare/'+product_slug+'/'+color_slug,
				data: $('#send_mail').serialize(),
				success: function(data) {
					if (data.error == 'none' || data.response.reject_reason == null) {
						te(product_slug, 'email', 'success');
						forward_to_entry(product_slug, color_slug);
					} else {
						te(product_slug, 'email', 'error');
						$('#email_alert').removeClass('hidden');
					}
				},
				dataType: 'JSON'
			});
		}
	});
	
	$('#enter_now').on('click', function(e) {
		e.preventDefault();
		te('entry-form', 'submit', '');
		var itsgood = true;

		if ($('#input_firstname').val() == "") { set_error($('#input_firstname')); itsgood = false; } 
		else { clear_error($('#input_firstname')); }
		
		if ($('#input_lastname').val() == "") { set_error($('#input_lastname')); itsgood = false; }
		else { clear_error($('#input_lastname')); }
		
		if ($('#input_email').val() == "" || !validateEmail($('#input_email').val())) { set_error($('#input_email')); itsgood = false; }
		else { clear_error($('#input_email')); }
		
		if ($('#input_email').val() != $('#input_email_confirm').val()) { set_error($('#input_email_confirm')); itsgood = false; }
		else { clear_error($('#input_email_confirm')); }
		
		if (!$('#input_terms').is(':checked')) { set_error($('#input_terms')); itsgood = false; }
		else { clear_error($('#input_terms')); }
		
		if ($('#input_product_id').val() == 0) { set_error($('#input_product_id')); itsgood = false; }
		else { clear_error($('#input_product_id')); }
		
		if ($('#input_color_id').val() == 0) { set_error($('#input_color_id')); itsgood = false; }
		else { clear_error($('#input_color_id')); }
		
		if (itsgood) { $('#entryform').submit(); }
		else { 
			te('entry-form', 'submit', 'error');
			return false;
		}
		
	});
	
	$('body :not(script)').contents().filter(function() {
	    return this.nodeType === 3;
	}).replaceWith(function() {
	    return this.nodeValue.replace(/[™®©]/g, '<sup>$&</sup>');
	});
	
	// Google Analytics Clicks
	$('.home-click').on('click', function() {
		te('home',$(this).prop('data-product'),'');
	});
	
	

});