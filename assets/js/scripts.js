jQuery(document).ready(function() {
	
    /*
        Background slideshow
    */
    $('.top-content').backstretch("assets/Image/background2.jpg");
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$('.top-content').backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$('.top-content').backstretch("resize");
    });
    
    /*
        Wow
    */
    new WOW().init();
	
});
