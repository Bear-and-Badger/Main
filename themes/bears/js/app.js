$(function() {
	$('body').on( 'click', '.SpoilerTitle', function() {
		$(this).siblings('.SpoilerText').slideToggle();
	});
});