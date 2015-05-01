$(document).ready(function(){
    var options = {
        success: function () {
            $('#errormessage').empty().removeClass('alert alert-danger');
            $('#messege').addClass("alert alert-success").append('Продукт добавлен успешно').fadeIn("slow").delay(1500).fadeOut(3000);
            $('#name').val('');
            $('#Description').val('');
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
});