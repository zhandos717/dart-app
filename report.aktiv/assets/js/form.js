$(document).ready(function() {
	$('form').submit(function(event) {
		var json;
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
					json = jQuery.parseJSON(result);
					if (json.url) {
						window.location.href = '/' + json.url;
					} else {
						alert('Ошибка: ' + json.message);
					} 
			},
		});
	});
});

    $(".delete").click(function() {
        var isBoss = confirm('Удалить данные ?');
        var tr = $(this).parents('tr');
        if (isBoss) {
            var id = $(this).data('id');
            var table = $(this).data('table');
            $.post("functions/search.php", {
                    delete_id: id,
                    table: table
                })
                .done(function(data) {
                    console.dir(data)
                })
                .fail(function(err) {
                    alert("Ошибка: " + err);
                });
            tr.addClass('danger');
        }
    })

