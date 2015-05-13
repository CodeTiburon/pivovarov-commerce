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
});