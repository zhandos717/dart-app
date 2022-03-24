<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 5) :
 	$active = 'active';
  $id_page = $_GET['id'];
//  $active_report_com = 'active';
include "header.php";
include "menu.php";

include_once 'functions/notification.php';
switch ($id_page) {
    case 1:
        include "sklad/b_report.php";
    break;
       case 2:
         include "sklad/info_sale.php";
    break;
       case 3:
     include "sklad/c_report.php";
    break;
       case 4:
        include "sklad/d_report.php";
    break;
       case 5:
       include "sklad/q_report.php";
    break;
    case 7:
        include "reports/w_report.php";
    break;
    case 8:
        include "reports/accses_report.php";
    break;
    case 9:
        include "sklad/commis.php"; 
    break;
  }
  include "footer.php";
  else :
header('Location: /');
endif; ?>