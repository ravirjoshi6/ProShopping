'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('ConfirmOrderController',
        function ConfirmOrderController($scope) {
            var cart = JSON.parse(sessionStorage.getItem('cart'));
            $scope.cart = cart;
        });
}());