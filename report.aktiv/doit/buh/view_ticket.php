<?php
include("../../bd.php");



if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 10) :


    $idxc = $_POST['id'];

    $idxc = (int) $_POST["id"];
    $idxc = strip_tags($_POST['id']);
    $idxc = htmlentities($_POST['id'], ENT_QUOTES, "UTF-8");
    $idxc = htmlspecialchars($_POST['id'], ENT_QUOTES);

    // $nomerzb = (int) $_POST["nomerzb"];
    // $nomerzb = strip_tags($_POST['nomerzb']);
    // $nomerzb = htmlentities($_POST['nomerzb'], ENT_QUOTES, "UTF-8");
    // $nomerzb = htmlspecialchars($_POST['nomerzb'], ENT_QUOTES);


    $result = $mysqli->query("SELECT *FROM tickets WHERE id = '$idxc'  ");
    $data_lost = mysqli_fetch_array($result);

    $result_per = $mysqli->query("SELECT *FROM percent");
    $data_per = mysqli_fetch_array($result_per);


    $result_too = $mysqli->query("SELECT *FROM too");
    $data_too = mysqli_fetch_array($result_too);

    $fioeo = $data_lost['eo'];

    $url = $_POST['url'];
    /******************************************************************************************************/
    function num2str($num)
    {
        $nul = 'ноль';
        $ten = array(
            array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
            array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        );
        $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
        $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
        $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
        $unit = array( // Units
            array('тиын', 'тиын', 'тиын',     1),
            array('тенге', 'тенге', 'тенге', 0),
            array('тысяча', 'тысячи', 'тысяч', 1),
            array('миллион', 'миллиона', 'миллионов', 0),
            array('миллиард', 'милиарда', 'миллиардов', 0),
        );
        //
        list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub) > 0) {
            foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v)) continue;
                $uk = sizeof($unit) - $uk - 1; // unit key
                $gender = $unit[$uk][3];
                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; # 20-99
                else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                // units without rub & kop
                if ($uk > 1) $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
            } //foreach
        } else $out[] = $nul;
        $out[] = morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
        $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
    }

    /**
     * Склоняем слово форму
     * @ author ngb
     */
    function morph($n, $f1, $f2, $f5)
    {
        $n = abs(intval($n)) % 100;
        if ($n > 10 && $n < 20) return $f5;
        $n = $n % 10;
        if ($n > 1 && $n < 5) return $f2;
        if ($n == 1) return $f1;
        return $f5;
    }
    /**********************************************************************************************/
?>
<!DOCTYPE html>
<html lang=ru-RU>
<head>
    <meta charset=UTF-8>
    <title>ЗАЛОГОВЫЙ БИЛЕТ</title>
    <link rel="stylesheet" href="css/stylezb.css" />

</head>
 <body>
    <!--
      <form action="act/changestatus.php" method="post">
          <button type="submit" name="gogo">Завершить</button>
      </form> -->

<div  class="noprint" >
  <div id="navbar" >
      <form class="" action="<?=$url;?>" method="POST">
        <input type="number" name="id"  hidden value="<?=$data3['id'];?>">
        <input type="text" name="url"  hidden value="index.php">
        <input type="text" name="date1"  hidden value="<?=$_POST['date1'];?>">
        <input type="text" name="date2"  hidden value="<?=$_POST['date2'];?>">
        <input type="text" name="region"  hidden value="<?=$_POST['region'];?>">
        <input type="text" name="adress"  hidden value="<?=$_POST['adress'];?>">
        <input type="text" name="kassa"  hidden value="<?=$_POST['kassa'];?>">
        <button type="submit" class="button7" name="button"> Назад</button>
      </form>
      </div>
  </div>
