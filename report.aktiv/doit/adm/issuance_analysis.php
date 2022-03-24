<?php
include __DIR__ . '/../../bd.php';

if ($_SESSION['logged_user']->status != 3)   header('Location: /');



/*
// $data = R::getAll("SELECT region, COUNT(*) as count , ROUND(AVG(srok)) as srok,SUM(summa_vydachy) 
FROM tickets WHERE region IN (SELECT region FROM kassa WHERE status = 1 GROUP BY region) 
GROUP BY srok  
ORDER BY SUM(summa_vydachy)   DESC ");
 
*/

// WHERE  
// $variable = R::getAll("SELECT  
//     DATE_FORMAT(t.dataseg, '%Y-%m') as month_t , 
//     -- SUM(t.summa_vydachy) as summa_vydachy,
//     COUNT(*) as count,
//     t.srok as day_t
//     FROM tickets t 
//     WHERE NOT t.status IN (1,11)
//     AND region IN (SELECT region FROM kassa WHERE status = 1 GROUP BY region) 
//     GROUP BY t.srok , month_t    
//     ORDER BY month_t   DESC");

// $arr = [];

// foreach ($variable as $key) {
//   $arr[$key['month_t']][$key['day_t']] = $key['count'];
// };


// echo '<pre>';
// var_dump($arr);
// exit;
// {
//         y: '2011 Q2',
//         item1: 2778,
//         item2: 2294
//       }

include "header.php";
include "menu.php";

$data = R::getAll("SELECT region, COUNT(*) as count , ROUND(AVG(srok)) as srok,SUM(summa_vydachy) FROM tickets WHERE region IN (SELECT region FROM kassa WHERE status = 1 GROUP BY region) GROUP BY srok,region  ORDER BY SUM(summa_vydachy)   DESC ");
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Анализ выдачи
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">

        <div class="box box-primary">
          <div class="box-header with-border">
       
          </div>
          <div class="box-body chart-responsive">
            <!-- <canvas id="myChart" style="height:30%"></canvas> -->
          </div>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
          </div>
          <div class="box-body table-responsive">
            <div class="">

              <table class="table table-bordered text-center" id='table-export'>
                <!--  -->
                <!-- datatable-tabletools  -->
                <thead>
                  <tr class="danger">
                    <td>
                      Количество
                    </td>
                    <td>
                      Срок
                    </td>
                    <td>
                      Сумма выдачи
                    </td>
                    <td>
                      Регион
                    </td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <? foreach ($data as $k) { ?>
                      <td>
                        <?= $k["count"] ?>
                      </td>
                      <td>
                        <?= $k["srok"] ?>
                      </td>
                      <td>
                        <?= $k["SUM(summa_vydachy)"] ?>
                      </td>
                      <td>
                        <?= $k["region"] ?>
                      </td>
                  </tr>
                <? } ?>
                </tbody>
              </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section>
</div>

<script src="/assets/plugins/chartjs/chart.min2021.js"></script>

<script>
  var ctx = document.getElementById('myChart').getContext('2d');

  const config = {
    type: 'radar',
    data: {
      labels: [
        'Январь',
        'Февраль',
        'Март',
        'Май',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь'
      ],
      datasets: [{
        label: 'My First Dataset',
        data: [65, 59, 90, 81, 56, 55, 40],
        fill: true,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgb(255, 99, 132)',
        pointBackgroundColor: 'rgb(255, 99, 132)',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: 'rgb(255, 99, 132)'
      }, {
        label: 'My Second Dataset',
        data: [28, 48, 40, 19, 96, 27, 100],
        fill: true,
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgb(54, 162, 235)',
        pointBackgroundColor: 'rgb(54, 162, 235)',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: 'rgb(54, 162, 235)'
      }]
    }
  };
  const myLineChart = new Chart(ctx, config);
</script>
<?php include "footer.php"; ?>