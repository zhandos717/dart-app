<?
include ("../../bd.php");
if ( isset($_SESSION['logged_user']) && $_SESSION['logged_user']->status ==3) : 
    $active_call = 'active'; 
    include "header.php";include "menu.php";
    $month = (int) htmlentities($_GET['month']);
    switch ($month) {
        case '11':
            $month = '2020-11-01';
            $month1 = '2020-11-30';
            break;
        case '12':
            $month = '2020-12-01';
            $month1 = '2020-12-31';
            break;
        case '1':
            $month = '2021-01-01';
            $month1 = '2021-01-31';
            break;
        case '2':
            $month = '2021-02-01';
            $month1 = '2021-02-28';
            break;
        default: 
            # code...
            break; } ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Отчет по звонкам </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="index.php">Регионы</a></li>
            <li class="active">Филиалы</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Отчет по сотрудникам </h3>
                    </div><!-- /.box-header -->
                    <div class="col-xs-12">
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="info">
                                        <th class="text-center">Дата</th>
                                        <th><span class="label label-danger">Оператор 1</span><br> Рахат</th>
                                        <th><span class="label label-danger">Оператор 2</span><br>Алемгуль</th>
                                        <th><span class="label label-danger">Оператор 3</span><br>Ринат</th>
                                        <th><span class="label label-danger">Оператор 4</span><br>Айсулу</th>
                                        <th><span class="label label-danger">Оператор 5</span><br>Назар</th>
                                        <th><span class="label label-danger">Оператор 6</span><br>Назира</th>
                                        <th><span class="label label-danger">Оператор 7</span><br>Санжар</th>
                                        <th><span class="label label-danger">Оператор 8</span><br>Алина</th>
                                        <th>ИТОГ</th>
                                        <th>Филиалы</th>
                                        <th>ИТОГ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?  $tables = $pdo->query("SELECT datereport,
                                    SUM(operator1),SUM(operator2),SUM(operator3),
                                    SUM(operator4),SUM(operator5),SUM(operator6),
                                    SUM(operator7),SUM(operator8),SUM(filial),SUM(shop)
                                    FROM callreports WHERE datereport BETWEEN '$month' AND '$month1' GROUP BY datereport")->fetchAll(PDO::FETCH_BOTH);
                                        foreach ($tables as $table) {
                                        $datereport= $table['datereport'];
                                    ?>
                                    <tr>
                                        <td><?= date('d.m.Y', strtotime($datereport)); ?>
                                        </td>
                                        <?$i =1; while($i<=8):?>
                                        <td>
                                            <? $total = $table['SUM(operator'.$i++.')']; 
                                  echo $total; 
                                $total1 +=$total;
                              ?>
                                            <?endwhile;?>
                                        </td>
                                        <td class="success">
                                            <?= $total1; ?>
                                        </td>
                                        <td>
                                            <?= $table['SUM(filial)']; ?>
                                        </td>
                                        <td class="warning">
                                            <?echo $total1+$table['SUM(filial)'];   unset($total1);?>
                                        </td>
                                    </tr>
                                    <?}?>
                                </tbody>
                                <tfoot>
                                    <?
                          $result = $pdo->query("SELECT 
                          SUM(operator1),SUM(operator2),SUM(operator3),
                          SUM(operator4),SUM(operator5),SUM(operator6),
                          SUM(operator7),SUM(operator8),SUM(filial)
                          FROM callreports WHERE datereport BETWEEN '$month' AND '$month1' ")->fetch(PDO::FETCH_ASSOC);
                          ?>
                                    <tr class="danger">
                                        <th>Итого</th>
                                        <?$i =1; while($i<=8):?>
                                        <td>
                                            <? $operator =$result['SUM(operator' . $i++ . ')']; 
                                  echo $operator;
                                  $operator1 += $operator;
                              ?>
                                        </td>
                                        <?endwhile;?>
                                        <td>
                                            <?= $operator1; ?>
                                        </td>
                                        <td><?= $result['SUM(filial)']; ?></td>
                                        <td> <?= $operator1 + $result['SUM(filial)']; ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.content-wrapper -->
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="col-xs-12">
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="info">
                                        <th class="text-center">Дата</th>
                                        <th>День</th>
                                        <th>Ночь</th>
                                        <th>Магазин</th>
                                        <th>Филиал</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                          $result = $pdo->query("SELECT datereport,
                          SUM(operator1),SUM(operator2),SUM(operator3),
                          SUM(operator4),SUM(operator5),SUM(operator6),
                          SUM(operator7),SUM(operator8),SUM(filial),SUM(shop)
                          FROM callreports WHERE datereport BETWEEN '$month' AND '$month1'  GROUP BY datereport")->fetchAll(PDO::FETCH_BOTH);
                          ?>
                                    <? foreach ($result as $n): 
                             $datereport = $n['datereport'];
                             $result11 = $pdo->query("SELECT 
                          SUM(operator1),SUM(operator2),SUM(operator3),
                          SUM(operator4),SUM(operator5),SUM(operator6),
                          SUM(operator7),SUM(operator8)
                          FROM callreports WHERE days = '1' AND datereport = '$datereport' ")->fetch(PDO::FETCH_ASSOC);
                            ?>
                                    <tr>
                                        <td><?= date('d.m.Y', strtotime($datereport)); ?></td>
                                        <td>
                                            <?$i =1;$c =1; while($i<=8):?>
                                            <?  $op = $result11['SUM(operator' . $i++ . ')'];
                                  $op2 = $n['SUM(operator'.$c++.')']; 
                                  $op3 += $op2-$op;
                                  $op1 += $op;
                              ?>
                                            <?endwhile;?>
                                            <?echo $op1;  ?>
                                        </td>
                                        <td>
                                            <?= $op3;
                                            $op44 += $op3;
                                            $op11 += $op1;
                                            unset($op3, $op1); ?>
                                        </td>
                                        <td> <?= $n['SUM(shop)']; ?>
                                            <? $sh +=$n['SUM(shop)']; ?>
                                        </td>
                                        <td> <?= $n['SUM(filial)']; ?>
                                            <? $fl +=$n['SUM(filial)']; ?>
                                        </td>
                                    </tr>
                                    <? endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr class="warning">
                                        <th>Общее</th>
                                        <td>
                                            <?= $op11; ?>
                                        </td>
                                        <td>
                                            <?= $op44; ?>
                                        </td>
                                        <td>
                                            <?= $sh; ?>
                                        </td>
                                        <td> <?= $fl; ?> </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col-md-6 -->
            <div class="col-md-6">
                <div class="box box-primary">
                    <!--  <div class="box-header">
                    <h3 class="box-title">Проторгованные товары</h3> -->
                    <!--</div> /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="danger">
                                        <th>Дата</th>
                                        <th>КЦ</th>
                                        <th>Филиалы</th>
                                        <th>Общее</th>
                                    </tr>
                                </thead>
                                <?
                          $result = $pdo->query("SELECT datereport,
                          SUM(operator1),SUM(operator2),SUM(operator3),
                          SUM(operator4),SUM(operator5),SUM(operator6),
                          SUM(operator7),SUM(operator8),SUM(filial),SUM(shop)
                          FROM callreports WHERE datereport BETWEEN '$month' AND '$month1' GROUP BY datereport")->fetchAll(PDO::FETCH_BOTH);
                          ?>
                                <tbody>
                                    <?foreach ($result as $n): ?>
                                    <tr>
                                        <td><?= date('d.m.Y', strtotime($n['datereport'])); ?></td>
                                        <td>
                                            <?$i =1;$c =1; while($i<=8):?>
                                            <?  $op += $n['SUM(operator'.$i++.')'];?>
                                            <?endwhile;?>
                                            <?= $op; ?>
                                        </td>
                                        <td>
                                            <?= $n['SUM(filial)']; ?>
                                        </td>
                                        <td>
                                            <?= $n['SUM(filial)'] + $op; ?>
                                            <? $op1 +=$op;  unset($op); ?>
                                        </td>
                                    </tr>
                                    <?endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr class="warning">
                                        <th>Итого</th>
                                        <th><?= $op1; ?></th>
                                        <th><?= $fl; ?></th>
                                        <th><?= $op1 + $fl; ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </section>
</div><!-- /.content-wrapper -->
<?include "footer.php";
  else:
  header('Location: ../../index.php');
  endif; ?>