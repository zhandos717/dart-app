         $(".black_list").click(function() {
                        var value = $(this).data('value');
                        var tr = $(this).parents('tr');

                        var isBoss = value == '1' ? prompt('Отправить в черный список клиента ?') : confirm('Вернуть из черного списка?');
                        
                        
                        if (isBoss) {
                            var id = $(this).data('id');
                            $.post("../function/search_clients.php", {
                                    delete_id: id,
                                    value: value,
                                    message: isBoss
                                })
                                .done(function(data) {
                                    console.dir(data)
                                })
                                .fail(function(err) {
                                    alert("Ошибка: " + err);
                                });
                            value == '1' ? tr.addClass('danger') : tr.removeClass('danger');
                        }
                    })