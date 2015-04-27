$(document).ready(function(){
    var li = $("#tree li");
    var myinput = $("#text");
        li.on('click', function(event){
            event.stopPropagation(); // отменяем всплытие пузырька

            li.removeClass('selected'); // отменяем выделение прошлых элементов
            $(this).addClass('selected'); // выделяем текущий элемент
            myinput.show(3000);

            //myinput.empty();  // удаляем инпут если он уже есть
            //myinput.append('<div class="actives">Введите имя ктегории</div><div><input type="text" width="120" height="10"></input></div>');
            //myinput.append('<button id="CategoryCreateButton" type="submit" class="btn btn-primary">Отправить</button>')

            var targ = $(this).data('id');

            $('#CategoryCreateButton').on('click',function(event){
                var text =  $('input[type="text"]').val();
            $.get("admin/add", { "id": targ, "name":text})  // отправляем Id и name На сервер
                .done(function(data) {
                    alert(data[0].name);
                });
            });

            $('#dell').on('click',function(event){
                var conf = confirm("Точно удалить?")
                if(conf) {
                    $.get("admin/dell", {"id": targ})  // отправляем Id на сервер
                        .done(function (data) {
                            alert(data[0].name);
                        });
                }
            });

        });

});