$(document).ready(function() {
    var $_token = $('#token').val();

    $('.bay').on('click', function (event) {

        var request = $.ajax({
            url: "./../../cart/add-product",
            method: "POST",
            headers: {'X-XSRF-TOKEN': $_token},
            data: {productId: $(this).data('product_id')}
        });
        request.done(function (data) {
            $('#quantity').empty();
            $('#sum').empty();
            $('#quantity').append(data.quantity);
            $('#sum').append(data.price);
        });
    });
    $(document).on('click','.buy', function (event) {

        var request = $.ajax({
            url: "cart/add-product",
            method: "POST",
            headers: {'X-XSRF-TOKEN': $_token},
            data: {productId: $(this).data('product_id')}
        });
        request.done(function (data) {
            $('#quantity').empty();
            $('#sum').empty();
            $('#quantity').append(data.quantity);
            $('#sum').append(data.price);
        });
    });
});