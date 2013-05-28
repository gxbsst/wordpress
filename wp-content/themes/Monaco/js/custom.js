jQuery(document).ready(function() {
	
/* Navigation */
	jQuery('#submenu ul.sfmenu').superfish({ 
		delay:       500,								// 0.1 second delay on mouseout 
		animation:   {opacity:'show',height:'show'},	// fade-in and slide-down animation 
		dropShadows: true								// disable drop shadows 
	});	


/* Responsive slides */


	jQuery('.flexslider').flexslider({
		controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav: false 
	});	



 jQuery('#content .grid_2:odd').after('<div class="clear"></div>');


});