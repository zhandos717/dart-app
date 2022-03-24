<?
include("../../bd.php");
if ($status == 3) :
    include "header.php";
    include "menu.php";
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
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <input type="text" class="form-control" placeholder="Поиск..." name="search" />
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
                                        <th>Примечание</th>
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
                                        <td><?= $data['message']; ?></td>
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
                <script src="/assets/js/black_list.js"></script>
                <script>
                    $('[name=search]')
                        .keyup(function() {
                            var data = $(this).val();
                            $.post('../function/search_clients.php', {
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
<? include "footer.php";
else :
    header('Location: /index.php');
endif; ?>