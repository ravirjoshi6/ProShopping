requirejs.config({
     baseUrl: 'scripts/lib',
    paths: {
        jquery:'jquery.min',
        jqueryUI: 'jquery-ui.min',
        flexisel: 'jquery.flexisel',
        flexslider: 'jquery.flexslider',
        simpleCart: 'simpleCart.min',
        memenu: 'memenu'
    }
});
requirejs(['jquery','jqueryUI','flexisel','flexslider','simpleCart','memenu'],
function   ($,        canvas,   sub) {
    //jQuery, canvas and the app/sub module are all
    //loaded and can be used here now.
   $(".memenu").memenu();
});