<div class="conten-wrapper">
<div class="dogovor">
<!-- Начала договора -->
    <h3 class="zagolovok">Договор комиссии № <?= $data_lost['nomerzb']; ?> <br>
    </h3>
    <span class="reg">г. <?= $data_lost['region']; ?></span>
    <!--Регион-->
    <span class="dd"> <?= date("d.m.Y", strtotime($data_lost['reg_data'])); ?></span>
    <!--Дата-->

    <p><span class="indent">ТОО «<?=$data_too['company'];?>»в лице <?=$fioeo;?> действующего (ей) на основании доверенности № <?=$_SESSION['logged_user']->doverennost;?>, именуемый в дальнейшем «Комиссионер» с одной стороны, и <?= $data_lost['fio']; ?> именуемый в дальнейшем «Комитент», с другой стороны, именуемые в дальнейшем «Стороны», заключили настоящий договор о нижеследующем: </span> <br>
    <br>

    <span class="indent">1.1.	Комиссионер обязуется по поручению Комитента за вознаграждение совершить от своего имени, но за счёт Комитента следующую сделку, направленную на реализацию нового или бывшего в употреблении имущества (далее Товар) третьему лицу (Покупателю), на условиях, предусмотренных в акте приема передачи настоящего Договора. </span> <br>
    <span class="indent">1.2.	Сделка купли-продажи Товара может быть осуществлена Комиссионером таким образом, что он сам в качестве покупателя принимает Товар, который он должен продать (сделка на себя- Делькредере), принятие Комиссионером ручательства за исполнение сделки. В этом случае Комитент обязан, помимо уплаты комиссионного вознаграждения, а в соответствующих случаях и дополнительного вознаграждения за делькредере, возместить комиссионеру израсходованные им по исполнению поручения суммы. </span> <br>
    <span class="indent">1.3.	Выплата денег Комитенту за проданный Товар производится в течении трех календарных дней с момента продажи или в иной срок, установленный по соглашению сторон. Выплата производится после предъявления Комитентом оригинала настоящего Договора и документа, удостоверяющего его личность. Комиссионер вправе авансом выплатить Комитенту стоимость товара до его продажи клиенту, при условии единовременной уплаты Комитентом вознаграждения Комиссионеру. Поручение Комитента считается исполненным после фактической продажи Товара. </span> <br>
    <span class="indent">1.4.	Комитент может отменить поручение только при условии, если Товар не продан Комиссионером. При этом Комитент уплачивает Комиссионеру за каждый день хранения Товара, за расходы на исполнение комиссионного поручения (проведение диагностики, предпродажная подготовка, выкладка Товара на витрине комиссионного магазина, размещение объявлений о продажи Товара в сети интернет, проведение презентации Товара потенциальным покупателям) по <?=$data_per['vozn'];?>% от суммы аванса, а также возвращает Комиссионеру аванс, полученный в соответствии с пунктом 1.3. настоящего Договора.  </span> <br>
    <span class="indent">1.5.	При отмене Комитентом поручения, вознаграждение, полученное Комиссионером в порядке, предусмотренном п.1.15.  настоящим договором, возврату не подлежит. </span> <br>
    <span class="indent">1.6.	Оплата Товара и передача Товара Покупателю осуществляется в момент совершения сделки. Расчеты с покупателем ведет Комиссионер. </span> <br>
    <span class="indent">1.7.	Комитент гарантирует, что указанный в акте приема передачи товар принадлежит ему на праве собственности, приобретено законным путем, не в следствии противоправной или преступной деятельности до совершения настоящего Договора никому другому не продан, не заложен, в споре под арестом не состоит и свободен от любых прав третьих лиц. </span> <br>
    <span class="indent">1.8.	Комитент принимает на себя обязательства, что если судом или органами досудебного расследования будет установлено, что Товар добыт преступным путем, то Комиссионер имеет право взыскать с Комитента возмещение понесенных расходов, установленных в пункте 1.4. настоящего Договора. </span> <br>
    <span class="indent">1.9.	Договор вступает в силу с момента подписания Сторонами, заключается до <?= date("d.m.Y", strtotime($data_lost['dv'])); ?> г., и продолжает действовать до полного выполнения сторонами своих обязательств по нему. </span> <br>
    <span class="indent">1.10. В случае если в течении 5 календарных дней с момента окончания срока действия Договора не реализованный Товар не был получен Комитентом, то такой Товар считается невостребованным, а ответственность Комиссионера перед Комитентом за сохранность Товара прекращается. Комиссионер имеет право распорядиться таким Товаром на свое усмотрение.	 </span> <br>
    <span class="indent">1.11. На комиссию принимаются новое или бывшее в употреблении имущество, пользующееся спросом износ изделия не более 40 %. Товар должен быть чистым, укомплектованным, в рабочем состоянии, позволяющим использовать его по назначению.	 </span> <br>
    <span class="indent">1.12. Комитент передает Товар Комиссионеру по адресу г.Нур-султан, ул.Кенесары 65 в момент подписания настоящего Договора на условиях и в соответствии с его положением. 	 </span> <br>
    <span class="indent">1.13. В случае досрочного расторжения договора Комиссии по инициативе Комитента, Комитент обязан обратиться в главный офис Комиссионера, расположенного по адресу: г.Нур-султан, ул.Сатпаева 23/1 	 </span> <br>
    <span class="indent">1.14. Комитент обязан уплатить Комиссионеру вознаграждение по правилам, установленным в разделе 1.15. настоящего Договора. </span> <br>
    <span class="indent">1.15. Комиссионное вознаграждение по настоящему договору составляет 0,5 % от стоимости Товара. Если Договор не был исполнен по причинам, зависящим от Комитента, Комиссионер сохраняет право на комиссионное вознаграждение, а также на возмещение понесенных расходов, установленных в пункте 1.4. настоящего Договора. </span> <br>
    <span class="indent">1.16. В случае, если Комиссионер совершит сделку на условиях более выгодных, чем те, которые были указаны Комитентом, дополнительная выгода причитается Комиссионеру. 	 </span> <br>
    <span class="indent">1.17. Товар, имеющий встроенные или внешние электронные носители информации (внутренняя память, съемные карты памяти и т.п.), принимается после удаления всех содержащихся на них данных (аккаунты, в том числе в социальных сетях и мобильных приложениях, файлы с аудио, фото, видеоматериалами, документами и др. информацией). Если такая информация не удалена Комитентом, в ходе предпродажной подготовки Комиссионер вправе удалить ее без дополнительного согласования и информирования Комитента. После приемки Товара на Комитента не может быть возложена какая-либо ответственность за сохранность вышеуказанной информации.	 </span> <br>
    <span class="indent">1.18. При обнаружении дефектов, которые могут быть исправлены, Стороны вправе согласовать проведение Комиссионером за счет Комитента предпродажной подготовки Товара (мелкий ремонт, химчистка и пр.). 	 </span> <br>
    <span class="indent">1.19. В случаях выявления недостатков Товара, которые не могли быть обнаружены в ходе визуального осмотра при приемке товара (скрытые дефекты), Комиссионер обязан незамедлительно уведомить Комитента любым способом по своему усмотрению. При этом Комиссионер вправе изъять из продажи Товар с такими недостатками и возвратить Комитенту или по согласованию с Комитентом продать Товар по сниженной цене. 	 </span> <br>
    <span class="indent">1.20. В случае возврата Комиссионеру Товара потребителем по причинам, делающим невозможное его использование по обычному прямому назначению (к примеру, блокировка электронного устройства вследствие неисполнения Комитентом своих обязательств перед оператором связи и другими уполномоченными лицами), а также изъятия Товара у потребителя правоохранительными и иными уполномоченными органами, обязательства по возврату потребителю денег, уплаченных за Товар, возлагается на Комитента	 </span> <br>
    <span class="indent">1.21. Комиссионер, вернувший потребителю деньги, возвратившему Товар в случае, предусмотренном пунктом 1.19. Договора, вправе требовать от Комитента возмещения своих расходов.	 </span> <br>
    <span class="indent">1.22. Комиссионер извещает Комитента о совершении сделки в отношении Товара, в том числе посредством сетей телекоммуникаций (сотовая связь, SMS-сообщения, WhatsApp, Telegram, по электронной почте и т.п. указанных в настоящем Договоре).	 </span> <br>
    <span class="indent">1.23. Настоящий Договор может быть расторгнут по соглашению Сторон в установленном законом РК порядке.	 </span> <br>
    <span class="indent">1.24. Договор прекращает своё действие при полном исполнении Сторонами условий Договора. 	 </span> <br>
    <span class="indent">1.25. Стороны пришли к соглашению, что споры, которые могут возникнуть между сторонами из настоящего Договора рассматриваются в соответствии с действующим законодательством РК.	 </span> <br>
    <span class="indent">1.26. Содержание ст. 188, 235, 238, 239, 260, 261, 401, 865, 866, 867, 871, 872, 877 ГК РК и юридические последствия совершенной сделки Сторонам известны.	 </span> <br>
    <span class="indent">1.27. Все дополнения и изменения к настоящему Договору должны быть составлены письменно и подписаны представителями обеих Сторон. Настоящий договор составлен в двух экземплярах по одному для каждой из Сторон, имеющих равную юридическую силу, и хранится по одному у каждой из сторон.	 </span> <br>
    <span class="indent"> Я <?= $data_lost['fio']; ?>  выражаю свое согласие на осуществление обработки, сбора, систематизации, накопления, хранения, уничтожения, обновления, использования, передачи персональных данных, указанных в настоящем договоре, в соответствии с законом РК «О персональных данных и их защите №94-V» от 21 мая 2013 года 	 </span> <br>

    </p>





    <h3 class="zagolovok">Реквизиты и подписи Сторон</h3>

    <table class="requisites">
                <tr>
                    <th class="pledger" style="text-align: center;">Комитент:</th>
                    <th colspan="2"   style="text-align: center;">Комиссионер:</th>
                </tr>
                <tr>
                    <td class="pledger"><b><?= $data_lost['fio']; ?> <b></td>
                    <!--Фамия имя отчесов клипента-->
                    <td colspan="2"><h3>ТОО « <?=$data_too['company'];?> »</h3></td>
                </tr>
                <tr>
                    <td class="pledger">Адрес: <?= $data_lost['adress']; ?></td>
                    <td colspan="2">Юр.адрес: г.Нур-Султан, район Алматы, <br> улица Қаныш Сәтбаев, здание 23/1, н.п. 4</td>
                </tr>
                <tr>
                    <td class="pledger">ИИН: <?= $data_lost['iin']; ?></td>
                    <td colspan="2">АО «ForteBank»</td>
                </tr>
                <tr>
                   <td class="pledger">уд.личности №<?= $data_lost['numberdocs']; ?><br> выдан <?= $data_lost['kemvydan']; ?><br> от <?= date("d.m.Y", strtotime($data_lost['date_vyd'])); ?> </td>
                    <td colspan="2">Номер счета KZ7396503F0009332890 </td> <!-- Мобильный телефон филиала-->
                </tr>
                <tr>
                    <td class="pledger">Тел.: <?= $data_lost['phones']; ?></td>
                    <td colspan="2">БИК: IRTYKZKA</td>
                </tr>
                <tr>
                    <td class="pledger"></td>
                    <td colspan="2">КБе: 17</td>
                </tr>
                <tr>
                    <td class="pledger"></td>

                </tr>
                <tr>
                    <th class="pledger">Комитент получил товар _____________</th>
                    <th>Комиссионер передал товар _____________ </th>
                    <th class="mP">М.П.</th>
                </tr>
            </table>
    </div>
