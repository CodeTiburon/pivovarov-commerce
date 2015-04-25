$(document).ready(function(){
var li = $("li");
    li.click(function(event){
        event.stopPropagation();
        li.removeClass('text-primary');

        $(this).addClass('text-primary');
        var targ = $(this).data('id');
        alert(targ);
    });
});