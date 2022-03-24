<? include("../../bd.php");
if ($_SESSION['logged_user']->status == 11) :
$active = 'active';
include "header.php"; 
include "app/menu.php";
include "commis/index.php"; 
include "footer.php"; 
else : 
header('Location: index.php');
endif; ?>
