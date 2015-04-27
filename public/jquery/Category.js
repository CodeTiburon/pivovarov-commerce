$(document).ready(function(){
    var li = $("#tree li");
    var myinput = $("#text");

            li.on('click', function(event){
            event.stopPropagation(); // отменяем всплытие пузырька
            li.removeClass('selected'); // отменяем выделение прошлых элементов
            $(this).addClass('selected'); // выделяем текущий элемент
            myinput.show(1000);
            var targ = $(this).data('id');
                

                // отправляем категорию
            $('#CategoryCreateButton').on('click',function(event){
                var text =  $('input[type="text"]').val();
            $.get("admin/addchild", { id : targ, name : text})  // отправляем Id и name На сервер
                .done(function(data) {
                    //alert(data);
                })
                    .fail(function(jqXHR) {
                    var responseText = jqXHR.responseText;
                    var feedback = JSON.parse(responseText).name
                    $('#errormessage').text(feedback);
                });
            });
                $('#CategorySiblingCreateButton').on('click',function(event){
                    var text =  $('input[type="text"]').val();
                    $.get("admin/addsibling", { id : targ, name : text})  // отправляем Id и name На сервер
                        .done(function(data) {
                        })
                        .fail(function(jqXHR) {
                            var responseText = jqXHR.responseText;
                            var feedback = JSON.parse(responseText).name
                            $('#errormessage').text(feedback);
                        });
                });
            });


    $('h3 #dell').on('click',function(event){
        alert('Hello');
        //$.get("admin/dell", {id : targ})  // отправляем Id на сервер
        //    .done(function (data) {
        //        alert(data);
        //    });


        });

});