
$(document).on("click", "#reportbydate", function(){
    var reportbydatefrom = $('#reportbydatefrom').val();
    var reportbydateto = $('#reportbydateto').val();
    var request = $.ajax({
        url: "./Reports/reportbydate",
        type: "POST",
        data: { reportbydatefrom: reportbydatefrom, reportbydateto: reportbydateto },
        beforeSend: function(){
            $('.report-data').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        $('.report-data').html(data);
    });
});

$(document).on("click", "#reportbydatekurunai", function(){
    var reportbydatefrom = $('#reportbydatefrom').val();
    var reportbydateto = $('#reportbydateto').val();
    var request = $.ajax({
        url: "./ReportsKurunai/reportbydate",
        type: "POST",
        data: { reportbydatefrom: reportbydatefrom, reportbydateto: reportbydateto },
        beforeSend: function(){
            $('.report-data').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        $('.report-data').html(data);
    });
});


$(document).on("click", "#reportbydateothers", function(){
    var reportbydatefrom = $('#reportbydatefrom').val();
    var reportbydateto = $('#reportbydateto').val();
    var request = $.ajax({
        url: "./ReportsOthers/reportbydate",
        type: "POST",
        data: { reportbydatefrom: reportbydatefrom, reportbydateto: reportbydateto },
        beforeSend: function(){
            $('.report-data').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        $('.report-data').html(data);
    });
});

$(document).on("click", "#reportbydateprint", function(){
    $("#reportbydateprint").attr("disabled", true);
    var reportbydatefrom = $('#reportbydatefrom').val();
    var reportbydateto = $('#reportbydateto').val();
    var request = $.ajax({
        url: "./Reports/reportbydateprint",
        type: "POST",
        data: { reportbydatefrom: reportbydatefrom, reportbydateto: reportbydateto },
        beforeSend: function(){
           // $('.report-data').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/>Printing...<img src='images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        // $('.report-data').html(data);
    });
});


$(document).on("click", "#reportbydateprintkurunai", function(){
    $("#reportbydateprint").attr("disabled", true);
    var reportbydatefrom = $('#reportbydatefrom').val();
    var reportbydateto = $('#reportbydateto').val();
    var request = $.ajax({
        url: "./ReportsKurunai/reportbydateprint",
        type: "POST",
        data: { reportbydatefrom: reportbydatefrom, reportbydateto: reportbydateto },
        beforeSend: function(){
            // $('.report-data').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/>Printing...<img src='images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        // $('.report-data').html(data);
    });
});

$(document).on("click", "#reportbydateprintothers", function(){
    $("#reportbydateprintothers").attr("disabled", true);
    var reportbydatefrom = $('#reportbydatefrom').val();
    var reportbydateto = $('#reportbydateto').val();
    var request = $.ajax({
        url: "./ReportsOthers/reportbydateprint",
        type: "POST",
        data: { reportbydatefrom: reportbydatefrom, reportbydateto: reportbydateto },
        beforeSend: function(){
            // $('.report-data').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/>Printing...<img src='images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        // $('.report-data').html(data);
    });
});

$(document).on("click", "#stockbydate", function(){
    var stockbydatefrom = $('#stockbydatefrom').val();
    var stockbydateto = $('#stockbydateto').val();

    var request = $.ajax({
        url: "./stockbydate",
        type: "POST",
        data: { stockbydatefrom: stockbydatefrom, stockbydateto: stockbydateto },
        beforeSend: function(){
            $('#stockdata').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='../images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        $('#stockdata').html(data);
    });
});

$(document).on("click", "#stockbydatekurunai", function(){
    var stockbydatefrom = $('#stockbydatefrom').val();
    var stockbydateto = $('#stockbydateto').val();

    var request = $.ajax({
        url: "./stockbydate",
        type: "POST",
        data: { stockbydatefrom: stockbydatefrom, stockbydateto: stockbydateto },
        beforeSend: function(){
            $('#stockdata').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='../images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        $('#stockdata').html(data);
    });
});

$(document).on("click", "#stockbydateprint", function(){
    $("#stockbydateprint").attr("disabled", true);
    var stockbydatefrom = $('#stockbydatefrom').val();
    var stockbydateto = $('#stockbydateto').val();

    var request = $.ajax({
        url: "./stockbydateprint",
        type: "POST",
        data: { stockbydatefrom: stockbydatefrom, stockbydateto: stockbydateto },
        beforeSend: function(){
            //$('#stockdata').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='../images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        //$('#stockdata').html(data);
    });
});



$(document).on("click", "#stockbydateprintkurunai", function(){
    $("#stockbydateprintkurunai").attr("disabled", true);
    var stockbydatefrom = $('#stockbydatefrom').val();
    var stockbydateto = $('#stockbydateto').val();

    var request = $.ajax({
        url: "./stockbydateprint",
        type: "POST",
        data: { stockbydatefrom: stockbydatefrom, stockbydateto: stockbydateto },
        beforeSend: function(){
            //$('#stockdata').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='../images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        //$('#stockdata').html(data);
    });
});