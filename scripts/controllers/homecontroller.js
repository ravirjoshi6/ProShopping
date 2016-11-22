'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('HomeController',
        function HomeController($scope) {
            var productlist = new ProductList();
            $scope.productlist = productlist;
        });
}());