<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->



<div class="newPage">
<p style="text-align:right"><strong>Приложение №1 </strong></p>

<p style="text-align:right"><strong>к договору Комиссии №<?= $data_lost['nomerzb']; ?> от <?=date("d.m.Y", strtotime($data_lost['reg_data']));?></strong></p>

<p>&nbsp;</p>

<p style="text-align:center"><strong>Акт-приёма передачи товара </strong></p>

<p style="text-align:center"><strong>к договору комиссии №<?= $data_lost['nomerzb']; ?> от <?=date("d.m.Y", strtotime($data_lost['reg_data']));?></strong></p>

<span class="reg">г. <?= $data_lost['region']; ?></span>
<!--Регион-->
<span class="dd"><?= date("d.m.Y", strtotime($data_lost['reg_data'])); ?></span>
<!--Дата-->
<p>ТОО &laquo;<?=$data_too['company'];?>&raquo; в лице <?=$data_too['doveren'];?> действующего (ей) на основании доверенности №<?=$data_too['kogda'];?>, именуемый в дальнейшем &laquo;Комиссионер&raquo; с одной стороны, и <?= $data_lost['fio']; ?>&nbsp; именуемый в дальнейшем &laquo;Комитент&raquo;, с другой стороны, именуемые в дальнейшем &laquo;Стороны&raquo;, составили настоящий Акт о нижеследующем:</p>

