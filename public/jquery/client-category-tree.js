$(document).ready(function(){
    var $_token = $('#token').val();

    $("#client_tree li").click(
        function (e) {
            $(this).children('ul').toggle();
            e.stopPropagation();
        }
    );


    $(".last > h3").on('click',function(event){
        $('.client_products').empty();
        var categoryId = $(this).parent().data('id');
        var request = $.ajax({
            url: "/take-products",
            method: "POST",
            headers: { 'X-XSRF-TOKEN' : $_token },
            data: { categoryId : categoryId }
        });
        request.done(function(data) {
            for (products in data.products)
            {

                console.log(data.products[products]);
                var product = (data.products[products]);

                var productTemplate = _.template($('#client_product_template').html());

                var RadyTemplate = productTemplate(product);

                $('.client_products').append(RadyTemplate);
            }
        });

        request.fail(function() {
            alert("Не получается изменить фото, попробуйте сделать это позже");
        });
    });

    $(document).on('click','.client_product_photo',function(){
        var id = ($(this).data('product_id'));
        window.location.replace('/home/product/' + id)
    });
});