$(document).ready(function(){
    var $_token = $('#tokendelete').val();
    var options = {
        success: function () {
            $('#messege')
                .empty()
                    .removeClass("alert alert-success");
            $('#errormessage')
                    .empty()
                        .removeClass('alert alert-danger');
            $('#messege')
                .addClass("alert alert-success")
                    .text('Продукт добавлен успешно')
                        .fadeIn("slow")
                            .delay(1500)
                                .fadeOut(3000);
            $('#name')
                .val('');
            $('#Description')
                .val('');
        },
        error: function (data) {
            $('#errormessage').empty();
            var responseText = data.responseText;
            var feedback = JSON.parse(responseText);
            for(var property in feedback){
                $('#errormessage').append('<p>' + feedback[property] + '</p>').addClass('alert alert-danger');
            }
        }
    };
        $("#products_add").ajaxForm(options);

    $(".proddell").on('click',function(){
        var targ = $(this).closest('.crum');
        var p = targ.prev('.product');
        var categoryId = ($(this).data('id_category'));
        var productId  = ($(this).data('id_product'));
        var request = $.ajax({
            url: "product/product-delete",
            method: "POST",
            headers: { 'X-XSRF-TOKEN' : $_token },
            data: { catid : categoryId, prodid : productId }
        });
        request.done(function(data) {
            if(data){
                console.log(p);
                p.hide(2000);
                targ.hide(2000);
            };
            targ.hide(2000);
        });

    });
});