<p>1. В соответствии с Договором №<?= $data_lost['nomerzb']; ?> от <?=date("d.m.Y", strtotime($data_lost['reg_data']));?>. Комитент передает, а Комиссионер принимает Товар ассортимента и качества:</p>

<table border="1" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
		<tr>
			<td style="width:66px">
			<p><strong>№ п.п.</strong></p>
			</td>
			<td style="width:359px">
			<p><strong>Наименование</strong></p>
			</td>
			<td style="width:95px">
			<p><strong>Кол-во</strong></p>
			</td>
			<td style="width:132px">
			<p><strong>Цена</strong></p>
			</td>
			<td style="width:113px">
			<p><strong>Сумма</strong></p>
			</td>
		</tr>
		<tr>
			<td style="width:66px">
			<p style="text-align:center">1</p>
			</td>
			<td style="width:359px">
        <p style="text-align:center">
			<?= $data_lost['category']; ?>, <?= $data_lost['tovarname']; ?> <?= $data_lost['hdd']; ?> <?= $data_lost['sostoyanie_bu']; ?>  <?= $data_lost['upakovka']; ?> <?= $data_lost['ekran']; ?> <?= $data_lost['korpus']; ?>
       SN: <?= $data_lost['sn']; ?>, IMEI:<?= $data_lost['imei']; ?>, <?= $data_lost['complect']; ?> <?= $data_lost['opisanie']; ?>
     </p>
			</td>
			<td style="width:95px">
			<p style="text-align:center">1</p>
			</td>
			<td style="width:132px">
        <p style="text-align:center">
			<?= number_format($data_lost['summa_vydachy'], 0, '.', ' '); ?></p>
			</td>
			<td style="width:113px">
        <p style="text-align:center">
			<?= number_format($data_lost['summa_vydachy'] + $data_lost['p1'] + $data_lost['obshproczasutki'], 0, '.', ' '); ?></p>
			</td>
		</tr>
	</tbody>
