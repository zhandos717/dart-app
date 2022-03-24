<?php include("../../../bd.php");
require 'vendor/autoload.php';
$ids = $_GET['id'];
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
$generatorSVG = new Picqer\Barcode\BarcodeGeneratorSVG();
$data = R::load('product', $ids);
$nomerzb = 'Z' . $data['id'];
$barcode = '<img width="120" height="50" src="data:image/png;base64,' . base64_encode($generator->getBarcode($nomerzb, $generator::TYPE_CODE_128)) . '">';

if (!empty($data['name'])) {
  $tovar_name = $data['name'];
} else {
  $tovar_name = $data['message'];
}; ?>

<table class="table" style="border:1px solid black;" style="width:60mm; height:42mm;">
  <tr>
    <td style="text-align:center; vertical-align:middle; font-size:18px; font-weight:800;"> AKTIV <br>market</td>
    <td><?= $barcode; ?></td>
  </tr>
  <tr>
    <td> </td>
    <td style="text-align:center;"> КТ: <?= $nomerzb ?></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center; width:60mm;"> <?= $tovar_name; ?> <br>Цена: <?= number_format($data['price'], 0, '.', ' '); ?> тг. </td>
  </tr>
</table>
<script type="text/javascript">
  window.print()
</script>