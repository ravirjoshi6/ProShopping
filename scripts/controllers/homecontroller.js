'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('HomeController',
        function HomeController($scope) {
            $scope.message = "this is homepage";
        });
}());