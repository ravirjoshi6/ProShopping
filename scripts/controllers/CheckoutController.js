'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('CheckoutController', function ($scope, cart) {
        var cart = JSON.parse(sessionStorage.getItem('cart'));
        $scope.cart = cart;
        var chk = new CheckoutValidtion();
        
    });
}());