</table>

<p>На сумму <?= number_format($data_lost['summa_vydachy'], 0, '.', ' '); ?> (<?= num2str($data_lost['summa_vydachy']); ?> ) тенге</p>

<p>2. Принятый Комиссионером товар обладает качеством и ассортиментом, соответствующим требованиям Договора.</p>

<p>3. Настоящий Акт составлен в двух экземплярах, имеющих равную юридическую силу, по одному экземпляру для каждой из Сторон и является неотъемлемой частью Договора между Сторонами. Настоящий акт является неотъемлемой частью договора Комиссии №<?= $data_lost['nomerzb']; ?> от <?=date("d.m.Y", strtotime($data_lost['reg_data']));?></p>

<p>4. Срок договора комиссии составляет <?= $data_lost['srok']; ?>&nbsp; дней.</p>

<p>5. Размер вознаграждения Комиссионера &ndash; 0,5% от стоимости товара):  <?= $data_lost['p1']; ?> (<?= num2str($data_lost['p1']); ?> )</p>

<p>6. Стоимость хранения Товара (один день) &ndash; 0,8 % от суммы аванса): <?= $data_lost['obshproczasutki']; ?> (<?= num2str($data_lost['obshproczasutki']); ?> ) с случае отмены поручения согласно п. 1.4. договора Комиссии.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<table align="left" border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
		<tr>
			<td style="width:50%">
			<p><strong>КОМИТЕНТ:</strong></p>

			<p>&nbsp;</p>

			<p>_____________________ / <?= $fioeo; ?></p>

			<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <em>(подпись)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (фамилия, инициалы)</em></p>
			</td>
			<td style="height:47px; width:368px">
			<p><strong>КОМИССИОНЕР</strong><strong>:</strong></p>

			<p>&nbsp;</p>

			<p>_____________________ / ________________</p>

			<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <em>(подпись)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (фамилия, инициалы)</em></p>
			</td>
		</tr>
	</tbody>
</table>

</div>

<div class="newPage">
  <p style="text-align:center"><strong>УПАКОВОЧНЫЙ ТАЛОН</strong></p>

<p>Адрес: г.Нур-Султан, район Алматы, <br> улица Қаныш Сәтбаев, здание 23/1, н.п. 4</p>
<p>Дата:&nbsp;&nbsp; <?= date("d.m.Y", strtotime($data_lost['dataseg'])); ?></p>

