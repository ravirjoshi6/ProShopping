'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('ConfirmOrderController',
        function ConfirmOrderController($scope) {
            var cart = JSON.parse(localStorage.getItem('cart'));
            $scope.cart = cart;
        });
}());