<?PHP
  include ("../../../bd.php");
  $nomerzb = $_GET['nomerzb'];

  $result = $mysqli->query("SELECT * FROM tickets WHERE nomerzb = '$nomerzb' ");
  $data3 = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang=ru-RU>
<head>
    <meta charset=UTF-8>
    <title>ЗАЛОГОВЫЙ БИЛЕТ</title>
    <link rel="stylesheet" href="stylezb.css" /> 

</head>
 <body>
    <!--
      <form action="act/changestatus.php" method="post">
          <button type="submit" name="gogo">Завершить</button>
      </form> -->

<div  class="noprint" >
  <div id="navbar" >
      <form class="" action="<?=$url;?>" method="POST">
        <button type="submit" class="button7" name="button"> Назад</button>
        <button  class="button7" onclick="print()" name="button"> Печатать</button>
      </form>
    </div>
  </div>
<div class="conten-wrapper">
<div class="dogovor">
  <?php
  $pkgs = array(
    array('shop' => 'ООО "Могута"', 'sku' => $nomerzb, 'price' => '1000', 'buyer_fio' => 'Авдеев Марк', 'buyer_phone' => '+7921424078'),
  );
  ?>
<?php foreach ($pkgs as $item): ?>
<table class="border">
<tr>
  <td>
  </td>
  <td>
    <?php echo barcode::code39($item['sku']); ?>
  </td>

</tr>

<tr>
  <td colspan="2"> <?= $data3['category']; ?>, <?= $data3['tovarname']; ?>
   SN: <?= $data3['sn']; ?>, IMEI:<?= $data3['imei']; ?>, <?= $data3['opisanie']; ?>  </td>
</tr>

</table>
<?php endforeach; ?>
</div>
</body>
</html>

<?php
class barcode {

  protected static $code39 = array(
    '0' => 'bwbwwwbbbwbbbwbw', '1' => 'bbbwbwwwbwbwbbbw',
    '2' => 'bwbbbwwwbwbwbbbw', '3' => 'bbbwbbbwwwbwbwbw',
    '4' => 'bwbwwwbbbwbwbbbw', '5' => 'bbbwbwwwbbbwbwbw',
    '6' => 'bwbbbwwwbbbwbwbw', '7' => 'bwbwwwbwbbbwbbbw',
    '8' => 'bbbwbwwwbwbbbwbw', '9' => 'bwbbbwwwbwbbbwbw',
    'A' => 'bbbwbwbwwwbwbbbw', 'B' => 'bwbbbwbwwwbwbbbw',
    'C' => 'bbbwbbbwbwwwbwbw', 'D' => 'bwbwbbbwwwbwbbbw',
    'E' => 'bbbwbwbbbwwwbwbw', 'F' => 'bwbbbwbbbwwwbwbw',
    'G' => 'bwbwbwwwbbbwbbbw', 'H' => 'bbbwbwbwwwbbbwbw',
    'I' => 'bwbbbwbwwwbbbwbw', 'J' => 'bwbwbbbwwwbbbwbw',
    'K' => 'bbbwbwbwbwwwbbbw', 'L' => 'bwbbbwbwbwwwbbbw',
    'M' => 'bbbwbbbwbwbwwwbw', 'N' => 'bwbwbbbwbwwwbbbw',
    'O' => 'bbbwbwbbbwbwwwbw', 'P' => 'bwbbbwbbbwbwwwbw',
    'Q' => 'bwbwbwbbbwwwbbbw', 'R' => 'bbbwbwbwbbbwwwbw',
    'S' => 'bwbbbwbwbbbwwwbw', 'T' => 'bwbwbbbwbbbwwwbw',
    'U' => 'bbbwwwbwbwbwbbbw', 'V' => 'bwwwbbbwbwbwbbbw',
    'W' => 'bbbwwwbbbwbwbwbw', 'X' => 'bwwwbwbbbwbwbbbw',
    'Y' => 'bbbwwwbwbbbwbwbw', 'Z' => 'bwwwbbbwbbbwbwbw',
    '-' => 'bwwwbwbwbbbwbbbw', '.' => 'bbbwwwbwbwbbbwbw',
    ' ' => 'bwwwbbbwbwbbbwbw', '*' => 'bwwwbwbbbwbbbwbw',
    '$' => 'bwwwbwwwbwwwbwbw', '/' => 'bwwwbwwwbwbwwwbw',
    '+' => 'bwwwbwbwwwbwwwbw', '%' => 'bwbwwwbwwwbwwwbw'
  );

  public static function code39($text) {
    if (!preg_match('/^[A-Z0-9-. $+\/%]+$/i', $text)) {
      throw new Exception('Ошибка ввода');
    }

    $text = '*'.strtoupper($text).'*';
    $length = strlen($text);
    $chars = str_split($text);
    $colors = '';

    foreach ($chars as $char) {
      $colors .= self::$code39[$char];
    }

    $html = '
            <div style=" float:left;">
            <div>';

    foreach (str_split($colors) as $i => $color) {
      if ($color=='b') {
        $html.='<SPAN style="BORDER-LEFT: 0.02in solid; DISPLAY: inline-block; HEIGHT: 1in;"></SPAN>';
      } else {
        $html.='<SPAN style="BORDER-LEFT: white 0.02in solid; DISPLAY: inline-block; HEIGHT: 1in;"></SPAN>';
      }
    }

    $html.='</div>
            <div style="float:left; width:100%;" align=center >'.$text.'</div></div>';
    //echo htmlspecialchars($html);
    echo $html;
  }

}
