$(function() {
    $(".Comment .Message img").each(function(i) {
        ShrinkImage($(this));
    });
	
    jQuery('body').on('click', '.image-shrunk', function(){
		img = jQuery(this);
        img.width('').height(''); // Reset image size
		
        img.addClass( "image-enlarged" );
		img.removeClass( "image-shrunk" ); 
    });
	
    jQuery('body').on('click', '.image-enlarged', function(){
        img = jQuery(this);
        ShrinkImage(img);
    });
});
$(window).resize(function() {
    $(".Comment .Message img").each(function(i) {
        ShrinkImage($(this));
    });
});
function ShrinkImage(img) {
   if( img.closest('blockquote').size() == 0 ) {
		post = img.closest("div.Message");
	} else {
		post = img.closest('blockquote');
	}
	
	img.css({maxWidth:post.width()+"px"});
	
	if( img.width() > 0 ) {	
		if( img.width() > post.width()) {
			img.removeClass( "image-enlarged" );
			img.addClass( "image-shrunk" );
			
			img.css({width:post.width()+"px"});
		}
	} else {
		img.bind('load', function() {
			ShrinkImage( $(this) );
		});
	}
}
