<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 9) :

include "header.php";

switch ($_GET['id']) {
case 1:
$buh_active= 'active';
include "menu.php";
include "sklad/b_report.php";
include 'footer.php';
break;
case 2:
    include "menu.php";
include "sklad/info_sale.php";
include 'footer.php';
break;
case 22:
    $comis_shop = 'active';
    include "menu.php";
include "sklad/info_sale_test.php";
include 'footer.php';
break;
case 3:include "menu.php";
include "sklad/c_report.php";
include 'footer.php';
break;
case 4:include "menu.php";
include "sklad/d_report.php";
include 'footer.php';
break;
case 5:
    include "menu.php";
include "report_commiss/e_report.php";
include 'footer.php';
break;
case 6:
    include "menu.php";
include "report_commiss/x_report.php";
include 'footer.php';
break;
case 7:
    include "menu.php";
include "report_commiss/x_report.php";
include 'footer.php';
break;

case 8:
    include "menu.php";
include "report_commiss/charts.php";
include 'footer.php';
break;

case 9:
     $comis_active = 'active';
include "menu.php";
    include "sklad/commis.php"; 
    include 'footer.php';
break;

default:
include "sklad/b_report.php";
include 'footer.php';
break;
}

else:
header('Location: ../../index.php');
endif; ?>