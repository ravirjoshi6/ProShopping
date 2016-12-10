'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('LoginController',
        function LoginController($scope,$location) {
            $scope.login = function (userlogin) {
                $.ajax({
                    url: "http://capstone.devview.info/user/login",
                    data: {
                        email: userlogin.email,
                        password: userlogin.pwd
                    },
                    type: 'POST'
                })
                .done(function (data) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        console.log(data);                       
                        $.cookie("authtoken", data.auth_token, { expires: 1 });
                        app.setlogin(data.auth_token);
                        $('.loginerror span').text("");
                        if (app.lastpath) {                           
                            $location.path(app.lastpath);
                            $scope.$apply();
                        } else {
                            $location.path('/');
                            //$scope.$apply();
                        }
                       
                    } else {
                        $('.loginerror span').text("Invalid Email/Password !!");
                    }
                })
            }
        });
}());