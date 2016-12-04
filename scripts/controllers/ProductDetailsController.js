'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('ProductDetailsController', function ($scope, cart) {
        var product = new Product();
        var cartobj = JSON.parse(sessionStorage.getItem("cart"));
        var quantity = "1";
        console.log(product.name);
        $scope.product = product;
        $scope.quantity = quantity;
        $scope.cartobj = cartobj;
        $scope.addtocart = function (product, quantity) {
            if (cartobj) {
                if (cartobj.products.filter(function (e) { return e.productid == product.productid })) {                   
                    cart.updatecart(product, quantity, cartobj);
                } else {                  
                    cart.addtocart(product, quantity);
                }
            } else {              
                cart.addtocart(product, quantity);
            }
            window.location.replace("/confirmorder");
        }
        $scope.removefromcart = function (product) {
            $scope.cartobj = cart.removefromcart(product);            
        }
    });
}());