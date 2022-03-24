<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status) :
include "../help_desc/pages/header.php"; 
include "menu.php"; 
switch ($page) {
case 'read':
    include "../help_desc/read-mail.php"; 
    break;
default:
    include "../help_desc/home.php"; 
    break;
}
include "../help_desc/pages/footer.php"; 
else :
header('Location: /');
endif;
