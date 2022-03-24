<?php
include("../../bd.php");
if ($status != 3) header('Location: /');

  include "header.php";
  include "menu.php";
  $dataf = $_POST;
  $den1 = $dataf['den1'];
  $den2 = $dataf['den2'];
  $region1 = $dataf['region1'];
  $adress1 = $dataf['adress1'];
  if (isset($dataf['filtr'])) {

    $den1 = $dataf['den1'];
    $den2 = $dataf['den2'];
    $region1 = $dataf['region1'];
    $adress1 = $dataf['adress1'];

/*
    if (!empty($den1) and !empty($den2)) {
      $resultq = mysqli_query($connect, "SELECT * FROM tabel
            WHERE
            segdata BETWEEN '$den1' AND '$den2'
             ");
    }
    if (!empty($den1) and !empty($den2) and !empty($region1)) {
      $resultq = mysqli_query($connect, "SELECT * FROM tabel
            WHERE region = '$region1' AND
            segdata BETWEEN '$den1' AND '$den2'");
    }
*/
    if (!empty($den1) and !empty($den2) and !empty($region1) and !empty($adress1)) {
      $resultq = mysqli_query($connect, "SELECT * FROM tabel
            WHERE region = '$region1' AND
            adress = '$adress1' AND
            -- typedogovor = 'Штат' AND
            segdata BETWEEN '$den1' AND '$den2' ");
    }
  }
?>
<script>
  function syncList() {}
  syncList.prototype.sync = function() {
    for (var i = 0; i < arguments.length - 1; i++) document.getElementById(arguments[i]).onchange = (function(o, id1, id2) {
      return function() {
        o._sync(id1, id2);
      };
    })(this, arguments[i], arguments[i + 1]);
    document.getElementById(arguments[0]).onchange();
  }
  syncList.prototype._sync = function(firstSelectId, secondSelectId) {
    var firstSelect = document.getElementById(firstSelectId);
    var secondSelect = document.getElementById(secondSelectId);

    secondSelect.length = 0;

    if (firstSelect.length > 0) {
      var optionData = this.dataList[firstSelect.options[firstSelect.selectedIndex == -1 ? 0 : firstSelect.selectedIndex].value];
      for (var key in optionData || null) secondSelect.options[secondSelect.length] = new Option(optionData[key], key);

      if (firstSelect.selectedIndex == -1) setTimeout(function() {
        firstSelect.options[0].selected = true;
      }, 1);
      if (secondSelect.length > 0) setTimeout(function() {
        secondSelect.options[0].selected = true;
      }, 1);
    }
    secondSelect.onchange && secondSelect.onchange();
  };
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Табель учета рабочего времени
      </h1>
    </section>
    <!-- Main content -->
    <section class="content" id="app">
      <!-- v-cloak -->
      <!-- <a href="filtrRashod.php" class="btn btn-block btn-primary">Фильтр по расходам</a> -->


      <div class="col-md-6">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <!-- <li  class="active"><a href="#branches" data-toggle="tab">Расходы по филиально</a></li> -->
            <!-- <li><a href="#regions" data-toggle="tab">Расходы по городам</a></li>
            <li><a href="#country" data-toggle="tab">За Казахстан</a></li> -->
            <li class="pull-left header"><i class="fa fa-th"></i> Формировать Табель учета рабочего времени </li>
          </ul>
          <div class="tab-content">

            <div class="tab-pane active" id="branches">
              <form action="" method="post">
                <div class="form-group">
                  <div class="row">
                    <!-- <div class="col-xs-3">
                      <input type="date" class="form-control" placeholder=".col-xs-3">
                    </div> -->
                    <div class="col-xs-6">
                      <input type="date" class="form-control" name="den1" placeholder=".col-xs-6" required="required">
                    </div>
                    <div class="col-xs-6">
                      <input type="date" class="form-control" name="den2" placeholder=".col-xs-6" required="required">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <select class="form-control" id="List1" name="region1" style="width: 100%;" required="required">
                    <option value="">Выберите регион(город)</option>
                    <!-- <option value="">ПО ВСЕМУ КЗ</option> -->
                    <?
                    $result2 = mysqli_query($connect, "SELECT region FROM tabel GROUP BY region");
                    while ($data2 = mysqli_fetch_array($result2)) { ?>
                      <option value="<?= $data2['region'] ?>"><?= $data2['region'] ?></option>
                    <? } ?>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" id="List2" name="adress1" style="width: 100%;" required="required">
                  </select>
                </div>
                <script type="text/javascript">
                        var syncList1 = new syncList;

                        syncList1.dataList = {


                          'Актау':{

                            <?
                            $result11 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Актау' ");
                            while($data11 = mysqli_fetch_array($result11))
                                 {?>
                                     '<?=$data11['adress'];?>':'<?=$data11['adress'];?>',
                               <?}?>
                          },

                          'Актобе':{

                            <?
                            $result12 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Актобе' ");
                            while($data12 = mysqli_fetch_array($result12))
                                 {?>
                                     '<?=$data12['adress'];?>':'<?=$data12['adress'];?>',
                               <?}?>
                          },

                          'Алматы':{

                            <?
                            $result13 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Алматы' ");
                            while($data13 = mysqli_fetch_array($result13))
                                 {?>
                                     '<?=$data13['adress'];?>':'<?=$data13['adress'];?>',
                               <?}?>
                          },

                          'Атырау':{

                            <?
                            $result14 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Атырау' ");
                            while($data14 = mysqli_fetch_array($result14))
                                 {?>
                                     '<?=$data14['adress'];?>':'<?=$data14['adress'];?>',
                               <?}?>
                          },

                          'Караганда':{

                            <?
                            $result15 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Караганда' ");
                            while($data15 = mysqli_fetch_array($result15))
                                 {?>
                                     '<?=$data15['adress'];?>':'<?=$data15['adress'];?>',
                               <?}?>
                          },

                          'Кокшетау':{

                            <?
                            $result16 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Кокшетау' ");
                            while($data16 = mysqli_fetch_array($result16))
                                 {?>
                                     '<?=$data16['adress'];?>':'<?=$data16['adress'];?>',
                               <?}?>
                          },


                          'Костанай':{

                            <?
                            $result17 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Костанай' ");
                            while($data17 = mysqli_fetch_array($result17))
                                 {?>
                                     '<?=$data17['adress'];?>':'<?=$data17['adress'];?>',
                               <?}?>
                          },

                          'Кызылорда':{

                            <?
                            $result18 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Кызылорда' ");
                            while($data18 = mysqli_fetch_array($result18))
                                 {?>
                                     '<?=$data18['adress'];?>':'<?=$data18['adress'];?>',
                               <?}?>
                          },


                          'Нур-Султан':{

                            <?
                            $result19 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Нур-Султан' ");
                            while($data19 = mysqli_fetch_array($result19))
                                 {?>
                                     '<?=$data19['adress'];?>':'<?=$data19['adress'];?>',
                               <?}?>
                          },

                          'Павлодар':{

                            <?
                            $result20 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Павлодар' ");
                            while($data20 = mysqli_fetch_array($result20))
                                 {?>
                                     '<?=$data20['adress'];?>':'<?=$data20['adress'];?>',
                               <?}?>
                          },

                          'Петропавловск':{

                            <?
                            $result21 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Петропавловск' ");
                            while($data21 = mysqli_fetch_array($result21))
                                 {?>
                                     '<?=$data21['adress'];?>':'<?=$data21['adress'];?>',
                               <?}?>
                          },


                          'Семей':{

                            <?
                            $result22 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Семей' ");
                            while($data22 = mysqli_fetch_array($result22))
                                 {?>
                                     '<?=$data22['adress'];?>':'<?=$data22['adress'];?>',
                               <?}?>
                          },

                          'Талдыкорган':{

                            <?
                            $result23 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Талдыкорган' ");
                            while($data23 = mysqli_fetch_array($result23))
                                 {?>
                                     '<?=$data23['adress'];?>':'<?=$data23['adress'];?>',
                               <?}?>
                          },

                          'Тараз':{

                            <?
                            $result24 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Тараз' ");
                            while($data24 = mysqli_fetch_array($result24))
                                 {?>
                                     '<?=$data24['adress'];?>':'<?=$data24['adress'];?>',
                               <?}?>
                          },


                          'Темиртау':{

                            <?
                            $result25 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Темиртау' ");
                            while($data25 = mysqli_fetch_array($result25))
                                 {?>
                                     '<?=$data25['adress'];?>':'<?=$data25['adress'];?>',
                               <?}?>
                          },


                          'Туркестан':{

                            <?
                            $result26 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Туркестан' ");
                            while($data26 = mysqli_fetch_array($result26))
                                 {?>
                                     '<?=$data26['adress'];?>':'<?=$data26['adress'];?>',
                               <?}?>
                          },

                          'Уральск':{

                            <?
                            $result27 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Уральск' ");
                            while($data27 = mysqli_fetch_array($result27))
                                 {?>
                                     '<?=$data27['adress'];?>':'<?=$data27['adress'];?>',
                               <?}?>
                          },


                          'Шымкент':{

                            <?
                            $result28 = mysqli_query($connect, "SELECT adress FROM tabel WHERE region = 'Шымкент' ");
                            while($data28 = mysqli_fetch_array($result28))
                                 {?>
                                     '<?=$data28['adress'];?>':'<?=$data28['adress'];?>',
                               <?}?>
                          },

                        };

                        // Включаем синхронизацию связанных списков
                        syncList1.sync("List1","List2","List3");
                        </script>
                <!-- <button class="btn btn-warning btn-block">Подтверить расход</button> -->
                <input class="btn btn-warning btn-block" type="submit" name="filtr" value="Искать...">
              </form>
            </div>
          </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
      </div><!-- /.col -->
    </section>
    <!-- Main content -->

<? if(isset($dataf['filtr'])){ ?>
    <br>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <!-- <h3 class="box-title">Responsive Hover Table</h3> -->

                                <div class="box-tools">
                                    <button id="btnExport" class="btn btn-success fa fa-excel" onclick="tableToExcel('report_table','ТАБЕЛЬ', 'ТАБЕЛЬ учета рабочего времени.xls')"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
                                    <script type="text/javascript">
                                        var tableToExcel = (function() {
                                            var uri = 'data:application/vnd.ms-excel;base64,',
                                                template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
                                                base64 = function(s) {
                                                    return window.btoa(unescape(encodeURIComponent(s)))
                                                },
                                                format = function(s, c) {
                                                    return s.replace(/{(\w+)}/g, function(m, p) {
                                                        return c[p];
                                                    })
                                                },
                                                downloadURI = function(uri, name) {
                                                    var link = document.createElement("a");
                                                    link.download = name;
                                                    link.href = uri;
                                                    link.click();
                                                }
                                            return function(table, name, fileName) {
                                                if (!table.nodeType) table = document.getElementById(table)
                                                var ctx = {
                                                    worksheet: name || 'Worksheet',
                                                    table: table.innerHTML
                                                }
                                                var resuri = uri + base64(format(template, ctx))
                                                downloadURI(resuri, fileName);
                                            }
                                        })();
                                    </script>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">


                                <br>
                                <div class="table-responsive">

                                    <table class="table table-bordered table-hover" id="report_table">
                                        <thead>
                                            <tr>
                                                <th colspan="20"> ТОО «АКТИВ ЛОМБАРД»</th>
                                                <th colspan="17">Утверждаю ______________ Шаграева И.Б.</th>
                                            </tr>

                                            <tr>
                                                <th colspan="20">БИН - 110 840 013 121</th>
                                                <th colspan="8" class="text-center">(подпись)</th>
                                                <th colspan="9"></th>
                                            </tr>

                                            <tr>
                                                <th colspan="14"><?=$_POST['region1'];?>, <?=$_POST['adress1'];?></th>
                                                <th colspan="23">ТАБЕЛЬ</th>
                                            </tr>
                                            <tr>
                                                <th colspan="12"></th>
                                                <th colspan="15">учета рабочего времени</th>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">№ п\п</td>
                                                <td rowspan="2">Фамилия</td>
                                                <td rowspan="2">Должность</td>
                                                <?
                                                $month = 2;
                                                $year = 2022;
                                                $kovodney  = date('t', mktime(0, 0, 0, $month, 1, $year));?>
                                                <td colspan="<?=$kovodney+2;?>" class="text-center">ФЕВРАЛЬ 2022 ГОД</td>
                                                <!-- <td rowspan="2" class="text-center">норма дней</td> -->
                                            </tr>
                                            <tr>
                                              <?
                                              $month = 2;
                                              $year = 2022;
                                              $kovodney  = date('t', mktime(0, 0, 0, $month, 1, $year));
                                              for ($i=1; $i <=$kovodney ; $i++) {
                                              ?>
                                                <td><?=$i;?></td>
                                              <?}?>
                                                <td>Отраб.<br>дни</td>
                                                <td>Отраб.<br>часы</td>
                                                <td>Норма <br>дней</td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <th colspan="<?=$kovodney+6;?>" class="text-center">ШТАТ</th>
                                            </tr>
                                            <?
                                            $resultq = mysqli_query($connect, "SELECT * FROM tabel
                                                  WHERE region = '$region1' AND
                                                  adress = '$adress1' AND
                                                  typedogovor = 'Штат' AND
                                                  segdata BETWEEN '$den1' AND '$den2' ");
                                            while ($dataq = mysqli_fetch_array($resultq)) {
                                              $typedogovor = $dataq['typedogovor'];
                                              ?>
                                            <tr>
                                                <th>1</th>
                                                <th><?=$dataq['fio'];?></th>
                                                <td><?=$dataq['doljnost'];?></td>
                                                <?
                                                $month = 2;
                                                $year = 2022;
                                                $kovodney  = date('t', mktime(0, 0, 0, $month, 1, $year));
                                                for ($i=1; $i <=$kovodney ; $i++) {
                                                ?>
                                                  <td><?=$i;?></td>
                                                <?}?>
                                                <td>од</td>
                                                <td>оч</td>
                                                <td>нд</td>
                                            </tr>
                                            <?}?>

                                            <tr>
                                                <th colspan="39" class="text-center">ГПХ</th>
                                            </tr>

                                            <?
                                            $resultq = mysqli_query($connect, "SELECT * FROM tabel
                                                  WHERE region = '$region1' AND
                                                  adress = '$adress1' AND
                                                  typedogovor = 'гпх' AND
                                                  segdata BETWEEN '$den1' AND '$den2' ");
                                            while ($dataq = mysqli_fetch_array($resultq)) {
                                              $typedogovor = $dataq['typedogovor'];
                                              ?>
                                            <tr>
                                                <th>2</th>
                                                <th><?=$dataq['fio'];?></th>
                                                <td><?=$dataq['doljnost'];?></td>
                                                <?
                                                $month = 2;
                                                $year = 2022;
                                                $kovodney  = date('t', mktime(0, 0, 0, $month, 1, $year));
                                                for ($i=1; $i <=$kovodney ; $i++) {
                                                ?>
                                                  <td><?=$i;?></td>
                                                <?}?>
                                                <td>од_гпх</td>
                                                <td>оч_гпх</td>
                                                <td>нд_гпх</td>
                                            </tr>
                                            <?}?>


                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>


            </section>
<?}?>
  </div>

<?php include "footer.php"; ?>
