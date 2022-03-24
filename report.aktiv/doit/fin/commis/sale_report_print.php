<?//проверка существовании сессии
include ("../../../bd.php");
if ( isset ($_SESSION['logged_user']) ) :   //если сущесттвует пользователь
 if ($_SESSION['logged_user']->status ==11):


   $exel_post  = R::load(postexel,1);
   $region = $exel_post['region'];
   $adress = $exel_post['adress'];
   $kassa = $exel_post['kassa'];
   $data1 = $exel_post['date1'];
   $data2 = $exel_post['date2'];
   $status = $exel_post['status'];
   R::store($exel_post);
   if($exel_post['date1'] AND $exel_post['date2']){
                               $data1 = $exel_post['date1'];
                               $data2 = $exel_post['date2'];
                             } else {
                               $data1 = '2020-08-19';
                               $data2 = $today;
                             };
                               if($adress == 'Все'){
                                                     $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND status = '$status'   AND dataseg BETWEEN '$data1' AND '$data2' ");
                                                     $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                                                     $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region'AND status = '$status'   AND dataseg BETWEEN '$data1' AND '$data2' ");
                                                     $data22 = mysqli_fetch_array($result12);
                                                   }
                               if($status ==  $adress){
                                                     $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region'  AND dataseg BETWEEN '$data1' AND '$data2'");
                                                     $comment = $region.' / '.$adress.' за период сыыы '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                                                     $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region'  AND dataseg BETWEEN '$data1' AND '$data2'");
                                                     $data22 = mysqli_fetch_array($result12);
                                                       }
                                                       if($adress != $status){
                                                                                 $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND status = '$status' AND  (dataseg BETWEEN '$data1' AND '$data2')");
                                                                                                             $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                                                                                                             $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region' AND status = '$status'  AND dataseg BETWEEN '$data1' AND '$data2'");
                                                                                                             $data22 = mysqli_fetch_array($result12);
                                                                                                             }
                               if($status AND ($adress != 'Все') AND ($status == 'Все')){
                                                             $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND adressfil = '$adress'  AND  (dataseg BETWEEN '$data1' AND '$data2')");
                                                               $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                                                               $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region'AND adressfil = '$adress'  AND dataseg BETWEEN '$data1' AND '$data2'");
                                                               $data22 = mysqli_fetch_array($result12);
                                                             };

                                                             if($status AND ($adress != 'Все') AND ($status != 'Все')){
                                                                                           $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND status = '$status' AND adressfil = '$adress'  AND  (dataseg BETWEEN '$data1' AND '$data2')");
                                                                                             $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                                                                                             $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region' AND status = '$status' AND adressfil = '$adress'  AND dataseg BETWEEN '$data1' AND '$data2'");
                                                                                             $data22 = mysqli_fetch_array($result12);
                                                                                           };

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<title>Выгрузка данных из базы данных</title>
	<link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
	<style type="text/css" class="init">

    </style>

	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" class="init">

        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    //'csvHtml5',
                    //'pdfHtml5'
                ]
            } );
        } );
            </script>
</head>
<body class="wide comments example">
	<a name="top" id="top"></a>


			<div class="content">
				<h1 class="page_title"> </h1>
				<div class="info">
					<p><?= $comment;?> </p>

				</div>
				<table id="example" class="display" style="width:100%">
          <thead>
              <tr class="success">
              <th>№ЗБ</th>
              <th>Клиент</th>
              <th>Телефон</th>
              <th style="width:45vh;">Залог</th>
              <th>Сумма выдачи</th>
              <th style="width:10vh;">Цена</th>
              <th>Дата выдачи</th>
              <th>Дата выкупа</th>
              <th>Дата возврата</th>
              <th>Кто принял</th>
              <th>Статус</th>
          <!-- <th>Действие</th> -->
              </tr>
          </thead>
					<tbody>
            <?
            while ($data_zb = mysqli_fetch_array($result)) {
            $stzb = $data_zb['status'];
            $result2 = mysqli_query($connect,"SELECT *FROM status_zb WHERE id = '$stzb' ");
            $data_st = mysqli_fetch_array($result2);
            $statuszb = $data_st['name'];
            ?>
            <tr>
              <form action="updstcomzb.php" method="t">
                <input hidden type="text" name="regionlombard" value="<?=$regionlombard;?>">
                <input hidden type="text" name="adresslombard" value="<?=$adresslombard;?>">
                <input hidden type="text" name="datapr" value="<?=$datapr;?>">
                <input hidden type="text" name="nomerzb" value="<?=$nomerzb;?>">
                    <td><?= $data_zb['nomerzb']; ?></td>
                    <td><?= $data_zb['fio']; ?></td>
                    <td><?= $data_zb['phones']; ?></td>
                    <td><?= $data_zb['category']; ?> <?= $data_zb['tovarname']; ?> <?= $data_zb['hdd']; ?> <?= $data_zb['upakovka']; ?> <?= $data_zb['ekran']; ?> <?= $data_zb['korpus']; ?> <?= $data_zb['opisanie']; ?>
                    SN: <?= $data_zb['sn']; ?> IMEI: <?= $data_zb['imei']; ?> <?= $data_zb['sostoyanie_bu']; ?> <?= $data_zb['complect']; ?>
                     </td>
                    <td><?= number_format($data_zb['summa_vydachy'], 0, '.', ' '); ?></td>
                    <td><?= number_format($data_zb['cena_pr'], 0, '.', ' '); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['reg_data'])); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['datavykup'])); ?></td>
                    <td><?= date("d.m.Y", strtotime($data_zb['dv'])); ?></td>
                    <td><?= $data_zb['eo']; ?></td>
                    <td><?= $statuszb; ?></td>
                  <!--  <td><input type="submit" name="gogo" class="btn btn-success" value="Принять"></td> -->
              </form>
            </tr>
            <? } ?>

					</tbody>
					<tfoot>
            <tr class="danger">
                <th colspan="3" class="text-center">Итого:</th>
                <th colspan="3" class="text-center">Сумма выдачи: <?= number_format($data22['SUM(summa_vydachy)'], 0, '.', ' '); ?> тг.</th>
                <th colspan="3" class="text-center">Сумма продажи: <?= number_format($data22['SUM(cena_pr)'], 0, '.', ' '); ?>  тг.</th>
                <th colspan="2" class="text-center">Доход: <?= number_format($data22['SUM(cena_pr)']-$data22['SUM(summa_vydachy)'], 0, '.', ' '); ?>  тг.</th>
            </tr>
					</tfoot>
				</table>

				</div>
			</div>
		</div>
	</div>
	<div class="fw-footer">
		<div class="skew"></div>
		<div class="skew-bg"></div>

	</div>
</body>
</html>
<?php endif; ?>

  <? else :?>

  чтобы что то сделать -  зайдите в свой личный кабинет или зарегистрируйтесь

 <?php endif; ?>
