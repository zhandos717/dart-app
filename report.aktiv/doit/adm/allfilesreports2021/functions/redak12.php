<? include("../../../../bd.php");

if ($_SESSION['logged_user']->status == 3) :


  // echo '<pre>';
  // var_dump($_POST);
  // echo '</pre>';
  // exit;

  $report = R::load('reports122021',  $_POST['id']);

  $report->data = $_POST['data'];
  $report->dl = $_POST['dl'];
  $report->dm = $_POST['dm'];
  $report->dop = $_POST['dop'];
  // $report->stabrashod = $_POST['stabrashod'];
  // $report->tekrashod = $_POST['tekrashod'];
  $report->allclients = $_POST['allclients'];
  $report->newclients = $_POST['newclients'];
  $report->dohod = $report->dl + $report->dm + $report->dop;
  $report->vzs = $_POST['vzs'];
  $report->vozvrat = $_POST['vozvrat'];
  $report->nakladnoy = $_POST['nakladnoy'];
  $report->reg_date = $_POST['reg_date'];

  $report->chv = $report->vzs - $report->vozvrat - $report->nakladnoy;

  $report->auktech = $_POST['auktech'];
  $report->aukshubs = $_POST['aukshubs'];
  $report->nalvzaloge = $_POST['nalvzaloge'];
  // $report->comment = $_POST['comment'];
  $report->dk = $_POST['dk'];
  if(isset($_POST['delete'])){
    R::trash($report); //for one bean
  }else{
    R::store($report);
  }
endif;

header('Location: https://report.aktiv-market.kz/doit/adm/allfilesreports2021/viewfilial12.php?region='.$report->region.'&adress='.$report->adress)

?>
