$(document).ready(function(){
    var $_token = $('#token').val();

    $("#client_tree li").click(
        function (e) {
            $(this).children('ul').toggle();
            e.stopPropagation();
        }
    );


    $(".last > h3").on('click',function(event){
        var categoryId = $(this).parent().data('id');
        var request = $.ajax({
            url: "/take-products",
            method: "POST",
            headers: { 'X-XSRF-TOKEN' : $_token },
            data: { categoryId : categoryId }
        });
        request.done(function(data) {

        });
        request.fail(function() {

        });
    });
});