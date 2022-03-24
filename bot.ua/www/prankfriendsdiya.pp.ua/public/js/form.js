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
					console.dir(result);
					json = jQuery.parseJSON(result);
					if (json.url) {
						window.location.href = '/' + json.url;
					} else {
						if(json.status == 'success'){
							$("form")[0].reset();
							$( ".btn-close" ).trigger( "click" );
						}
						alert(json.status + ' - ' + json.message);
					}
			},
		});
	});

	$(".delete_user").click(function(){
	var isBoss=	confirm('Удалить данные ?');
	var tr =$(this).parents('tr');
		if(isBoss){
			var id = $(this).data('id');
			var table = $(this).data('table');
			var post = $.post( "/delete",{delete_id:id,table:table }) 
				.done( function(data) {
					console.dir(data)
				})
				.fail(function(err){
					alert( "Ошибка: "+err );
				});
			tr.addClass('table-danger'); 
		}
	})
	$('.sendmessage').click(function(){
			var id = $(this).data('user');
			$('input[name=user_id]').val(id);
	})

	$('.edit_week').click(function(){
			var id = $(this).data('id');
			$('input[name=id_week]').val(id);
	})
});