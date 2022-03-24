 <? //проверка существовании сессии
    include("../../bd.php");
    if ($_SESSION['logged_user']->status == 3) :
        include "header.php";
        include "menu.php"; ?>
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <h1>
                 Анализ товаров
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
                             <form action="functions/report/report_acces.php" id="report" method="POST">
                                 <div class="col-md-2">
                                     <div class="form-group">
                                         <!-- <label for="dl">Доход ломбард:</label> -->
                                         <input type="date" disabled class="form-control" value="<?= date('Y-m-d') ?>" name="date1">
                                     </div>
                                 </div>
                                 <div class="col-md-2">
                                     <div class="form-group">
                                         <!-- <label for="dl">Доход ломбард:</label> -->
                                         <input type="date" disabled class="form-control" value="<?= date('Y-m-d') ?>" name="date2">
                                     </div>
                                 </div>
                                 <div class="col-md-3">
                                     <div class="form-group">
                                         <!-- <label for="dl">Доход ломбард:</label> -->
                                         <select disabled class="form-control" id="List1" name="region">
                                             <option value="">Выберите город</option>
                                             <? $res = R::findAll('productreport', 'GROUP BY region ORDER BY datereg ASC');
                                                foreach ($res as $key => $value) { ?>
                                                 <option value="<?= $value['region'] ?>">
                                                     <?= $value['region'] ?>
                                                 </option>
                                             <? } ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-md-2">
                                     <div class="form-group">
                                         <!-- <label for="dl">Доход ломбард:</label> -->
                                         <button type="submit" disabled class="btn-success btn btn-block ">Подтвердить!</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                         <div class="box-footer">

                         </div>
                         <!--.box-body -->
                     </div>
                     <!--.box -->
                 </div>

                 <div class="answer">

                 </div>

                 <div class="col-md-12">
                     <div class="box">
                         <div class="box-header with-border">
                             <h3 class="box-title">График по аксессуарам</h3>

                             <div class="box-tools pull-right">
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                 </button>
                                 <div class="btn-group">
                                     <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                         <i class="fa fa-wrench"></i></button>
                                     <ul class="dropdown-menu" role="menu">
                                         <li><a href="#">Action</a></li>
                                         <li><a href="#">Another action</a></li>
                                         <li><a href="#">Something else here</a></li>
                                         <li class="divider"></li>
                                         <li><a href="#">Separated link</a></li>
                                     </ul>
                                 </div>
                                 <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                             </div>
                         </div>
                         <!-- /.box-header -->
                         <div class="box-body">
                             <div class="row">
                                 <div class="col-md-8">
                                     <p class="text-center">
                                         <strong>Продажи: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                     </p>

                                     <div class="chart">
                                         <!-- Sales Chart Canvas -->
                                         <canvas id="salesChart" style="height: 180px;"></canvas>
                                     </div>
                                     <!-- /.chart-responsive -->
                                 </div>
                                 <!-- /.col -->
                                 <div class="col-md-4">
                                     <p class="text-center">
                                         <strong>Goal Completion</strong>
                                     </p>

                                     <div class="progress-group">
                                         <span class="progress-text">Add Products to Cart</span>
                                         <span class="progress-number"><b>160</b>/200</span>

                                         <div class="progress sm">
                                             <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                                         </div>
                                     </div>
                                     <!-- /.progress-group -->
                                     <div class="progress-group">
                                         <span class="progress-text">Complete Purchase</span>
                                         <span class="progress-number"><b>310</b>/400</span>

                                         <div class="progress sm">
                                             <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                                         </div>
                                     </div>
                                     <!-- /.progress-group -->
                                     <div class="progress-group">
                                         <span class="progress-text">Visit Premium Page</span>
                                         <span class="progress-number"><b>480</b>/800</span>

                                         <div class="progress sm">
                                             <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                                         </div>
                                     </div>
                                     <!-- /.progress-group -->
                                     <div class="progress-group">
                                         <span class="progress-text">Send Inquiries</span>
                                         <span class="progress-number"><b>250</b>/500</span>

                                         <div class="progress sm">
                                             <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                                         </div>
                                     </div>
                                     <!-- /.progress-group -->
                                 </div>
                                 <!-- /.col -->
                             </div>
                             <!-- /.row -->
                         </div>
                         <!-- ./box-body -->
                         <div class="box-footer">
                             <div class="row">
                                 <div class="col-sm-3 col-xs-6">
                                     <div class="description-block border-right">
                                         <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                         <h5 class="description-header">$35,210.43</h5>
                                         <span class="description-text">TOTAL REVENUE</span>
                                     </div>
                                     <!-- /.description-block -->
                                 </div>
                                 <!-- /.col -->
                                 <div class="col-sm-3 col-xs-6">
                                     <div class="description-block border-right">
                                         <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                         <h5 class="description-header">$10,390.90</h5>
                                         <span class="description-text">TOTAL COST</span>
                                     </div>
                                     <!-- /.description-block -->
                                 </div>
                                 <!-- /.col -->
                                 <div class="col-sm-3 col-xs-6">
                                     <div class="description-block border-right">
                                         <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                         <h5 class="description-header">$24,813.53</h5>
                                         <span class="description-text">TOTAL PROFIT</span>
                                     </div>
                                     <!-- /.description-block -->
                                 </div>
                                 <!-- /.col -->
                                 <div class="col-sm-3 col-xs-6">
                                     <div class="description-block">
                                         <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                         <h5 class="description-header">1200</h5>
                                         <span class="description-text">GOAL COMPLETIONS</span>
                                     </div>
                                     <!-- /.description-block -->
                                 </div>
                             </div>
                             <!-- /.row -->
                         </div>
                         <!-- /.box-footer -->
                     </div>
                     <!-- /.box -->
                 </div>
                 <!-- /.col -->
             </div>
         </section>
     </div>

     <script>
         $(document).ready(function() {
             // Get context with jQuery - using jQuery's .get() method.
             var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
             // This will get the first returned node in the jQuery collection.
             var salesChart = new Chart(salesChartCanvas);

             var salesChartData = {
                 labels: ["January", "February", "March", "April", "May", "June", "July"],
                 datasets: [{
                         label: "Electronics",
                         fillColor: "rgb(210, 214, 222)",
                         strokeColor: "rgb(210, 214, 222)",
                         pointColor: "rgb(210, 214, 222)",
                         pointStrokeColor: "#c1c7d1",
                         pointHighlightFill: "#fff",
                         pointHighlightStroke: "rgb(220,220,220)",
                         data: [65, 59, 80, 81, 56, 55, 40]
                     },
                     {
                         label: "Digital Goods",
                         fillColor: "rgba(60,141,188,0.9)",
                         strokeColor: "rgba(60,141,188,0.8)",
                         pointColor: "#3b8bba",
                         pointStrokeColor: "rgba(60,141,188,1)",
                         pointHighlightFill: "#fff",
                         pointHighlightStroke: "rgba(60,141,188,1)",
                         data: [28, 48, 40, 19, 86, 27, 90]
                     }
                 ]
             };

             var salesChartOptions = {
                 //Boolean - If we should show the scale at all
                 showScale: true,
                 //Boolean - Whether grid lines are shown across the chart
                 scaleShowGridLines: false,
                 //String - Colour of the grid lines
                 scaleGridLineColor: "rgba(0,0,0,.05)",
                 //Number - Width of the grid lines
                 scaleGridLineWidth: 1,
                 //Boolean - Whether to show horizontal lines (except X axis)
                 scaleShowHorizontalLines: true,
                 //Boolean - Whether to show vertical lines (except Y axis)
                 scaleShowVerticalLines: true,
                 //Boolean - Whether the line is curved between points
                 bezierCurve: true,
                 //Number - Tension of the bezier curve between points
                 bezierCurveTension: 0.3,
                 //Boolean - Whether to show a dot for each point
                 pointDot: false,
                 //Number - Radius of each point dot in pixels
                 pointDotRadius: 4,
                 //Number - Pixel width of point dot stroke
                 pointDotStrokeWidth: 1,
                 //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                 pointHitDetectionRadius: 20,
                 //Boolean - Whether to show a stroke for datasets
                 datasetStroke: true,
                 //Number - Pixel width of dataset stroke
                 datasetStrokeWidth: 2,
                 //Boolean - Whether to fill the dataset with a color
                 datasetFill: true,
                 //String - A legend template
                 legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
                 //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                 maintainAspectRatio: true,
                 //Boolean - whether to make the chart responsive to window resizing
                 responsive: true
             };

             //Create the line chart
             salesChart.Line(salesChartData, salesChartOptions);
         })
     </script>

 <? include 'footer.php';
    else :
        header('Location: ../../index.php');
    endif; ?>