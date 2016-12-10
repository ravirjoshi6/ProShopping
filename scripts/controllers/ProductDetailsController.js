'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('ProductDetailsController', function ($scope, $location, $routeParams, cart, getSingleProducts) {

       
        var productPromise = getSingleProducts.getProduct($routeParams.id);
        productPromise.then(function (result) {
            var product = result;
            var cartobj = JSON.parse(localStorage.getItem("cart"));
            var quantity = "1";
            var size = 'S';
            $scope.product = product;
            $scope.quantity = quantity;
            $scope.size = size,
            $scope.cartobj = cartobj;
            $('.rating').raty({ click: rateproduct });
            $('.rating').raty('score', $scope.product.rating);
            $scope.addtocart = function (product, quantity, size) {
                cartobj = JSON.parse(localStorage.getItem("cart"));
                if (cartobj) {
                    quantity = parseInt(quantity);
                    if (cartobj.products.filter(function (e) { return (e.productid == product.productid) && (e.size == size) }).length > 0) {
                        //if (cartobj.products.filter(function (e) { return e.size == size }).length > 0) {
                        cart.updatecart(product, quantity, cartobj, size);
                    } else {
                        cart.addtocart(product, quantity, cartobj, size);
                    }
                } else {
                    cart.addtocart(product, quantity, undefined, size);
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
        });
        
       
    });
}());