<script type="text/javascript">
$(function() {
	$.fn.autogrow = function(o) { return; }

	$.sceditor.setCommand( "spoiler", function() { this.execCommand( "formatblock", "<pre>"); }, "Set as spoiler" );
	$.sceditorBBCodePlugin.setCommand( "spoiler", { pre: null }, null, "[spoiler]{0}[/spoiler]", "<pre class='editor-spoiler'>{0}</pre>");
	$.sceditorBBCodePlugin.setCommand( "youtube", null, null, function(element, content) {
		if(!element.attr('data-youtube-id')) return content;
		return '[video]' + element.attr('data-youtube-id') + '[/video]';
	},'<iframe width="560" height="315" src="http://www.youtube.com/embed/{0}?wmode=opaque" data-youtube-id="{0}" frameborder="0" allowfullscreen></iframe>' );
	$.sceditorBBCodePlugin.bbcodes["video"] = $.sceditorBBCodePlugin.bbcodes.youtube;
	
	$(".TextBox, #Form_ConversationMessage .MessageBox").livequery(function() {
		var form = $(this).parents("div.CommentForm, #Form_Discussion");
			form.find(".ButtonBar").hide();
		var editor = $(this).sceditorBBCodePlugin({
			height: 200,
			style: "/plugins/SCEditor/design/jquery.sceditor.default.min.css",
			toolbar: "bold,italic,underline,strike|left,center,right,justify|size,color,removeformat|link,unlink,image,youtube|code,quote,spoiler|cut,copy,paste,pastetext|source",
			colors: "#FFF,#CCC,#BBB,#999,#666,#333,#000|"+
					"#FCC,#F66,#F00,#C00,#900,#600,#300|"+
					"#FC9,#F96,#F90,#F60,#C60,#930,#630|"+
					"#FF9,#FF6,#FC6,#FC3,#C93,#963,#633|"+
					"#FFC,#FF3,#FF0,#FC0,#990,#660,#330|"+
					"#9F9,#6F9,#3F3,#3C0,#090,#060,#030|"+
					"#9FF,#3FF,#6CC,#0CC,#399,#366,#033|"+
					"#CFF,#6FF,#3CF,#36F,#33F,#009,#006|"+
					"#CCF,#99F,#66C,#63F,#60C,#339,#309|"+
					"#FCF,#F9F,#C6C,#C3C,#939,#636,#303"
		})[0];

		this.editor = editor; // Support other plugins!
		
		$(form).bind("clearCommentForm", {editor:editor}, function(e) {
			form.find("textarea").hide();
			$(e.data.editor).data("sceditor").setWysiwygEditorValue("");
		}).bind("writeButtonClick", { }, function() {
			return true;
		});
		
		$(form).find('form').bind("submit", {editor:editor}, function(e) {
			$(e.data.editor).data("sceditor").updateTextareaValue("");
		});
		
		$(form).find('form').bind("form-pre-serialize", {editor:editor}, function(e) {
			$(e.data.editor).data('sceditor').updateTextareaValue();
		});
	});
	
	$('.CommentTabs .PreviewButton').hide();
	
	$('.CommentTabs .WriteButton').click(function(e) {
		e.preventDefault();
		e.stopImmediatePropagation();
	});
});
</script>