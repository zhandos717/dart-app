<?
include __DIR__ . '/../../layouts/header.php';
include __DIR__ . '/../../layouts/menu/video_surveillance.php';



$data1 = date('Y-m-d');
$segdata = date("Y-m-d");
// $result_region = mysqli_query($connect, "SELECT region FROM employeecard GROUP BY region");
// $result_adress = mysqli_query($connect, "SELECT adress FROM employeecard GROUP BY adress");
// $result_doljnost = mysqli_query($connect, "SELECT doljnost FROM employeecard GROUP BY doljnost");
if(isset($_GET['gogogo'])){
  $region2 = $_GET['region'];
  $adress2 = $_GET['adress'];
  $resultr = mysqli_query($connect, "SELECT * FROM employeecard WHERE region = '$region2' AND adress = '$adress2' ");

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

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Отметка сотдрудников в РАПОРТ
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

          <div class="box-body">
            <form action=""  method="GET">
              <div class="col-lg-2 col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-bank"></i>
                  </span>


                  <select class="form-control"  id="List1" name="region" style="width: 100%;">
                    <option>Выберите регион(город)</option>
                    <?
                    $result2 = mysqli_query($connect, "SELECT region FROM employeecard GROUP BY region");
                          while ( $data2 = mysqli_fetch_array($result2))
                              {?>
                                <option value="<?=$data2['region']?>"><?=$data2['region']?></option>
                            <?}?>
                  </select>
                </div>
              </div>

              <div class="col-lg-2 col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-tag"></i>
                  </span>
                  <select class="form-control"   id="List2" name="adress" style="width: 100%;">
                  </select>

                </div>
              </div>

      <script type="text/javascript">
              var syncList1 = new syncList;

              syncList1.dataList = {


                'Актау':{

                  <?
                  $result11 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Актау' ");
                  while($data11 = mysqli_fetch_array($result11))
                       {?>
                           '<?=$data11['adress'];?>':'<?=$data11['adress'];?>',
                     <?}?>
                },

                'Актобе':{

                  <?
                  $result12 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Актобе' ");
                  while($data12 = mysqli_fetch_array($result12))
                       {?>
                           '<?=$data12['adress'];?>':'<?=$data12['adress'];?>',
                     <?}?>
                },

                'Алматы':{

                  <?
                  $result13 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Алматы' ");
                  while($data13 = mysqli_fetch_array($result13))
                       {?>
                           '<?=$data13['adress'];?>':'<?=$data13['adress'];?>',
                     <?}?>
                },

                'Атырау':{

                  <?
                  $result14 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Атырау' ");
                  while($data14 = mysqli_fetch_array($result14))
                       {?>
                           '<?=$data14['adress'];?>':'<?=$data14['adress'];?>',
                     <?}?>
                },

                'Караганда':{

                  <?
                  $result15 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Караганда' ");
                  while($data15 = mysqli_fetch_array($result15))
                       {?>
                           '<?=$data15['adress'];?>':'<?=$data15['adress'];?>',
                     <?}?>
                },

                'Кокшетау':{

                  <?
                  $result16 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Кокшетау' ");
                  while($data16 = mysqli_fetch_array($result16))
                       {?>
                           '<?=$data16['adress'];?>':'<?=$data16['adress'];?>',
                     <?}?>
                },


                'Костанай':{

                  <?
                  $result17 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Костанай' ");
                  while($data17 = mysqli_fetch_array($result17))
                       {?>
                           '<?=$data17['adress'];?>':'<?=$data17['adress'];?>',
                     <?}?>
                },

                'Кызылорда':{

                  <?
                  $result18 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Кызылорда' ");
                  while($data18 = mysqli_fetch_array($result18))
                       {?>
                           '<?=$data18['adress'];?>':'<?=$data18['adress'];?>',
                     <?}?>
                },


                'Нур-Султан':{

                  <?
                  $result19 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Нур-Султан' ");
                  while($data19 = mysqli_fetch_array($result19))
                       {?>
                           '<?=$data19['adress'];?>':'<?=$data19['adress'];?>',
                     <?}?>
                },

                'Павлодар':{

                  <?
                  $result20 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Павлодар' ");
                  while($data20 = mysqli_fetch_array($result20))
                       {?>
                           '<?=$data20['adress'];?>':'<?=$data20['adress'];?>',
                     <?}?>
                },

                'Петропавловск':{

                  <?
                  $result21 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Петропавловск' ");
                  while($data21 = mysqli_fetch_array($result21))
                       {?>
                           '<?=$data21['adress'];?>':'<?=$data21['adress'];?>',
                     <?}?>
                },


                'Семей':{

                  <?
                  $result22 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Семей' ");
                  while($data22 = mysqli_fetch_array($result22))
                       {?>
                           '<?=$data22['adress'];?>':'<?=$data22['adress'];?>',
                     <?}?>
                },

                'Талдыкорган':{

                  <?
                  $result23 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Талдыкорган' ");
                  while($data23 = mysqli_fetch_array($result23))
                       {?>
                           '<?=$data23['adress'];?>':'<?=$data23['adress'];?>',
                     <?}?>
                },

                'Тараз':{

                  <?
                  $result24 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Тараз' ");
                  while($data24 = mysqli_fetch_array($result24))
                       {?>
                           '<?=$data24['adress'];?>':'<?=$data24['adress'];?>',
                     <?}?>
                },


                'Темиртау':{

                  <?
                  $result25 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Темиртау' ");
                  while($data25 = mysqli_fetch_array($result25))
                       {?>
                           '<?=$data25['adress'];?>':'<?=$data25['adress'];?>',
                     <?}?>
                },


                'Туркестан':{

                  <?
                  $result26 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Туркестан' ");
                  while($data26 = mysqli_fetch_array($result26))
                       {?>
                           '<?=$data26['adress'];?>':'<?=$data26['adress'];?>',
                     <?}?>
                },

                'Уральск':{

                  <?
                  $result27 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Уральск' ");
                  while($data27 = mysqli_fetch_array($result27))
                       {?>
                           '<?=$data27['adress'];?>':'<?=$data27['adress'];?>',
                     <?}?>
                },


                'Шымкент':{

                  <?
                  $result28 = mysqli_query($connect, "SELECT adress FROM employeecard WHERE region = 'Шымкент' ");
                  while($data28 = mysqli_fetch_array($result28))
                       {?>
                           '<?=$data28['adress'];?>':'<?=$data28['adress'];?>',
                     <?}?>
                },

              };

              // Включаем синхронизацию связанных списков
              syncList1.sync("List1","List2","List3");
              </script>

              <div class="input-group input-group-sm">
                <span class="input-group-btn">
                  <input type="submit" class="btn btn-info" name="gogogo" value="Подтвердить!">
                  <!-- <button type="submit" class="btn btn-info">Подтвердить!</button> -->
                </span>
              </div>
            </form>
          </div>
          <!--.box-body -->
        </div>
        <!--.box -->
      </div>
      <!--.col-md-12 -->
      <!--------------------------------------------------------------------------->
      <!-- <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"> </h3>
          </div>
          <div class="box-body">
            <div class="answer">
              asdasdf
            </div>
          </div>
        </div>
      </div> -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Список сотдрудников</h3>
              </div>
              <div class="box-body">
                <!-- <form class="" action="addTabel" method="post"> -->


                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Регион</th>
                      <th>Филиал</th>
                      <th>ФИО</th>
                      <th>График работы</th>
                      <th>Время ОПОЗДАНИЕ<br>(УКАЖИТЕ ВРЕМЯ-ЕСЛИ ОПОЗДАЛ)</th>
                      <th>Доп инфомация</th>
                      <!-- <th>Штрафы</th> -->
                      <th>Отметка</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?

                    // $result = mysqli_query($connect, "SELECT * FROM employeecard ");
                          while ( $datar = mysqli_fetch_array($resultr)) {
                            $id =$datar['id'];
                            $idpred =$_GET['idpred'];
                            $idget =$_GET['id'];
                            if($id==$idpred){
                              $resultidpred = mysqli_query($connect, "SELECT * FROM tabel WHERE id = '$idget' AND segdata = '$segdata'  ");
                              $dataidpred = mysqli_fetch_array($resultidpred);
                              $vpr = $dataidpred['vrmeiya'];
                              $strtext='Сохранено';
                              $colorbtn = 'info';
                              $dopinfo = $dataidpred['dopinfo'];
                              $idtabel = $dataidpred['id'];
                            }
                            else{
                              $resultidpred2 = mysqli_query($connect, "SELECT * FROM tabel WHERE idpred = '$id' AND segdata = '$segdata' ");
                              $dataidpred2 = mysqli_fetch_array($resultidpred2);
                              $vpr = $dataidpred2['vrmeiya'];
                              $strtext='+';
                              $colorbtn = 'danger';
                              $dopinfo = $dataidpred2['dopinfo'];
                              $idtabel = $dataidpred['id'];
                            }

                            ?>
                    <tr>
                      <td>
                        <?=$id;?> - <?=$datar['region'];?>
                      </td>
                      <td><?=$datar['adress'];?></td>
                      <td><?=$datar['fio'];?><br><i><?=$datar['doljnost'];?></i></td>
                      <td><?=$datar['time_work'];?></td>
                      <form class="" action="addTabel" method="GET">

                      <td>
                        <input type="time" value='<?=$vpr;?>' name="vrmeiya" class="form-control">
                      </td>
                      <td>
                        <select class="form-control" required name="dopinfo">
                          <option value="<?=$dopinfo;?>"><?=$dopinfo;?></option>
                          <option value="БО">Без опоздании</option>
                          <option value="В">выходной</option>
                          <option value="А">отпуск без сохранения заработной оплаты</option>
                          <option value="П">прогул</option>
                          <option value="О">оплачиваемый отпуск</option>
                          <option value="ДО">отпуск по беременности и родам</option>
                          <option value="К">командировка</option>
                          <option value="Н">В ночь</option>
                          <option value="ОПЗ">Опоздал(а)</option>
                          <option value="УД">Удаленно</option>
                          <option value="Б">Больничный</option>
                          <option value="УВ">Уволен</option>
                          <!-- <option value=""></option>
                          <option value=""></option>
                          <option value=""></option>
                          <option value=""></option> -->

                        </select>
                      </td>
                      <!-- <td>
                        <select class="form-control" required name="shtraf">
                          <option value="">Если есть штраф -Выберите</option>
                          <option value="Опоздал на 5 минут, штраф 5000 тг">Опоздал на 5 минут, штраф 5000 тг</option>
                          <option value="Опоздал на 5 минут, штраф 5000 тг">Опоздал на 10 минут, штраф 10000 тг</option>
                          <option value="Опоздал на 5 минут, штраф 5000 тг">Опоздал на 15 минут, штраф 15000 тг</option>
                        </select>
                      </td> -->
                      <td>

                        <input type="text" name="typedogovor"  value="<?=$datar['typedogovor'];?>" hidden="true">
                        <input type="text" name="otdel"  value="<?=$datar['otdel'];?>" hidden="true">
                        <input type="number" name="id"  value="<?=$datar['id'];?>" hidden="true">
                        <input type="submit" name="addtabel" value="<?=$strtext;?>" class="btn btn-<?=$colorbtn;?>" />
                      </td>
                      </form>
                    </tr>
                    <?}?>
                  </tbody>

                </table>
                <!-- <input type="submit" name="addtabel" value="Сохранить данные" class="btn btn-danger" /> -->
                <!-- </form> -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--------------------------------------------------------------------------->
    </div><!-- /.content-wrapper -->
  </section>
</div>

<? include __DIR__ . '/../../layouts/footer.php'; ?>
