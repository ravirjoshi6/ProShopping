'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('HomeController',
        function HomeController($scope, getProducts) {
            
            
            var productListPromise = getProducts.getProductList();
            productListPromise.then(function (result) {
               
                $scope.productlist = result.products;
                $scope.viewby = 4;
                $scope.totalItems = $scope.productlist.length;
                $scope.currentPage = 1;
                $scope.itemsPerPage = $scope.viewby;
                $scope.maxSize = 2; //Number of pager buttons to show   
            });

            //var productlist = new ProductList();
            //$scope.productlist = productlist;
            //$scope.viewby = 4;
            //$scope.totalItems = $scope.productlist.length;
            //$scope.currentPage = 1;
            //$scope.itemsPerPage = $scope.viewby;
            //$scope.maxSize = 2; //Number of pager buttons to show   
           

            $scope.setPage = function (pageNo) {
                $scope.currentPage = pageNo;
            };

            $scope.pageChanged = function () {
                console.log('Page changed to: ' + $scope.currentPage);
            };

            $scope.setItemsPerPage = function (num) {
                $scope.itemsPerPage = num;
                $scope.currentPage = 1; //reset to first paghe
            }
        });
}());