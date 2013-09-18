<?php if (!defined('APPLICATION')) exit(); ?>
<h2><?php echo T('Mark all viewed'); ?></h2>
<p>Are you really sure you want to mark all viewed?</p>
<form id="confirm-viewed-post" method="POST" action="/discussions/markallviewed">
	<input type="hidden" name="confirm" value="true" />
	<div class="Buttons">
		<button type="submit" class="Button" style="font-weight:bold;font-size:14px;">Yes, really mark all discussions as read.</button>
	</div>
</form>

<script>
$('#confirm-viewed-post').submit(function() {
	$.POST('/discussions/markallviewed', { confirm: true}, function() {
		$.popup.close({popupId: 'Popup'});
		window.location.hash = "";
		window.location.pathname = "/discussions";
	});
});
</script>