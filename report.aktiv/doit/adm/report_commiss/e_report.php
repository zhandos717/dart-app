    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="index.php">Регионы</a></li>
                <li class="active">Филиалы</li>
            </ol>
            <br>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!--------------------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <!--<div class="box-header">
                <h3 class="box-title"><b></b></h3>
              </div> /.box-header -->
                        <div class="box-body">
                            <div class="">
                                <!--table-responsive-->
                                <table class="table table-hover table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th> <span class="rotate">Регион</span> </th>
                                            <th>По базе</th>
                                            <th>Товары 2019 г. </th>
                                            <th>Товары 2020 г. </th>
                                            <th>В магазине</th>
                                            <th>Дефектные</th>
                                            <th>Недостача</th>
                                            <th>Не проторгованные</th>
                                            <th>Проданные в минус</th>
                                            <th>Проходящие по делу</th>
                                            <th>Перемешение на бк </th>
                                            <th>Kcell блокировка </th>
                                            <th>Дефектные у директоров </th>
                                            <th>Шубы в аукционисте техники </th>
                                            <th>Вылезли с баланса итд из за сбоя </th>
                                            <th>Переданные на диогностику в Астану </th>
                                            <th>Не установлены цены</th>
                                            <th>Итог</th>
                                            <th>Другое </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </tfoot>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box box-primary -->
                </div>
                <!--------------------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <!--<div class="box-header">
                <h3 class="box-title"><b></b></h3>
              </div> /.box-header -->
                        <div class="box-body">
                            <div class="">
                                <!--table-responsive-->
                                <table class="table table-hover table-bordered" id="datatable-tabletools">
                                    <?$i= 1; $data = R::find('sales12','GROUP BY region');?>
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Критерий</th>
                                            <? foreach( $data as $res): ?>
                                            <th><?= $res['region']; ?></th>
                                            <? endforeach;?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1</th>
                                            <th>По базе</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>2</th>
                                            <th>Товары 2019 г.</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>3</th>
                                            <th>Товары 2020 г.</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>4</th>
                                            <th>В магазине</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tbody>
                                    </tfoot>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box box-primary -->
                </div>
                <!--------------------------------------------------------------------------->
        </section>
    </div><!-- /.content-wrapper -->