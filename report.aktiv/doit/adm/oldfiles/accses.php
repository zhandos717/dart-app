<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
include "header.php";
    $comis_shop = 'active';
include "menu.php";?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Сведения по реализованным товарам
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
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Выберите период</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="functions/report/report_sales_acces.php" id="report" method="POST">
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="input-group">
                                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="date1">
                                </div>
                                <!-- /input-group -->
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="input-group">
                                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="date2">
                                </div>
                                <!-- /input-group -->
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-bank"></i>
                                    </span>
                                    <select class="form-control" id="List1" name="region">
                                        <option value="">Выберите город</option>
                                        <? $res = R::findAll('productreport','GROUP BY region ORDER BY datereg ASC'); 
                                        foreach ($res as $key => $value) {?>
                                        <option value="<?= $value['region'] ?>">
                                            <?= $value['region'] ?>
                                        </option>
                                        <?}?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cc-visa"></i>
                                    </span>
                                    <select class="form-control" name="payment">
                                        <option value="">Все способоы оплаты</option>
                                        <option value="1">Наличный</option>
                                        <option value="2">Без наличный</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group input-group-sm">
                                <!-- <span class="input-group-btn">     </span> -->
                                <button type="submit" class="btn-success btn ">Подтвердить!</button>
                            </div>
                        </form>
                    </div>
                    <!--.box-body -->
                </div>
                <!--.box -->
            </div>
            <div class="answer">

            </div>
        </div><!-- /.content-wrapper -->
    </section>
</div>
<!--.col-md-12 -->

<?include 'footer.php';
else:
header('Location: ../../index.php');
endif; ?>