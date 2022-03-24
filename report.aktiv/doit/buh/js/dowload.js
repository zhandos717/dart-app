       $(document).ready(function() {


            $('.btn-danger').click(function() {
                var report = $('#report').val();
                var date1 = $('#date1').val();
                var date2 = $('#date2').val();
                var region = $('#get_region').val();
                var filial = $('#adress').val();
                $("#answer").addClass('text-center').text('Идет загрузка подождите....');
                $.post("functions/upload_report.php", { //functions/upload_report.php
                        report: report,
                        date1: date1,
                        date2: date2,
                        region: region,
                        filial: filial
                    }) 
                    .done(function(data) {
                        //alert('ghb');
                        $('#answer').html(data);
                    });
            });

        }); 

        $(function() {
            $('form#kassa').submit(function(e) {
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