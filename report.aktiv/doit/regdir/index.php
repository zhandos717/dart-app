<? //проверка существовании сессии			
include("../../bd.php");
if ($_SESSION['logged_user']->status == 2) :
    include "header.php";
    include "menu.php"; 
    include "body.php"; 
    include "footer.php"; 
    else : 
endif; ?>