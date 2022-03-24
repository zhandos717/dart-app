
$(function() {
            $('form').submit(function(e) {
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
            //отмена действия по умолчанию для кнопки submit
            e.preventDefault(); 
            });
            }); 

$(document).ready(function() {
$('.update_payment').click(function () {
    var id = $(this).val();
    $.post( "/doit/function/payment.php", { id_update: id})
    .done(function( data ) {
      // $('.overlay').remove();
      // $('.modal-body').text(id);
       $('.modal-body').html(data);
    });
});
}); 

$('.delete_payment').click(function() {
  var id = $("input[name='id_update_payment']").val();
  $.post( "/doit/function/payment.php", { id_delete: id})
  .done(function( data ) {
    //$('.modal-body').text(id);
  $('.modal-body').html(data);
  });
});

$(function() {
    $('.submit').click(function(e) {
    //$( ".close" ).trigger( "click" );
      var $form = $('form#update_pay');
    
    $.ajax({
    type: $form.attr('method'),
    url: $form.attr('action'),
    data: $form.serialize()
    }).done(function(data) {
      $('.modal-body').html(data);
    }).fail(function() {
    alert('Ошибка');
    });

    $('.modal-body').text('Привет');
    //отмена действия по умолчанию для кнопки submit
    e.preventDefault(); 
    });
});