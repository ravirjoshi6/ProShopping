'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('ProductDetails', function ($scope) {
        var product = new Product();
        console.log(product.name);
        $scope.product = product;
       
    });
     
}());