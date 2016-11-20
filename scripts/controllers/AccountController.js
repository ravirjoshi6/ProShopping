'use strict';
(function () {
    var app = angular.module("proshop");
    app.controller('AccountController',
        function AccountController($scope) {
            var newuser = new User();
            $scope.register = function (user) {
                if ($("#terms").is(':checked')) {
                    newuser.firstname = user.firstname;
                    newuser.lastname = user.lastname;
                    newuser.email = user.email;                   
                    newuser.pwd = user.pwd;
                    $.ajax({
                        url: "http://capstone.devview.info/user/create",
                        data: {
                            firstName: newuser.firstname,
                            lastName: newuser.lastname,
                            email: newuser.email,
                            password: newuser.pwd
                        },
                        type: 'POST'                       
                    })
                    .done(function (data) {
                        console.log(data);
                    })
                } else {
                    alert("Please accept terms and conditions");
                }
            }

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