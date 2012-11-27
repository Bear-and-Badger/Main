<script type="text/javascript">
$(function() {
	$('body').on( 'click', '.UserNetworksToggle', function(e) {
		e.preventDefault();
		$(this).next('.UserNetworks').slideToggle();
		
		if( $(this).text().indexOf('Show') > -1 ) {
			$(this).text( 'Hide networks' );
		} else {
			$(this).text( 'Show networks' );
		}
	});
});
</script>