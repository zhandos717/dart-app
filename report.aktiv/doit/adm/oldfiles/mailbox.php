<? //проверка существовании сессии
include("../../bd.php");

  if ($_SESSION['logged_user']->status == 3) :
  $page = $_GET['page'];
  $INBOX = $_GET['INBOX'];
  include "../mailbox/header.php"; 
  include "menu.php"; 
  switch ($page) {
    case 'read':
      include "../mailbox/read-mail.php"; 
      break;
    case 'compose':
      include "../mailbox/compose.php"; 
      break;
    default:
      include "../mailbox/mailbox.php"; 
      break;
  }
include "../mailbox/footer.php"; 
else :
header('Location: ../../index.php');
endif; ?>