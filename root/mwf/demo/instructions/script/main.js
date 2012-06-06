$(function() {

	// Source code beautifier
	prettyPrint();
	
	// Modal source dialogs
	$('.view-source-link').on('click', function(event) {
	
		event.preventDefault();
		
		var sourceId = $(event.target).attr('href');
		$(sourceId).modal({
			overlayClose: true
		});
	
	});
	
});