'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('ProductDetailsController', function ($scope, $location, cart) {

        var product = new Product();
        var cartobj = JSON.parse(localStorage.getItem("cart"));
        var quantity = "1";
        $scope.product = product;
        $scope.quantity = quantity;
        $scope.cartobj = cartobj;
        $scope.addtocart = function (product, quantity) {
            cartobj = JSON.parse(localStorage.getItem("cart"));
            if (cartobj) {
                quantity = parseInt(quantity);
                if (cartobj.products.filter(function (e) { return e.productid == product.productid })) {
                    cart.updatecart(product, quantity, cartobj);
                } else {
                    cart.addtocart(product, quantity);
                }
            } else {
                cart.addtocart(product, quantity);
            }          
            $location.path('/confirmorder');           
        }
        $scope.removefromcart = function (product) {
            $scope.cartobj = cart.removefromcart(product);
        }
        var rateproduct = function (rating) {
            var isLoged = app.checklogin(window.location.pathname);
            if (isLoged) {
                $.ajax({
                    url: "http://capstone.devview.info/product/ratemyproduct/",
                    data: {
                        product_id: $scope.product.productid,
                        rating: parseInt(rating),
                        auth_token: app.isLoged
                    },
                    type: 'POST'
                })
               .done(function (data) {
                   //do somthing.
               });
            } else {
                $location.path('/login');
                $scope.$apply();            
            }
        }
        $('.rating').raty({ click: rateproduct });
        $('.rating').raty('score', $scope.product.rating);
    });
}());