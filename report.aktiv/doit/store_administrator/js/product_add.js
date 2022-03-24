
  $(document).ready(function() {

    $('.fa-trash').click(function() {
      $(this).parents('.col-sm-6').css('display', 'none');
      console.log('Есть');
    });

    $('.fa-edit').click(function() {
      let id = $(this).data('id');
      $.post('./function/get_product.php', {
        id: id
      }).done(function(data) {
        $('.modal-body').html(data);
      })
    });

  });

     $(document).on("submit", "form", function(e){
      e.preventDefault();

      var $form = $(this);

        var data = $form.serialize();
        var file_data = $('#file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

      $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        dataType: 'text',
        data: {data: data, formData: form_data},
       cache:false, // В запросах POST отключено по умолчанию, но перестрахуемся
        contentType: false, // Тип кодирования данных мы задали в форме, это отключим
        processData: false, // Отключаем, так как передаем файл
      }).done(function(answer) {
        console.log(answer);
         $('.answer').text(answer);
         //message(answer);
      }).fail(function(answer) {
        console.log(answer);
        $('.answer').text(answer);
      });
    
      $('.close').trigger("click");  

    });


    function message(answer){
        var out = '<div class="alert alert-'+ answer.class +' alert-dismissable">';
        out += ' <button type ="button" class ="close" data-dismiss="alert" aria-hidden="true" > &times; </button>';
        out += '<h4 ><i class="icon fa fa-'+ answer.icon +' "> </i> '+ answer.type +'!</h4>';
        out += answer.message;
        out += '</div> ';
        $('.answer').html(out);
    }