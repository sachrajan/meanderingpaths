(function($){
	
	$(document).on( 'click', '.gc-notice .notice-dismiss', function() {
		
	    $.ajax({
	        url: ajaxurl,
	        data: {
	            action: 'gc_mark_notice_as_dismissed',
				notice_id: $(this).parent('.gc-notice').data('notice_id')
	        }
	    });

	});
	
})(jQuery);