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
	jQuery('nav.flexslider-controls a.prev, nav.flexslider-controls a.next, nav.flexslider-controls-one a.prev, nav.flexslider-controls-one a.next').click(function(e){
		var id   = jQuery(this).data('id');
		var href = jQuery(this).attr('href');
		
		jQuery('#' + id).flexslider(href);
		e.preventDefault();
	});	
	// =========================================================
	// STYLER
	// =========================================================
	jQuery('input, select').styler();	
	// =========================================================
	// GOOGLE MAP
	// =========================================================
	var gmap;	
	if(document.getElementById('map-canvas'))
	{
		google.maps.event.addDomListener(window, 'load', initialize);		
	}
	// =========================================================
	// BTN PRINT CLICK
	// =========================================================
	jQuery('.btn-print').click(function(e){
		var url = jQuery(this).attr('href');
		printwindow = window.open(url, '_blank', 'fullScreen=yes');
		printwindow.onload = function() {
			printwindow.focus();
			printwindow.print();
		};		
		e.preventDefault();
	});
});

jQuery(window).load(function(){
	var design_slideshow         = false;
	var design_slideshow_speed   = 1;
	var home_slideshow           = false;
	var home_slideshow_speed     = 1;
	var location_slideshow       = false;
	var location_slideshow_speed = 1;

	if(defaults[0].theme_settings_design_slideshow == 'on') design_slideshow = true;
	if(defaults[0].theme_settings_home_slideshow == 'on') home_slideshow = true;
	if(defaults[0].theme_settings_location_slideshow == 'on') location_slideshow = true;

	design_slideshow_speed = parseInt(defaults[0].theme_settings_design_slideshow_speed)*1000;
	home_slideshow_speed   = parseInt(defaults[0].theme_settings_home_slideshow_speed)*1000;	
	location_slideshow_speed   = parseInt(defaults[0].theme_settings_location_slideshow_speed)*1000;
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
	jQuery('.flexslider-carousel-one').flexslider({
		animation: "slide",
	    animationLoop: false,	    
	    itemMargin: 0,
	    controlNav: false,
	    move: 1,
	    slideshow: false,
	    slideshowSpeed: location_slideshow_speed
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
		manualControls: ".slider-design-nav ol li",
		after: function(){
	        var title = jQuery('.slider-home aside ul.slides li.flex-active-slide').data('title');
	        jQuery('.slider-home .bottom-slider p').text(title);
    	}
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


/**
 * Initialize Google map
 */
function initialize() 
{
	window.markers_obj = [];
	window.info_windows = [];
	var first_key  = Object.keys(markers)[0];
	var first      = markers[first_key];
	var index      = 0;
	var mapOptions = {
		zoom:   15,
		center: new google.maps.LatLng(first.location.lat, first.location.lng),
		disableDefaultUI: true,
		zoomControl: true,
		animation: google.maps.Animation.DROP
	};

	gmap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	if(typeof markers != 'undefined')
	{
		jQuery.each(markers, function(){
			obj = new google.maps.Marker({
					position: new google.maps.LatLng(parseFloat(this.location.lat), parseFloat(this.location.lng)),
					map:      gmap,
					title:    this.title,
					icon:     this.icon
				});
			info = new InfoBox({ 
				content: '<div id="info-window" class="info-window">' + this.title + '</div>',
				boxClass: 'info-box', 				
    			closeBoxMargin: "0",
    			closeBoxURL: null
			});
			window.markers_obj.push(obj);	
			window.info_windows.push(info);	
			setToggle(window.markers_obj[index], this.ID);
			setInfoWindow(gmap, window.markers_obj[index], window.info_windows[index]);			
			index++;		
		});			
	}	
	toggleBounce(window.markers_obj[0], first.ID);
}

/**
 * Set info window google events
 * @param object map         --- google map
 * @param object marker      --- marker
 * @param object info_window --- info window
 */
function setInfoWindow(map, marker, info_window)
{
  	google.maps.event.addListener(marker, 'mouseover', function() {
  	    info_window.open(map, marker);
  	});
  	google.maps.event.addListener(marker, 'mouseout', function() {
  	    info_window.close();
  	});
}

/**
 * Set toogle animation to marker
 * @param object marker --- marker
 */
function setToggle(marker, ID)
{
	google.maps.event.addListener(marker, 'click', function(){ toggleBounce(marker, ID) });
}

/**
 * Google map, marker animation
 */
function toggleBounce(obj, ID) 
{
	/*var is_animation = obj.getAnimation();
	if (window.marker_animation) 
	{
		for (var i = 0; i < window.markers_obj.length; i++) 
		{
			window.markers_obj[i].setAnimation(null);
		}
		window.marker_animation = false;
		if(is_animation == null)
		{
			obj.setAnimation(google.maps.Animation.BOUNCE);
			window.marker_animation = true;
		}		
	} 
	else 
	{
		obj.setAnimation(google.maps.Animation.BOUNCE);
		window.marker_animation = true;
	}*/
	hideAll('.slider-location');
	jQuery('#group-' + ID).removeClass('hide');	
	jQuery('.flexslider-carousel-one').resize();	
}

/**
 * Add hide css_class to all items
 * @param  string css_class --- css class to select
 */
function hideAll(css_class)
{
	jQuery(css_class).each(function(){
		if(!jQuery(this).hasClass('hide')) jQuery(this).addClass('hide');
	});
}


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

/**
 * JUST FOR FUCKING IE8
 */
if (!Object.keys) {
  Object.keys = (function () {
    'use strict';
    var hasOwnProperty = Object.prototype.hasOwnProperty,
        hasDontEnumBug = !({toString: null}).propertyIsEnumerable('toString'),
        dontEnums = [
          'toString',
          'toLocaleString',
          'valueOf',
          'hasOwnProperty',
          'isPrototypeOf',
          'propertyIsEnumerable',
          'constructor'
        ],
        dontEnumsLength = dontEnums.length;

    return function (obj) {
      if (typeof obj !== 'object' && (typeof obj !== 'function' || obj === null)) {
        throw new TypeError('Object.keys called on non-object');
      }

      var result = [], prop, i;

      for (prop in obj) {
        if (hasOwnProperty.call(obj, prop)) {
          result.push(prop);
        }
      }

      if (hasDontEnumBug) {
        for (i = 0; i < dontEnumsLength; i++) {
          if (hasOwnProperty.call(obj, dontEnums[i])) {
            result.push(dontEnums[i]);
          }
        }
      }
      return result;
    };
  }());
}