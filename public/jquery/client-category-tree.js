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
         categoryId = $(this).parent().data('id');
        var request = $.ajax({
            url: "/take-products",
            method: "POST",
            headers: { 'X-XSRF-TOKEN' : $_token },
            data: { categoryId : categoryId }
        });
        request.done(function(data) {
            renderProducts(data)
        });

        request.fail(function() {
            alert("Не получается изменить фото, попробуйте сделать это позже");
        });
    });

    $(document).on('click','.client_product_photo',function(){
        var id = ($(this).data('product_id'));
        window.location.replace('/home/product/' + id)
    });

    $(document).on('click','.pagination',function(event){
        event.preventDefault();
    });
    $(document).on('click','.pagination > li > a',function(event){
         //var page = $(this).text();
        var href = $(this).attr('href');
        var page = href.split('http://test.ru/take-products/?page=')
        var request = $.ajax({
            url: "/take-products" + '?page=' + page[1],
            method: "POST",
            headers: { 'X-XSRF-TOKEN' : $_token },
            data: { categoryId : categoryId }
        });
        request.done(function(data) {
            $('.client_products').empty();
            renderProducts(data)
        });
    });

    function renderProducts(data){

        $('.my_p').empty();
        for (products in data.products)
        {
            var product = (data.products[products]);

            var productTemplate = _.template($('#client_product_template').html());

            var RadyTemplate = productTemplate(product);

            $('.client_products').append(RadyTemplate);
            $('.my_paginator').show();
        }
        $('.my_p').append(data.plincs);
    }
});