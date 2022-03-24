<?include("../../bd.php");
 if ($_SESSION['logged_user']->status == 11) :

$id_page = $_GET['id'];


switch ($id_page) {
    case 1:
        $active1 = 'active';
        include "app/header.php";
        include "app/menu.php";
        include "sklad/b_report.php";
        include "app/footer.php";
        break;
     case 2:
        $active1 = 'active';
         include "header.php";
        include "menu.php";
          include "sklad/info_sale.php";
          include "footer.php";
        break;
     case 3:
        $active1 = 'active';
         include "app/header.php";
        include "app/menu.php";
       include "sklad/c_report.php";
         include "footer.php";
        break;
     case 4:
        $active1 = 'active';
         include "app/header.php";
        include "app/menu.php";
        include "sklad/d_report.php";
          include "footer.php";
        break;
     case 5:
        $active1 = 'active';
         include "app/header.php";
        include "app/menu.php";
        include "sklad/q_report.php";
          include "footer.php";
        break;
    default:
      include "header.php";
      include "menu.php";
      include 'shop_cc.php';
      include "footer.php";
      break;
}

else :
header('Location: ../../index.php');
endif; ?>