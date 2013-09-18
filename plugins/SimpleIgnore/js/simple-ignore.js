$(function() {
	$('.Ignored').find('.ignore-button button').click(function(e) {
		var self = $(this);
		self.parents('.Ignored').find('.Message').slideToggle();
		if (self.text() == 'Show') {
			self.text('Hide');
		} else {
			self.text('Show');
		}
	});
});





