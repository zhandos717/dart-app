<?php
include ("../../../bd.php");

 if ($_SESSION['logged_user']->status ==10):
?>
<?

$exel_post  = R::load('postexel','2');

//R::store($exel_post);

$today = date('Y-m-d');
$region = $exel_post['region'];
$adress = $exel_post['adress'];
$kassa = $exel_post['kassa'];
$data1 = $exel_post['date1'];
$data2 = $exel_post['date2'];
$status = $exel_post['status'];


              if($adress){
                          $result = mysqli_query($connect,"SELECT * FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND kassa = '$kassa' AND dataseg = '$data1' AND NOT status = '11'");
                          $comment = $region.' / '.$adress.' за период с '. date("d.m.Y", strtotime($data1)). ' по ' .date("d.m.Y", strtotime($data2));

                          $result12 = mysqli_query($connect,"SELECT  SUM(summa_vydachy),SUM(cena_pr) FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND kassa = '$kassa' AND dataseg = '$data1' AND NOT status = '11' ");
                          $data22 = mysqli_fetch_array($result12);
                        };
                                  ?>

<html>
	<head>
		<title>Ежедневная сводка по операциям<?=$adresslombard?> </title>
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<!-- <link rel="stylesheet" href="../vendor/ ootstrap/css/bootstrap.css" /> -->

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="../css/invoice-print.css" />
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<style>

 div.Pp {
			 width: 1200px;   /* ширина */
			 height: 500px; /* высота */
			 padding: 0px 20px 30px 50px; /* внутренние отступы - верх, право, низ, лево */
			 margin: auto;  /* выравнивание по центру */
			 font-family:  "";/* нужный шрифт */
		 font-size: 90%;/* размер шрифта */}

			table.table-border {
				border-collapse: collapse;
			}
 			table.table-border td, table.table-border th {
				border: 1px solid black;
				border-collapse: collapse;
			}

		/*=======================================================================================*/
</style> 
	</head>
	<body>
		<div class="Pp">

			<p style="text-align:center; font-size:150%;"><strong>Ежедневная сводка по операциям</strong> <br>
							<small>за <?=date("d.m.Y", strtotime($data1));?> г.</small></p>
			<h4><strong> <em>г.<?=$region;?>, <?=$adress;?> / <?=$kassa;?> </em> </strong></h4>

	<table class="table-border">
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
while ($data = mysqli_fetch_array($result)) { ?>
		<tr>
			<td style="text-align:center;"><?=$i++;?>.</td>
			<td><?= $data['nomerzb']; ?></td>
			<td><?= $data['fio']; ?></td>
			<td>
				<?= $data['category']; ?> <?= $data['tovarname']; ?> <?= $data['hdd']; ?> <?= $data['opisanie']; ?>
				SN: <?= $data['sn']; ?> IMEI: <?= $data['imei']; ?> <?= $data['sostoyanie_bu']; ?> <?= $data['complect']; ?>
			</td>
			<td style="text-align:center;">1</td>
			<td style="text-align:center;">0,5</td>
			<td style="text-align:center;"><?= number_format($data['summa_vydachy'], 0, '.', ' '); ?></td>
			<td style="text-align:center;"><?= $data['srok']; ?></td>
			<td style="text-align:center;"><?= date("d.m.Y", strtotime($data['dv'])); ?></td>
			<td style="text-align:center;"><?= number_format($data['p1'], 0, '.', ' '); ?></td>
			<td></td>
			<td></td>
		</tr>
<? } ?>
<tr>
		<th colspan="13" class="text-center"> Возврат</th>
</tr>
<?
	$i = 1;
$result = $mysqli->query("SELECT *from tickets WHERE region = '$region' AND adressfil = '$adress' AND kassa = '$kassa' AND datavykup = '$data1' AND  status = '4' ");
while ($data = mysqli_fetch_array($result)) { ?>
	<tr>
	  <td style="text-align:center;"><?=$i++;?>.</td>
	  <td><?= $data['nomerzb']; ?></td>
	  <td><?= $data['fio']; ?></td>
	  <td>
	    <?= $data['category']; ?> <?= $data['tovarname']; ?> <?= $data['hdd']; ?> <?= $data['opisanie']; ?>
	SN: <?= $data['sn']; ?> IMEI: <?= $data['imei']; ?> <?= $data['sostoyanie_bu']; ?> <?= $data['complect']; ?>
	  </td>
	  <td style="text-align:center;">1</td>
	  <td style="text-align:center;">0,5</td>
	  <td style="text-align:center;"><?= number_format($data['summa_vydachy'], 0, '.', ' '); ?></td>
	  <td style="text-align:center;"><?= $data['srok']; ?></td>
	  <td style="text-align:center;"><?= date("d.m.Y", strtotime($data['dv'])); ?></td>
	  <td style="text-align:center;"> </td>
	  <td style="text-align:center;"> <?= number_format($data['summa_vydachy'], 0, '.', ' '); ?></td>
	  <td style="text-align:center;"><?= number_format($data['proc'], 0, '.', ' '); ?></td>
	</tr>
<? } ?>
<?
$result = $mysqli->query("SELECT SUM(summa_vydachy), SUM(n08),SUM(p1) from tickets WHERE region = '$region' AND adressfil = '$adress' AND kassa = '$kassa' AND dataseg = '$data1' AND NOT status = '11'");
$data = mysqli_fetch_array($result);
?>
<tr>
		<th colspan="6"> ИТОГО по <?= $kassa; ?> (Сумма : <?= number_format($data1['endsumm'], 0, '.', ' '); ?> тенге)</th>
		<th><?= number_format($data['SUM(summa_vydachy)'], 0, '.', ' '); ?></th>
		<th></th>
		<th></th>
		<th><?= number_format($data['SUM(p1)'], 0, '.', ' '); ?></th>
		<th> </th>
		<th> </th>
