<?php
require 'db.php';

$fioeo = $_SESSION['logged_user']->eo;
$region = $_SESSION['logged_user']->region;
$adresslombard = $_SESSION['logged_user']->adressfil;
$kassa = $_SESSION['logged_user']->kassa;

$idx = $_POST['idx'];
date_default_timezone_set('Asia/Almaty');
if (isset($_SESSION['logged_user']) and ($_SESSION['logged_user']->root == 2)) :


    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_base);
    if ($mysqli->connect_error) {
        die('Ошибка : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    $nomerzb = $_GET['nomerzb'];
    //  $nomerzb = (int) $_GET["nomerzb"];
  // $nomerzb = strip_tags($_GET['nomerzb']);
    $nomerzb = htmlentities($_GET['nomerzb'], ENT_QUOTES, "UTF-8");
    $nomerzb = htmlspecialchars($_GET['nomerzb'], ENT_QUOTES);

    $result = $mysqli->query("select *from tickets WHERE id = '$idx'  ");
    $data_lost = mysqli_fetch_array($result);


    $result_per = $mysqli->query("select *from percent");
    $data_per = mysqli_fetch_array($result_per);

    $result_too = $mysqli->query("select *from too");
    $data_too = mysqli_fetch_array($result_too);
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

    if($data_lost['cena_pr'] == $_POST['cena_pr']){
        $sale_name = 'Продажа '.$data_lost['tovarname'].' КТ:'.$data_lost['nomerzb'];
      }
      else {
        $sale_name = 'Внесение задатка '.$data_lost['tovarname'].' КТ:'.$data_lost['nomerzb'];
      }
?>
<!DOCTYPE html>
<html lang=ru-RU>
<head>
    <meta charset=UTF-8>
    <title>Заявление на покупку</title>
    <link rel="stylesheet" href="css/stylesale.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

      <script>
      // Отправка данных
    		$( document ).ready(function() {
    			$( "form" ).submit(function() { // При нажатии кнопки с типом сабмит отправляем данные
    				event.preventDefault();
    				var formData = $( this ).serialize();// создаем переменную, которая содержит закодированный набор элементов формы в виде строки

    				$.post( "kkmqr/webkkm.php", formData, function( data ) { //  передаем и загружаем данные с сервера с помощью HTTP запроса методом POST
    					$( ".modal-body" ).html(data); // вставляем в элемент #Otvet данные, полученные от сервера
    				})
    			});
    		});

        function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
        }
      </script>

</head>
 <body>
  <div id="openModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header noprint">
        <h3 class="modal-title"> Фискальный чек проведенной операции </h3>
        <a href="#close" title="Close"
        class="close noprint">×</a>
      </div>
      <div class="modal-body" style="display:block;" id="mydiv">
        <div class="windows8">
        <div class="wBall" id="wBall_1">
          <div class="wInnerBall"></div>
        </div>
        <div class="wBall" id="wBall_2">
          <div class="wInnerBall"></div>
        </div>
        <div class="wBall" id="wBall_3">
          <div class="wInnerBall"></div>
        </div>
        <div class="wBall" id="wBall_4">
          <div class="wInnerBall"></div>
        </div>
        <div class="wBall" id="wBall_5">
          <div class="wInnerBall"></div>
        </div>
      </div>
      </div>
      <div class="noprint">
        <button type="button" class="button13" onclick="print()">Распечатать</button>
      </div>
    </div>
  </div>
</div>
    <!--
      <form action="act/changestatus.php" method="post">

          <button type="submit" name="gogo">Завершить</button>
      </form> -->
      <div  class="noprint" >
    <!-- ФОрма передачии данных на обработчик -->
    <form id="navbar" >
      <a href="tickets-saler.php">Назад</a>
      <input type="number"  hidden name="Price" value="<?=$_POST['cena_pr'];?>"> <!--Сумма операции-->
      <input type="text"  hidden name="buyer" value="<?=$_POST['namebuyer']?>"> <!--Сумма операции-->
      <input type="text"  hidden name="buyeriin" value="<?=$_POST['iinbuyer']?>"> <!--Сумма операции-->
      <input type="text"  hidden name="buyertel" value="<?=$_POST['telbuyer']?>"> <!--Сумма операции-->
      <input type="text" hidden name="PositionName" value="<?=$sale_name;?>">
      <input type="number" hidden name="OperationType" value="2">  <!--Тип опрации (0 покупка) (1 Возврат покупки) (2 Продажа) (3 Возврат продажи)-->
      <input type="number"  hidden name="idsale" value="<?=$data_lost['id'];?>">
      <input type="text"  hidden name="saler" value="<?=$_POST['saler']?>">
      <input class="submit" type="submit" value="Печать" onclick="print()">
      <a href="#openModal">Показать чек</a>
    </form>
    <!-- / ФОрма передачии данных на обработчик -->
    </div>
    <div class="conten-wrapper">
      <?php
        if(($data_lost['cena_pr'] <= $_POST['cena_pr']) OR (($data_lost['zadatok'] + $_POST['cena_pr']) ==$data_lost['cena_pr'])):
      ?>
    <div class="newPage">
        <table class="prlzh">
            <tr><th style="text-align:center;"> TOO "<?=$data_too['company'];?>" </th></tr>
            <tr><td style="text-align:center;"><em>г.<?= $region; ?> <?= $data_too['adres']; ?>  </em></td></tr>
        </table>
        <h2 class="zagolovok"><em>Заявленние на покупку с торгов</em></h2>
        <div style="margin-top:30px; margin-bottom: 10px;">
            <span style="margin-left:20px; "> Ф.И.О <?=$_POST['namebuyer']?> </span><br>
            <span style="margin-left:20px;  "> ИИН <?=$_POST['iinbuyer']?>, телефон <?=$_POST['telbuyer']?> </span> <br>
            <span style="margin-left:20px;  ">Купил(а) в ТОО "<?=$data_too['company'];?>"</span>
        </div>
        <table class="tovar" style="width:100%;">
          <tr>
            <th colspan="2"> Наименование товара:	<?= $_POST['buyer_product']; ?>
              </th>
          </tr>
          <tr>
            <th colspan="2">SN: <?= $data_lost['sn']; ?>/ IMEI:<?= $data_lost['imei']; ?>,</th>
          </tr>
          <tr>
            <th colspan="2">Общее состояние:<?= $_POST['comment_product']; ?> </th>
          </tr>
          <tr>
            <th>iCloud_______________________</th><th>Комплектация:_______________________________________</th>
          </tr>
          <tr>
            <th colspan="2">Стоимость товара: <?=number_format($data_lost['cena_pr'], 0, '.', ' ');?> (<?= num2str($data_lost['cena_pr']); ?> )</th>
          </tr>
        </table>
    </div>
        <p>
          Притензий не имею, и иметь не буду к качеству и состоянию товара, купленного мной в ТОО "<?=$data_too['company'];?>". На отсутсвие аккаунтов проверил(а).
        </p>
        <table class="clien_podpis">
        <tr>
        <td style="white-space: nowrap;"><?=$_POST['namebuyer']?></td> <td style="border-bottom:1px solid black;width:200px;"></td>
        </tr>
        <tr>
        <td></td> <td style="text-align:center; font-size:80%;">(подпись)</td>
        </tr>
        </table>
        <h2 class="zagolovok"><em>Уведомление</em></h2>
        <p>ТОО "<?=$data_too['company'];?>" уведомляет, что купленный товары бывшего использования <b><u>ОБМЕНУ И ВОЗВРАТУ НЕ ПОДЛЕЖИТ</u></b>.</p>

        <p>Дата покупки: <?=date('d.m.Y')?> г.   <span>Время покупки:<?=date('H:i:s')?> </span></p>

        <table class="clien_podpis">
        <tr>
        <td style="white-space: nowrap;"><?=$_POST['namebuyer']?></td> <td style="border-bottom:1px solid black; width:200px;"></td>
        </tr>
        <tr>
        <td></td> <td style="text-align:center; font-size:80%;">(подпись)</td>
        </tr>
        </table>
        <p><span style="border-bottom:1px solid black;"> Откуда узнали про наш магазин:</span></p>
        <table>
        <tr>
          <th>1)</th>
            <th style="border:3px solid black; width:20px;"></th>
              <th style="padding-right:60px;">OLX</th>
          <th>2)</th>
            <th style="border:3px solid black; width:20px;"></th>
              <th style="padding-right:60px;">INSTAGRAM</th>
          <th>3)</th>
            <th style="border:3px solid black; width:20px;"></th>
              <th style="padding-right:60px;">vkontakte</th>
          <th>4)</th>
            <th style="border:3px solid black; width:20px;"></th>
              <th style="padding-right:60px;">GOOGLE</th>
          <th>5)</th>
            <th style="border:3px solid black; width:20px;"></th>
              <th style="padding-right:60px;">ИНОЕ</th>
        </tr>
        </table>
        <br>
        <br>
        <table>
          <tr style="margin-top:20%;">
            <td>Продавец</td><td style="width:100px; border-bottom:1px solid black;" ></td><td><?=$_POST['saler'];?></td><td style="width:10%;"></td><td>Кассир</td><td style="width:100px; border-bottom:1px solid black;">
            </td><td><?=$fioeo;?></td>
          </tr>
        </table>
        <?php endif;
        // Если сумму не соответсвует сумме покупки///////////////////////////
        if(($data_lost['cena_pr'] > $_POST['cena_pr']) AND (($data_lost['zadatok'] + $_POST['cena_pr']) != $data_lost['cena_pr'])):
        ?>
        <div class="newPage">
            <table class="prlzh">
                <tr><th style="text-align:center;"> TOO "<?=$data_too['company'];?>" </th></tr>
                <tr><td style="text-align:center;"><em>г.<?= $region; ?> <?= $data_too['adres']; ?>  </em></td></tr>
            </table>
            <h2 class="zagolovok"><em>ЗАДАТОК №<?= $data_lost['nomerzb']; ?></em></h2>
            <div style="margin-top:30px; margin-bottom: 10px;">
                <span style="margin-left:20px; "> Я, <b><?=$_POST['namebuyer']?></b> ИИН:<b><?=$_POST['iinbuyer']?>, <?=date('d.m.Y')?></b> числа оставил(а) задаток в размере <b><?=$_POST['cena_pr'];?> (<?= num2str($_POST['cena_pr']); ?>)</b> тенге, за товар
                  <?= $_POST['buyer_product'];?> с кодом товара №<b> <?= $data_lost['nomerzb']; ?></b>
                до ____________, <?= date(Y);?> года включительно. <br></span><br>
                <span style="margin-left:30%; "><b>Обязуюсь  прийти в срок и выкупить товар.</b></span>
              <p style="text-align:center;font-weight:bolder;font-style:italic; ">В случае не явки в указанный срок или отказа от покупки задаток не возвращется.</p>
            </div>
            <p>
              Номер телефон:<b> <?=$_POST['telbuyer']?> </b><br><br>
              Подпись покупателя:<b> <?=$_POST['namebuyer']?>/_________________________ </b><br><br>
              Задаток принял:<b> <?=$fioeo;?>/_________________________ </b> <br><br>
              Стоимость товара: <b><?=number_format($data_lost['cena_pr'], 0, '.', ' ');?> (<?= num2str($data_lost['cena_pr']); ?> )</b><br>
              Внесенная сумма: <b><?=number_format($data_lost['zadatok'] +$_POST['cena_pr'], 0, '.', ' ');?> (<?= num2str($data_lost['zadatok']+$_POST['cena_pr']); ?> ) </b><br>
              Остаточная стоимость:<b> <?=number_format(($data_lost['cena_pr']-($data_lost['zadatok']+$_POST['cena_pr'])), 0, '.', ' ');?> (<?= num2str($data_lost['cena_pr']-($data_lost['zadatok']+$_POST['cena_pr'])); ?>)</b> <br>
            </p>
            <hr>
            <table class="prlzh">
                <tr><th style="text-align:center;"> TOO "<?=$data_too['company'];?>" </th></tr>
                <tr><td style="text-align:center;"><em>г.<?= $region; ?> <?= $data_too['adres']; ?>  </em></td></tr>
            </table>
            <h2 class="zagolovok"><em>ЗАДАТОК №<?= $data_lost['nomerzb']; ?></em></h2>
            <div style="margin-top:30px; margin-bottom: 10px;">
                <span style="margin-left:20px; "> Я, <b><?=$_POST['namebuyer']?></b> ИИН:<b><?=$_POST['iinbuyer']?>, <?=date('d.m.Y')?></b> числа оставил(а) задаток в размере <b><?=$_POST['cena_pr'];?> (<?= num2str($_POST['cena_pr']); ?>)</b> тенге, за товар
                  <?= $_POST['buyer_product'];?> с кодом товара №<b> <?= $data_lost['nomerzb']; ?></b>
                до ____________, <?= date(Y);?> года включительно. <br></span><br>
                <span style="margin-left:30%; "><b>Обязуюсь  прийти в срок и выкупить товар.</b></span>
              <p style="text-align:center;font-weight:bolder;font-style:italic; ">В случае не явки в указанный срок или отказа от покупки задаток не возвращется.</p>
            </div>
            <p>
              Номер телефон:<b> <?=$_POST['telbuyer']?> </b><br><br>
              Подпись покупателя:<b> <?=$_POST['namebuyer']?>/_________________________ </b><br><br>
              Задаток принял:<b> <?=$fioeo;?>/_________________________ </b> <br><br>
              Стоимость товара: <b><?=number_format($data_lost['cena_pr'], 0, '.', ' ');?> (<?= num2str($data_lost['cena_pr']); ?> )</b><br>
              Внесенная сумма: <b><?=number_format($data_lost['zadatok']+$_POST['cena_pr'], 0, '.', ' ');?> (<?= num2str($data_lost['zadatok']+$_POST['cena_pr']); ?> ) </b><br>
              Остаточная стоимость:<b> <?=number_format(($data_lost['cena_pr']-($data_lost['zadatok']+$_POST['cena_pr'])), 0, '.', ' ');?> (<?= num2str($data_lost['cena_pr']-($data_lost['zadatok']+$_POST['cena_pr'])); ?>)</b> <br>
            </p>
        </div>
        <?php endif; ?>
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
    </body>
    </html>

  <?php else : ?> Вы не авторизованы<br />
  <?php endif; ?>
