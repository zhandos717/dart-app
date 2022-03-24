<? //проверка существовании сессии
include("../../bd.php");

if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 10) :
 	$active1 = 'active';
  $id_page = $_GET['id'];
  $active_report_com = 'active';

    include "header.php";
     include "menu.php";

     if($id_page == 1 ){
      include "sklad/b_report.php";

  }elseif($id_page == 2) {
      include "sklad/info_sale.php";
  }
  elseif($id_page == 3) {
      include "sklad/c_report.php";
  }
  elseif($id_page == 4) {
      include "sklad/d_report.php";
  }
  elseif($id_page == 5) {
      include "sklad/q_report.php";
  }
   elseif($id_page == 6) {
      include "sklad/w_report.php";
  }
  include "footer.php";
  endif;
  else :
?>

<meta http-equiv='Refresh' content='0; URL=/report/'>

<?php endif; ?>
