jQuery(document).ready(function() {
	jQuery('.az-submenu').click(function(evt) {
		var submenu_selected = jQuery(this).parent('li');
		jQuery('.az-menu li').removeClass('active');
		jQuery(submenu_selected).addClass('active');
		jQuery(submenu_selected).parents('li').addClass('active');
		jQuery(submenu_selected).children('ul').slideToggle('fast');
		
		jQuery('.az-menu ul li').not('.active').find('i.az-submenu-caret').removeClass('fa-angle-down');
		jQuery('.az-menu ul li').not('.active').find('i.az-submenu-caret').addClass('fa-angle-right');

		jQuery(submenu_selected).children('i.az-submenu-caret').toggleClass('fa-angle-right fa-angle-down');
		jQuery('.az-menu ul li').not('.active').children('ul').slideUp('fast');
		
		setTimeout(function() {
			check_height();
		}, 1000);		
	});

	jQuery('.az-btn-menu').click(function() {
		jQuery('.az-ltheme').toggleClass('mini-view ');
	});

	jQuery('.az-btn-xs-menu').click(function() {
		jQuery('.az-ltheme-left').toggleClass('xs-show ');
	});

	check_height();
	
	function check_height() {
		var height = jQuery('.az-menu').height();
		jQuery('.az-ltheme-right').css('min-height', height + 'px');
		console.log(height);
	}
});