<?php
include("../../bd.php");
if ($status != 3) header('Location: /');

  include "header.php";
  include "menu.php";
  $dataf = $_POST;

  if (isset($dataf['filtr'])) {

    $den1 = $dataf['den1'];
    $region1 = $dataf['region1'];
    $adress1 = $dataf['adress1'];

    if (!empty($den1) and !empty($den2) ) {
      $resultq = mysqli_query($connect, "SELECT * FROM tabel
            WHERE
            segdata='$den1'");
    }
  }
?>
<div class="content-wrapper">
  <section class="content-header">
      <h1>
          Просмотр рапортов на любой день, если ОВН конечно не забыл заполнить, екрный бабай
      </h1>
      <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li class="active">Просмотр рапорта</li>
      </ol>
  </section>
  <section class="content">

      <div class="row">
          <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <div class="box-tools">
                      <button id="btnExport" class="btn btn-success fa fa-excel" onclick="tableToExcel('report_table','РАПОРТ', 'РАПОРТ ежедневный.xls')"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
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
                <div class="box-body">
                    <form action=""  method="POST">

                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="den1" >
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <input class="btn-warning btn" type="submit" name="filtr" value="Формировать рапорт, НО перед тем как нажать скажите - СЮФ СЮФ">
                            </div>
                        </div>
                    </form>
                </div>
              </div>
          </div>
      </div>
<? if(isset($dataf['filtr'])){ ?>
      <div class="row">
          <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <h2 class="box-title text-center">Рапорт</h2>
                  <p class="box-title text-center"><b>За <?=date("d.m.Y", strtotime($den1));?> г. (день)</b></p>
                  <p class="box-title text-center">Довожу до Вашего сведения, что по результатам предоставленного филиалами фото отчёта за контролем соблюдения работниками
                  трудовой дисциплины, сообщаем:
                  <br>
                  <b>Штаб г. Нур-Султан</b></p>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="report_table">
                      <thead>
                        <tr>
                          <th rowspan="2">
                          Отдел
                          </th>
                          <th rowspan="2">Ф.И.О сотрудника</th>
                          <th rowspan="2">Должность</th>
                          <th  colspan="2">Отсутствующие
                          опоздавшие
                          </th>
                          <th rowspan="2">Дополнительная информация о сотрудниках</th>
                        </tr>
                        <tr>
                          <th>В</th>
                          <th>В</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?  $resultq2 = mysqli_query($connect, "SELECT COUNT(*) FROM tabel
                                  WHERE  segdata='$den1' AND otdel = 'ОВН'");
                                  $dataq2 = mysqli_fetch_array($resultq2);
                                    $countovn = $dataq2['COUNT(*)'];
                                  ?>
                          <th rowspan="<?=$countovn+1;?>"> ОВН </th>

                        </tr>

                    <?  $resultq = mysqli_query($connect, "SELECT * FROM tabel
                            WHERE  segdata='$den1' AND otdel = 'ОВН'");
                            while ($dataq = mysqli_fetch_array($resultq)) {
                              if($dataq['dopinfo']=='БО'){ $dopinfo = '+'; }
                              if($dataq['dopinfo']=='В'){ $dopinfo = 'выходной'; }
                              if($dataq['dopinfo']=='А'){ $dopinfo = 'отпуск без сохранения заработной оплаты'; }
                              if($dataq['dopinfo']=='П'){ $dopinfo = 'прогул'; }
                              if($dataq['dopinfo']=='О'){ $dopinfo = 'оплачиваемый отпуск'; }
                              if($dataq['dopinfo']=='ДО'){ $dopinfo = 'отпуск по беременности и родам'; }
                              if($dataq['dopinfo']=='К'){ $dopinfo = 'командировка'; }
                              if($dataq['dopinfo']=='Н'){ $dopinfo = 'В ночь'; }
                              if($dataq['dopinfo']=='ОПЗ'){ $dopinfo = 'Опоздал(а)'; }
                              if($dataq['dopinfo']=='УД'){ $dopinfo = 'Удаленно'; }
                              if($dataq['dopinfo']=='Б'){ $dopinfo = 'Больничный'; }
                              if($dataq['dopinfo']=='УВ'){ $dopinfo = 'Уволен'; }
                            ?>
                            <tr>
                                <th> <?=$dataq['fio']?> </th>
                                <td> <?=$dataq['doljnost'];?> </td>
                                <th></th>
                                <th>
                                  <?
                                  if($dataq['dopinfo']=='ОПЗ'){
                                  echo  $vrmeiya = $dataq['vrmeiya'];
                                  }
                                  ?>
                                </th>
                                <td><?=$dopinfo;?></td>
                            </tr>
                            <?}?>
                            <tr>
                              <td colspan="6" style="text-align:center"></td>
                      		  </tr>

                            <tr>
                              <?  $resultq2 = mysqli_query($connect, "SELECT COUNT(*) FROM tabel
                              WHERE  segdata='$den1' AND otdel = 'Отдел кадров'");
                              $dataq2 = mysqli_fetch_array($resultq2);
                                $countkadr = $dataq2['COUNT(*)'];
                              ?>
                              <th rowspan="<?=$countkadr+1;?>"> Отдел кадров </th>
                            </tr>
                            <?  $resultq = mysqli_query($connect, "SELECT * FROM tabel
                            WHERE  segdata='$den1' AND otdel = 'Отдел кадров'");
                            while ($dataq = mysqli_fetch_array($resultq)) {
                              if($dataq['dopinfo']=='БО'){ $dopinfo = '+'; }
                              if($dataq['dopinfo']=='В'){ $dopinfo = 'выходной'; }
                              if($dataq['dopinfo']=='А'){ $dopinfo = 'отпуск без сохранения заработной оплаты'; }
                              if($dataq['dopinfo']=='П'){ $dopinfo = 'прогул'; }
                              if($dataq['dopinfo']=='О'){ $dopinfo = 'оплачиваемый отпуск'; }
                              if($dataq['dopinfo']=='ДО'){ $dopinfo = 'отпуск по беременности и родам'; }
                              if($dataq['dopinfo']=='К'){ $dopinfo = 'командировка'; }
                              if($dataq['dopinfo']=='Н'){ $dopinfo = 'В ночь'; }
                              if($dataq['dopinfo']=='ОПЗ'){ $dopinfo = 'Опоздал(а)'; }
                              if($dataq['dopinfo']=='УД'){ $dopinfo = 'Удаленно'; }
                              if($dataq['dopinfo']=='Б'){ $dopinfo = 'Больничный'; }
                              if($dataq['dopinfo']=='УВ'){ $dopinfo = 'Уволен'; }
                            ?>
                            <tr>
                              <th> <?=$dataq['fio']?> </th>
                              <td> <?=$dataq['doljnost'];?> </td>
                              <th></th>
                              <th>
                                <?
                                if($dataq['dopinfo']=='ОПЗ'){
                                echo  $vrmeiya = $dataq['vrmeiya'];
                                }
                                ?>
                              </th>
                              <td><?=$dopinfo;?></td>
                            </tr>
                            <?}?>
                            <tr>
                              <td colspan="6" style="text-align:center"></td>
                      		  </tr>
                            <tr>
                      <?  $resultq2 = mysqli_query($connect, "SELECT COUNT(*) FROM tabel
                              WHERE  segdata='$den1' AND otdel = 'Бухгалтерия'");
                              $dataq2 = mysqli_fetch_array($resultq2);
                                $count_bug = $dataq2['COUNT(*)'];
                              ?>
                              <th rowspan="<?=$count_bug+1;?>"> Бухгалтерия </th>
                            </tr>
                    <?  $resultq = mysqli_query($connect, "SELECT * FROM tabel
                            WHERE  segdata='$den1' AND otdel = 'Бухгалтерия'");
                            while ($dataq = mysqli_fetch_array($resultq)) {
                              if($dataq['dopinfo']=='БО'){ $dopinfo = '+'; }
                              if($dataq['dopinfo']=='В'){ $dopinfo = 'выходной'; }
                              if($dataq['dopinfo']=='А'){ $dopinfo = 'отпуск без сохранения заработной оплаты'; }
                              if($dataq['dopinfo']=='П'){ $dopinfo = 'прогул'; }
                              if($dataq['dopinfo']=='О'){ $dopinfo = 'оплачиваемый отпуск'; }
                              if($dataq['dopinfo']=='ДО'){ $dopinfo = 'отпуск по беременности и родам'; }
                              if($dataq['dopinfo']=='К'){ $dopinfo = 'командировка'; }
                              if($dataq['dopinfo']=='Н'){ $dopinfo = 'В ночь'; }
                              if($dataq['dopinfo']=='ОПЗ'){ $dopinfo = 'Опоздал(а)'; }
                              if($dataq['dopinfo']=='УД'){ $dopinfo = 'Удаленно'; }
                              if($dataq['dopinfo']=='Б'){ $dopinfo = 'Больничный'; }
                              if($dataq['dopinfo']=='УВ'){ $dopinfo = 'Уволен'; }
                            ?>
                            <tr>
                                <th> <?=$dataq['fio']?> </th>
                                <td> <?=$dataq['doljnost'];?> </td>
                                <th></th>
                                <th>
                                  <?
                                  if($dataq['dopinfo']=='ОПЗ'){
                                  echo  $vrmeiya = $dataq['vrmeiya'];
                                  }
                                  ?>
                                </th>
                                <td><?=$dopinfo;?></td>
                            </tr>
                            <?}?>
                            <tr>
                              <td colspan="6" style="text-align:center"></td>
                      		  </tr>
                            <tr>
                              <?  $resultq2 = mysqli_query($connect, "SELECT COUNT(*) FROM tabel
                                      WHERE  segdata='$den1' AND otdel = 'Администрация'");
                                      $dataq2 = mysqli_fetch_array($resultq2);
                                        $countk_adm = $dataq2['COUNT(*)'];
                                      ?>
                              <th rowspan="<?=$countk_adm+1;?>"> Администрация </th>

                            </tr>

                    <?  $resultq = mysqli_query($connect, "SELECT * FROM tabel
                            WHERE  segdata='$den1' AND otdel = 'Администрация'");
                            while ($dataq = mysqli_fetch_array($resultq)) {
                              if($dataq['dopinfo']=='БО'){ $dopinfo = '+'; }
                              if($dataq['dopinfo']=='В'){ $dopinfo = 'выходной'; }
                              if($dataq['dopinfo']=='А'){ $dopinfo = 'отпуск без сохранения заработной оплаты'; }
                              if($dataq['dopinfo']=='П'){ $dopinfo = 'прогул'; }
                              if($dataq['dopinfo']=='О'){ $dopinfo = 'оплачиваемый отпуск'; }
                              if($dataq['dopinfo']=='ДО'){ $dopinfo = 'отпуск по беременности и родам'; }
                              if($dataq['dopinfo']=='К'){ $dopinfo = 'командировка'; }
                              if($dataq['dopinfo']=='Н'){ $dopinfo = 'В ночь'; }
                              if($dataq['dopinfo']=='ОПЗ'){ $dopinfo = 'Опоздал(а)'; }
                              if($dataq['dopinfo']=='УД'){ $dopinfo = 'Удаленно'; }
                              if($dataq['dopinfo']=='Б'){ $dopinfo = 'Больничный'; }
                              if($dataq['dopinfo']=='УВ'){ $dopinfo = 'Уволен'; }
                            ?>
                            <tr>
                                <th> <?=$dataq['fio']?> </th>
                                <td> <?=$dataq['doljnost'];?> </td>
                                <th></th>
                                <th>
                                  <?
                                  if($dataq['dopinfo']=='ОПЗ'){
                                  echo  $vrmeiya = $dataq['vrmeiya'];
                                  }
                                  ?>
                                </th>
                                <td><?=$dopinfo;?></td>
                            </tr>
                            <?}?>
                            <tr>
                              <td colspan="6" style="text-align:center"></td>
                      		  </tr>
                            <tr>
                              <?  $resultq2 = mysqli_query($connect, "SELECT COUNT(*) FROM tabel
                                      WHERE  segdata='$den1' AND otdel = 'Юридический отдел'");
                                      $dataq2 = mysqli_fetch_array($resultq2);
                                        $countk_ur = $dataq2['COUNT(*)'];
                                      ?>
                              <th rowspan="<?=$countk_ur+1;?>"> Юридический отдел </th>

                            </tr>

                    <?  $resultq = mysqli_query($connect, "SELECT * FROM tabel
                            WHERE  segdata='$den1' AND otdel = 'Юридический отдел'");
                            while ($dataq = mysqli_fetch_array($resultq)) {
                              if($dataq['dopinfo']=='БО'){ $dopinfo = '+'; }
                              if($dataq['dopinfo']=='В'){ $dopinfo = 'выходной'; }
                              if($dataq['dopinfo']=='А'){ $dopinfo = 'отпуск без сохранения заработной оплаты'; }
                              if($dataq['dopinfo']=='П'){ $dopinfo = 'прогул'; }
                              if($dataq['dopinfo']=='О'){ $dopinfo = 'оплачиваемый отпуск'; }
                              if($dataq['dopinfo']=='ДО'){ $dopinfo = 'отпуск по беременности и родам'; }
                              if($dataq['dopinfo']=='К'){ $dopinfo = 'командировка'; }
                              if($dataq['dopinfo']=='Н'){ $dopinfo = 'В ночь'; }
                              if($dataq['dopinfo']=='ОПЗ'){ $dopinfo = 'Опоздал(а)'; }
                              if($dataq['dopinfo']=='УД'){ $dopinfo = 'Удаленно'; }
                              if($dataq['dopinfo']=='Б'){ $dopinfo = 'Больничный'; }
                              if($dataq['dopinfo']=='УВ'){ $dopinfo = 'Уволен'; }
                            ?>
                            <tr>
                                <th> <?=$dataq['fio']?> </th>
                                <td> <?=$dataq['doljnost'];?> </td>
                                <th></th>
                                <th>
                                  <?
                                  if($dataq['dopinfo']=='ОПЗ'){
                                  echo  $vrmeiya = $dataq['vrmeiya'];
                                  }
                                  ?>
                                </th>
                                <td><?=$dopinfo;?></td>
                            </tr>
                            <?}?>
                            <tr>
                              <td colspan="6" style="text-align:center"></td>
                      		  </tr>
                            <tr>
                              <?  $resultq2 = mysqli_query($connect, "SELECT COUNT(*) FROM tabel
                                      WHERE  segdata='$den1' AND otdel = 'IT отдел'");
                                      $dataq2 = mysqli_fetch_array($resultq2);
                                        $countk_it = $dataq2['COUNT(*)'];
                                      ?>
                              <th rowspan="<?=$countk_it+1;?>"> IT отдел </th>

                            </tr>
                    <?  $resultq = mysqli_query($connect, "SELECT * FROM tabel
                            WHERE  segdata='$den1' AND otdel = 'IT отдел'");
                            while ($dataq = mysqli_fetch_array($resultq)) {
                              if($dataq['dopinfo']=='БО'){ $dopinfo = '+'; }
                              if($dataq['dopinfo']=='В'){ $dopinfo = 'выходной'; }
                              if($dataq['dopinfo']=='А'){ $dopinfo = 'отпуск без сохранения заработной оплаты'; }
                              if($dataq['dopinfo']=='П'){ $dopinfo = 'прогул'; }
                              if($dataq['dopinfo']=='О'){ $dopinfo = 'оплачиваемый отпуск'; }
                              if($dataq['dopinfo']=='ДО'){ $dopinfo = 'отпуск по беременности и родам'; }
                              if($dataq['dopinfo']=='К'){ $dopinfo = 'командировка'; }
                              if($dataq['dopinfo']=='Н'){ $dopinfo = 'В ночь'; }
                              if($dataq['dopinfo']=='ОПЗ'){ $dopinfo = 'Опоздал(а)'; }
                              if($dataq['dopinfo']=='УД'){ $dopinfo = 'Удаленно'; }
                              if($dataq['dopinfo']=='Б'){ $dopinfo = 'Больничный'; }
                              if($dataq['dopinfo']=='УВ'){ $dopinfo = 'Уволен'; }
                            ?>
                            <tr>
                                <th> <?=$dataq['fio']?> </th>
                                <td> <?=$dataq['doljnost'];?> </td>
                                <th></th>
                                <th>
                                  <?
                                  if($dataq['dopinfo']=='ОПЗ'){
                                  echo  $vrmeiya = $dataq['vrmeiya'];
                                  }
                                  ?>
                                </th>
                                <td><?=$dopinfo;?></td>
                            </tr>
                            <?}?>
                            <tr>
                              <td colspan="6" style="text-align:center"></td>
                      		  </tr>
                            <tr>
                              <?  $resultq2 = mysqli_query($connect, "SELECT COUNT(*) FROM tabel
                                      WHERE  segdata='$den1' AND otdel = 'Отдел рекламы'");
                                      $dataq2 = mysqli_fetch_array($resultq2);
                                        $countk_or = $dataq2['COUNT(*)'];
                                      ?>
                              <th rowspan="<?=$countk_or+1;?>"> Отдел рекламы </th>
                            </tr>
                    <?  $resultq = mysqli_query($connect, "SELECT * FROM tabel
                            WHERE  segdata='$den1' AND otdel = 'Отдел рекламы'");
                            while ($dataq = mysqli_fetch_array($resultq)) {
                              if($dataq['dopinfo']=='БО'){ $dopinfo = '+'; }
                              if($dataq['dopinfo']=='В'){ $dopinfo = 'выходной'; }
                              if($dataq['dopinfo']=='А'){ $dopinfo = 'отпуск без сохранения заработной оплаты'; }
                              if($dataq['dopinfo']=='П'){ $dopinfo = 'прогул'; }
                              if($dataq['dopinfo']=='О'){ $dopinfo = 'оплачиваемый отпуск'; }
                              if($dataq['dopinfo']=='ДО'){ $dopinfo = 'отпуск по беременности и родам'; }
                              if($dataq['dopinfo']=='К'){ $dopinfo = 'командировка'; }
                              if($dataq['dopinfo']=='Н'){ $dopinfo = 'В ночь'; }
                              if($dataq['dopinfo']=='ОПЗ'){ $dopinfo = 'Опоздал(а)'; }
                              if($dataq['dopinfo']=='УД'){ $dopinfo = 'Удаленно'; }
                              if($dataq['dopinfo']=='Б'){ $dopinfo = 'Больничный'; }
                              if($dataq['dopinfo']=='УВ'){ $dopinfo = 'Уволен'; }
                            ?>
                            <tr>
                                <th> <?=$dataq['fio']?> </th>
                                <td> <?=$dataq['doljnost'];?> </td>
                                <th></th>
                                <th>
                                  <?
                                  if($dataq['dopinfo']=='ОПЗ'){
                                  echo  $vrmeiya = $dataq['vrmeiya'];
                                  }
                                  ?>
                                </th>
                                <td><?=$dopinfo;?></td>
                            </tr>
                            <?}?>
                            <tr>
                              <td colspan="6" style="text-align:center"></td>
                      		  </tr>
                            <tr>
                              <?  $resultq2 = mysqli_query($connect, "SELECT COUNT(*) FROM tabel
                                      WHERE  segdata='$den1' AND otdel = 'Служба безопасности'");
                                      $dataq2 = mysqli_fetch_array($resultq2);
                                        $countk_sb = $dataq2['COUNT(*)'];
                                      ?>
                              <th rowspan="<?=$countk_sb+1;?>"> Служба безопасности </th>
                            </tr>

                    <?  $resultq = mysqli_query($connect, "SELECT * FROM tabel
                            WHERE  segdata='$den1' AND otdel = 'Служба безопасности'");
                            while ($dataq = mysqli_fetch_array($resultq)) {
                              if($dataq['dopinfo']=='БО'){ $dopinfo = '+'; }
                              if($dataq['dopinfo']=='В'){ $dopinfo = 'выходной'; }
                              if($dataq['dopinfo']=='А'){ $dopinfo = 'отпуск без сохранения заработной оплаты'; }
                              if($dataq['dopinfo']=='П'){ $dopinfo = 'прогул'; }
                              if($dataq['dopinfo']=='О'){ $dopinfo = 'оплачиваемый отпуск'; }
                              if($dataq['dopinfo']=='ДО'){ $dopinfo = 'отпуск по беременности и родам'; }
                              if($dataq['dopinfo']=='К'){ $dopinfo = 'командировка'; }
                              if($dataq['dopinfo']=='Н'){ $dopinfo = 'В ночь'; }
                              if($dataq['dopinfo']=='ОПЗ'){ $dopinfo = 'Опоздал(а)'; }
                              if($dataq['dopinfo']=='УД'){ $dopinfo = 'Удаленно'; }
                              if($dataq['dopinfo']=='Б'){ $dopinfo = 'Больничный'; }
                              if($dataq['dopinfo']=='УВ'){ $dopinfo = 'Уволен'; }
                            ?>
                            <tr>
                                <th> <?=$dataq['fio']?> </th>
                                <td> <?=$dataq['doljnost'];?> </td>
                                <th></th>
                                <th>
                                  <?
                                  if($dataq['dopinfo']=='ОПЗ'){
                                  echo  $vrmeiya = $dataq['vrmeiya'];
                                  }
                                  ?>
                                </th>
                                <td><?=$dopinfo;?></td>
                            </tr>
                            <?}?>
                            <tr>
                              <td colspan="6" style="text-align:center"></td>
                      		  </tr>
                            <?
                            $resultq3 = mysqli_query($connect, "SELECT region,adress FROM `tabel` WHERE adress!='Акын сара 37(Бэк-офис)' GROUP BY region,adress");
                            while ($dataq3 = mysqli_fetch_array($resultq3)){
                              $region_h = $dataq3['region'];
                              $adress_h = $dataq3['adress'];
                            ?>
                            <tr>
                              <?
                              $resultq2 = mysqli_query($connect, "SELECT COUNT(*), adress FROM tabel
                                      WHERE  segdata='$den1' AND region = '$region_h' AND adress = '$adress_h'");
                                      $dataq2 = mysqli_fetch_array($resultq2);
                                        $countk_sb = $dataq2['COUNT(*)'];
                                      ?>
                              <th rowspan="<?=$countk_sb+1;?>"> <?=$region_h;?>/<?=$adress_h;?> </th>
                            </tr>
                            <?
                            $resultq = mysqli_query($connect, "SELECT * FROM tabel
                                    WHERE  segdata='$den1' AND region = '$region_h' AND adress = '$adress_h' ");
                                    while ($dataq = mysqli_fetch_array($resultq)) {
                                      if($dataq['dopinfo']=='БО'){ $dopinfo = '+'; }
                                      if($dataq['dopinfo']=='В'){ $dopinfo = 'выходной'; }
                                      if($dataq['dopinfo']=='А'){ $dopinfo = 'отпуск без сохранения заработной оплаты'; }
                                      if($dataq['dopinfo']=='П'){ $dopinfo = 'прогул'; }
                                      if($dataq['dopinfo']=='О'){ $dopinfo = 'оплачиваемый отпуск'; }
                                      if($dataq['dopinfo']=='ДО'){ $dopinfo = 'отпуск по беременности и родам'; }
                                      if($dataq['dopinfo']=='К'){ $dopinfo = 'командировка'; }
                                      if($dataq['dopinfo']=='Н'){ $dopinfo = 'В ночь'; }
                                      if($dataq['dopinfo']=='ОПЗ'){ $dopinfo = 'Опоздал(а)'; }
                                      if($dataq['dopinfo']=='УД'){ $dopinfo = 'Удаленно'; }
                                      if($dataq['dopinfo']=='Б'){ $dopinfo = 'Больничный'; }
                                      if($dataq['dopinfo']=='УВ'){ $dopinfo = 'Уволен'; }
                                    ?>
                              <tr>
                                <th> <?=$dataq['fio']?> </th>
                                <td> <?=$dataq['doljnost'];?> </td>
                                <th></th>
                                <th>
                                  <?
                                  if($dataq['dopinfo']=='ОПЗ'){
                                  echo  $vrmeiya = $dataq['vrmeiya'];
                                  }
                                  ?>
                                </th>
                                <td><?=$dopinfo;?></td>
                              </tr>
                                    <?}?>
                                    <tr>
                                      <td colspan="6" style="text-align:center"></td>
                              		  </tr>
                            <?}?>
                          </tbody>
                            </table>
                            <h4 class="text-center">Начальник ОВН Стрельбицкий А.</h4>
                          </div>
                  </div> <!--box body -->
              </div>
          </div>
      </div>

<?}?>
    </section>
</div>
<?php include "footer.php"; ?>
