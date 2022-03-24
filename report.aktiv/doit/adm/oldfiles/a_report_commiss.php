<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
$active = 'active';
  $id_page = $_GET['id'];


    $data1 = $_POST['date1'];
    $data2 = $_POST['date2'];
    include "header.php";


      switch ($id_page):
        case 1:
              include "menu.php";
          include "report_commiss/accses/region_report.php";
        break;
        case 2:
              include "menu.php";
          include "report_commiss/b_report.php";
        break;
        case 3:
              include "menu.php";
          include "report_commiss/с_report.php";
        break;
        case 4:
              include "menu.php";
          include "report_commiss/new_report.php";
        break;
        case 5:
          $comis_active = 'active';
              include "menu.php";
          include "report_commiss/q_report.php";
        break;
        case 6:
              include "menu.php";
          include "report_commiss/b_report.php";
        break;
        case 7:
            $comis_shop = 'active';
            include "menu.php";
          include 'stock_analysis.php'; //"report_commiss/w_report.php";
        break;
        case 9:
            $comis_shop = 'active';
              include "menu.php";
          include "report_commiss/price_list.php";
        break;
        case 10:
             $comis_active = 'active';
              include "menu.php";
          include "report_commiss/report_x.php"; 
        break;
        default: include "report_commiss/info_sale.php";  break;
      endswitch;

  include "footer.php";
  else :
    header('Location: /');
  endif; ?>