 $(document).ready(function() {
            $("button#region_report").click(function() {
                var region = $(this).val();

                $.post("accses.php", {
                        region: region
                    })
                    .done(function(data) {
                        $('.content-wrapper').html(data);
                    });
            });
        });
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var november = $("#november").val();
        var december = $("#december").val();

        var pieChart = new Chart(pieChartCanvas);
        var PieData = [{
                value: december,
                color: "#3C8DBC",
                highlight: "#DD4B39",
                label: "Декабрь"
            },
            {
                value: november,
                color: "#00C0EF",
                highlight: "#DD4B39",
                label: "Ноябрь"
            }
        ];
        var pieOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            percentageInnerCutout: 50,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
            responsive: true,
            maintainAspectRatio: true,
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        pieChart.Doughnut(PieData, pieOptions);