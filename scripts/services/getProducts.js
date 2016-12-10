var app = angular.module("proshop");
app.factory('getProducts', function ($http) {

    var getData = function () {

        // Angular $http() and then() both return promises themselves 
        return $http({ method: "GET", url: "http://capstone.devview.info//product/getproducts" }).then(function (result) {

            // What we return here is the data that will be accessible 
            // to us after the promise resolves
            return result.data;
        });
    };


    return { getProductList: getData };
});