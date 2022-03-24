
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


                $('#get_region').change(function() {
                // alert('Чет там');
                //alert(region);
                var region = $(this).val();
                console.log(region);
                $('#adress').load('../function/get_adress.php', {
                region: region
                });
                });
    
                $('#get_shop').change(function() {
                    var region = $(this).val();
                    console.log(region);
                    $('#shop').load('../function/get_adress.php', {
                    get_shop: region
                    });
                });

            });  

