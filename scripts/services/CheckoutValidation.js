var CheckoutValidtions = function () {   
     this.validatePaymentDetails = function() {
         var error = [];
         // validate name
        if ($('[name="name"]').val() === "" || $('[name="name"]').val() === undefined || $('[name="name"]').val() === null) {
            $('[name="name"]').parent().addClass('has-error');
            error.push("Please Enter Card Holder's Name.");
        } else {
            $('[name="name"]').parent().removeClass('has-error');
        }    

        // validate card
        if ($('[name="card"]').val() === "" || $('[name="card"]').val() === undefined || $('[name="card"]').val() === null) {
            $('[name="card"]').parent().addClass('has-error');
            error.push("Please Enter Valid Card Number.");
        } else{
            if( this.cardnumbercheck($('[name="card"]').val())){
                $('[name="card"]').parent().removeClass('has-error');
            }else{
                $('[name="card"]').parent().addClass('has-error');
                error.push("Please Enter Valid Card Number.");
            } 
        }

         // validate cvv
        if ($('[name="cvv"]').val() === "" || $('[name="cvv"]').val() === undefined || $('[name="cvv"]').val() === null || $('[name="cvv"]').val().length != 3) {
            $('[name="cvv"]').parent().addClass('has-error');
            error.push("Please Enter Valid CVV Number.");
        } else {
            if (Math.floor($('[name="cvv"]').val()) == $('[name="cvv"]').val() && $.isNumeric($('[name="cvv"]').val())) {
                $('[name="cvv"]').parent().removeClass('has-error');
            } else {
                $('[name="cvv"]').parent().addClass('has-error');
                error.push("Please Enter Valid CVV Number.");
            }
        }

         // validate card exp date
        if ($('[name="expdate"]').val() === "" || $('[name="expdate"]').val() === undefined || $('[name="expdate"]').val() === null ||  new Date($('[name="expdate"]').val()) < new Date() ) {
            $('[name="expdate"]').parent().addClass('has-error');
            error.push("Please Enter Valid Exp Date.");
        } else {
            $('[name="expdate"]').parent().removeClass('has-error');
        }

        return error;
    }
    this.validateShippingAddress = function () {
        var error = [];
        if ($('[name="add1"]').val() === "" || $('[name="add1"]').val() === undefined || $('[name="add1"]').val() === null) {
            $('[name="add1"]').parent().addClass('has-error');
            error.push("Please Enter Valid Address.");
        } else {
            $('[name="add1"]').parent().removeClass('has-error');
        }
       
        if ($('[name="city"]').val() === "" || $('[name="city"]').val() === undefined || $('[name="city"]').val() === null) {
            $('[name="city"]').parent().addClass('has-error');
            error.push("Please Enter Valid City.");
        } else {
            $('[name="city"]').parent().removeClass('has-error');
        }
        if ($('[name="state"]').val() === "" || $('[name="state"]').val() === undefined || $('[name="state"]').val() === null) {
            $('[name="state"]').parent().addClass('has-error');
            error.push("Please Enter Valid State.");
        } else {
            $('[name="state"]').parent().removeClass('has-error');
        }
        if ($('[name="zip"]').val() === "" || $('[name="zip"]').val() === undefined || $('[name="zip"]').val() === null || !$.isNumeric($('[name="zip"]').val())) {
            $('[name="zip"]').parent().addClass('has-error');
            error.push("Please Enter Valid Zip.");
        } else {
            $('[name="zip"]').parent().removeClass('has-error');
        }
        if ($('[name="country"]').val() === "" || $('[name="country"]').val() === undefined || $('[name="country"]').val() === null) {
            $('[name="country"]').parent().addClass('has-error');
            error.push("Please Enter Valid Country.");
        } else {
            $('[name="country"]').parent().removeClass('has-error');
        }
        return error;
    }
    this.validateUserLogin = function () {
        var error = [];
    }
    this.validateUserRegistration = function () {
        var error = [];
    }

    this.cardnumbercheck = function(inputtxt) {           
        // var cardno = /^(?:5[1-5][0-9]{14})$/;
        inputtxt = inputtxt.replace(/ /g, "");
        inputtxt = inputtxt.replace(/-/g, "");
        var cardno = /^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/;        
        if(inputtxt.match(cardno))  
        {  
            return true;  
        }  
        else  
        {             
            return false;  
        }  
    }    
}