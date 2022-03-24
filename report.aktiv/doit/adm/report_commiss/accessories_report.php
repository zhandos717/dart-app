    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
                                <table class="table table-hover table-bordered" id="datatable-tabletools">
                                    <thead>
                                        <tr class="bg-olive">
                                            <th>№</th>
                                            <th>Код товара</th>
                                            <th>Адрес</th>
                                            <th>Описание</th>
                                            <th>Дата поступлния в магазин</th>
                                            <th>Сумма прихода</th>
                                            <th>Сумма продажи</th>
                                            <th>Срок на продаже</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? $data = R::find('tickets','status = ? OR status = ? OR status = ? OR status = ? ORDER BY dv ASC',[7,10,14,15]);
                         $i = 1;
                         foreach($data as $param){
                         $day = (int) round((strtotime(date('Y-m-d')) - strtotime($param['dv'])) / (60 * 60 * 24));
                          
                        if($day < 7 ){$color1 = 'blue'; $count += 1;}
                        elseif($day > 7 AND  $day < 14){$color1 = 'blue'; $count11 += 1;}
                        elseif($day >= 14 AND $day < 21){ $color = 'success'; $color1 = 'olive'; $count1 += 1; }
                        elseif($day >= 21 && $day < 30){$color = 'warning'; $color1 = 'yellow'; $count2 += 1;}
                        elseif($day >= 30){$color = 'danger'; $color1 = 'red'; $count3 += 1;}
                      ?>
                                        <tr class="<?= $color; ?>">
                                            <td> <?= $i++; ?>.</td>
                                            <td> <?= $param['nomerzb']; ?></td>
                                            <td> <?= $param['region']; ?>-<?= $param['adressfil']; ?></td>
                                            <td>
                                                <? echo $param['type'] .'  '. $param['category'] .'  '. $param['tovarname'] .'  '. $param['opisanie'] .'  '. $param['hdd']; ?>
                                            </td>
                                            <td> <?= date('d.m.Y', strtotime($param['dv'])); ?></td>
                                            <td> <?= $param['summa_vydachy']; ?></td>
                                            <td> <?= $param['cena_pr']; ?></td>
                                            <td>
                                                <span class="badge bg-<?= $color1; ?>">
                                                    <? echo $day; unset($color,$color1);?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?}?>
                                    </tbody>
                                    </tfoot>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box box-primary -->
                    <!--------------------------------------------------------------------------->
                </div>
                <div class="col-md-6">
                    <!-- DONUT CHART -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Анализ в графике</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="productChart" style="height:250px"></canvas>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
        </section>
    </div><!-- /.content-wrapper -->