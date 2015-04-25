$(document).ready(function(){
    var options = {
        success: function(data) {


            if(data.redirect) {
                window.location = data.redirect;
            }

            else if(data.badcredentials){
                $('#errormessage').append('<p>' + data.badcredentials + '</p>').addClass('alert alert-danger');

            }

            else if(data.errors) {
                $('#errormessage').empty();
                for(var property in data.errors) {
                    if(property){
                        var count = (data.errors[property]).length;
                        var i=0;
                        for (i ; i < count; i++) {
                            var error = (data.errors[property][i]);
                            $('#errormessage').append('<p>' + error + '</p>').addClass('alert alert-danger');
                        }
                    }
                }
            }

            else{
                window.location = http/test.ru;
            }

        }
    };
    $("#login").ajaxForm(options);
});