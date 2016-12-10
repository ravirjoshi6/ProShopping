'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('ConfirmOrderController',
        function ConfirmOrderController($scope) {
            var cart = JSON.parse(localStorage.getItem('cart'));
            $scope.cart = cart;
            $.each(cart.products, function (i, item) {
                if (item.name == "custome") {
                    $('#normal').hide();
                    $('#custome').show();
                } else {
                    $('#normal').show();
                    $('#custome').hide();
                }
            });
        });
}());