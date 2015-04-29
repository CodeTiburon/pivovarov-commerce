$(document).ready(function(){
    var myinput = $("#text");
    var $_token = $('#token').val();
    //var clicLi = function(event) {
    //                    event.stopPropagation(); // отменяем всплытие пузырька
    //                    li.removeClass('selected'); // отменяем выделение прошлых элементов
    //                    $(this).addClass('selected'); // выделяем текущий элемент
    //                    myinput.show(1000);
    //                    targ = $(this).data('id');
    //            }

                //ВЫБИРАЕМ КАТЕГОРИЮ И ЕЕ ID
            $(document).on('click', "#tree li", function(event) {
                event.stopPropagation(); // отменяем всплытие пузырька
                $('li').removeClass('selected'); // отменяем выделение прошлых элементов
                $(this).addClass('selected'); // выделяем текущий элемент
                myinput.show(1000);
                targ = $(this).data('id');
            });


                    //ДОБАВЛЯЕМ ПОДКАТЕГОРИЮ
    $('#CategoryCreateButton').on('click',function(event){
        var text =  $('#categ').val();
        var request = $.ajax({
                url: "admin/addchild",
                method: "POST",
                headers: { 'X-XSRF-TOKEN' : $_token },
                data: { id : targ, name : text }
            });
            request.done(function(data) {
                var element = $("#tree li[data-id="+data.parent_id+"]");

                if(element.children().length < 3) {
                    $("<ul>"+data.html+"</ul>").appendTo(element);
                }
                else {
                    element = $("#tree li[data-id="+data.parent_id+"] > ul");
                    $(data.html).appendTo(element);
                }
            });
            request.fail(function(jqXHR) {
                         var responseText = jqXHR.responseText;
                         var feedback = JSON.parse(responseText).name
                         $('#errormessage').text(feedback);
                     });
        });

                  //ДОБАВЛЯЕМ КАТЕГОРИЮ НА ТОТ ЖЕ УРОВЕНЬ
    $('#CategorySiblingCreateButton').on('click',function(event){
        var text =  $('#categ').val();
        var request = $.ajax({
            url: "admin/addsibling",
            method: "POST",
            headers: { 'X-XSRF-TOKEN' : $_token },
            data: { id : targ, name : text }
        });
        request.done(function(data) {
           var element = $("#tree li[data-id="+data.selected_id+"]");
            $(data.html).insertAfter(element);
        });
        request.fail(function(jqXHR) {
            var responseText = jqXHR.responseText;
            var feedback = JSON.parse(responseText).name
            $('#errormessage').text(feedback);
        });
        });



                    //УДАЛАЯЕМ ЭЛЕМЕНТ

    $(document).on('click',"h3 #dell",function(event){
        event.stopPropagation();
        $(myinput).hide(1000);
        $('#myModal').modal('show');
        $('#confirm').on('click',function(event){
        $('#myModal').modal('hide');
            var request = $.ajax({
                url: "admin/dell",
                method: "POST",
                headers: { 'X-XSRF-TOKEN' : $_token },
                data: { id : targ }
            });
                request.done(function(data) {
                    var element = $("#tree li[data-id="+data.selected_id+"]");
                    element.hide();
                });
                request.fail(function(jqXHR) {
                    var responseText = jqXHR.responseText;
                    var feedback = JSON.parse(responseText).name
                    $('#errormessage').text(feedback);
                });
        });
    });
});