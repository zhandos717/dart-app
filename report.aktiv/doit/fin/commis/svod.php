<? //проверка существовании сессии
          $today = date('Y-m-d');
          $region = $_POST['region'];
          $adress = $_POST['adress'];
          $kassa = $_POST['kassa'];
          $data1 = $_POST['date1'];
          $data2 = $_POST['date2'];
          $status = $_POST['status'];

          $exel_post  = R::load('postexel','2');
          $exel_post->region = $region;
          $exel_post->adress = $adress;
          $exel_post->kassa = $kassa;
          $exel_post->date1 = $data1;
          $exel_post->date2 = $data2;
          $exel_post->status = $status;
          R::store($exel_post);


                  if($_POST['date1']){
                                      $data1 = $_POST['date1'];
                                      $data2 = $_POST['date2'];
                                    } else {
                                      $data1 = $today;
                                      $data2 = $today;
                                    };
            if($adress){
                          $result1 = $mysqli->query("SELECT *from tickets WHERE region = '$region' AND adressfil = '$adress' AND kassa = '$kassa' AND dataseg = '$data1' AND NOT status = '11'");
                          $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1));





                          $result2 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(n08),SUM(p1),SUM(proc) from tickets WHERE region = '$region' AND adressfil = '$adress' AND kassa = '$kassa' AND dataseg = '$data1' AND NOT status = '11'");
                          $data22 = mysqli_fetch_array($result2);

                          $result3 = $mysqli->query("SELECT *from tickets WHERE region = '$region' AND adressfil = '$adress' AND salerkassa= '$kassa' AND datavykup = '$data1' AND  status = '4' ");

                          $result4 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(n08),SUM(p1),SUM(proc) from tickets WHERE region = '$region' AND adressfil = '$adress' AND kassa = '$kassa' AND dataseg = '$data1' AND NOT status = '11'");

                        $result6 = $mysqli->query("SELECT SUM(summa_vydachy), SUM(n08),SUM(p1),SUM(proc) from tickets WHERE region = '$region' AND adressfil = '$adress' AND kassa = '$kassa' AND datavykup = '$data1' AND NOT status = '11'");


                        $result88 = $mysqli->query("SELECT * FROM repotscom WHERE  region = '$region' AND adress = '$adress' AND kassa = '$kassa' AND datereport = '$data1'");

                        $data22 = mysqli_fetch_array($result88);




                        }; ?>

    <script type="text/javascript" src="linkedselect.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Товары комисcионного магазина
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
                 <a href="commis/report_print.php" target="_blank" class="btn bg-olive btn-flat"> <i class="fa fa-file-text"> </i> </a>
                   <h3 class="box-title">Выберите период</h3>
                   <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                     <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                   </div>
                 </div>
                 <div class="box-body">
                   <form action="svodka.php" method="POST">

                     <div class="col-lg-2 col-md-2 col-sm-2">
                       <div class="input-group">
                              <input type="date" class="form-control" style="width: 16rem;" min="2020-08-19" max="<?=$today;?>" value="<?=$data1;?>" name="date1">
                        </div>
                        <!-- /input-group -->
                     </div>
                      <div class="col-lg-2 col-md-4">
                                         <div class="input-group">
                                               <span class="input-group-addon">
                                               <i class="fa fa-bank"></i>
                                               </span>
                                               <select class="form-control"  id="List3" name="region">
                                            <?if($region){?><option value="<?=$region;?>"><?=$region;?></option><?};?>
                                                 <option value="Нур-султан">Нур-султан</option>
                                                 <option value="Актау">Актау</option>
                                                 <option value="Актобе">Актобе</option>
                                                 <option value="Алматы">Алматы</option>
                                                 <option value="Атырау">Атырау</option>
                                                 <option value="Караганда">Караганда</option>
                                                 <option value="Кокшетау">Кокшетау</option>
                                                 <option value="Костанай">Костанай</option>
                                                 <option value="Павлодар">Павлодар</option>
                                                 <option value="Семей">Семей</option>
                                                 <option value="Талдыкорган">Талдыкорган</option>
                                                 <option value="Тараз">Тараз</option>
                                                 <option value="Шымкент">Шымкент</option>
                                                 <option value="Уральск">Уральск</option>
                                               </select>
                                         </div>
                                       </div>
                                       <div class="col-lg-2 col-md-4">
                                         <div class="input-group">
                                               <span class="input-group-addon">
                                               <i class="fa fa-building"></i>
                                               </span>
                                               <select class="form-control"  id="List4" name="adress">
                                               </select>
                                         </div>
                                       </div>
                                       <div class="col-lg-2 col-md-4">
                                         <div class="input-group">
                                               <span class="input-group-addon">
                                               <i class="fa fa-fax"></i>
                                               </span>
                                               <select class="form-control" name="kassa">
                                                 <?if($kassa){?><option value="<?=$kassa;?>"> <?=$kassa;?> </option><?};?>
                                                 <option value="Касса 1"> Касса 1 </option>
                                                 <option value="Касса 2"> Касса 2 </option>
                                                 <option value="Касса 3"> Касса 3 </option>
                                                 <option value="Касса 4"> Касса 4 </option>
                                               </select>
                                         </div>
                                       </div>
                                       <div class="input-group input-group-sm">
                                           <span class="input-group-btn">
                                             <button type="submit" class="btn btn-info">Подтвердить!</button>
                                           </span>
                                     </div>
                                     </form>
                      </div><!--.box-body -->
                   </div> <!--.box -->
                 </div> <!--.col-md-12 -->
          <!--------------------------------------------------------------------------->
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><b>  <?= $comment;?></b></h3>
              </div><!-- /.box-header -->
              <div class="box-body">

                <div class="table-responsive">
                  <table id="example1" class="tableas table table-hover table-bordered">
                    <tr class="text-center">
    																<th rowspan="2">№ П/П</th>
    																<th rowspan="2">Номер ЗБ</th>
    																<th rowspan="2">Клиент</th>
    																<th rowspan="2" style="width:20rem;">Наименование залога</th>
    																<th rowspan="2">Кол-во</th>
    																<th rowspan="2">% по кредиту</th>
    																<th colspan="3">Выдан кредит</th>
    																<th rowspan="2">Вознаграждение</th>
    																<th rowspan="2">Возврат кредита</th>
    																<th rowspan="2">Неустойка при расторжении договора</th>
    														</tr>
    														<tr>
    																<th style="width:5rem;"> Сумма </th>
    																<th>Срок</th>
    																<th>До</th>
    														</tr>
    														<tr>
    																<th colspan="13" class="text-center"> <?= $kassa; ?></th>
    														</tr>
    														<tr>
    																<th colspan="13" class="text-center"> Выдача</th>
    														</tr>
    														<?
    														$i = 1;

    														while ($data = mysqli_fetch_array($result1)) { ?>
    																<tr>
    																		<th><?=$i++;?></th>
    																		<th><?= $data['nomerzb']; ?></th>
    																		<th><?= $data['fio']; ?></th>
    																		<th>
    																			<?= $data['category']; ?> <?= $data['tovarname']; ?> <?= $data['hdd']; ?> <?= $data['opisanie']; ?> <?= $data['upakovka']; ?> <?= $data['ekran']; ?> <?= $data['korpus']; ?>
                          								SN: <?= $data['sn']; ?> IMEI: <?= $data['imei']; ?> <?= $data['sostoyanie_bu']; ?> <?= $data['complect']; ?>
    																		</th>
    																		<th>1</th>
    																		<th>0,5</th>
    																		<th><?= number_format($data['summa_vydachy'], 0, '.', ' '); ?></th>
    																		<th><?= $data['srok']; ?></th>
    																		<th><?= date("d.m.Y", strtotime($data['dv'])); ?></th>
    																		<th><?= number_format($data['p1'], 0, '.', ' '); ?></th>
    																		<th></th>
    																		<th></th>
    																</tr>
    														<? } ?>
    														<?

    														$data = mysqli_fetch_array($result2);
    														?>
    														<tr>
    																<th colspan="13" class="text-center"> Возврат</th>
    														</tr>
    														<?
    															$i = 1;

    														while ($data = mysqli_fetch_array($result3)) { ?>
    																<tr>
    																	<th><?=$i++;?></th>
    																	<th><?= $data['nomerzb']; ?></th>
    																	<th><?= $data['fio']; ?></th>
    																	<th>
    																		<?= $data['category']; ?> <?= $data['tovarname']; ?> <?= $data['hdd']; ?> <?= $data['opisanie']; ?> <?= $data['upakovka']; ?> <?= $data['ekran']; ?> <?= $data['korpus']; ?>
    										SN: <?= $data['sn']; ?> IMEI: <?= $data['imei']; ?> <?= $data['sostoyanie_bu']; ?> <?= $data['complect']; ?>
    																	</th>
    																	<th>1</th>
    																	<th>0,5</th>
    																	<th><?= number_format($data['summa_vydachy'], 0, '.', ' '); ?></th>
    																	<th><?= $data['srok']; ?></th>
    																	<th><?= date("d.m.Y", strtotime($data['dv'])); ?></th>
    																	<th><?= number_format($data['p1'], 0, '.', ' '); ?></th>
    																	<th> <?= number_format($data['summa_vydachy'], 0, '.', ' '); ?></th>
    																	<th><?= number_format($data['proc'], 0, '.', ' '); ?></th>
    																</tr>
    														<? } ?>
    														<?

    														$data = mysqli_fetch_array($result4);
    														//(OR datavykup = '$dataseg' )

    														$data59 = mysqli_fetch_array($result6);
    														?>
    														<tr>
    																<th colspan="6"> ИТОГО по <?= $kassa; ?> (Сумма : <?= number_format($data22['endsumm'], 0, '.', ' ');?> тенге)</th>
    																<th><?= number_format($data['SUM(summa_vydachy)'], 0, '.', ' '); ?></th>
    																<th></th>
    																<th></th>
    																<th><?= number_format($data['SUM(p1)'], 0, '.', ' '); ?></th>
    																<th> </th>
    																<th><?= number_format($data59['SUM(proc)'], 0, '.', ' '); ?></th>
    														</tr>

                  </table>
                </div><!-- /.table-responsive -->
              </div><!-- /.box-body -->
            </div><!-- /.box box-primary -->
          </div><!-- /.col-md-6 -->


							<div class="col-lg-4">
                <div class="box box-primary">
								<section class="card">
									<div class="card-body">
										<table class="table table-responsive-md table-bordered mb-0">
											<tr ><th colspan="2">ИНФОРМАЦИЯ ПО КАССАМ</th> </tr>
											<tr ><td>НА НАЧАЛО ДНЯ</td> <th><?=number_format($data22['summstart'], 0, '.', ' ');?> тенге</th> 						 </tr>
											<tr ><td>Пополнение касс(ы)</td><th><?=number_format($data22['finhelp'], 0, '.', ' ');?> тенге</th> 	</tr>
											<tr ><td>Изъятие из касс(ы)</td><th><?=number_format($data22['withdrawal'], 0, '.', ' ');?> тенге</th> 	</tr>
											<tr ><td>Выдано кредитов</td><th> <?=number_format($data22['vydacha'], 0, '.', ' ');?>  тенге</th> 		</tr>
											<tr ><td>Получено процентов</td><th><?=number_format($data22['proc']+$data22['comis'], 0, '.', ' ');?> тенге</th> 	</tr>
											<tr ><td>Возврат кредитов</td><th><?=number_format($data22['vozvrat'], 0, '.', ' ');?> тенге</th> 						</tr>
											<tr ><td>Выручка от продаж</td><th><?=number_format($data22['summsale'], 0, '.', ' ');?> тенге</th>  			</tr>
                      <tr ><td>Задаток</td><th><?=number_format($data22['deposit'], 0, '.', ' ');?> тенге</th>  			</tr>
                      <tr ><td>Прибыль от продаж</td><th><?=number_format($data22['salesincome'], 0, '.', ' ');?> тенге</th>  			</tr>
											<tr ><td><strong>НА КОНЕЦ ДНЯ </strong></td><th><?= number_format($data22['endsumm'], 0, '.', ' ');?> тенге</th> </tr>
											</tbody>
										</table>
									</div>
								</section>
							</div>
            </div>
          <!--------------------------------------------------------------------------->


          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title"><b>  <?= $comment;?></b></h3>
              </div><!-- /.box-header -->
              <div class="box-body">

                <div class="table-responsive">
                  <table id="example1" class="tableas table table-hover table-bordered">
                    <thead>
                      <tr class="text-center table-success">
                        <th>№</th>
                        <th style="width:5rem;">ДАТА ПРОДАЖИ</th>
                        <th>КОД ТОВАРА</th>
                        <th>ТОВАР</th>
                        <th>ПРИХОДНАЯ СУММА ТОВАРА</th>
                        <th>ЗАДАТОК</th>
                        <th>СУММА РЕАЛИЗАЦИИ</th>
                        <th>ПРИБЫЛЬ</th>
                        <th>ПРОДАВЕЦ</th>
                        <th>Кассир</th>
                        <th>ПОКУПАТЕЛЬ</th>
                        <th>ИИН</th>
                        <th>ТЕЛЕФОН</th>
                      </tr>
                    </thead>
                        <tbody>
                        <?
                        $result96 = $mysqli->query("SELECT * FROM salecomision WHERE dataa = '$data1' AND region = '$region' AND filial = '$adress' AND kassa = '$kassa' AND zadatok IS NULL");
                        while ($data3 = mysqli_fetch_array($result96)) {
                        ?>
                        <tr class="text-center">
                        <td><?=$i++;?>.</td>
                        <td><?= date("d.m.Y", strtotime($data3['dataa'])); ?> </td>
                        <td> <?=$data3['codetovar'];?> </td>
                        <td class="text-left"><?
                        $nomerzb = $data3['codetovar'];
                        $result33 = $mysqli->query("SELECT * FROM tickets WHERE  nomerzb = '$nomerzb'");
                        $data_zb = mysqli_fetch_array($result33);?>
                        <?= $data_zb['category']; ?>, <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?>
                               SN: <?= $data_zb['sn']; ?>, IMEI:<?= $data_zb['imei']; ?>,<?= $data_zb['opisanie']; ?>
                        </td>
                        <td><?= number_format($data3['summaprihod'], 0, '.', ' ');?></td>
                        <td><?= number_format($data3['zadatok'], 0, '.', ' ');?></td>
                        <td><?= number_format($data3['summareal'], 0, '.', ' ');?></td>
                        <td><?= number_format($data3['summareal']-$data3['summaprihod'], 0, '.', ' ');?></td>
                        <td> <?=$data3['saler'];?> </td>
                        <td> <?=$data3['kassir'];?> </td>
                        <td> <?=$data3['pokupatel'];?> </td>
                        <td> <?=$data3['pokupateliin'];?> </td>
                        <td> <?=$data3['pokupateltel'];?> </td>
                        </tr>
                        <? } ?>
                        </tbody>
                        <tfoot>
                          <?
                          $result4 = $mysqli->query("SELECT SUM(pribl),SUM(summareal),SUM(summaprihod),SUM(zadatok),COUNT(*) as count FROM salecomision WHERE dataa = '$data1' AND region = '$region' AND filial = '$adress' AND kassa = '$kassa' AND zadatok IS  NULL ");
                          $data4 = mysqli_fetch_array($result4);
                          ?>
                          <tr class="text-center table-danger">
                            <th></th>
                            <th colspan="3">Итог</th>
                            <th><?=number_format($data4['SUM(summaprihod)'], 0, '.', ' ');?></th>
                            <th><?=number_format($data4['SUM(zadatok)'], 0, '.', ' ');?></th>
                            <th><?=number_format($data4['SUM(summareal)'], 0, '.', ' ');?></th>
                            <th><?=number_format($data4['SUM(pribl)'], 0, '.', ' ');?></th>
                            <th></th>
                            <th colspan="3">Количество клиентов</th>
                            <th><?=$data4['count'];?></th>
                          </tr>
                        </tfoot>
                  </table>
                </div><!-- /.table-responsive -->
              </div><!-- /.box-body -->
            </div><!-- /.box box-primary -->
          </div><!-- /.col-md-6 -->



            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><b>  <?= $comment;?></b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                  <div class="table-responsive">
                    <table id="example1" class="tableas table table-hover table-bordered">
                      <thead>
                        <tr class="text-center table-success">
                          <th>№</th>
                          <th style="width:5rem;">ДАТА ПРОДАЖИ</th>
                          <th>КОД ТОВАРА</th>
                          <th>ТОВАР</th>
                          <th>ПРИХОДНАЯ СУММА ТОВАРА</th>
                          <th>ЗАДАТОК</th>
                          <th>СУММА РЕАЛИЗАЦИИ</th>
                          <th>ПРИБЫЛЬ</th>
                          <th>ПРОДАВЕЦ</th>
                          <th>Кассир</th>
                          <th>ПОКУПАТЕЛЬ</th>
                          <th>ИИН</th>
                          <th>ТЕЛЕФОН</th>
                        </tr>
                      </thead>
                          <tbody>
                          <?
                          $result96 = $mysqli->query("SELECT * FROM salecomision WHERE dataa = '$data1' AND region = '$region' AND filial = '$adress' AND kassa = '$kassa' AND zadatok IS NOT NULL");
                          while ($data3 = mysqli_fetch_array($result96)) {
                          ?>
                          <tr class="text-center">
                          <td><?=$i++;?>.</td>
                          <td><?= date("d.m.Y", strtotime($data3['dataa'])); ?> </td>
                          <td> <?=$data3['codetovar'];?> </td>
                          <td class="text-left"><?
                          $nomerzb = $data3['codetovar'];
                          $result33 = $mysqli->query("SELECT * FROM tickets WHERE  nomerzb = '$nomerzb'");
                          $data_zb = mysqli_fetch_array($result33);?>
                          <?= $data_zb['category']; ?>, <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?>
                                 SN: <?= $data_zb['sn']; ?>, IMEI:<?= $data_zb['imei']; ?>,<?= $data_zb['opisanie']; ?>
                          </td>
                          <td><?= number_format($data3['summaprihod'], 0, '.', ' ');?></td>
                          <td><?= number_format($data3['zadatok'], 0, '.', ' ');?></td>
                          <td><?= number_format($data3['summareal'], 0, '.', ' ');?></td>
                          <td><?= number_format($data3['pribl'], 0, '.', ' ');?></td>
                          <td> <?=$data3['saler'];?> </td>
                          <td> <?=$data3['kassir'];?> </td>
                          <td> <?=$data3['pokupatel'];?> </td>
                          <td> <?=$data3['pokupateliin'];?> </td>
                          <td> <?=$data3['pokupateltel'];?> </td>
                          </tr>
                          <? } ?>
                          </tbody>
                          <tfoot>
                            <?
                            $result4 = $mysqli->query("SELECT SUM(pribl),SUM(summareal),SUM(summaprihod),SUM(zadatok),COUNT(*) as count FROM salecomision WHERE dataa = '$data1' AND region = '$region' AND filial = '$adress' AND kassa = '$kassa' AND zadatok IS NOT NULL ");
                            $data4 = mysqli_fetch_array($result4);
                            ?>
                            <tr class="text-center table-danger">
                              <th></th>
                              <th colspan="3">Итог</th>
                              <th><?=number_format($data4['SUM(summaprihod)'], 0, '.', ' ');?></th>
                              <th><?=number_format($data4['SUM(zadatok)'], 0, '.', ' ');?></th>
                              <th><?=number_format($data4['SUM(summareal)'], 0, '.', ' ');?></th>
                              <th><?=number_format($data4['SUM(pribl)'], 0, '.', ' ');?></th>
                              <th></th>
                              <th colspan="3">Количество клиентов</th>
                              <th><?=$data4['count'];?></th>
                            </tr>
                          </tfoot>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
              </div><!-- /.box box-primary -->
            </div><!-- /.col-md-6 -->

        </div><!-- /.content-wrapper -->
      </section>
    </div>

    <script type="text/javascript">
      // Создаем новый объект связанных списков
      var syncList3 = new syncList;
      // Определяем значения подчиненных списков (2 и 3 селектов)
      syncList3.dataList = {
        /* Определяем элементы второго списка в зависимости
        от выбранного значения в первом списке */
        'Актау': {
          '11 мкрн дом3': '11 мкрн дом3'
        },

        'Актобе': {
          <?if($adress){?>'<?=$adress;?>':'<?=$adress;?>',<?};?>
          'Абулхаир Хана 84': 'Абулхаир Хана 84',
          'Шернияза 51': 'Шернияза 51'
        },

        'Алматы': {
          <?if($adress){?>'<?=$adress;?>':'<?=$adress;?>',<?};?>
          'Акан Сери 11': 'Акан Сери 11',
          'Ауэзова 169': 'Ауэзова 169',
          'Ауэзова 32': 'Ауэзова 32',
          'Гоголя 91': 'Гоголя 91',
          'Минина 24': 'Минина 24',
          'Назарбаева 118': 'Назарбаева 118',
          'Сатпаева 109': 'Сатпаева 109',
          'Толе би 285': 'Толе би 285'
        },

        'Нур-султан': {
          <?if($adress){?>'<?=$adress;?>':'<?=$adress;?>',<?};?>
          'Кенесары 65': 'Кенесары 65',
          'Абая 8': 'Абая 8',
          'Абылай хана 6': 'Абылай хана 6',
          'Абылайхана 32/2 (Встреча)': 'Абылайхана 32/2 (Встреча)',
          'Бейбитшилик 47': 'Бейбитшилик 47',
          'Кабанбай батыра, 2': 'Кабанбай батыра, 2',
          'Кажымукана 22': 'Кажымукана 22',
          'Сатпаева 23/1': 'Сатпаева 23/1',
          'Сыганак 18': 'Сыганак 18',
          'Тауелсыздык 45': 'Тауелсыздык 45',
          'Комиссионный магазин': 'Комиссионный магазин',
        },

        'Атырау': {
          'Сатпаева 32': 'Сатпаева 32'
        },

        'Караганда': {
          <?if($adress){?>'<?=$adress;?>':'<?=$adress;?>',<?};?>
          'Абдирова 19': 'Абдирова 19',
          'Майкудук 48': 'Майкудук 48',
          'Шахтеров (Ермекова) 52': 'Шахтеров (Ермекова) 52'
        },

        'Кокшетау': {
          'Абая 143': 'Абая 143'
        },


        'Костанай': {
          'Абая 173': 'Абая 173'
        },


        'Павлодар': {
          'Назарбаева 89': 'Назарбаева 89'
        },

        'Семей': {
          'Дулатова 145': 'Дулатова 145'
        },


        'Талдыкорган': {
          'Абая 254': 'Абая 254'
        },

        'Уральск': {
          'Курмангазы 165': 'Курмангазы 165'
        },


        'Тараз': {
          <?if($adress){?>'<?=$adress;?>':'<?=$adress;?>',<?};?>
          'Абая 170': 'Абая 170',
          'Самал 14': 'Самал 14'
        },

        'Шымкент': {
          <?if($adress){?>'<?=$adress;?>':'<?=$adress;?>',<?};?>
          'Байтурсынова 20': 'Байтурсынова 20',
          'Иляева 5/4': 'Иляева 5/4',
          'Назарбекова 11 (Нурсат)': 'Назарбекова 11 (Нурсат)',
          'Рыскулова 24/1': 'Рыскулова 24/1',
          'Рыскулова 84а': 'Рыскулова 84а',
          'Север (Терискей 9)': 'Север (Терискей 9)',
          'Уалиханова 192 (11 мкрн)': 'Уалиханова 192 (11 мкрн)'
        }

      };

      // Включаем синхронизацию связанных списков
      syncList3.sync("List3", "List4");
    </script>
