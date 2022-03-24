    $(document).ready(function() {

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
        e.preventDefault();
      });


    });