requirejs.config({
    baseUrl: 'scripts/',
    paths: {
        jquery: 'lib/jquery',
        jqueryUI: 'lib/jquery-ui',
        flexisel: 'lib/jquery.flexisel',
        flexslider: 'lib/jquery.flexslider',
        simpleCart: 'lib/simpleCart',      
        memenu: 'lib/memenu',
        angular: 'lib/angular',
    },
    shim: {
        'angular': {
            exports: 'angular'
        }
    },
});
requirejs(['jquery', 'jqueryUI', 'flexisel', 'flexslider', 'simpleCart', 'memenu', 'angular'],
    function($, jqueryUI, flexisel, flexslider, simpleCart, memenu, angular) {
        //jQuery, canvas and the app/sub module are all
        //loaded and can be used here now.
        $(".memenu").memenu();
        requirejs(['app/app']);
    });