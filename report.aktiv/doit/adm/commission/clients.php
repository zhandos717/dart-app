<?php
    include __DIR__ . '/../../../bd.php';
    if ($status != 3)header('Location: /index.php');


    include __DIR__.'/../../layouts/header.php';
    include '../menu.php';
    $result = R::findAll('tickets', 'status = 12 GROUP BY iin  ORDER BY id DESC');

?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
            </ol>
        </section>
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Поиск клиентов</h3>
                            <button class="btn btn-success add" data-toggle="modal" data-target="#exampleModal"> Добавить </button>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                        <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                        <button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                        </button>
                        </div>
                        </div>
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Клиенты </h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body answer">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="info">
                                        <th>№</th>
                                        <th>Дата выдачи документа</th>
                                        <th>ИИН</th>
                                        <th>Ф.И.О</th>
                                        <th>Телефон</th>
                                        <th>Номер документа</th>
                                        <th>Орган выдачи</th>
                                        <th>Адрес</th>
                                        <th>Дом</th>
                                        <th>Квартира</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <? $i = 1;
                                foreach ($result as $data) {
                                    $client = R::findOne('clients', 'iin=?', [$data['iin']]);
                                ?>
                                    <tr <? if ($client['status'] == 1) {
                                            echo 'class="danger"';
                                        }; ?>>
                                        <td><?= $i++; ?>.</td>
                                        <td><?= date("d.m.Y", strtotime($data['date_vyd'])); ?></td>
                                        <td><?= $data['iin']; ?></td>
                                        <td><?= $data['fio']; ?></td>
                                        <td><?= $data['phones']; ?></td>
                                        <td><?= $data['numberdocs']; ?></td>
                                        <td><?= $data['kemvydan']; ?></td>
                                        <td><?= $data['adress']; ?></td>
                                        <td><?= $data['dom']; ?></td>
                                        <td><?= $data['kvartira']; ?></td>
                                        <td>
                                            <? if ($client['status'] != 1) : ?>
                                                <button class="btn btn-danger black_list" data-value='1' data-id="<?= $data['id']; ?>" title="В черный список"> <i class="fa fa-times" aria-hidden="true"></i> </button>
                                            <? else : ?>
                                                <button class="btn btn-primary black_list" data-value='2' data-id="<?= $data['id']; ?>" title="Вернуть из черного списка"> <i class="fa fa-rotate-left" aria-hidden="true"></i> </button>
                                            <? endif; ?>
                                        </td>
                                    </tr>
                                <? } ?>
                            </table>
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->

                <div class="modal" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Добавление</h4>
                            </div>
                            <form action="../function/add_black_list_client.php" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="Full_name">Ф.И.О</label>
                                        <input type="text" class="form-control" id="Full_name" required name="fio" placeholder="Фамилия Имя Отчество">
                                    </div>
                                    <div class="form-group">
                                        <label for="fio">ИИН</label>
                                        <input type="number" class="form-control" name="iin" id="iin" minlength="12" maxlength="12" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="document_number">Номер уд/парспорт <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="document_number" name="document_number" required placeholder="012346789">
                                    </div>
                                    <div class="form-group">
                                        <label for="document_issue_date">Дата выдачи документа</label>
                                        <input type="date" id="document_issue_date" class="form-control" id="document_issue_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="issued_by">Орган выдачи</label>
                                        <select name="issued_by" id="issued_by" class="form-control">
                                            <option>МВД-РК</option>
                                            <option>МЮ-РК</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="reason_blocking">Причина блокировки</label>
                                        <textarea name="reason_blocking" id="reason_blocking" class="form-control" required></textarea>
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

                <script src="/assets/js/black_list.js"></script>
                <script>
                    $('[type="submit"]')
                        .keyup(function() {
                            var data = $(this).val();
                            $.post('../../function/search_clients.php', {
                                    search: data
                                })
                                .done(function(data) {
                                    $('.answer').html(data);
                                })
                                .fail(function(data) {
                                    alert('Ошибка отправки' + data)
                                })
                        });
                </script>
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php include "../footer.php"; ?>