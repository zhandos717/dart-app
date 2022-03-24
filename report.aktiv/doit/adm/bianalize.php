<script>
      $(function () {
          var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        var areaChartCanvas2 = $("#areaChart2").get(0).getContext("2d");
        var areaChartCanvas3 = $("#areaChart3").get(0).getContext("2d");
        var areaChartCanvas4 = $("#areaChart4").get(0).getContext("2d");

        var areaChart = new Chart(areaChartCanvas);
        var areaChart2 = new Chart(areaChartCanvas2);
        var areaChart3 = new Chart(areaChartCanvas3);
        var areaChart4 = new Chart(areaChartCanvas4);

        var areaChartData = {
          labels: ["Март 2021", "Апрель 2021", "Май 2021", "Июнь 2021", "Июль 2021", "Август 2021", "Сентябрь 2021", "Октябрь 2021", "Ноябрь 2021"],
          datasets: [
            {
              label: "Аукционист техники ",
              fillColor: "rgba(14,148,55,1)",
              strokeColor: "rgba(14,148,55,1)",
              pointColor: "#0e9437",
              pointStrokeColor: "rgba(14,148,55,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(14,148,55,1)",
              data: [<?=$auktech3;?>, <?=$auktech4;?>, <?=$auktech5;?>, <?=$auktech6;?>, <?=$auktech7;?>,<?=$auktech8;?>,<?=$auktech9;?>,<?=$auktech10;?>,<?=$auktech;?>]
            },

          ]
        };

        var areaChartData2 = {
          labels: ["Март 2021", "Апрель 2021", "Май 2021", "Июнь 2021", "Июль 2021", "Август 2021", "Сентябрь 2021", "Октябрь 2021", "Ноябрь 2021"],
          datasets: [

            {
              label: "Аукционист шубы",
              fillColor: "rgba(255, 128, 0, 0.9)",
              strokeColor: "rgba(255, 128, 0, 1)",
              pointColor: "rgba(255, 128, 0, 1)",
              pointStrokeColor: "#ff0000",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(255, 128, 0,1)",
              data: [<?=$aukshuba3;?>, <?=$aukshuba4;?>, <?=$aukshuba5;?>,<?=$aukshuba6;?>,<?=$aukshuba7;?>,<?=$aukshuba8;?>,<?=$aukshuba9;?>,<?=$aukshuba10;?>,<?=$aukshuba;?>]
            },


          ]
        };

        var areaChartData3 = {
          labels: ["Март 2021", "Апрель 2021", "Май 2021", "Июнь 2021", "Июль 2021", "Август 2021", "Сентябрь 2021", "Октябрь 2021", "Ноябрь 2021"],
          datasets: [

            {
              label: "Нал в залоге",
              fillColor:   "rgba(255,0,0,0.4)",
              strokeColor: "rgba(255,0,0,0.8)",
              pointColor: "rgba(255,0,0,0.8)",
              pointStrokeColor: "rgba(255,0,0, 0.2)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(255,0,0, 0.2)",
              data: [<?=$nalvzaloge3;?>, <?=$nalvzaloge4;?>, <?=$nalvzaloge5;?>,<?=$nalvzaloge6;?>,<?=$nalvzaloge7;?>,<?=$nalvzaloge8;?>,<?=$nalvzaloge9;?>,<?=$nalvzaloge10;?>,<?=$nalvzaloge;?>]
            }
          ]
        };

        var areaChartData4 = {
          labels: ["Март 2021", "Апрель 2021", "Май 2021", "Июнь 2021", "Июль 2021", "Август 2021", "Сентябрь 2021", "Октябрь 2021", "Ноябрь 2021"],
          datasets: [
            {
              label: "Чистая прибыль",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?=$chistaya3;?>, <?=$chistaya4;?>, <?=$chistaya5;?>, <?=$chistaya6;?>, <?=$chistaya7;?>,<?=$chistaya8;?>,<?=$chistaya9;?>,<?=$chistaya10;?>,<?=$chistaya;?>]
            }
          ]
        };

        var areaChartOptions = {
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
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        var areaChartOptions2 = {
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
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        var areaChartOptions3 = {
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
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        var areaChartOptions4 = {
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
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        areaChart.Line(areaChartData, areaChartOptions);
        areaChart2.Line(areaChartData2, areaChartOptions2);
        areaChart3.Line(areaChartData3, areaChartOptions3);
        areaChart4.Line(areaChartData4, areaChartOptions4);

        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChartCanvas2 = $("#lineChart2").get(0).getContext("2d");
        var lineChartCanvas3 = $("#lineChart3").get(0).getContext("2d");
        var lineChartCanvas4 = $("#lineChart4").get(0).getContext("2d");

        var lineChart = new Chart(lineChartCanvas);
        var lineChart2 = new Chart(lineChartCanvas2);
        var lineChart3 = new Chart(lineChartCanvas3);
        var lineChart4 = new Chart(lineChartCanvas4);

        var lineChartOptions = areaChartOptions;
        var lineChartOptions2 = areaChartOptions2;
        var lineChartOptions3 = areaChartOptions3;
        var lineChartOptions4 = areaChartOptions4;

        lineChartOptions.datasetFill = false;
        lineChartOptions2.datasetFill = false;
        lineChartOptions3.datasetFill = false;
        lineChartOptions4.datasetFill = false;

        lineChart.Line(areaChartData, lineChartOptions);
        lineChart2.Line(areaChartData2, lineChartOptions2);
        lineChart3.Line(areaChartData3, lineChartOptions3);
        lineChart4.Line(areaChartData4, lineChartOptions4);

        // var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        // var pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
        // var pieChartCanvas3 = $("#pieChart3").get(0).getContext("2d");
        // var pieChartCanvas4 = $("#pieChart4").get(0).getContext("2d");

        // var pieChart = new Chart(pieChartCanvas);
        // var pieChart2 = new Chart(pieChartCanvas2);
        // var pieChart3 = new Chart(pieChartCanvas3);
        // var pieChart4 = new Chart(pieChartCanvas4);

        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
          {
            value: 700,
            color: "#f56954",
            highlight: "#f56954",
            label: "Доходы"
          },
          {
            value: 500,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "Текучие расходы"
          },
          {
            value: 400,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "Нал в залоге"
          },
          {
            value: 600,
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "Safari"
          },
          {
            value: 300,
            color: "#3c8dbc",
            highlight: "#3c8dbc",
            label: "Opera"
          },
          {
            value: 100,
            color: "#d2d6de",
            highlight: "#d2d6de",
            label: "Navigator"
          }
        ];
        // var PieData2 = [
        //
        //   {
        //     value: 700,
        //     color: "#f56954",
        //     highlight: "#f56954",
        //     label: "Доходы"
        //   },
        //   {
        //     value: 700,
        //     color: "#f56954",
        //     highlight: "#f56954",
        //     label: "Доходы"
        //   },
        //   {
        //     value: 700,
        //     color: "#f56954",
        //     highlight: "#f56954",
        //     label: "Доходы"
        //   },
        //
        // ];
        //
        // var PieData3 = [
        //
        //   {
        //     value: 700,
        //     color: "#f56954",
        //     highlight: "#f56954",
        //     label: "Доходы"
        //   },
        //   {
        //     value: 700,
        //     color: "#f56954",
        //     highlight: "#f56954",
        //     label: "Доходы"
        //   },
        //   {
        //     value: 700,
        //     color: "#f56954",
        //     highlight: "#f56954",
        //     label: "Доходы"
        //   },
        //
        // ];
        //
        // var PieData4 = [
        //
        //   {
        //     value: 700,
        //     color: "#f56954",
        //     highlight: "#f56954",
        //     label: "Доходы"
        //   },
        //   {
        //     value: 700,
        //     color: "#f56954",
        //     highlight: "#f56954",
        //     label: "Доходы"
        //   },
        //   {
        //     value: 700,
        //     color: "#f56954",
        //     highlight: "#f56954",
        //     label: "Доходы"
        //   },
        //
        // ];

        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };

        // var pieOptions2 = {
        //   //Boolean - Whether we should show a stroke on each segment
        //   segmentShowStroke: true,
        //   //String - The colour of each segment stroke
        //   segmentStrokeColor: "#fff",
        //   //Number - The width of each segment stroke
        //   segmentStrokeWidth: 2,
        //   //Number - The percentage of the chart that we cut out of the middle
        //   percentageInnerCutout: 50, // This is 0 for Pie charts
        //   //Number - Amount of animation steps
        //   animationSteps: 100,
        //   //String - Animation easing effect
        //   animationEasing: "easeOutBounce",
        //   //Boolean - Whether we animate the rotation of the Doughnut
        //   animateRotate: true,
        //   //Boolean - Whether we animate scaling the Doughnut from the centre
        //   animateScale: false,
        //   //Boolean - whether to make the chart responsive to window resizing
        //   responsive: true,
        //   // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        //   maintainAspectRatio: true,
        //   //String - A legend template
        //   legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        // };
        //
        // var pieOptions3 = {
        //   //Boolean - Whether we should show a stroke on each segment
        //   segmentShowStroke: true,
        //   //String - The colour of each segment stroke
        //   segmentStrokeColor: "#fff",
        //   //Number - The width of each segment stroke
        //   segmentStrokeWidth: 2,
        //   //Number - The percentage of the chart that we cut out of the middle
        //   percentageInnerCutout: 50, // This is 0 for Pie charts
        //   //Number - Amount of animation steps
        //   animationSteps: 100,
        //   //String - Animation easing effect
        //   animationEasing: "easeOutBounce",
        //   //Boolean - Whether we animate the rotation of the Doughnut
        //   animateRotate: true,
        //   //Boolean - Whether we animate scaling the Doughnut from the centre
        //   animateScale: false,
        //   //Boolean - whether to make the chart responsive to window resizing
        //   responsive: true,
        //   // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        //   maintainAspectRatio: true,
        //   //String - A legend template
        //   legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        // };
        //
        // var pieOptions4 = {
        //   //Boolean - Whether we should show a stroke on each segment
        //   segmentShowStroke: true,
        //   //String - The colour of each segment stroke
        //   segmentStrokeColor: "#fff",
        //   //Number - The width of each segment stroke
        //   segmentStrokeWidth: 2,
        //   //Number - The percentage of the chart that we cut out of the middle
        //   percentageInnerCutout: 50, // This is 0 for Pie charts
        //   //Number - Amount of animation steps
        //   animationSteps: 100,
        //   //String - Animation easing effect
        //   animationEasing: "easeOutBounce",
        //   //Boolean - Whether we animate the rotation of the Doughnut
        //   animateRotate: true,
        //   //Boolean - Whether we animate scaling the Doughnut from the centre
        //   animateScale: false,
        //   //Boolean - whether to make the chart responsive to window resizing
        //   responsive: true,
        //   // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        //   maintainAspectRatio: true,
        //   //String - A legend template
        //   legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        // };

        pieChart.Doughnut(PieData, pieOptions);
        // pieChart2.Doughnut(PieData2, pieOptions2);
        // pieChart3.Doughnut(PieData3, pieOptions3);
        // pieChart4.Doughnut(PieData4, pieOptions4);

        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        // var barChartCanvas2 = $("#barChart2").get(0).getContext("2d");
        // var barChartCanvas3 = $("#barChart3").get(0).getContext("2d");
        // var barChartCanvas4 = $("#barChart4").get(0).getContext("2d");

        var barChart = new Chart(barChartCanvas);
        // var barChart2 = new Chart(barChartCanvas2);
        // var barChart3 = new Chart(barChartCanvas3);
        // var barChart4 = new Chart(barChartCanvas4);

        var barChartData = areaChartData;
        // var barChartData2 = areaChartData2;
        // var barChartData3 = areaChartData3;
        // var barChartData4 = areaChartData4;


        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";

        // barChartData2.datasets[1].fillColor = "#00a65a";
        // barChartData2.datasets[1].strokeColor = "#00a65a";
        // barChartData2.datasets[1].pointColor = "#00a65a";
        //
        // barChartData3.datasets[1].fillColor = "#00a65a";
        // barChartData3.datasets[1].strokeColor = "#00a65a";
        // barChartData3.datasets[1].pointColor = "#00a65a";
        //
        // barChartData4.datasets[1].fillColor = "#00a65a";
        // barChartData4.datasets[1].strokeColor = "#00a65a";
        // barChartData4.datasets[1].pointColor = "#00a65a";

        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        // var barChartOptions2 = {
        //   //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        //   scaleBeginAtZero: true,
        //   //Boolean - Whether grid lines are shown across the chart
        //   scaleShowGridLines: true,
        //   //String - Colour of the grid lines
        //   scaleGridLineColor: "rgba(0,0,0,.05)",
        //   //Number - Width of the grid lines
        //   scaleGridLineWidth: 1,
        //   //Boolean - Whether to show horizontal lines (except X axis)
        //   scaleShowHorizontalLines: true,
        //   //Boolean - Whether to show vertical lines (except Y axis)
        //   scaleShowVerticalLines: true,
        //   //Boolean - If there is a stroke on each bar
        //   barShowStroke: true,
        //   //Number - Pixel width of the bar stroke
        //   barStrokeWidth: 2,
        //   //Number - Spacing between each of the X value sets
        //   barValueSpacing: 5,
        //   //Number - Spacing between data sets within X values
        //   barDatasetSpacing: 1,
        //   //String - A legend template
        //   legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //   //Boolean - whether to make the chart responsive
        //   responsive: true,
        //   maintainAspectRatio: true
        // };
        //
        // var barChartOptions3 = {
        //   //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        //   scaleBeginAtZero: true,
        //   //Boolean - Whether grid lines are shown across the chart
        //   scaleShowGridLines: true,
        //   //String - Colour of the grid lines
        //   scaleGridLineColor: "rgba(0,0,0,.05)",
        //   //Number - Width of the grid lines
        //   scaleGridLineWidth: 1,
        //   //Boolean - Whether to show horizontal lines (except X axis)
        //   scaleShowHorizontalLines: true,
        //   //Boolean - Whether to show vertical lines (except Y axis)
        //   scaleShowVerticalLines: true,
        //   //Boolean - If there is a stroke on each bar
        //   barShowStroke: true,
        //   //Number - Pixel width of the bar stroke
        //   barStrokeWidth: 2,
        //   //Number - Spacing between each of the X value sets
        //   barValueSpacing: 5,
        //   //Number - Spacing between data sets within X values
        //   barDatasetSpacing: 1,
        //   //String - A legend template
        //   legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //   //Boolean - whether to make the chart responsive
        //   responsive: true,
        //   maintainAspectRatio: true
        // };
        //
        // var barChartOptions4 = {
        //   //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        //   scaleBeginAtZero: true,
        //   //Boolean - Whether grid lines are shown across the chart
        //   scaleShowGridLines: true,
        //   //String - Colour of the grid lines
        //   scaleGridLineColor: "rgba(0,0,0,.05)",
        //   //Number - Width of the grid lines
        //   scaleGridLineWidth: 1,
        //   //Boolean - Whether to show horizontal lines (except X axis)
        //   scaleShowHorizontalLines: true,
        //   //Boolean - Whether to show vertical lines (except Y axis)
        //   scaleShowVerticalLines: true,
        //   //Boolean - If there is a stroke on each bar
        //   barShowStroke: true,
        //   //Number - Pixel width of the bar stroke
        //   barStrokeWidth: 2,
        //   //Number - Spacing between each of the X value sets
        //   barValueSpacing: 5,
        //   //Number - Spacing between data sets within X values
        //   barDatasetSpacing: 1,
        //   //String - A legend template
        //   legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //   //Boolean - whether to make the chart responsive
        //   responsive: true,
        //   maintainAspectRatio: true
        // };

        barChartOptions.datasetFill = false;
        // barChartOptions2.datasetFill = false;
        // barChartOptions3.datasetFill = false;
        // barChartOptions4.datasetFill = false;

        barChart.Bar(barChartData, barChartOptions);
        // barChart2.Bar(barChartData2, barChartOptions2);
        // barChart3.Bar(barChartData3, barChartOptions3);
        // barChart4.Bar(barChartData4, barChartOptions4);
      });
    </script>