</tr>
</table>
 <br>
 <?
 $result = $mysqli->query("SELECT * from repotscom WHERE region = '$region' AND adress = '$adress' AND kassa = '$kassa' AND datereport = '$data1' ");
 $data15 = mysqli_fetch_array($result);
 ?>
 <table class="table-border"  style="display:inline;">
	 <tbody>
		 <tr ><th colspan="2" style="color:#0866B9;">ИНФОРМАЦИЯ ПО КАССАМ</th> </tr>
		 <tr ><th>НА НАЧАЛО ДНЯ</th> <th><?=number_format($data15['summstart'], 0, '.', ' ');?> тенге</th> </tr>
		 <tr ><td style="color:#C45656;">Пополнение касс(ы)</td> <td><?=number_format($data15['finhelp'], 0, '.', ' ');?> тенге</td> 	</tr>
		 <tr ><td style="color:#C45656;">Изъятие из касс(ы)</td> <td><?=number_format($data15['withdrawal'], 0, '.', ' ');?> тенге</td> 	</tr>
		 <tr ><td style="color:#C45656;">Выдано кредитов</td> <td> <?=number_format($data15['vydacha'], 0, '.', ' ');?>  тенге</td> 		</tr>
		 <tr ><td style="color:#C45656;">Получено процентов</td> <td><?=number_format($data15['proc']+$data15['comis'], 0, '.', ' ');?> тенге</td> 	</tr>
		 <tr ><td style="color:#C45656;">Возврат кредитов</td> <td><?=number_format($data15['vozvrat'], 0, '.', ' ');?> тенге</td> 						</tr>
		 <tr ><td style="color:#C45656;">Выручка от продаж</td> <td><?=number_format($data15['salesincome'], 0, '.', ' ');?> тенге</td>  			</tr>
		 <tr ><th >НА КОНЕЦ ДНЯ </th> <th><?= number_format($data15['endsumm'], 0, '.', ' ');?> тенге</th> </tr>
	 </tbody>
 </table>


 <table class="table-border" style="display:inline; padding-left:30px;" >

 	<?
 	$result12 =$mysqli->query("SELECT COUNT(dataseg) as count FROM tickets WHERE region = '$region' AND adressfil = '$adress' AND kassa = '$kassa'  AND dataseg = '$data1' " );
 		$data12 = mysqli_fetch_array($result12);
 	?>
	<tr>
 		<th  colspan="2" style="color:#0866B9;"> ИФОРМАЦИЯ ПО ПУНКТУ:</th>
 	</tr>
	<!-- <tr>
 		 <td>Новых клиенто</td><td> 1 человек</td> </td>
 	</tr> -->
 	<tr>
 		<td style="color:#0866B9;">Всего клиентов</td><td> <?=$data12['count'];?> клиентов</td>
 	</tr>

 </table>


<table style="margin-left:700px; margin-top:-80px;">
<tr>
<td>Исполнитель:</td><td>______________</td><td>/<?=$fioeo;?></td>
</tr>
<tr>
<td></td><td style="text-align:center;"><small>(подпись)</small></td><td style="text-align:center;"><small>Ф.И.О</small></td>
</tr>
<tr>
<td>Директор:</td><td>______________</td><td>/____________________</td>
</tr>
<tr>
<td></td><td style="text-align:center;"><small>(подпись)</small></td><td style="text-align:center;"><small>Ф.И.О</small></td>
</tr>
</table>
</div>
		<!-- <script>
			window.print();
		</script> -->
		<script>
		$('.tableas tbody tr').each(function(i) {
		var number = i + 1;
		$(this).find('td:first').text(number+".");
		});
		$('.tablea tbody tr').each(function(i) {
		var number = i + 1;
		$(this).find('td:first').text(number+".");
		});
		$('.tabl tbody tr').each(function(i) {
		var number = i + 1;
		$(this).find('td:first').text(number+".");
		});
		</script>
	</body>
</html>

<?php else : ?>
Вы не авторизованы<br />
<?php endif; ?>
