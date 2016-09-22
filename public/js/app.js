// CSRF protection
$.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });


$(document).on("click", ".Showreports", function() {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var request = $.ajax({
        url: "./Reports/ShowReports",
        type: "POST",
        data: { from_date: from_date, to_date: to_date },
        beforeSend: function(){
            $('.data-area').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        $('.data-area').html(data);
    });
});


$(document).on("click", ".DownloadReports", function() {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var request = $.ajax({
        url: "./Reports/DownloadReports",
        type: "POST",
        data: { from_date: from_date, to_date: to_date },
        beforeSend: function(){
            $('.data-area').html("<div class='row'><div class='col-md-12 text-center'><br/><br/><br/><br/><img src='images/ajax-loader.gif'/></div></div>");
        }
    });
    request.success(function( data ) {
        $('.data-area').html(data);
    });
});


$(function() {
    $( ".datepicker" ).datepicker({
        dateFormat: "dd-mm-yy",
        numberOfMonths: 3,
        showCurrentAtPos: 2
    });
});

//form submit on click events
    $( ".itemsadd" ).focus(function() {
        $( "#formiddaa" ).submit();
        $(".next-round").val('');
        $("#item").attr('disabled', 'disabled');
        $("#item").focus();
    });

    $( ".CreateCashEntry" ).click(function() {
        $( "#formidda" ).submit();
    });
