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
                    .append('Ваш заказ принят')
                         .fadeIn("slow")
                            .delay(1500)
                                .fadeOut(3000);
            setTimeout(function(){
            $('#messege')
                .empty()
                    .append('Вы будете пернаправлены на главную страницу')
                        .fadeIn("slow")
                            .delay(1500)
                                .fadeOut(3000)},4500);
            setTimeout(function() {
                window.location.replace('/');
            },9000);
        },
        error: function (data) {
            $('#errormessage').empty();

            var responseText = data.responseText;
            var feedback = JSON.parse(responseText);

            for(var property in feedback){
                $('#errormessage').append('<p>' + feedback[property] + '</p>').addClass('alert alert-danger');
            }
        }

    }
    $("#products_add").ajaxForm(options);
});