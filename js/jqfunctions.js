mainNav = function() {
	$("#topnav li").bind("mouseenter",function(){
                this.className += "_over over";
	}).bind("mouseleave",function(){
                this.className = this.className.replace("_over over", "");
	});
}

jQuery(document).ready(function() {

    $(".latestWidget").jcarousel({
        scroll: 3,
        visible: 3,
        buttonNextHTML: '<div class="next">Next &raquo;</div>',
        buttonPrevHTML: '<div class="prev">&laquo; Prev</div>'
    });

	$("#media_panel .mediaWidget").jcarousel({
        scroll: 3,

		buttonNextHTML: '<div class="next">Next &raquo;</div>',
		buttonPrevHTML: '<div class="prev">&laquo; Prev</div>'
	});
	
	$(".mod-relvideo312 .mediaWidget").jcarousel({
		scroll: 1,

		buttonNextHTML: '<div class="next">Next &raquo;</div>',
		buttonPrevHTML: '<div class="prev">&laquo; Prev</div>'
	});

	
	$(".mod-moreslsh312 .mediaWidget").jcarousel({
		scroll: 1,

		buttonNextHTML: '<div class="next">Next &raquo;</div>',
		buttonPrevHTML: '<div class="prev">&laquo; Prev</div>'
	});
	
	$(".mod-mediacntr332 .mccVideo").jcarousel({
		scroll: 4,
		buttonNextHTML: '<div class="next">Next &raquo;</div>',
		buttonPrevHTML: '<div class="prev">&laquo; Prev</div>'
	});
	
	$(".mod-mediacntr332 .mccSlideshow").jcarousel({
		scroll: 4,
        buttonNextHTML: '<div class="next">Next &raquo;</div>',
        buttonPrevHTML: '<div class="prev">&laquo; Prev</div>'
    });

	$('.video_rel .tabWidget > ul').tabs();
	
    $('.mod-participate498 .rightLinks > ul').tabs();

	$('span.openAdvSearch').click(function() {
		$('div.mod-advsearch').slideDown('fast');
	});

	$('div.hidelink span').click(function() {
		$('div.mod-advsearch').slideUp('fast');
	});

	$('span.openMediaSearch').click(function() {
		$('div.mod-mediaAdvSearch').slideDown('fast');
	});

	$('div.hidelink span').click(function() {
		$('div.mod-mediaAdvSearch').slideUp('fast');
	});

// home top stage
    $('.mod-stage996 .stgslide').cycle({
        fx: 'fade',
		timeout: 15000,
		speed: 500,
        before: onBefore,
        pager: '.stgbtnwrpr .stgbtngrp',
        pagerAnchorBuilder: function(idx, slide) {
            idxNUM = idx + 1;
            return '<div id="stgbtn' + idxNUM + '" class="stgbtnoff">' + idxNUM + '</div>';
        }
    });

	$('.mod-stage996 .stgbtngrp .stgbtnoff').click(function(){
		$('.mod-stage996 .stgslide').cycle('stop');
	});

	// media slideshow base	
//	$('#media_cat .categoryList').cycle({ 
//		fx: 'scrollVert', 
//		timeout: 0,
//		next: '#media_cat .next', 
//		prev: '#media_cat .previous'
//	});	
//	

	
    // set up of slide show gallery

    $('.mod-gallery954 .ssInfoPane').addClass('gallery_info');

    $('.mod-gallery954 .jcarousel-skin-gallery').addClass('gallery_show'); // adds new class name to 33 maintain degradability

    $('.mod-gallery954 ul.gallery_show').galleria({
        history: false, // controls the history object for bookmarking, back-button etc.
        clickNext: true, // helper for making the image clickable
        insert: '#main_image', // the containing selector for our main image
        onImage: function(image, caption, description, tracker, thumb) { // let's add some image effects for demonstration purposes

            // fade in the image & caption
            image.css('display', 'none').fadeIn(200);
            caption.css('display', 'none').fadeIn(200);
            description.css('display', 'none').fadeIn(200);
            tracker.css('display', 'none').fadeIn(200);

            // fetch the thumbnail container
            var _li = thumb.parents('li');

            // fade out inactive thumbnail
            _li.siblings().children('img.selected').fadeTo(100, 0.5);

            // fade in active thumbnail
            thumb.fadeTo('fast', 1).addClass('selected');

            // add a title for the clickable image
            image.attr('title', 'Next image >>');

            $('#main_image').trigger('img_change');

        },
        onThumb: function(thumb) { // thumbnail effects goes here

            // fetch the thumbnail container
            var _li = thumb.parents('li');

            // if thumbnail is active, fade all the way.
            var _fadeTo = _li.is('.active') ? '1' : '0.5';

            // fade in the thumbnail when finished loading
            thumb.css({ display: 'none', opacity: 0 })
            thumb.css({ display: 'block' }).fadeTo(500, _fadeTo);

            // hover effects
            thumb.hover(
				function() { thumb.fadeTo('fast', 1); },
				function() { _li.not('.active').children('img').fadeTo('fast', 0.5); } // don't fade out if the parent is active
			)
        }
    });

    $('.mod-gallery954').prepend("<div class='autoControl'>Pause</div>");
		var active = true;
		var gal = jQuery('.mod-gallery954');
		var ctrl = gal.find('.autoControl')

    $(function() {
        //var slideshow = $("gallerytitle");

        if (active) {
            ctrl.css("background-position", "0 0");
            gal.everyTime('10s', 'slideshow', function() {
                $.galleria.next();
            });
        } if (!active) {
            ctrl.css("background-position", "0 -23px");
        };

        ctrl.css("cursor", "pointer").click(function() {
            if (!active) {
                active = true;
                $.galleria.next();
                ctrl.css("background-position", "0 0").html("Pause");
                gal.everyTime('10s', 'slideshow', function() {
                    $.galleria.next();
                });
            } else if (active) {
                active = !active;
                ctrl.css("background-position", "0 -23px").html("Play");
                gal.stopTime('slideshow');
            }
        });

    });

	jQuery('.mod-gallery954 #gallery').jcarousel({
		scroll: 5,
		  initCallback: gallery_initCallback
	 });

	 $.hotkeys.add('left', function(){$.galleria.prev();});
	 $.hotkeys.add('right', function(){$.galleria.next();});


	$('.mod-gallery954 .main_image_wrapper').append("<a class='prevImg' href='#'>Previous Image</a>");
	$('.mod-gallery954 .main_image_wrapper').append("<a class='nextImg' href='#'>Next Image</a>");

	$('.mod-gallery954 .prevImg').click(function(){
		$.galleria.prev();
		if (active) {
			active = !active;
			ctrl.css("background-position", "0 -23px").html("Play");
			gal.stopTime('slideshow');
		}
		return false;
	});
	$('.mod-gallery954 .nextImg').click(function(){
		$.galleria.next();
		if (active) {
			active = !active;
			ctrl.css("background-position", "0 -23px").html("Play");
			gal.stopTime('slideshow');
		}
		return false;
	});
		
	$('.mod-gallery954 .galleria_wrapper, .mod-gallery954 .jcarousel-item, .mod-gallery954 .jcarousel-prev, .mod-gallery954 .jcarousel-next').click(function(){
		if (active) {
			active = !active;
			ctrl.css("background-position", "0 -23px").html("Play");
			gal.stopTime('slideshow');
		}
	});

	$('.mod-gallery954 .gallery_info').hide();

	$('.mod-gallery954 .ssInfoLink').toggle(
		function () {
		  $('.mod-gallery954 .gallery_info').slideDown('fast');
		  $(this).html("hide slideshow info");
		  return false;
		},
		function () {
		  $('.mod-gallery954 .gallery_info').slideUp('fast');
		  $(this).html("slideshow info");
		  return false;
		}
	);



    //end setup of slideshow gallery

	// initialize scrollable  
	$('.modCarousel_latestNews .carouselScroll').scrollable({
		size: 3,
		items: ".items",
		clickable: false
});
	
	// initialize scrollable  
	$('.modCarousel_mediaWidget .carouselScroll').scrollable({
		size: 4,
		items: ".items",
		clickable: false
	});
	
	// initialize scrollable  
	$('.modCarousel_mediaCenter .carouselScroll').scrollable({
		size: 3,
		items: ".items",
		clickable: false
	});

});

$.fn.cycle.updateActivePagerLink = function(pager, currSlideIndex) {
    $(pager).find('div').removeClass('stgbtnon')
        .filter('div:eq(' + currSlideIndex + ')').addClass('stgbtnon');
};

function gallery_initCallback(carousel) {
	var listTotal = jQuery('#gallery li').length;

	jQuery('.mod-gallery954 #main_image').bind('img_change', function() {
	    var num = parseInt((jQuery('.mod-gallery954 .caption').text()).split(";", 1)[0]) - 3;
	    var location = parseInt(jQuery('.mod-gallery954 .caption').text().split(";", 2)[0]) + 1;

	    jQuery('.mod-gallery954 .caption').html(jQuery('.caption').text().split(";", 2)[1]);
	    jQuery('.mod-gallery954 .tracker').html(location + " of " + listTotal);

	    carousel.scroll(num);
	    return false;
	});
};

function onBefore() {
	$('.stghrimg').html($('.stgslideheading', this).html());
	$('.stghrtxt').html($('.stgslidecontent', this).html());
	$('.stgcredit').html($('.stgslidecredit', this).html());
}

jQuery(function($) {

	//tabs
	$('.tabWidget > ul').tabs();

});