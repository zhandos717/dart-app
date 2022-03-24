<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../../../../bd.php");
if ($_SESSION['logged_user']->status == 3) :


  $report = R::load('reports012022',  $_POST['id']);

  $report['data'] = $_POST['data'];
  $report['dl'] = (int)$_POST['dl'];
  $report->dm = (int)$_POST['dm'];
  $report['dop'] = (int)$_POST['dop'];
  /*$report->stabrashod = $_POST['stabrashod'];
  $report->tekrashod = $_POST['tekrashod'];
  */$report->allclients = $_POST['allclients'];
  $report->newclients = $_POST['newclients'];
  $report['dohod'] = (int) $report['dl'] + (int) $report['dm'] + (int) $report['dop'];
  $report->vzs = $_POST['vzs'];
  $report->vozvrat = $_POST['vozvrat'];
  $report->nakladnoy = $_POST['nakladnoy'];
  $report->reg_date = $_POST['reg_date'];

  $report->chv = $report->vzs - $report->vozvrat - $report->nakladnoy;

  $report->auktech = $_POST['auktech'];
  $report->aukshubs = $_POST['aukshubs'];
  $report->nalvzaloge = $_POST['nalvzaloge'];
  $report->comment = $_POST['comment'];
 // $report->dk = $_POST['dk'];

	if(!empty($_POST['delete'])){
		R::trash($report); //for one bean
	}else{
		R::store($report);
	}

  header('Location: ../viewfilial01.php?region=' .$report->region. '&adress=' .$report->adress);

endif;


?>
