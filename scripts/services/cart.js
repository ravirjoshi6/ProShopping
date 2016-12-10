'use strict';
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
    this.addtocart = function (product, quantity,cartobj,size) {
        quantity = parseInt(quantity);
        if (cartobj == undefined) {
            var newcart = this.getnewcart();
        } else {
            var newcart = cartobj;
        }
        var product = {
            productid: product.productid,
            name: product.name,
            quantity: quantity,
            size:size,
            img: product.img,
            price: parseInt(product.price),
            total: product.price * quantity
        }
        newcart.products.push(product);
        $.each(newcart.products, function (i,item) {
            newcart.carttotal = newcart.carttotal + item.total;
            newcart.cartquantity = newcart.cartquantity + item.quantity;
        })
        if (cartobj) {
            cartobj.carttotal = 0;
            cartobj.cartquantity = 0;
            $.each(cartobj.products, function (i, item) {
                cartobj.carttotal = cartobj.carttotal + item.total;
                cartobj.cartquantity = cartobj.cartquantity + item.quantity;
            })
        } else {
            newcart.cartid = 1;
            newcart.userid = 27;
        }
        
        $('.carttotal').text("$ " + newcart.carttotal + ".00");
        localStorage.setItem('cart', JSON.stringify(newcart));
    }
    this.updatecart = function (product, quantity,cartobj,size) {
        quantity = parseInt(quantity);
        cartobj.products.filter(function (e) {
            if (e.productid == product.productid && e.size == size) {
                e.size = size;
                e.quantity = e.quantity + quantity;
                e.total = product.price * e.quantity;                
            }
            cartobj.carttotal = 0;
            cartobj.cartquantity = 0;
            $.each(cartobj.products, function (i, item) {
                cartobj.carttotal = cartobj.carttotal + item.total;
                cartobj.cartquantity = cartobj.cartquantity + item.quantity;
            })
        })      
        localStorage.setItem('cart', JSON.stringify(cartobj));

    }

    this.removefromcart = function (product) {
        var cartobj = JSON.parse(localStorage.getItem('cart'));
        $.each(cartobj.products, function (i, item) {           
            if (item.productid == product.productid && item.size == product.size) {
                cartobj.products.pop(i);
                if (cartobj.products.length == 0) {
                    localStorage.removeItem('cart');
                    cartobj = null;
                }else{
                    localStorage.setItem('cart', JSON.stringify(cartobj));                   
                }               
            }
        })
        return cartobj;
    }
});