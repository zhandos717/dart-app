<?
include ("../../bd.php");
if ( isset($_SESSION['logged_user']) && $_SESSION['logged_user']->status ==14) : 
  include "app/header.php";
  include "pages/report.php";
  include "app/footer.php";
  else:?>
<meta http-equiv='Refresh' content='0; URL=/'>
<? endif; ?>
