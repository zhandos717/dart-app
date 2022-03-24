<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 3) :
      $comis_active = 'active';
    
    if(!empty($_REQUEST['nomerzb'])){
      $nomerzb = $_REQUEST['nomerzb'];
    }else{
      $nomerzb = $_SESSION['nomerzb'];
    };
      include "header.php"; 
      include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Результаты поиска:
        </h1>
        <br />
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная <?= $string;?></a></li>
        </ol>
      </section>
<!--###################################################-->  
        <section class="content">
        <? if($_SESSION['message']){?>
          <div class="row">
            <div class="col-xs-12">
              <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>	<i class="icon fa fa-check"></i> Успех!</h4>
                  <?=$_SESSION['message'];?>
                </div>
            </div>
          </div>
          <?}; unset($_SESSION['message']);?>
<!--###################################################-->     
            <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box">
                <form method="post" action="update_ticket.php">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="введите номер договора" name="nomerzb" />
                    <span class="input-group-btn">
                        <input type="submit" class="btn btn-info btn-flat" value="Поиск по товарам" />
                    </span>
                    </div><!-- /input-group -->
                </form>
                </div>
            </div>
            <? if(!empty($nomerzb)): ?>
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-danger">
                  <div class="box-body">
                    <form action="functions/update_ticket.php" method="post" enctype="multipart/form-data" >
                      <table class="table table-bordered">
                        <tbody>
                        <?
                        $result = mysqli_query($connect, "SELECT * FROM tickets WHERE nomerzb = '$nomerzb' ");
                        $data_zb = mysqli_fetch_array($result);
                        $status = [1=>'Сформирован',2=>'Выдан кредит',3=>'Пролонгирован',
                                  4=>'Полный возврат кредита',5=>'Полная реализация',6=>'На гарантийном сроке',
                                  7=>'На исполнении у эксперта',8=>'На исполнении у директора',9=>'Частично находится  на реализации',
                                  10=>'Находится на складе магазина',11=> 'Забракованный',12=>'Изъято',
                                  13=>'На балансе у компании',14=>'На витрине',15=>'На ремонте']
                          ?>
                            <tr>
                              <th> 
                                Номер договора
                              </th>
                              <th>
                                <?=$data_zb['nomerzb'];?>
                              </th>
                            </tr>
                            <tr>
                              <th> 
                                Регион/Адресс/Касса
                              </th>
                              <th>
                                <?=$data_zb['region'];?>/
                                <?=$data_zb['adressfil'];?>/
                                <?=$data_zb['kassa'];?>
                              </th>
                            </tr>
                            <tr>
                              <th> 
                                Сотрудник
                              </th>
                              <th>
                                <?=$data_zb['eo'];?>
                              </th>
                            </tr>
                            <tr>
                              <th> 
                                Клиент
                              </th>
                              <th>
                                <?=$data_zb['fio'];?>
                              </th>
                            </tr>
                            <tr>
                              <th> 
                                Дата выдачи
                              </th>
                              <th>
                                <?=$data_zb['dataseg'];?>
                              </th>
                            </tr>
                            <tr>
                              <th> 
                                Наименование имущества
                              </th>
                              <td>
                                <?=$data_zb['type'];?> <?=$data_zb['category'];?> <?=$data_zb['tovarname'];?>
                                <?=$data_zb['opisanie'];?>
                              </td>
                            </tr>
                            <tr>
                              <th> 
                               Срок залога
                              </th>
                              <td>
                              <?=$data_zb['srok'];?> Д.
                              </td>
                            </tr>
                            <tr>
                              <th> 
                               IMEI/SN
                              </th>
                              <td>
                                <?=$data_zb['sn'];?>  <?=$data_zb['imei'];?>
                              </td>
                            </tr>
                            <tr>
                              <th> 
                               Статус товара
                              </th>
                              <td> 
                                <select name="status" class="form-control" id="">
                                  <option value="<?=$data_zb['status'];?>"><?=$status[$data_zb['status']];?></option>
                                  <? $i=0; while($i<=14){
                                    $i++;
                                    if($i != $data_zb['status'] ){?>
                                     <option value="<?=$i;?>"><?=$status[$i];?></option>
                                    <?}}?>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <th> 
                               Примечание
                              </th>
                              <td> 
                                <textarea name="comment" class="form-control" ></textarea>
                              </td>
                            </tr>
                            <tr>
                              <th> 
                               Подтверждающией документ
                              </th>
                              <td> 
                                <input type="file" name="file" class="form-control" accept=".jpg, .jpeg, .pdf">
                              </td>
                            </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="2">
                            <input type="number" hidden name="idx" value="<?=$data_zb['id']?>" >
                              <button class="btn btn-block bg-olive" type="submit" name="go_update">
                                    <i class="fa fa-check"></i>
                                    Подтвердить
                              </button>
                            </th>
                          </tr>
                        </tfoot>
                      </table>
                      </form>
                  </div>
                </div>
            </div>
            <?endif; unset($_SESSION['nomerzb']);?>
        </div><!-- /.row -->


        <div class="row">
          <div class="col-xs-12">
                <div class="box">   
                 <div class="box-body">   
                       <table class="table">
                       <tr>
                       <th>Код товара</th>
                       <th>Клиент</th>
                       <th>Номер</th>
                       <th>Описание</th>
                       <th>Сумма выдачи</th>
                       <th>Сумма продажи</th>
                       <th>Дата выдачи</th>
                       <th>Дата окончание срока</th>
                       <th>Дата поступления в магазин </th>
                       <th>Комиссионер</th>
                       </tr>
                       <? $result = mysqli_query($connect, "SELECT * FROM tickets WHERE status = '12' ");
                          while($data_zb = mysqli_fetch_array($result)){?>
                            <tr>
                              <td><?= $data_zb['nomerzb']; ?></td>
                              <td><?= $data_zb['fio']; ?></td>
                              <td><?= $data_zb['phones']; ?></td>
                              <td><?= $data_zb['category']; ?> <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?> <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?> <?= $data_zb['opisanie']; ?>
                              SN: <?= $data_zb['sn']; ?> IMEI: <?= $data_zb['imei']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['complect']; ?>
                              </td>
                              <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                              <td><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                              <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                              <td><?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>
                              <td><? if($data_zb['dateshop']){echo date("d.m.Y", strtotime($data_zb['dateshop']));}else { echo '--'; } ?></td>
                              <td><?= $data_zb['eo']; ?></td>
                              <td><?= $statuszb; ?></td>
                          </tr>
                          <?}?>   
                       </table>
                  </div>     
                </div>        
          </div>
        </div>


      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <? include "footer.php"; ?>
  <?php endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>
  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь
<?php endif; ?>