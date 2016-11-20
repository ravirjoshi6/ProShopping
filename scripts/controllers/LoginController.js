'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('LoginController',
        function LoginController($scope) {
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
                        $('.loginerror span').text("");
                        window.location.replace("/");
                    } else {
                        $('.loginerror span').text("Invalid Email/Password !!");
                    }
                })
            }
        });
}());