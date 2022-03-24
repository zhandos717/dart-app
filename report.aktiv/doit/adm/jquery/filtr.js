    $(function() {
        $('form').submit(function(event) {
            var url = $(this).attr('action')
            var regions = $('.select3').val();
            var datarange = $('#reservation').val();
            //var data = $form.serialize();
            console.log(url);
             console.log(regions);
            $.post(url, {
                    regions: regions,
                    datarange:datarange
                })
                .done(function(data) {
                    $('.answer').html(data);
                });
            event.preventDefault();
        })
    });