requirejs.config({
     baseUrl: 'scripts/dist',
    paths: {
        jquery:'jquery.min',
        jqueryUI: 'jquery-ui.min',
        flexisel: 'jquery.flexisel.min',
        flexslider: 'jquery.flexslider.min',
        simpleCart: 'simpleCart.min',
        angular:'angular.min',
        memenu: 'memenu.min'
    }
});
requirejs(['jquery','jqueryUI','flexisel','flexslider','simpleCart','memenu'],
function   ($,canvas,   sub) {
    //jQuery, canvas and the app/sub module are all
    //loaded and can be used here now.
   $(".memenu").memenu();
});