'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('CheckoutController', function ($scope,$location,cart) {
        var isLoged = app.checklogin(window.location.pathname);
        if (isLoged) {
            var cart = JSON.parse(localStorage.getItem('cart'));
            $('[name="expdate"]').datepicker();
            $scope.cart = cart;
            $scope.placeOrder = function () {
                var isLoged = app.checklogin(window.location.pathname);
                if (isLoged) {
                    var validate = new CheckoutValidtions();
                    $scope.errors1 = validate.validatePaymentDetails();
                    $scope.errors2 = validate.validateShippingAddress();
                    if ($scope.errors1.length == 0 && $scope.errors2.length == 0) {

                    }
                } else {
                    $location.path('/login');
                    $scope.$apply();
                }
            }
        } else {
            $location.path('/login');
            $scope.$apply();
        }
       
    });
}());