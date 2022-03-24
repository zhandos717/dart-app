    <?
    if(empty($date1)){
      $date1 = date('Y-m-d');
      $date2 = date('Y-m-d');
    };  
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1> Отчет по проданным товарам1 </h1>
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
            <div class="box box-success">
              <div class="box-body">
                  <div class="col-lg-2 col-md-2 col-sm-2"> 
                    <div class="input-group">
                       <div class="input-group-addon">
                          <i class="fa fa-university"></i>
                        </div>
                      <select class="form-control" id="region"  name="date1">
                        <option value="" >Все</option>
                        <?$reg = R::find('sales','GROUP BY region');
                          foreach ($reg as $city) {
                            echo"<option>{$city['region']}</option>";
                          }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="input-group">
                       <div class="input-group-addon">
                          <i class="fa fa-cc-visa"></i>
                        </div>
                      <select  class="form-control" id="vid" name="date1">
                        <option value="" >Все</option>
                        <?$reg = R::find('sales','GROUP BY vid');
                          foreach ($reg as $city) {
                            $vid = $city['vid'];
                            echo"<option value='$vid'>$vid</option>";
                          }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group">
                      <input type="date" class="form-control" id="date1" style="width: 16rem;" min="2020-08-19" max="<?= date('Y-m-d'); ?>" value="<?= $date1; ?>" name="date1">
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group">
                      <input type="date" class="form-control" id="date2" style="width: 16rem;" min="2020-08-19" max="<?= date('Y-m-d'); ?>" value="<?= $date2; ?>" name="date2">
                    </div>
                  </div>
                  <div class="input-group input-group-sm">
                    <button  class="btn-success btn">Подтвердить!</button>
                  </div>
              </div>
            </div> 
          </div>
          <div class="col-md-12">
            <div class="box box-primary">
              <!--<div class="box-header">
                <h3 class="box-title"><b></b></h3>
              </div> /.box-header -->
              <div class="box-body"> 
                <div id="answer">
                  <!--table-responsive-->
                  <table class="table table-hover table-bordered" >
                    <thead>
                      <tr class="warning">
                        <th>№ П/П</th>
                        <th>Регион</th>
                        <th>Филиал</th>
                        <th>Дата продажи</th> 
                        <th>Код товара</th>
                        <th>Описание</th>
                        <th>Вид оплаты</th>
                        <th>Сумма приемки</th> 
                        <th>Сумма продажи</th>
                        <th>Прибыль</th>
                      </tr> 
                    </thead>
                    <tbody>
                      <?php 
                      $i =1;
                      $result = R::findAll('sales012021','ORDER BY id DESC LIMIT 5');
                    foreach($result as $data){
                    ?>  
                      <tr>
                        <td> <?= $i++; ?>. </td>
                        <td> <?= $data['region']; ?>  </td>
                        <td> <?= $data['adress']; ?> </td>
                        <td> <?= date('d.m.Y', strtotime($data['data'])); ?> </td>
                        <td> <?= $data['codetovar']; ?> </td>
                        <td> <?= $data['tovarname']; ?> </td>
                        <td> <?= $data['vid']; ?> </td>
                        <td> <?= $data['summaprihod']; ?> </td>
                        <td> <?= $data['summareal']; ?> </td>
                        <td> <?= $data['summareal']-$data['summaprihod']; ?> </td>
                      </tr>
                      <?}?>  
                    </tbody>
                  </table> 
                </div><!-- /.table-responsive -->
              </div><!-- /.box-body -->
            </div><!-- /.box box-primary -->
          </div><!-- /.col-md-6 -->
        </div><!-- /.content-wrapper -->
      </section>
    </div>
    <script>
      $(document).ready(function() {
        $('.btn-success').click(function() {
          var date1 = $('#date1').val();
          var date2 = $('#date2').val();
          var region = $('#region').val();
          var vid = $('#vid').val();
          var eo = $(this).val();
          //alert(vid);
            $.post("report_commiss/eo/report_sale.php", {
              region: region,
              vid: vid,
              date1: date1,
              date2: date2
            })
            .done(function(data) {
             //alert('Привет');
              $('#answer').html(data);
            });
        });
      });
    </script>