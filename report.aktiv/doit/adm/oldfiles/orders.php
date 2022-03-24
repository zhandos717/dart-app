<? //проверка существовании сессии
include("../../bd.php");
include "header.php";
include 'menu.php'
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Заказы
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Таблица заказов</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Номер заказа</th>
                                        <th>Клиент</th>
                                        <th>Номер телефона</th>
                                        <th>Адрес</th>
                                        <th>Сообщение</th>
                                        <th>Время заказа</th>
                                        <th>Статус заказа</th>
                                        <th>Примечание</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                        $orders = R::findall('zakaz','ORDER BY id DESC');
                                        $i = 1;
                                        foreach ($orders as $key) {?>
                                    <tr>
                                        <td> <?= $i++ ?></td>
                                        <td><?= $key['numberzakaz']; ?></td>
                                        <td><?= $key['fio']; ?></td>
                                        <td><?= $key['tel']; ?></td>
                                        <td> <?= $key['city']; ?> <?= $key['adres']; ?></td>
                                        <td><?= $key['message']; ?>
                                            <?= $key['tovarname']; ?> :
                                            <?= $key['cena']; ?>
                                        </td>
                                        <td><?= date('H:i:s d.m.Y', strtotime($key['segdata'])) ?></td>
                                        <td> <?= $key['status']; ?> </td>
                                        <td><?= $key['description']; ?></td>
                                    </tr>
                                    <? }?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<? include "footer.php"; ?>