'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('ProductDesignController',
        function ProductDesignController($scope) {
            TShirtDesignTool.init();
            $(document).foundation();
        });
}());