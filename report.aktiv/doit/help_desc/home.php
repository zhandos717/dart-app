<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Заявки </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Приборная панель</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="answer"></div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-success">
                        <!-- <div class="box-header"></div> -->
                        <div class="box-body">
                            <button class="btn btn-success fa fa-plus" data-toggle="modal" data-target="#exampleModal"></button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Исходящие заявки</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Номер заявки</th>
                                            <th>Заказчик</th>
                                            <th>Номер телефона</th>
                                            <th>Сообщение</th>
                                            <th>Примечание</th>
                                            <th>Статус</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $table = R::findAll('applications', 'user=?', [$fio]);
                                        $i = 1;
                                        foreach ($table as $t) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $t['id']; ?></td>
                                                <td><?= $t['user']; ?></td>
                                                <td><?= $t['phone']; ?></td>
                                                <td><?= $t['message']; ?></td>
                                                <td><?= $t['note']; ?></td>
                                                <td><?= $t['status']; ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Добавление заявки</h4>
            </div>
            <form action="../function/add_help_desk.php" method="POST">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department">Отдел</label>
                                <select name="department" id="department" required class="form-control">
                                    <option value="">Выберите отдел</option>
                                    <option>IT-отдел</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Номер телефона для связи</label>
                                <input type="text" class="form-control phone" required name="phone" id="phone" placeholder="+7 777 777 77 77">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" hidden value="<?= $user['id']; ?>" name="user_id">
                                <label for="subject">Тема</label>
                                <input type="text" class="form-control" list="subject_1" name="subject" autocomplete="off" required id="subject" placeholder="Регистрация сотрудника в комиссионном магазине">
                                <datalist id="subject_1">
                                    <option value="Регистрация сотрудника в комиссионном магазине">
                                    <option value="Добавление функционала">
                                </datalist>
                            </div>
                        </div>

                        <div class="col-md-12 modal_input">
                            <div class="form-group  message_input">
                                <label for="message">Сообщение</label>
                                <textarea name="message" class="form-control" id="message" placeholder="Введите сообщение"></textarea>
                            </div>
                            <div class="message_input2">

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Cохранить</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function() {
        $('#subject').change(function() {
            if ($(this).val() == 'Регистрация сотрудника в комиссионном магазине') {
                $('.message_input').css('display', 'none');
                $('.message_input2').css('display', 'block').load('../function/help_desc/add_usert.php');
            } else {
                $('.message_input2').css('display', 'none');
                $('.message_input').css('display', 'block');
            }
        });
        $('form').submit(function(e) {
            var $form = $(this);
            $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: $form.serialize()
                })
                .done(function() {
                    var out = '<div class="alert alert-success alert-dismissable">';
                    out += ' <button type ="button" class ="close" data-dismiss="alert" aria-hidden="true" > &times; </button>';
                    out += '<h4 ><i class="icon fa fa-check"> </i> Данные добавлены!</h4>';
                    out += 'Для проверки обновите страницу';
                    out += '</div> ';
                    $('.answer').html(out);
                })
                .fail(function(er) {
                    $('.answer').html(er);
                });
            $('.close').trigger("click");
            e.preventDefault();
        });
        function getTable() {
            $.post('../function/help_desc/get_help_table.php')
                .done(function(date) {
                    var out = '';
                    var i = 1;
                    for (t in date) {
                        out += `<tr><td>${i++}.</td>`
                        out += `<td>${date[t].id}</td>`
                        out += `<td>${date[t].user}</td>`
                        out += `<td>${date[t].phone}</td>`
                        out += `<td>${date[t].message}</td>`
                        out += `<td>${date[t].note}</td>`
                        out += `<td>${date[t].status}</td></tr>`
                    }
                    $('tbody').html(out);
                })
        };
        setInterval(() => getTable(), 5000);
    });
    window.addEventListener("DOMContentLoaded", function() {
        [].forEach.call(document.querySelectorAll('.phone'), function(input) {
            var keyCode;

            function mask(event) {
                event.keyCode && (keyCode = event.keyCode);
                var pos = this.selectionStart;
                if (pos < 3) event.preventDefault();
                var matrix = "+7 (___) ___ ____",
                    i = 0,
                    def = matrix.replace(/\D/g, ""),
                    val = this.value.replace(/\D/g, ""),
                    new_value = matrix.replace(/[_\d]/g, function(a) {
                        return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                    });
                i = new_value.indexOf("_");
                if (i != -1) {
                    i < 5 && (i = 3);
                    new_value = new_value.slice(0, i)
                }
                var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                    function(a) {
                        return "\\d{1," + a.length + "}"
                    }).replace(/[+()]/g, "\\$&");
                reg = new RegExp("^" + reg + "$");
                if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
                if (event.type == "blur" && this.value.length < 5) this.value = ""
            }
            input.addEventListener("input", mask, false);
            input.addEventListener("focus", mask, false);
            input.addEventListener("blur", mask, false);
            input.addEventListener("keydown", mask, false)
        });
    });
</script>