<? include_once "../../bd.php";
if ($_SESSION['logged_user']->status == 10) :
    include "header.php";
    include "menu.php";
    $region = R::findAll('kassa', 'region <> "Тест" GROUP BY region');
?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Финансовые передвижения</h1>
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
                    <div class="box box-success">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </div>
                                        <select class="form-control" id="report">
                                            <option value="1">Проданные акссесуары || productreport </option>
                                            <option value="2">Комиссионные договоры Выдача || tickets</option>
                                            <option value="4">Комиссионные договоры Возврат || tickets</option>
                                            <option value="5">Комиссионные договоры Продажа || tickets</option>
                                            <option value="6">Проданные товары || salecomision</option>
                                            <!-- <option value="7">Продажи декабрь || sales12</option> -->
                                            <!-- <option value="8">Продажи январь,февраль || sales</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-university"></i>
                                        </div>
                                        <select class="form-control" id="get_region">
                                            <? 
                                            foreach ($region as $city) {
                                                echo "<option>{$city['region']}</option>";
                                            } ?>
                                            <option value="">Все</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-university"></i>
                                        </div>
                                        <select class="form-control" id="adress">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-3 col-md-3  col-sm-3">
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="date1" style="width: 16rem;" min="2020-08-19" max="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" name="date1">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="date2" style="width: 16rem;" min="2020-08-19" max="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" name="date2">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="input-group input-group-sm">
                                        <button class="btn-danger btn col-md-12">Подтвердить!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                        </div>
                        <div class="box-body">
                            <div id="answer">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Данных в таблице нет</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<? include "footer.php";
else :
    header('Location: index.php');
endif; ?>