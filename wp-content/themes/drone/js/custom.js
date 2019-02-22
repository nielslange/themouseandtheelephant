jQuery.noConflict();

// portfolio item
function zp_portfolio_item_width(){
	var container_width = jQuery('#zp_masonry_container').width();
	
	jQuery( '.zp_masonry_item' ).each( function(){
		if( container_width <= 600 ){
			if( jQuery(this).hasClass('col2') ){			
				var item_width = Math.floor( (container_width - 30 ) / 1 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}		
			if( jQuery(this).hasClass('col3') ){
				var item_width = Math.floor( (container_width - 30 ) / 1 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}
			if( jQuery(this).hasClass('col4') ){
				var item_width = Math.floor( ( container_width - 30 ) / 1 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}
			// Video/Audio height
			var vid_aud_height = jQuery(this).find( '.jp-audio img, .jp-video img' ).height();
			jQuery(this).find( '.jp-audio, .jp-video' ).css({"height": vid_aud_height+"px" });
		}else if( container_width <= 768 ){
			if( jQuery(this).hasClass('col2') ){			
				var item_width = Math.floor( (container_width - 60 ) / 2 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}		
			if( jQuery(this).hasClass('col3') ){
				var item_width = Math.floor( (container_width - 60 ) / 2 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}
			if( jQuery(this).hasClass('col4') ){
				var item_width = Math.floor( ( container_width - 60 ) / 2 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}
			// Video/Audio height
			var vid_aud_height = jQuery(this).find( '.jp-audio img, .jp-video img' ).height();
			jQuery(this).find( '.jp-audio, .jp-video' ).css({"height": vid_aud_height+"px" });
		}else if( container_width <= 1024 ){
			if( jQuery(this).hasClass('col2') ){
				var item_width = Math.floor( (container_width - 60 ) / 2 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}		
			if( jQuery(this).hasClass('col3') ){
				var item_width = Math.floor( (container_width - 90 ) / 3 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}
			if( jQuery(this).hasClass('col4') ){
				var item_width = Math.floor( ( container_width - 120 ) / 4 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}
			// Video/Audio height
			var vid_aud_height = jQuery(this).find( '.jp-audio img, .jp-video img' ).height();
			jQuery(this).find( '.jp-audio, .jp-video' ).css({"height": vid_aud_height+"px" });
		}else{
			if( jQuery(this).hasClass('col2') ){			
				var item_width = Math.floor( (container_width - 60 ) / 2 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}		
			if( jQuery(this).hasClass('col3') ){
				var item_width = Math.floor( (container_width - 90 ) / 3 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}
			if( jQuery(this).hasClass('col4') ){
				var item_width = Math.floor( ( container_width - 120 ) / 4 );
				jQuery(this).css({"width":item_width+"px", "max-width":item_width+"px"});
			}
			// Video/Audio height
			var vid_aud_height = jQuery(this).find( '.jp-audio img, .jp-video img' ).height();
			jQuery(this).find( '.jp-audio, .jp-video' ).css({"height": vid_aud_height+"px" });
		}
	});
}

// initiate isotope
function initiate_isotope(){
	
	/* ========== PORTFOLIO ISOTOPE ========== */
	//set portfolio item width
	zp_portfolio_item_width();

	var jQuerycontainer = jQuery('#zp_masonry_container');
	// check pre-selected category
	filter_item = jQuery('.zp_masonry_filter .option-set a.selected').attr('data-option-value');

	jQuerycontainer.isotope({
		 itemSelector : '.zp_masonry_item ',
		 filter: filter_item
	});
		
	var jQueryoptionSets = jQuery('.zp_masonry_filter .option-set'),
	jQueryoptionLinks = jQueryoptionSets.find('a');	
	jQueryoptionLinks.click(function(){
			var jQuerythis = jQuery(this);
			// don't proceed if already selected
			if ( jQuerythis.hasClass('active') ) {
			  return false;
			}
			var jQueryoptionSet = jQuerythis.parents('.option-set');
			jQueryoptionSet.find('.active').removeClass('active');
			jQuerythis.addClass('active');
	  
			// make option object dynamically, i.e. { filter: '.my-filter-class' }
			var options = {},
				key = jQueryoptionSet.attr('data-option-key'),
				value = jQuerythis.attr('data-option-value');
			// parse 'false' as false boolean
			value = value === 'false' ? false : value;
			options[ key ] = value;
			if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
			  // changes in layout modes need extra logic
			  changeLayoutMode( jQuerythis, options )
			} else {
			  // otherwise, apply new options
			  jQuerycontainer.isotope( options );
			}			
			return false;
	});
	
}

// animate header
function header_animate(){
	var scrollPosition = jQuery(window).scrollTop();
	
	if( scrollPosition >= 1 ){
		jQuery('#header').removeClass('fixed_header');
		jQuery('#header').addClass('navbar-fixed-top');
	}else{
		jQuery('#header').removeClass('navbar-fixed-top');
		jQuery('#header').addClass('fixed_header');
	}
}

//Scroll Function
jQuery.fn.topLink = function(settings) {
	settings = jQuery.extend({
		min: 1,
		fadeSpeed: 200
	},
	settings );
	
	return this.each(function() {
		// listen for scroll
		
		var el = jQuery(this);
		el.hide(); // in case the user forgot
		jQuery(window).scroll(function() {
			if(jQuery(window).scrollTop() >= settings.min) {
				el.fadeIn(settings.fadeSpeed);
			} else {
				el.fadeOut(settings.fadeSpeed);
			}
		});
	});
};

jQuery(document).ready(function() {
	
	/* ========== TO TOP LINK ========== */	
	jQuery('#top-link').topLink({
		min: 400,
		fadeSpeed: 500
	});
	
	// smoothscroll
	jQuery('#top-link').click(function(e) {
		e.preventDefault();
		jQuery.scrollTo(0,300);
	});

	/* ========== FITVIDS PLUGIN ========== */	
	jQuery('.fitvids, .video_container').fitVids();

	jQuery(window).on('scroll', function(e) {		
		// enable header effect when scrolled
		header_animate();		
	});
	
	
	/* ========== PRETTYPHOTO ========== */
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		hook: 'data-rel',
		deeplinking: false
	});
	
	// Trigger portfolio image sizes
	zp_portfolio_item_width();
	var jQuerycontainer = jQuery('#zp_masonry_container');
	// check pre-selected category
	filter_item = jQuery('.zp_masonry_filter .option-set a.selected').attr('data-option-value');

	jQuerycontainer.isotope({
		 itemSelector : '.zp_masonry_item',
		 filter: filter_item
	});

	/* ========== BOOTSTRAP CAROUSEL ========== */
	jQuery('.carousel').carousel({
		interval: 6000
	});
	
	/* ============== ACCORDION ============== */

	jQuery('.zp_open').collapse('show');
	
	/* ========== Tabs  ========== */
	jQuery('.tab_container').find('.nav.nav-tabs > li:first-child').children('a[data-toggle="tab"]').tab('show');
	jQuery('.tab_container').find('.nav.nav-tabs > li:first-child').children('a[data-toggle="tab"]').parent().addClass('active');	
	jQuery('.tab_container').find('.tab-content > li:first-child').children('.tab-pane').addClass('in active');
	
	/* ========== MOBILE MENU ========== */
	jQuery( '.mobile_menu button' ).toggle( function(){
		jQuery('.nav-primary').slideDown();
	},function(){
		jQuery('.nav-primary').slideUp();
	});

	jQuery('.nav-primary .menu li').each(function(){
		if( jQuery(this).children('ul.sub-menu').length > 0 ){
			jQuery(this).children('a').after('<span class="indicator"><i class="fa fa-angle-down"></i></span>');	
		}
	});
	jQuery('.nav-primary .menu li span.indicator').toggle(function(){
		jQuery(this).next('ul.sub-menu').show();
		jQuery(this).children('.fa').removeClass('fa-angle-down');
		jQuery(this).children('.fa').addClass('fa-angle-up');
	},function(){
		jQuery(this).next('ul.sub-menu').hide();
		jQuery(this).children('.fa').removeClass('fa-angle-up');
		jQuery(this).children('.fa').addClass('fa-angle-down');
	});
	
	/* ========== Top Widget Area Trigger ========== */
	jQuery('.zp_top_area_trigger').click(function(){
		trigger = jQuery(this).children('i');
		sliding_area = jQuery(this).parent('.zp_top_area').children('.zp_top_area_wrap');		
		if( trigger.hasClass( 'fa-plus' )){
			sliding_area.slideDown();
			trigger.removeClass('fa-plus');
			trigger.addClass('fa-minus');	
		}else{
			sliding_area.slideUp();
			trigger.removeClass('fa-minus');
			trigger.addClass('fa-plus');	
		}
	});
});

jQuery(window).load(function(){
	/* ========== Initiate Portfolio ========== */
	initiate_isotope();
	
	var jQuerycontainer = jQuery('#zp_masonry_container');
	// check pre-selected category
	filter_item = jQuery('.zp_masonry_filter .option-set a.selected').attr('data-option-value');

	jQuerycontainer.isotope({
		 itemSelector : '.zp_masonry_item',
		 filter: filter_item
	});
});

/* ========== refresh isotope on window resize ========== */
jQuery( window ).resize(function() {
	initiate_isotope();
	
	var jQuerycontainer = jQuery('#zp_masonry_container');
	// check pre-selected category
	filter_item = jQuery('.zp_masonry_filter .option-set a.selected').attr('data-option-value');

	jQuerycontainer.isotope({
		 itemSelector : '.zp_masonry_item',
		 filter: filter_item
	});
});