jQuery(function() {
    $("div.Message img").each(function(i) {
        ShrinkImage(jQuery(this));
    });
	
    $('body').on('click', '.image-shrunk', function(){
		img = jQuery(this);
        img.width('').height(''); // Reset image size
		
        img.addClass( "image-enlarged" );
		img.removeClass( "image-shrunk" ); 
    });
	
    $('body').on('click', '.image-enlarged', function(){
        img = jQuery(this);
        ShrinkImage(img);
    });
});
jQuery(window).resize(function() {
    jQuery("div.Message img").each(function(i) {
        ShrinkImage(jQuery(this));
    });
});
function ShrinkImage(img) {
    img.width('').height(''); // reset any prior values
    if(img.closest('blockquote').size() == 0) {
        post = img.closest("div.Message");
    } else {
        // If we're inside a quote we should resize to that boundary
        post = img.closest('blockquote');
    }
    if(img.width() > post.width()) {
        if(img.closest('div.resize-wrap').size() == 0) {
            // The first resize, we need to create the containers
            if(img.parent().is("a")) {
                img.parent().wrap('<div class="resize-wrap"/>');
            } else {
                img.wrap('<div class="resize-wrap"/>');
            }
			
            img.closest('div.resize-wrap').append('<p style="font-size:79%">Image has been resized. Click to embiggen.</p>');
        }

		img.removeClass( "image-enlarged" );
		img.addClass( "image-shrunk" );
        
        ratio = img.height()/img.width();
        img.width(post.width());
        img.height(img.width()*ratio);
    } else if(img.closest('div.resize-wrap').size() == 1) {
      
    }
}
