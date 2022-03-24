<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 5) :
  include "header.php";
  $active_report = 'active';
  include "menu.php";
  $month = $_GET['month'];
  $year = $_GET['year'];
  $month_start = date("$year-$month-01");
  $month_end = date("$year-$month-31");

  $date = new DateTime($month_start);
  $date->modify('last day of this month');
  $last_day = $date->format('d');
  $month = $date->format('m');
  $year = $date->format('Y');

  function calculate_percentage($price, $sale)
  {
    return round((($price - $sale) * 100) / $price, 2);
  }

  $result = R::getAll("SELECT  data,SUM(summaprihod), SUM(remainder), SUM(predoplata), SUM(summareal), SUM(pribl), COUNT(*)
FROM sales 
WHERE region='$region' 
AND adress='$adress' 
AND statustovar  IS NULL 
AND data BETWEEN '$month_start' AND  '$month_end'
GROUP BY data ");


  $salers = R::getAll("SELECT saler, regionlombard, SUM(summareal), SUM(pribl), COUNT(*), SUM(summaprihod)
FROM sales  
WHERE region = '$region' 
AND adress = '$adress' 
AND statustovar IS NULL 
AND data BETWEEN '$month_start' AND '$month_end'   
GROUP BY saler  ");

  include_once 'functions/notification.php';
  $plan = R::findOne('magplan', "month = '$month' AND year = '$year'  AND region ='$region' AND adress = '$adress'");
  $planden = $plan['plan'] / $last_day;
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $region; ?>/<?= $adress; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная <?= $month_start; ?> <?= $month_end ?> </a></li>
        <li><a id="region" href="index.php"><?= $region; ?></a></li>
        <li class="active" id="adress"><?= $adress; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <? if (!empty($res)) { ?>
        <!-- если товары есть показываем их  -->
        <div class="row">
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h4>У вас
                  <?= $res['count']; ?> ед. товара находятся более 10 дней на реализации
                </h4>
                <h3>На общую сумму <?= number_format($res['SUM(cena_pr)'], 0, '.', ' '); ?> тг</h3>
              </div>
              <div class="icon">
                <i class="fa fa-warning"></i>
              </div>
              <a href="a_report.php?id=7" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
        </div><!-- /.row -->
      <? } ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="answer">
          </div>
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title"> <button class="btn btn-success fa fa-plus" title="Добавить отчет" data-toggle="modal" data-target="#exampleModal"> </button> Отчет </h3> -->
              <button class="btn btn-primary" id='get_chart'> Построить график </button>
            </div><!-- /.box-header -->

            <div class="box-body hidden" id='table_chart'>

              <div class="btn-group" id="filter">
                <button type="button" class="btn btn-danger">Выберите фильтр</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#all">По магазину</a></li>
                  <li><a href="#branches">По филиалам</a></li>
                  <li class="divider"></li>
                  <li><a href="#year_total">За год</a></li>
                </ul>
              </div>

              <div class="overlay hidden">
                <i class="fa fa-refresh fa-spin"></i>
              </div>

              <canvas id="myChart" height="120%"></canvas>
            </div>

            <div class="box-body" id="report_mounth">
              <div class="table-responsive">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                    <tr class="info">
                      <th rowspan="2">ДАТА</th>
                      <th rowspan="2">Общая сумма прихода</th>
                      <!-- <th rowspan="2">ПРЕДОПЛАТА</th> -->
                      <th rowspan="2">Общ.сумма реализации</th>
                      <th rowspan="2">ПРИБЫЛЬ</th>
                      <th rowspan="2">ПРИБЫЛЬ (-% Банка)</th>
                      <!-- <th rowspan="2">Приход товара за день</th> -->
                      <th rowspan="2">Кл-во товаров</th>
                      <th style="white-space:nowrap;" colspan="2" class="text-center">ПЛАН: <?= number_format($plan['plan'], 0, '.', ' '); ?> тг.</th>
                    </tr>
                    <tr class="bg-olive">
                      <th class="text-center">В день</th>
                      <th class="text-center">%</th>
                    </tr>
                  </thead>
                  <tbody>
                    <? $i = 1;
                    foreach ($result as $data1) {
                      $sc += $data1['COUNT(*)'];
                      $procent = calculate_percentage($data1['SUM(pribl)'], $planden);
                    ?>
                      <tr>
                        <td><a class="btn btn-success" href="detail.php?data=<?= $data1['data']; ?>"><?= date("d.m.Y", strtotime($data1['data'])); ?></a></td>
                        <td><?= number_format($data1['SUM(summaprihod)'], 0, '.', ' ');
                            $summaprihod += $data1['SUM(summaprihod)']; ?></td>
                        <!-- <td><?= number_format($data1['SUM(predoplata)'], 0, '.', ' ');
                                  $predoplata += $data1['SUM(predoplata)']; ?></td> -->
                        <td><?= number_format($data1['SUM(summareal)'], 0, '.', ' ');
                            $summareal += $data1['SUM(summareal)'];  ?></td>
                        <td class="success"><?= number_format($data1['SUM(pribl)'], 0, '.', ' ');
                                            $pribl += $data1['SUM(pribl)'];  ?></td>

                        <td class="danger"> <?= number_format($data1['SUM(remainder)'] - $data1['SUM(summaprihod)'], 0, '.', ' ');
                                            $total_shop += $data1['SUM(remainder)'] - $data1['SUM(summaprihod)'] ?> </td>
                        <td><?= $data1['COUNT(*)']; ?></td>
                        <td class="text-center">
                          <?= number_format($planden, 0, '.', ' ');
                          $plan += $planden; ?>
                        </td>
                        <td class="text-center">
                          <? if ($procent > 0) { ?>
                            <a title="<?= number_format(round($data1['SUM(pribl)']), 0, '.', ' '); ?>-<?= number_format(round($planden1), 0, '.', ' ') ?>=<?= number_format(round($procent2), 0, '.', ' ') ?>" class="description-percentage text-green">
                              <i class="fa fa-caret-up"></i> <?= number_format($procent, 0, '.', ' '); ?> %</a>
                          <? } elseif ($procent < 0) { ?>
                            <a title="<?= number_format(round($data1['SUM(pribl)']), 0, '.', ' '); ?>-<?= number_format(round($planden1), 0, '.', ' ') ?>=<?= number_format(round($procent2), 0, '.', ' ') ?>" class="description-percentage text-danger">
                              <i class="fa fa-caret-down"></i> <?= number_format($procent, 0, '.', ' '); ?> %</a>
                          <? }; ?>
                        </td>
                      </tr>
                    <? } ?>
                  </tbody>
                  <tfoot>
                    <tr class='info'>
                      <th>Итого</th>
                      <th><?= number_format($summaprihod, 0, '.', ' '); ?></th>
                      <!-- <th><?= number_format($predoplata, 0, '.', ' '); ?></th> -->
                      <th><?= number_format($summareal, 0, '.', ' '); ?></th>
                      <th><?= number_format($pribl, 0, '.', ' '); ?></th>
                      <th><?= number_format($total_shop, 0, '.', ' '); ?></th>
                      <th><?= $sc; ?></th>
                      <th><?= number_format($plan, 0, '.', ' '); ?></th>
                      <th>
                        <?
                        $procent =  (($pribl - $plan) * 100) / $pribl; //($plan*$pribl)*100;

                        $res = $pribl - $plan;
                        if ($procent > 0) { ?>
                          <a title="<?= number_format(round($pribl), 0, '.', ' '); ?>-<?= number_format(round($plan), 0, '.', ' ') ?>=<?= number_format(round($res), 0, '.', ' ') ?>" class="description-percentage text-green">
                            <i class="fa fa-caret-up"></i> <?= number_format($procent, 0, '.', ' '); ?> %</a>
                        <? } elseif ($procent < 0) { ?>
                          <a title="<?= number_format(round($pribl), 0, '.', ' '); ?>-<?= number_format(round($plan), 0, '.', ' ') ?>=<?= number_format(round($res), 0, '.', ' ') ?>" class="description-percentage text-danger">
                            <i class="fa fa-caret-down"></i> <?= number_format($procent, 0, '.', ' '); ?> %</a>
                        <? }; ?>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
        <div class='col-xs-6'>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">График доли от прибыли</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table class="table table-condensed">
                <thead>
                  <tr>
                    <th style="width: 10px">№</th>
                    <th>Филиал</th>
                    <th>Прогресс</th>
                    <th style="width: 40px">Процент</th>
                  </tr>
                </thead>
                <tbody>
                  <?
                  $i = 1;
                  foreach ($salers as $data2) {
                    $procent = round(($data2['SUM(pribl)'] * 100) / $pribl);
                    if ($procent > 20) {
                      $color = 'success';
                      $color1 = 'green';
                    } elseif ($procent > 10) {
                      $color = 'info';
                      $color1 = 'blue';
                    } elseif ($procent > 5) {
                      $color = 'warning';
                      $color1 = 'yellow';
                    } else {
                      $color = 'danger';
                      $color1 = 'red';
                    }
                  ?>
                    <tr>
                      <td><?= $i++ ?>.</td>
                      <td>
                        <?= $data2['saler']; ?> <br>
                        Прибыль: <?= number_format($data2['SUM(pribl)'], 0, '.', ' '); ?> тг.
                      </td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-<?= $color; ?>" style="width: <?= $procent; ?>%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-<?= $color1; ?>"><?= $procent; ?>% </span></td>
                    </tr>
                  <? } ?>
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
        <div class='col-xs-6'>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ежедневный отчет <?= date("d.m.Y", strtotime($data1['data'])); ?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <?php
              $numOfAccess = R::count(
                'sales',
                "region = '$region' 
              AND adress = '$adress' 
              AND statustovar IS NULL 
              AND data =  :data 
              AND codetovar LIKE :search ",
                [
                  ':data' => $data1['data'],
                  ':search' => '%Z%'
                ]
              );
              $numOfCommiss = R::count(
                'sales',
                "region = '$region' 
                        AND adress = '$adress' 
                        AND statustovar IS NULL 
                        AND data =  :data 
                        AND codetovar LIKE :search ",
                [
                  ':data' => $data1['data'],
                  ':search' => '%-%'
                ]
              ); ?>
              <table class="table table-condensed">
                <thead>
                  <tr>
                    <!-- <th>№</th> -->
                    <th>Наименование</th>
                    <th>Количество</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td> Приход </td>
                    <td> <?= number_format($data1['SUM(summaprihod)'], 0, '.', ' '); ?></td>
                  </tr>
                  <tr>
                    <td>Продажа </td>
                    <td> <?= number_format($data1['SUM(summareal)'], 0, '.', ' '); ?></td>
                  </tr>
                  <tr>
                    <td>Продажа </td>
                    <td> <?= number_format($data1['SUM(summareal)'], 0, '.', ' '); ?></td>
                  </tr>
                  <tr>
                    <td> Прибыль </td>
                    <td> <?= number_format($data1['SUM(pribl)'], 0, '.', ' '); ?></td>
                  </tr>
                  <tr>
                    <td> Прибыль (-% Банка) </td>
                    <td> <?= number_format($data1['SUM(remainder)'] - $data1['SUM(summaprihod)'], 0, '.', ' '); ?></td>
                  </tr>
                  <tr>
                    <td> Кол-во прод </td>
                    <td> <?= $data1['COUNT(*)'] - ($numOfCommiss + $numOfAccess) ?> </td>
                  </tr>
                  <tr>
                    <td> Комиссионка </td>
                    <td> <?= $numOfCommiss ?> </td>
                  </tr>
                  <tr>
                    <td> Аксессуары </td>
                    <td> <?= $numOfAccess ?> </td>
                  </tr>
                  <tr>
                    <td> Общее кол-во </td>
                    <td><?= number_format($data1['COUNT(*)'], 0, '.', ' '); ?></td>
                  </tr>
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
    </section>
  </div><!-- /.content-wrapper -->
  <div class="modal" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Добавление продажи</h4>
        </div>
        <form action="./functions/addReport.php" method="POST">
          <div class="modal-body">
            <div class="row ">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="data">Дата отчета:</label>
                  <input class="form-control" id="data" type="date" name="data" min="<?= date('Y-m-01'); ?>" value="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d'); ?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="codetovar">Код товара:</label>
                  <input class="form-control" id="codetovar" type="text" name="codetovar" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="get_region">Город:</label>
                  <select id="get_region" name="regionlombard" class="form-control" required>
                    <option value="">Выберите город</option>
                    <? $reg = R::findAll('diruser', 'GROUP BY region');
                    foreach ($reg as $key) { ?>
                      <option><?= $key['region'] ?></option>
                    <? } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="adress">Город:</label>
                  <select id="adress" name="adresslombard" class="form-control">
                    <option value="">Выберите город</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="vid">Вид оплаты:</label>
                  <select name="vid" id="vid" class="form-control">
                    <? $pay = R::findAll('payment');
                    foreach ($pay as $value) { ?>
                      <option value="<?= $value['bank'] ?> | <?= $value['payment'] ?>">
                        <?= $value['bank'] ?> | <?= $value['payment'] ?>
                      </option>
                    <? } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="summareal">Сумма реализации:</label>
                  <input class="form-control" id="summareal" type="number" name="summareal" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="summaprihod">Приходная сумма товара:</label>
                  <input class="form-control" id="summaprihod" type="number" name="summaprihod">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="predoplata">Предоплата:</label>
                  <input class="form-control" id="predoplata" type="number" name="predoplata">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="tovarname">Наименование товара:</label>
                  <textarea class="form-control" id="tovarname" name="tovarname" required></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="saler">Продавец (ФИО):</label>
                  <select name="saler" id="saler" class="form-control">
                    <? $result = R::findAll('saler', "region = '$region' AND shop = '$adress'");
                    foreach ($result as $data) { ?>
                      <option value="<?= $data['fiosaler']; ?>"><?= $data['fiosaler']; ?></option>
                    <? } ?>
                  </select>
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group">
                  <label for="pokupatel">ФИО покупателя:</label>
                  <input class="form-control" id="pokupatel" type="text" name="pokupatel" required="">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    var ctx = document.getElementById('myChart').getContext('2d');

    function $_get(sParam) {
      var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
      for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : sParameterName[1];
        }
      }
    };

    const config = {
      type: 'line',
      data: {
        labels: [1, 2],
        datasets: [{
          label: 'Продажи в регионе',
          data: [0],
          backgroundColor: [
            '#FBDB54',
          ],
          borderColor: [
            '#F78309',
          ],
          borderWidth: 1
        }]
      }
    };
    const myLineChart = new Chart(ctx, config);

    $('.dropdown-menu').click(function(event) {
      $('.overlay').toggleClass('hidden')
      $.getJSON('/doit/function/get_region_sales.php', {
        year: $_get('year'),
        month: $_get('month'),
        filter: event.target.hash
      }).done(function(data) {
        $('.overlay').toggleClass('hidden')
        myLineChart.data = data;
        myLineChart.update();
      });
    });

    $('#get_chart').click(function() {
      $.getJSON('/doit/function/get_region_sales.php', {
        year: $_get('year'),
        month: $_get('month'),
      }).done(function(data) {

        $('#get_chart').text('Показать/скрыть');
        $('#table_chart').toggleClass('hidden');
        $('#report_mounth').toggleClass('hidden');

        myLineChart.data = data;
        myLineChart.update();
      });
    });
  </script>


  <script>
    $(function() {
      $('#get_region').change(function() {
        var region = $(this).val();
        console.log(region);
        $('#adress').load('../function/get_adress.php', {
          value: region
        });
      });
    });
    $('form').submit(function(e) {
      var $form = $(this);
      $.ajax({
          type: $form.attr('method'),
          url: $form.attr('action'),
          data: $form.serialize()
        })
        .done(function(data) {
          var out = '<div class="alert alert-success alert-dismissable">';
          out += ' <button type ="button" class ="close" data-dismiss="alert" aria-hidden="true" > &times; </button>';
          out += '<h4 ><i class="icon fa fa-check"> </i> Данные добавлены!</h4>';
          out += data + ' Для проверки обновите страницу';
          out += '</div> ';
          $('.answer').html(out);
        })
        .fail(function(er) {
          $('.answer').html(er);
        });
      $('.close').trigger("click");
      e.preventDefault();
    });
  </script>
<?
  include "footer.php";
else :
  header('Location: /');
endif; ?>