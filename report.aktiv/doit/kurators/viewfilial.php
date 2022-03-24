<? include("../../bd.php");
if ($_SESSION['logged_user']->status == 9) :
  $active_lombard = 'active';
  $adress = $_GET['adress'];
  $region = $_GET['region'];
  include "header.php";
  include "menu.php";

  function percent($number)
  {
    $percent = '20';
    return $number - ($number / 100 * $percent);
  }
  $diruser = R::findOne('diruser', 'region = ? AND adress = ? AND status = 1 ', [$region, $adress]);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $region; ?>/<?= $adress; ?>
        <small><a href="index.php">назад к списку</a></small>
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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Отчет директора филиала: <?= $diruser['fio'] ?> <a href="tel:<?= $diruser['phone'] ?>"><?= $diruser['phone'] ?></a> </h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table  class="table table-bordered table-hover">
                  <thead>
                    <tr style="background: #398ebd; color: white;">
             
                      <th>Дата</th>
                      <th>Доход ломбард</th>
                      <th>Доход магазин</th>
                      <!-- <th>ДОХОД КОМИССИОНКИ</th> -->
                      <th>Доп доход</th>
                      <th>Доход</th>
                      <th>Расходы</th>
                      <th>ПРИБЫЛЬ</th>
                      <th>Чистая прибыль (-20%)</th>
                      <th>ЕЖЕДНЕВНЫЙ ПЛАН</th>
                      <th>% Выполнения <br> плана</th>
                      <th>% + - </th>
                      <th>Все клиенты</th>
                      <th>Новые клиенты</th>
                      <th>Выдача за сутки</th>
                    <th>Возврат</th>
                            <th>Накладные</th>
                      <th>Чистая выдача</th>
                      <th>Аукционист техника</th>
                      <th>Аукционист шубы</th>
                      <th>Нал в залоге</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?

                    $result = R::findAll('reports', 'region = ? AND adress = ? ORDER BY data', [$region, $adress]);

                    $datapl = R::findOne('planlombard', 'region = ? AND adress=?', [$region, $adress]);
                    $planden = $datapl['plan'] / date("t");    //еждневный план = Ежемесячный план деленная на 30 дней

                    foreach ($result as $data1) {

                      $summaplanvden = $summaplanvden + $planden;   //сумма плана в день
                      $procent = ($data1['dohod'] * 100) / $planden;                // процент выполнения плана
                      $summaprocent = $summaprocent + $procent;   //общая сумма процентов выполнения плана
                      $kolvozap = $kolvozap + 1;
                      $sredsummapr = $summaprocent / $kolvozap;  // средняя сумма процента
                      $pm =  $procent - 100;  // +- на сколько отстает от плана или перевыполняет

                      $pribl = $data1['dohod'] - $data1['stabrashod'] - $data1['tekrashod'];

                      $chistpribl = percent($pribl);

                      $dl += $data1['dl'];   //  итог доходов ломбардов
                      $dm += $data1['dm'];  // итог доходов 

                      
                    $consumption = R::getRow("SELECT SUM(summarf),comments 
                                              FROM `rashodfillial` 
                                              WHERE region = '$region' 
                                              AND adress = '$adress'
                                              AND datarashoda = '{$data1['data']}'");

                      $auktech = $data1['auktech'];
                      $aukshubs = $data1['aukshubs'];
                      $nalvzaloge = $data1['nalvzaloge'];
                      $auktech_total += $auktech; // Итог аукционист техники
                      $aukshubs_total += $aukshubs;  // Итог аукционист шуб
                      $nalvzaloge_total += $nalvzaloge; // Итог нал залогов

                      $dop += $data1['dop']; // Итог доп дохода
                      $dohod += $data1['dohod']; // Итог доходов
                      $pr = $data1['dohod'] - $data1['stabrashod'] - $data1['tekrashod']; // Итог прибыли
                      $chistaya += $chistpribl;

                      $rashod += $data1['tekrashod'] + $data1['stabrashod']; // Итог расходов
                      $vzs += $data1['vzs'];
                      $chv += $data1['chv']; // Чистая выдача 
                      $allclients += $data1['allclients']; //итог всех клиентов
                      $newclients += $data1['newclients']; //итог новых клиентов
                      $prib_total += $pribl;
                      $planden_total += $planden;
                        $vozvrat += $data1['vozvrat'];
                        $nakladnoy += $data1['nakladnoy'];
                    ?>

                      <tr style="white-space:nowrap;">
                        <td><?= date("d.m.Y", strtotime($data1['data'])); ?></td>
                        <td><?= number_format($data1['dl'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['dm'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['dop'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['dohod'], 0, '.', ' '); ?></td>

                                           <td title="<?= $consumption['comments']; ?>"><?= number_format($consumption['SUM(summarf)'], 0, '.', ' ');
                                                                    $total_consumption +=   $consumption['SUM(summarf)'] ?></td>

                        <td><strong><?= number_format($pribl, 0, '.', ' '); ?></strong></td>
                        <td class="success"><strong><?= number_format($chistpribl, 0, '.', ' '); ?></strong></td>
                        <td><?= number_format($planden, 0, '.', ' '); ?></td>
                        <td><?= number_format($procent, 0, '.', ' '); ?> %</td>
                        <td class="text-red"><?= number_format($pm, 0, '.', ' '); ?> %</td>
                        <td><?= number_format($data1['allclients'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['newclients'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['vzs'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['vozvrat'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['nakladnoy'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['chv'], 0, '.', ' ');       
                        echo ($data1['vzs'] - $data1['vozvrat'] - $data1['nakladnoy']) != $data1['chv']?'Есть расхожденние':'';?></td>
                        <td><?= number_format($data1['auktech'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['aukshubs'], 0, '.', ' '); ?></td>
                        <td><?= number_format($data1['nalvzaloge'], 0, '.', ' '); ?></td>
                      </tr>
                    <? }
                    $procent2 = $pribl - $plan;
                    $procent = ($procent2 * 100) / $plan;
                    ?>
                  </tbody>
                  <tfoot>
                    <tr class="bg-olive">
                      <td colspan="1" class="text-center">Итог:</td>
                      <td> <?= number_format($dl, 0, '.', ' ');  ?></td>
                      <td><?= number_format($dm, 0, '.', ' ');  ?></td>
                      <td><?= number_format($dop, 0, '.', ' '); ?></td>
                      <td><?= number_format($dohod, 0, '.', ' '); ?></td>
                      
                      <td><?= number_format($total_consumption, 0, '.', ' ');  ?></td>
                      <td><?= number_format($prib_total, 0, '.', ' '); ?></td>

                      <td><?= number_format($chistaya, 0, '.', ' '); ?></td>
                      <td><?= number_format($planden_total, 0, '.', ' '); ?></td>
                      <td><?= number_format(0, 0, '.', ' ');  ?></td>
                      <td><?= number_format(0, 0, '.', ' ');  ?></td>

                      <td><?= number_format($allclients, 0, '.', ' ');  ?></td>
                      <td><?= number_format($newclients, 0, '.', ' ');  ?></td>
                      <td><?= number_format($vzs, 0, '.', ' ');  ?></td>
                        <td><?= number_format($vozvrat, 0, '.', ' ');  ?></td>
                          <td><?= number_format($nakladnoy, 0, '.', ' ');?></td>
                      <td><?= number_format($chv, 0, '.', ' ');  ?></td>
                      <td><?= number_format($data1['auktech'], 0, '.', ' ');  ?></td>
                      <td><?= number_format($data1['aukshubs'], 0, '.', ' ');  ?></td>
                      <td><?= number_format($data1['nalvzaloge'], 0, '.', ' '); ?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div>
      </section>
  </div>
<? include "footer.php";
else :
  header('Location: index.php');
endif; ?>