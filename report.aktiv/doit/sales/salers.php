<?php
include("../../bd.php");
include "../layouts/header.php";
include 'menu.php';

if ($_SESSION['logged_user']->status == 5) :
    $result = R::findAll('saler', 'region=? AND shop=?', [$region, $adress]); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Список продавцов </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div style="display: none;" class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
                        <h4><i class="icon fa fa-check"> </i> Данные добавлены!</h4>
                        Для проверки обновите страницу
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <button class="btn btn-success update" data-toggle="modal" data-target="#exampleModal"> Добавить сотрудника </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="col-xs-12">
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr class="bg-olive">
                                            <th>№</th>
                                            <th>Ф.И.О</th>
                                            <th>Город</th>
                                            <th>Адрес</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                        $i = 1;
                                        foreach ($result as $key) {
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?> </td>
                                                <td><?= $key['fiosaler']; ?></td>
                                                <td><?= $key['region']; ?></td>
                                                <td><?= $key['shop']; ?></td>
                                                <td><a class="btn btn-danger" href="functions/delete_saler.php?id=<?= $key['id'] ?>" onclick="return confirm('Вы уверены?') "> <i class="fa fa-times-circle" aria-hidden="true"></i> </a></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col-md-6 -->
            </div><!-- /.content-wrapper -->
        </section>
    </div>
    <div class="modal" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Изменение данных</h4>
                </div>
                <form action="functions/edit_saler.php" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fiosaler">Ф.И.О</label>
                                    <input type="text" class="form-control" id="fiosaler" required autocomplete="off" name="fiosaler" placeholder="Фамилия Имя Отчество">
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
<? endif;
include "../layouts/footer.php"; ?>