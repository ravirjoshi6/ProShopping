'use strict';
(function () {
    var app = angular.module("proshop", ["ngRoute"]);
    app.controller('errorController', function ($scope) { });
    app.config(function ($routeProvider, $locationProvider) {
        $locationProvider.html5Mode(true);
        $routeProvider
                .when("/", {
                    templateUrl: "/scripts/views/index.html",
                    controller: "HomeController"
                })
             .when("/login", {
                 templateUrl: "/scripts/views/login.html",
                 controller: "LoginController"
             })
            .when("/product-design", {
                templateUrl: "/scripts/views/product-design.html",
                controller: "ProductDesignController"
            })
            .when("/account", {
                templateUrl: "/scripts/views/account.html",
                controller: "AccountController"
            })
        .otherwise({
            redirectTo: "/error.html"
        });
    });
}());

