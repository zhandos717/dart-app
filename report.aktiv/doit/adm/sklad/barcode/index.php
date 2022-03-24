<?php

include("../../../../bd.php");

require 'vendor/autoload.php';

$ids = $_GET['id'];
// This will output the barcode as HTML output to display in the browser
//$generator = new Picqer\Barcode\BarcodeGeneratorHTML();

//echo $generator->getBarcode('081231723897', $generator::TYPE_EAN_5);

$generator = new Picqer\Barcode\BarcodeGeneratorPNG();

$generatorSVG = new Picqer\Barcode\BarcodeGeneratorSVG();

//$nomerzb = $data3['nomerzb'];

$result3 = $mysqli->query("SELECT * FROM tickets WHERE id = '$ids' ");
$data3 = mysqli_fetch_array($result3);

$nomerzb = $data3['nomerzb'];

$barcode = '<img width="120" height="50" src="data:image/png;base64,' . base64_encode($generator->getBarcode($nomerzb, $generator::TYPE_CODE_128)) .'">';


 if(empty($data3['tovarname'])){
          $tovar_name = $data3['opisanie'];
              }else {
              $tovar_name = $data3['tovarname'];
              };?>

<table class="table"  style="border:1px solid black;" style="width:60mm; height:42mm;">
  <tr>
    <td style="text-align:center; vertical-align:middle; font-size:18px; font-weight:800;"> AKTIV <br>market</td>
    <td><?=$barcode;?></td>
  </tr>
  <tr>
    <td>  </td>
    <td style="text-align:center;"> КТ: <?=$data3['nomerzb']?></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center;"> <?=$tovar_name;?> <br>Цена: <?=number_format($data3['cena_pr'], 0, '.', ' ');?> тг. </td>
  </tr>
</table>
<script type="text/javascript">
  window.print()
</script>
