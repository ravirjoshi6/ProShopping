'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('ProductDetails', function ($scope, cart) {
        var product = new Product();
        var quantity = "3";
        console.log(product.name);
        $scope.product = product;
        $scope.quantity = quantity;

        $scope.addtocart = function (product, quantity) {          
            var cartobj = JSON.parse(sessionStorage.getItem("cart"));
            if (cartobj) {
                if (cartobj.products.filter(function (e) { return e.productid == product.productid })) {                   
                    cart.updatecart(product, quantity, cartobj);
                } else {                  
                    cart.addtocart(product, quantity);
                }
            } else {              
                cart.addtocart(product, quantity);
            }
           
        }
    });
}());