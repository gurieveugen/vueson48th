jQuery(document).ready(function(){
	// =========================================================
	// FANCYBOX
	// =========================================================
	jQuery(".fancybox").fancybox({
		helpers: {
		    overlay: {
		    	locked: false
		    }
		  }
	});	
	jQuery(".various").fancybox({		
		fitToView	: false,
		width		: '590px',
		height		: '684px',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		wrapCSS     : 'register-lightbox'
	});
	// =========================================================
	// FLEXSLIDER
	// =========================================================
	jQuery('nav.flexslider-controls a.prev, nav.flexslider-controls a.next').click(function(e){
		var id   = jQuery(this).data('id');
		var href = jQuery(this).attr('href');
		jQuery('#' + id).flexslider(href);
		e.preventDefault();
	});
	// =========================================================
	// STYLER
	// =========================================================
	jQuery('input, select').styler();
});


jQuery(window).load(function(){
	var design_slideshow       = false;
	var design_slideshow_speed = 1;
	var home_slideshow         = false;
	var home_slideshow_speed   = 1;

	if(defaults[0].theme_settings_design_slideshow == 'on') design_slideshow = true;
	if(defaults[0].theme_settings_home_slideshow == 'on') home_slideshow = true;

	design_slideshow_speed = parseInt(defaults[0].theme_settings_design_slideshow_speed)*1000;
	home_slideshow_speed   = parseInt(defaults[0].theme_settings_home_slideshow_speed)*1000;	
	// =========================================================
	// FLEXSLIDER
	// =========================================================
	jQuery('.flexslider-carousel').flexslider({
		animation: "slide",
	    animationLoop: false,
	    itemWidth: 226,
	    itemMargin: 0,
	    controlNav: false,
	    move: 1,
	    slideshow: false
	});
	jQuery('.slider-design').flexslider({
		slideshow: design_slideshow,
		slideshowSpeed: design_slideshow_speed,
		animation: "fade",
		manualControls: ".slider-design-nav ol li"
	});
	jQuery('.slider-home').flexslider({
		slideshow: home_slideshow,
		slideshowSpeed: home_slideshow_speed,
		animation: "fade",
		manualControls: ".slider-design-nav ol li"
	});	
	// =========================================================
	// FACEBOOK
	// =========================================================
	FB.init({
		appId  : '732484396795127',
		status : true, // check login status
		cookie : true, // enable cookies to allow the server to access the session
		xfbml  : true  // parse XFBML
	});
});

function streamPublish(name, description, hrefTitle, hrefLink, userPrompt, picture_src){        
    FB.ui({ method : 'feed', 
            message: userPrompt,
            link   :  hrefLink,
            caption:  hrefTitle,
            picture: picture_src
   });
}
function publishStream(){
    streamPublish("Stream Publish", 'Check my public link!', 'Public Link!', 'http://wp8.miydim.com/somelink', "Public Link to my File");
}

function newInvite(){
     var receiverUserIds = FB.ui({ 
            method : 'apprequests',
            message: 'Come on man checkout my applications. visit http://ithinkdiff.net',
     },
     function(receiverUserIds) {             
            }
     );	             
}
