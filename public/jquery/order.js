$(document).ready(function(){
    var $_token = $('#token').val();
    $(".delete").on('click',function(){
        var tr = $(this).closest('tr');
        var productID = $(this).data('product_id');
        var reqest = $.ajax({
            url: "delete-product",
            method: "POST",
            headers: {'X-XSRF-TOKEN': $_token},
            data: {productId: productID}
        });

        reqest.done(function(data) {
            tr.fadeOut(1500);
            $('.change_sum').fadeOut(1500);
            setTimeout(function(){$('.change_sum').text(data.price).fadeIn(1500)},1500);
            $('#sum').empty();
            $('#sum').append(data.price);
            $('#quantity').empty();
            $('#quantity').append(data.quantity);

        });
    });

    $(".change").on('click',function(){
        var quantity = $(this).parent('td').prev('td').children('input').val();
        var productId = $(this).data('product_id');
        var tr = $(this).closest('tr');

        var reqest = $.ajax({
            url: "update-quantity",
            method: "POST",
            headers: {'X-XSRF-TOKEN': $_token},
            data: {quantity: quantity, productId: productId}
        });
        reqest.done(function(data) {
            if(data.quantity !== 0){
                $('#quantity').empty();
                $('#quantity').append(data.quantity);
                $('#sum').empty();
                $('#sum').append(data.price);
                $('.change_sum').fadeOut(1500);
                setTimeout(function(){$('.change_sum').text(data.price).fadeIn(1500)},1500);

            } else {
                tr.fadeOut(1500);
                $('#quantity').empty();
                $('#quantity').append(data.quantityAll);
                $('#sum').empty();
                $('#sum').append(data.price);
                $('.change_sum').fadeOut(1500);
                setTimeout(function(){$('.change_sum').text(data.price).fadeIn(1500)},1500);
            }
            $('#messege')
                .empty()
                    .removeClass("alert alert-success");
            $('#messege')
                .addClass("alert alert-success")
                    .append('Ваше колличество было изменено')
                        .fadeIn("slow")
                            .delay(500)
                                .fadeOut(3000);
        });
    });
});