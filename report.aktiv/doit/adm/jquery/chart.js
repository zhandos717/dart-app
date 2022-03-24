
$(function () {

    var url = 'functions/charts/charts.php';

    $.getJSON( url, { data: "lombard" } )
    .done(function( json ) {
          var area = new Morris.Area({
          element: 'lombard',
          resize: true,    
          data: json,
          xkey: 'm',
          ykeys: ['auk','nalvzaloge'],
          labels: ['Ауционист','Нал в залоге'],
          lineColors: ['#DD4B39','#179F5D'],
          hideHover: 'auto'
          });  
          
        //  $('.json').text(json);
          


    })
    .fail(function( jqxhr, textStatus, error ) {
      var err = textStatus + ", " + error;
      alert( "Request Failed: lombard " + err );
    });
    
    $.getJSON( url, { data: "auctioneer" } )
    .done(function( result ) {
    var area = new Morris.Area({
    element: 'auctioneer',
    resize: true,    
    data: result,
    xkey: 'm',
    ykeys: ['aukshubs','auktech'],
    labels: ['Ауционист шуб','Ауционист техники'],
    lineColors: ['#FFDB00','#6EDADA'],
    hideHover: 'auto'
    })
    .fail(function( jqxhr, textStatus, error ) {
      var err = textStatus + ", " + error;
      alert( "Request Failed: auctioneer " + err );
    });
    });



    $.getJSON( url, { data: "clients" } )
    .done(function( clients ) {
    var area = new Morris.Area({
    element: 'clients',
    resize: true,    
    data: clients,
    xkey: 'm',
    ykeys: ['newclients','allclients'],
    labels: ['Новые клиенты','Все клиенты'],
    lineColors: ['#587BB0','#FE7A02'],
    hideHover: 'auto'
    })
    .fail(function( jqxhr, textStatus, error ) {
      var err = textStatus + ", " + error;
      alert( "Request Failed: clients " + err );
    });
    });


    $.getJSON( url, { data: "shop" } )
    .done(function( shop ) {
      
    var line = new Morris.Line({
    element: 'shop',
    resize: true,
    data: shop,
    xkey: 'm',
    ykeys: ['dm'],
    labels: ['Продажи'],
    lineColors: ['#efefef'],
    lineWidth: 1,
    hideHover: 'auto',
    gridTextColor: "#fff",
    gridStrokeWidth: 0.4, 
    pointSize: 4,
    pointStrokeColors: ["#efefef"],
    gridLineColor: "#efefef",
    gridTextFamily: "Open Sans",
    gridTextSize: 10
    })
    .fail(function( jqxhr, textStatus, error ) {
      var err = textStatus + ", " + error;
      alert( "Request Failed: shop " + err );
    });
    });



    });


