 <?php
        $region = $_POST['region'];
        $adress = $_POST['adress'];
        $idx = $_POST['idx'];
        $status_sklad = $_POST['status_sklad'];
        $statusremont = $_POST['statusremont'];
        if(isset($_POST['go_sklad']))
                {
                    $tickets = R::load('tickets',$idx);
                    $tickets->status = $status_sklad;
                    R::store($tickets);
                }
        if(isset($_POST['go_status']))
                {
                    $tickets = R::load('tickets',$idx);
                    $tickets->statusremont = $statusremont;
                    R::store($tickets);
                };
        unset($status_sklad);
        $result15 =$mysqli->query($connect,"SELECT COUNT(status) as count FROM tickets WHERE status = '15' " );
        $data15 = mysqli_fetch_array($result15);                       
        ?>  
      <!-- Content Wrapper. Contains page content -->
           <div class="content-wrapper">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
             <!-- Content Header (Page header) -->
             <section class="content-header">
              <h2 class="box-title">Имущество на ремонте</h2>
               <ol class="breadcrumb">
                 <li><a href="http://s747191p.beget.tech/pages/forms/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                 <li><a href="http://s747191p.beget.tech/pages/forms/index.php">Регионы</a></li>
                 <li class="active">Магазины</li>
               </ol>
            </section>
             <!-- Main content -->
             <section class="content">
               <div class="row">
        <!--------------------------------------------------------------------------->
                      <div class="col-md-12">
                        <div class="box box-danger">    
                          <div class="box-header">
                            <h3 class="box-title pull-left">Список товара филиала на ремонте &ensp;</h3>
                            <div class="box-tools">
                              <div class="input-group" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control input-sm pull-right" id="search-text" placeholder="Поиск" onkeyup="tableSearch()">
                                <div class="input-group-btn">
                                  <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                              </div>
                            </div>
                          </div><!-- /.box-header -->
                          <div class="box-body no-padding">
                                  <!-- /.search form -->
							<div class="table-responsive">
                            <table class="table table-hover table-bordered" id="info-table">
                              <thead>
                              <tr class="success">
                                <th style="width: 5rem">№</th>
                                <th style="width: 5rem">№ЗБ</th>
                                <th style="width: 5rem">Дата поступления на ремонт</th>
                                <th class="text-center" style="width: 40rem">Описание имущества</th>
                                <th style="width: 15rem">Вид поломки</th>
                                <th style="width: 20rem">Статус</th>
                              </tr>
                            </thead>
                              <tbody>
                                <?
                                 $result3 = $mysqli->query("SELECT * FROM tickets WHERE  status = '15' ");
                                   while ($data3 = mysqli_fetch_array($result3)) {
                                    $statusremont = $data3['statusremont'];
                                                  // $result2 = $mysqli->query("SELECT *FROM status_remont WHERE id = '$stzb' ");
                                                  // $data_st = mysqli_fetch_array($result2);
                                                  // $statuszb = $data_st['name'];
                                                     if($statusremont == 1){
                                                  $status = '<span class="label label-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">В очереди</font></font></span>';}
                                                  if($statusremont == 2){
                                                  $status = '<span class="label label-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">В процессе</font></font></span>';}
                                                 
                                                 if($statusremont == 3){
                                                  $status = '<span class="label label-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выполнено</font></font></span>';}

                                                   if($statusremont == 4){
                                                  $status = '<span class="label label-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Не пригоден для ремонта</font></font></span>';} ?>
                                              <tr>
                                              <td class="text-center"> </td>
                                              <td> <?=$data3['nomerzb'];?> </td>
                                              <td><?= date("d.m.Y", strtotime($data3['dateremont'])); ?></td>
                                              <td>    <?= $data3['category']; ?>, <?= $data3['tovarname']; ?> <?= $data3['hdd']; ?> <?= $data3['sostoyanie_bu']; ?>  <?= $data3['upakovka']; ?> <?= $data3['ekran']; ?> <?= $data3['korpus']; ?>
                                               SN: <?= $data3['sn']; ?>, IMEI:<?= $data3['imei']; ?>, <?= $data3['complect']; ?> <?= $data3['opisanie']; ?>
                                             </td>
                                              <td><?=$data3['remontmessage'];?></td>
                                              <td> 
                                                <form method="post" action="remont.php">
                                                <div class="input-group">
                                                  <span class="input-group-btn">
                                                    <input name="adress" hidden value="<?=$adress;?>"> 
                                                    <input name="region" hidden value="<?=$region;?>"> 
                                                    <input name="idx" hidden value="<?=$data3['id'];?>">  
                                                    <input name="status_sklad" hidden value="10">
                                                    <button type="submit" name="go_sklad"  class="btn btn-danger " title="Вернуть на склад"><i class="fa fa-university"></i> </button> 
                                                  </span>
                                             
                                                <select name="statusremont" class="form-control">
                                                  <option value="1" selected><?=$status;?></option>
                                                  <option value="2">В процессе</option>
                                                  <option value="3">Выполнено</option>
                                                  <option value="4">Не пригоден для ремонта</option>
                                                </select>
                                                  <span class="input-group-btn">
                                                    <button type="submit" name="go_status"  class="btn btn-success" title="Изменить Статус"> <i class="fa fa-cogs"></i> </button>
                                                  </span>
                                                </div><!-- /input-group -->
													</form>
                                              </td>
                                              </tr>
                                              <? } ?>                                                     
                              </tbody>
                              <tfoot>
                                <tr class="danger">
                                  <th colspan="4" class="text-center">Итого на ремонте находится </th>
                                  <th><?=$data15['count'];?> ед.</th>
                                  <th></th>
                                </tr>
                              </tfoot>
                            </table>
							  </div>
                            <script>
                                        $('.table tbody tr').each(function(i) {
                                        var number = i + 1;
                                        $(this).find('td:first').text(number+".");
                                        });
                                        </script>
                                <script>
                                    function tableSearch() {
                                        var phrase = document.getElementById('search-text');
                                        var table = document.getElementById('info-table');
                                        var regPhrase = new RegExp(phrase.value, 'i');
                                        var flag = false;
                                        for (var i = 1; i < table.rows.length; i++) {
                                            flag = false;
                                            for (var j = table.rows[i].cells.length - 1; j >= 0; j--) {
                                                flag = regPhrase.test(table.rows[i].cells[j].innerHTML);
                                                if (flag) break;
                                            }
                                            if (flag) {
                                                table.rows[i].style.display = "";
                                            } else {
                                                table.rows[i].style.display = "none";
                                            }
                                        }
                                    }
                                    </script>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                      </div><!-- /.col-md-6 -->


                   </div><!-- /.col -->
               
           </section>
      </div>




