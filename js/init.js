jQuery(document).ready(function($) {
	$( ".wp_slide_up_content_tab_grabber" ).click(function(){
		$( ".wp_slide_up_content_tab_content" ).slideToggle("fast", function() {
		});
	});
});
