﻿'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('CheckoutController', function ($scope,$location,cart) {
        var isLoged = app.checklogin(window.location.pathname);
        if (isLoged) {
            var cart = JSON.parse(localStorage.getItem('cart'));
            $.each(cart.products, function (i, item) {
                if (item.name == "custome") {
                    $('#normal').hide();
                    $('#custome').show();
                } else {
                    $('#normal').show();
                    $('#custome').hide();
                }
            });
            $('[name="expdate"]').datepicker();
            $scope.cart = cart;
            $scope.placeOrder = function () {
                var isLoged = app.checklogin(window.location.pathname);
                if (isLoged) {
                    var validate = new CheckoutValidtions();
                    $scope.errors1 = validate.validatePaymentDetails();
                    $scope.errors2 = validate.validateShippingAddress();
                    if ($scope.errors1.length == 0 && $scope.errors2.length == 0) {
                        localStorage.removeItem('cart');
                        $location.path('/thankyou');
                    }
                } else {
                    $location.path('/login');
                    //$scope.$apply();
                }
            }
        } else {
            $location.path('/login');
           // $scope.$apply();
        }
       
    });
}());