<table border="1" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
		<tr>
			<td style="width:46px">
			<p style="text-align: center;"><strong>№ п.п.</strong></p>
			</td>
			<td style="width:315px">
			<p style="text-align: center;"><strong>Номенклатура</strong></p>
			</td>
			<td style="width:110px">
			<p style="text-align: center;"><strong>Договор</strong></p>
			</td>
			<td style="width:128px">
			<p style="text-align: center;"><strong>Сумма</strong></p>
			</td>
			<td style="width:137px">
			<p style="text-align: center;"><strong>Дата окончания договора</strong></p>
			</td>
		</tr>
		<tr>
			<td style="width:46px">
			<p style="text-align: center;">1</p>
			</td>
			<td style="width:315px">
      <p style="text-align:center">
    <?= $data_lost['category']; ?>, <?= $data_lost['tovarname']; ?> <?= $data_lost['hdd']; ?> <?= $data_lost['sostoyanie_bu']; ?>  <?= $data_lost['upakovka']; ?> <?= $data_lost['ekran']; ?> <?= $data_lost['korpus']; ?>
     SN: <?= $data_lost['sn']; ?>, IMEI:<?= $data_lost['imei']; ?>, <?= $data_lost['complect']; ?> <?= $data_lost['opisanie']; ?>
   </p>

			</td>
			<td style="width:110px">
			<p style="text-align: center;">№ <?= $data_lost['nomerzb']; ?></p>
			</td>
			<td style="width:128px">
			<p style="text-align: center;"><p style="text-align: center;"><?= number_format($data_lost['summa_vydachy'], 0, '.', ' '); ?></p></p>
			</td>
			<td style="width:137px">
			<p style="text-align: center;"><?= date("d.m.Y", strtotime($data_lost['dv'])); ?>г.</p>
			</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p><strong>Комиссионер&nbsp; _________________/<?= $fioeo; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; дата <?= date("d.m.Y", strtotime($data_lost['dataseg'])); ?></strong></p>

</div>
    <hr class="noprint" style="margin-bottom:30px;">
    <hr class="noprint">
