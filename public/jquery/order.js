$(document).ready(function(){
    var $_token = $('#token').val();
    $(".delete").on('click',function(){
        var productID = $(this).data('product_id');
        var reqest = $.ajax({
            url: "delete-product",
            method: "POST",
            headers: {'X-XSRF-TOKEN': $_token},
            data: {productId: productID}
        });

        reqest.done(function(data) {
            alert ('ok');
        });
    });

    $(".change").on('click',function(){
        var quantity = $(this).parent('td').prev('td').children('input').val();
        var reqest = $.ajax({
            url: "update-quantity",
            method: "POST",
            headers: {'X-XSRF-TOKEN': $_token},
            data: {quantity: quantity}
        });
        reqest.done(function(data) {
            alert ('ok');
        });
    });
});