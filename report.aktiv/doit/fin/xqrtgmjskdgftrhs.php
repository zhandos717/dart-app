<?php
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь

  if ($_SESSION['logged_user']->status == 11) :

$nomerzb = $_POST['nomerzb'];
$saler_fio = $_SESSION['logged_user']->fio;


if(isset($_POST['go_sale'])){
  $cena_pr = $_POST['cena_pr'];
  $datesale = $_POST['datesale'];
  $timedata = date("Y-m-d H:i:s");
  $result = mysqli_query($connect," UPDATE tickets SET cena_pr = '$cena_pr', status = '5', datesale = '$datesale', dataatime = '$timedata', saler = '$saler_fio', salerstatus = '2' WHERE nomerzb = '$nomerzb' ");
};
unset($_POST['go_sale']);?>

<meta http-equiv='Refresh' content='0; URL=sale_product.php'>


  <?php endif; ?>

<? else :

  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<?php endif; ?>
