'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('ProductDesignController',
        function ProductDesignController($scope, $location,cart) {
            TShirtDesignTool.init();
            $(document).foundation();
            $scope.saveproduct = function () {
                var product = {
                    productid: 100,
                    name: "custome",                   
                    size: "M",
                    img: $('#finalproduct').attr("src"),
                    price: 10,
                    total: 10
                }
                $('#normal').hide();
                $('#custome').show();
                cart.addtocart(product, 1, null, "M");
                setTimeout($('#save-design-popup').foundation('reveal', 'close'), 500);
                $location.path('/checkout');
            }
        });
}());