<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
<div class="newPage">
    <div class="rko">
        <p class="p101"> Приложение 1 <br>
            к приказу Министра Финансов <br>
            Республики Казахстан <br>
            от 20 декабря 2012 года №562<br>
            <br>
            Форма КО-2<br>
        <p class="f101"> г.<?= $data_lost['region']; ?>, <?= $adresslombard; ?></p>
        <table class="Too">
            <tr>
                <td class="o101">ТОО "<?=$data_too['company'];?>"</td>
            </tr>
            <tr>
                <td class="o1010">Организация (индивидуальный предприниматель)</td>
            </tr>
        </table>
        <table class="line01">
            <tr></tr>
        </table>
        <table class="row01">
            <tr>
                <td class="iin201">ИИН/БИН</td>
                <td class="iin01"><?=$data_too['bin'];?></td>
            </tr>
        </table>

        <table class="DT01">
            <tr class="nm101">
                <td class="nmdoc01">Номер документа</td>
                <td class="dts01">Дата составления</td>
            </tr>
            <tr>
                <td class="zb01"><?= $data_lost['nomerzb']; ?></td>
                <td class="data01"><?= date("d.m.Y", strtotime($data_lost['reg_data'])); ?></td>
            </tr>
        </table>

        <p class="order01">РАСХОДНЫЙ КАССОВЫЙ ОРДЕР</p>

        <table class="T101">
            <tr class="H101">
                <td class="debet01">Дебет</td>
                <td class="kredit01" rowspan="2">Кредит</td>
                <td class="summa01" rowspan="2">Сумма, в тенге</td>
                <td class="kod01" rowspan="2">Код целевого <br>назначения</td>
            </tr>
            <tr class="H201">
                <td class="kredit01">Корреспондирующий счет</td>
            </tr>
            <tr class="H301">
                <td class="debet201">1710</td>
                <td class="kredit201">1010</td>
                <td class="summa201"><?= $data_lost['summa_vydachy']; ?></td>
                <td class="kod201"></td>
            </tr>
        </table>

        <table class="T201">
            <tr class="H401">
                <td class="pr01">Выдать</td>
                <td class="kl01" colspan="5"><?= $data_lost['fio']; ?></td>
            </tr>
            <tr class="H401">
                <td class="pr01">Основание</td>
                <td class="kl01" colspan="5">Выдача аванса по договору №<?=$data_lost['nomerzb'];?> от <?= date("d.m.Y", strtotime($data_lost['reg_data'])); ?> </td>
            </tr>

            <tr class="H401">
                <td class="pr01">Прилагаемые документы</td>
                <td class="kl01" colspan="5">Договор №<?= $data_lost['nomerzb']; ?> от
                    <?= date("d.m.Y", strtotime($data_lost['reg_data'])); ?></td>
            </tr>

            <tr class="H401">
                <td class="pr01">Сумма</td>

                <td class="kl01" colspan="5"><?= number_format($data_lost['summa_vydachy'], 0, '.', ' '); ?>
                (<?= num2str($data_lost['summa_vydachy']); ?> )</td>
            </tr>
            <tr class="H402">
                <td class="pr01"></td>
                <td class="prop" colspan="5">(прописью)</td>
            </tr>
            <tr class="H401">
                <td class="ruc">Руководитель</td>
                <td class="dolzhnost01">Директор</td>
                <td class="slesh01">/</td>
                <td class="Fio"><?= $fioeo; ?></td>
            </tr>
            <tr class="H402">
                <td class="pp01"></td>
                <td class="dolzhnost101">(должность)</td>
                <td class="podpis01">(подпись)</td>
                <td class="Fio01">(расшифровка подписи)</td>
            </tr>
            <tr class="H401">
                <td class="ruc" colspan="2">Главный бухгалтер или уполномоченное лицо</td>
                <td class="slesh01">/</td>
                <td class="Fio">Не предусмотрено</td>
            </tr>
            <tr class="H402">
                <td class="pp01" colspan="2"></td>
                <td class="podpis01">(подпись)</td>
                <td class="Fio01">(расшифровка подписи)</td>
            </tr>
        </table>
        <table class="T202">
            <tr class="H401">
                <td class="pol">Получил</td>
                <td class="dt02"><?= date("d.m.Y", strtotime($data_lost['reg_data'])); ?></td>
                <td class="slesh02"></td>
                <td class="slesh02">/</td>
                <td class="Fio02" colspan="4"><?= $data_lost['fio']; ?></td>
            </tr>
            <tr class="H402">
                <td class="pp01"></td>
                <td class="pp01"></td>
                <td class="podpis01">(подпись)</td>
                <td class="slesh03"></td>
                <td class="Fio01">(фамилия, имя, отчество)</td>
            </tr>
        </table>

        <table class="T203">
            <tr class="H401">
                <td class="ud">по паспорту/уд.уличности</td>
                <td class="nomer">№<?= $data_lost['numberdocs']; ?></td>
                <td class="dtv">от <?= date("d.m.Y", strtotime($data_lost['date_vyd'])); ?> </td>
                <td class="organ"><?= $data_lost['kemvydan']; ?></td>
                <td class="organ"></td>
                <td class="organ"></td>
            </tr>
            <tr class="H402">
                <td colspan="7" class="naim">(наименование, номер, дата и место выдачи документа, удостоверяющего
                    личность получателя)</td>
            </tr>
        </table>
        <table class="T204">
            <tr class="H401">
                <td class="pol01" colspan="2">Выдал кассир-приемщик</td>
                <td class="slesh02"></td>
                <td class="slesh02">/</td>
                <td class="Fio03" colspan="6" style="width: 230px;"><?= $fioeo; ?></td>
            </tr>
            <tr class="H402">
                <td class="pp01"></td>
                <td class="pp01"></td>
                <td class="podpis01">(подпись)</td>
                <td class="slesh03"></td>
                <td class="Fio04" colspan="5">(фамилия, имя, отчество)</td>
            </tr>
        </table>
        </div>
    </div>

