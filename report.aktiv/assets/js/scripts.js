$(window).load(function() {

    "use strict";

    /*
     ----------------------------------------------------------------------
     Preloader
     ----------------------------------------------------------------------
     */
    $(".loader").delay(400).fadeOut();
    $(".animationload").delay(400).fadeOut("fast");

});

$(document).ready(function() {


        $('#get_region').change(function() {
            var region = $(this).val();
            console.log(region);
            $('#adress').load('/doit/function/get_adress.php', {
            value: region
            });
        });

    $('.sw_btn').on("click", function(){
        $("body").toggleClass("light");
    });
    /*
     ----------------------------------------------------------------------
     Nice scroll
     ----------------------------------------------------------------------
     */
    $("html").niceScroll({
        cursorcolor: '#fff',
        cursoropacitymin: '0',
        cursoropacitymax: '1',
        cursorwidth: '2px',
        zindex: 999999,
        horizrailenabled: false,
        enablekeyboard: false
    });



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