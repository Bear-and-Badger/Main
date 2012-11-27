$(function() {
    $(".Comment .Message img").each(function(i) {
        ShrinkImage($(this));
    });
	
    $('body').on('click', '.image-shrunk', function(){
		img = $(this);
        img.width('').height(''); // Reset image size
		
        img.addClass( "image-enlarged" );
		img.removeClass( "image-shrunk" ); 
    });
	
    $('body').on('click', '.image-enlarged', function(){
        img = $(this);
        ShrinkImage(img);
    });
});
$(window).resize(function() {
    $(".Comment .Message img").each(function(i) {
        ShrinkImage($(this));
    });
});
function ShrinkImage(img) {
    //img.width('').height(''); // reset any prior values
	
    if(img.closest('blockquote').size() == 0) {
        post = img.closest("div.Message");
    } else {
        // If we're inside a quote we should resize to that boundary
        post = img.closest('blockquote');
    }
	
    if(img.width() > post.width()) {
		img.removeClass( "image-enlarged" );
		img.addClass( "image-shrunk" );
        
        ratio = img.height()/img.width();
        img.width(post.width());
        img.height(img.width()*ratio);
    }
}
