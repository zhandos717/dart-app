<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 10) :
    include "header.php";
    include "menu.php";?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Финансовые передвижения
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="index.php">Регионы</a></li>
                <li class="active">Филиалы</li>
            </ol>
        </section>
        <!-- Main content --> 
        <section class="content">
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <!--box -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="datatable-tabletools" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Регион</th>
                                <th>Адрес</th>
                                <th>Касса</th>
                                <th>Сумма на начало дня</th>
                                <th>Сумма на конец дня</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = R::findAll('kassa', "region <> 'Тест' AND cashbox > 0 ORDER BY cashbox DESC"); //WHERE status = 1 OR status = 2
                            $i = 1;
                            foreach ($result as $data) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $data['region'] ?></td>
                                    <td><?= $data['filial'] ?></td>
                                    <td><?= $data['kassa'] ?></td>
                                    <td><?= $data['startamount'] ?></td>
                                    <td><?= $data['cashbox'] ?></td>
                                </tr>
                            <? }; ?>
                        </tbody>
                    </table>
                </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<? include "footer.php";
else :
    header('Location: /');
endif; ?>