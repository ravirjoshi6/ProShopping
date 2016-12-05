﻿'use strict';
var app = angular.module("proshop");
app.service('cart', function () {
    this.getnewcart = function () {
        var cart = {
            cartid: "",
            products: [],
            carttotal: 0,
            cartquantity: 0,
            userid: ""
        }
        return cart;
    }
    this.addtocart = function (product, quantity) {
        var newcart = this.getnewcart();
        var product = {
            productid: product.productid,
            name: product.name,
            quantity: quantity,
            img: product.img,
            price: product.price,
            total: product.price * quantity
        }
        newcart.products.push(product);
        $.each(newcart.products, function (i,item) {
            newcart.carttotal = newcart.carttotal + item.total;
            newcart.cartquantity = newcart.cartquantity + item.quantity;
        })
        newcart.cartid = "1";       
        newcart.userid = 27;
        $('.carttotal').text("$ " + newcart.carttotal + ".00");
        sessionStorage.setItem('cart', JSON.stringify(newcart));
    }
    this.updatecart = function (product, quantity, cartobj) {
        cartobj.products.filter(function (e) {
            if (e.productid == product.productid) {
                e.quantity = quantity;
                e.total = product.price * quantity;                
            }
            cartobj.carttotal = 0;
            $.each(cartobj.products, function (i, item) {
                cartobj.carttotal = cartobj.carttotal + item.total;
                cartobj.cartquantity = cartobj.cartquantity + item.quantity;
            })
        })      
        sessionStorage.setItem('cart', JSON.stringify(cartobj));

    }

    this.removefromcart = function (product) {
        var cartobj = JSON.parse(sessionStorage.getItem('cart'));
        $.each(cartobj.products, function (i, item) {
            if (item.productid == product.productid) {               
                cartobj.products.pop(i);
                if (cartobj.products.length == 0) {
                    sessionStorage.removeItem('cart');
                    cartobj = null;
                }else{
                    sessionStorage.setItem('cart', JSON.stringify(cartobj));
                }
                return cartobj;
            }
        })
    }
});