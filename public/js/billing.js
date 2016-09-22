/*    $(document).on("focus", "#selling_price", function(){
        var product_code = $('#product_code').val();
        var request = $.ajax({
            url: "./getstock",
            type: "POST",
            data: { product_code: product_code },
            beforeSend: function(){
                //$('.allinvoice').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='images/ajax-loader.gif'/></div></div>");
            }
        });
        request.success(function( data ) {
            $('.balance').text(data);
        });
    });

    */

    //reprint
    $(document).on("click", "#bill_print", function(){
        var bill_print_id = $('#bill_print_id').val();
        var request = $.ajax({
            url: "./bill_print",
            type: "POST",
            data: { bill_print_id: bill_print_id },
            beforeSend: function(){
                //$('.allinvoice').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='images/ajax-loader.gif'/></div></div>");
            }
        });
        request.success(function( data ) {
            //$('.balance').text(data);
        });
    });

    //reprint
    $(document).on("click", "#bill_print_kurunai", function(){
        var bill_print_id = $('#bill_print_id').val();
        var request = $.ajax({
            url: "./bill_print_kurunai",
            type: "POST",
            data: { bill_print_id: bill_print_id },
            beforeSend: function(){
                //$('.allinvoice').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='images/ajax-loader.gif'/></div></div>");
            }
        });
        request.success(function( data ) {
            //$('.balance').text(data);
        });
    });

    //reprint
    $(document).on("click", "#bill_print_others", function(){
        var bill_print_id = $('#bill_print_id').val();
        var request = $.ajax({
            url: "./bill_print_others",
            type: "POST",
            data: { bill_print_id: bill_print_id },
            beforeSend: function(){
                //$('.allinvoice').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='images/ajax-loader.gif'/></div></div>");
            }
        });
        request.success(function( data ) {
            //$('.balance').text(data);
        });
    });

    $(document).on("keyup", "#quantity", function(){
        var quantity = $('#quantity').val();
        var balance = $('.balance').text();

        if(quantity > parseInt(balance)){
            $('.available').text("No Stock");
            $('#quantity').val("");
            $('#quantity').focus();
        }else{
            $('.available').text("");
        }
    });

    $(document).on("focusout", "#quantity", function(){
        var quantity = $('#quantity').val();
        if(quantity <= 0){
            $('#quantity').focus();
        }
    });



    $( ".AddBillItem" ).focus(function() {
        $( "#BillingForm" ).submit();
    });

    $( ".PurchaseItem" ).focus(function() {
        $( "#PurchaseItemForm" ).submit();
    });

$(document).ready(function(){
    $( ".billingfinalformclass" ).click(function() {
        $( "#billingfinalform" ).submit();
    });
});


    $( ".purchasefinalformclass" ).click(function() {
        $( "#PurchaseFinalForm" ).submit();
    });




    $(document).on("keyup", "#discount", function(){
        var discount = $('#discount').val();
        var balance = $('.balance').text();

        if(quantity > parseInt(balance)){
            $('.available').text("No Stock");
            $('#quantity').val("");
            $('#quantity').focus();
        }else{
            $('.available').text("");
        }
    });

    $(document).on("focus", "#discount", function(){
        $('#discount').select();
    });