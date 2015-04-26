$(document).ready(function(){
    var li = $("#tree li");
    var myinput = $("#text");
        li.on('click', function(event){
            event.stopPropagation(); // отменяем всплытие пузырька

            li.removeClass('text-primary'); // отменяем выделение прошлых элементов
            $(this).addClass('text-primary'); // выделяем текущий элемент

            myinput.empty();  // удаляем инпут если он уже есть
            myinput.append('<div class="actives">Введите имя ктегории</div><div><input type="text" width="120" height="10"></input></div>');
            myinput.append('<button id="CategoryDeleteButton" type="submit" class="btn btn-danger"> Удалить</button>')
            myinput.append('<button id="CategoryCreateButton" type="submit" class="btn btn-primary">Отправить</button>')
            var targ = $(this).data('id');

            $('#CategoryCreateButton').on('click',function(event){
                var text =  $('input[type="text"]').val();
            $.get("admin/update", { "id": targ, "name":text})  // отправляем данные
                .done(function(data) {
                    alert(data[0].name);
                });
            });

            $('#CategoryDeleteButton').on('click',function(event){
                var text =  $('input[type="text"]').val();
                $.get("admin/dell", { "id": targ, "name":text})  // отправляем данные
                    .done(function(data) {
                        alert(data[0].name);
                    });
            });
        });

});