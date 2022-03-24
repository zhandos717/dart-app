$( document ).ready(function() {

    $('form#search_form').submit(function(event) {
        var search = $('#search_сontent').val();
            $(".answer").addClass('text-center').text('Идет загрузка подождите....');
                $.post("functions/upload_report.php", { //functions/upload_report.php
                    search : search
                    })
                    .done(function(data) {
                        $('.answer').html(data);
                    });
        event.preventDefault();
    });


$(function() {
    $('form#report').submit(function(e) {
    var $form = $(this);
    $.ajax({
    type: $form.attr('method'),
    url: $form.attr('action'),
    data: $form.serialize()
    }).done(function(data) {
        $('.answer').html(data);
    }).fail(function() {
    alert('Ошибка');
    });
    e.preventDefault(); //отмена действия по умолчанию для кнопки submit
    });
    });  
}); 