<!-- *********************************************************************************************************** -->
    <div class="Pko">
        <p class="p1"> Приложение 1 </br>
            к приказу Министра Финансов </br>
            Республики Казахстан </br>
            от 20 декабря 2012 года №562</br>
            </br>
            Форма КО-1</br>
            <p class="f1"> г.<?= $region; ?>, <?= $adresslombard; ?></p>
            <table class="T00">
                <tr>
                    <td>ТОО "<?=$data_too['company'];?>"</td>
                </tr>
            </table>
            <p class="o1">Организация (индивидуальный предприниматель)</p>
            <table class="row">
                <tr>
                    <td class="iin2">ИИН/БИН</td>
                    <td class="iin">110840013121</td>
                </tr>
            </table>
            <table class="DT">
                <tr class="nm1">
                    <td class="nmdoc">Номер документа</td>
                    <td class="dts">Дата составления</td>
                </tr>
                <tr>
                    <td class="zb"><?= $data_lost['nomerzb']; ?></td>
                    <td class="data"><?= date("d.m.Y", strtotime($data_lost['dataseg'])); ?></td>
                </tr>
            </table>
            <p class="line1">л и н и я о т р ы в а</p>

            <table class="T01">
                <tr>
                    <td class="o2">Организация (индивидуальный предприниматель)</td>
                </tr>
                <tr>
                    <td class="T011">ТОО "<?=$data_too['company'];?>"</td>
                </tr>
            </table>



            <p class="kvitan"> КВИТАНЦИЯ </br>
                к приходному кассовому ордеру</br>
                №<?= $data_lost['nomerzb']; ?> от <?= date("d.m.Y", strtotime($data_lost['reg_data'])); ?></br>
            </p>
            <p class="prinyat"> Принято от: <?= $data_lost['fio']; ?> </br>
                Основание: Комиссионное вознаграждение</br>
                <!--Вид операции-->
                по договору №<?= $data_lost['nomerzb']; ?> от <?= date("d.m.Y", strtotime($data_lost['reg_data'])); ?></br>
                </br>
                Сумма: <?= $data_lost['p1']; ?> (<?= num2str($data_lost['p1']); ?> )</br>
                </br>
                </br>
                </br>
                М.П.</br>
                </br>
                </br>
                </br>
                Кассир:________/ <?= $fioeo; ?>
                <!--Экпсперт оценщик-->
                <p class="p12">(подпись)</p>
            </p>
            <p class="order">ПРИХОДНЫЙ КАССОВЫЙ ОРДЕР</p>
            <table class="T1">
                <tr class="H1">
                    <td rowspan="2" class="debet">Дебет</td>
                    <td class="kredit">Кредит</td>
                    <td class="summa" rowspan="2">Сумма, в тенге</td>
                    <td class="kod" rowspan="2">Код целевого </br>назначения</td>
                </tr>
                <tr class="H2">
                    <td class="kredit">Корреспондирующий счет</td>
                </tr>
                <tr class="H3">
                    <th class="debet2">1010</th>
                    <th class="kredit2">6110</th>
                    <th class="summa2"><?= $data_lost['p1']; ?></th>
                    <th class="kod2"></th>
                </tr>
            </table>
            <table class="T2">
                <tr class="H4">
                    <td class="pr">Принято от:</td>
                    <td class="kl"><?= $data_lost['fio']; ?></td>
                </tr>
                <tr class="H5">
                    <td class="os">Основание:</td>
                    <td class="os1">Комиссионное вознаграждение
                        по договору №<?= $data_lost['nomerzb']; ?> </td>
                </tr>
            </table>

            <table class="T3">
                <tr class="H6">
                    <td class="voz">Комиссионное вознаграждение:</td>
                    <td class="i"> <?= $data_lost['p1']; ?> тенге</td>
                </tr>
                <tr class="H7">

                </tr>
            </table>
            <table class="T4">
                <tr class="H8">
                    <td class="summ">Cумма:</td>
                    <td colspan="2" class="summ12"><?= $data_lost['p1']; ?>  (<?= num2str($data_lost['p1']); ?> )</td>
                </tr>
            </table>
            <table class="T5">
                <tr class="H9">
                    <td class="kass">Получил кассир-приемщик</td>
                    <td class="pusto"></td>
                    <td class="slesh">/</td>
                    <th class="kass1" style="width: 200px;"><?= $fioeo; ?></th>
                </tr>
                <tr class="H9">
                    <td class="kass"></td>
                    <td class="pusto1">(подпись)</td>
                    <td class="slesh1"></td>
                    <td class="kass2">(расшифровка подписи)</td>
                </tr>
            </table>
    </div>
    <script>
window.onscroll = function() {myFunction()};
var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;
function myFunction() {
if (window.pageYOffset >= sticky) {
navbar.classList.add("sticky")
} else {
navbar.classList.remove("sticky");
}
}
</script>

    <!--=======================================================================================-->
</body>
</html>
<?php endif; ?>
<?php else : ?> Вы не авторизованы<br />
<?php endif; ?>
