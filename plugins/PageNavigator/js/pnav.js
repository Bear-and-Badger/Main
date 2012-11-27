jQuery(document).ready(function($) {

$('a.pntop').click(function() {
parent.window.scrollTo(0, 0);
return false;
});

$('a.pnbottom').click(function() {
ht = $(document).height();
parent.window.scrollTo(0, ht-200);
return false;
});

});




