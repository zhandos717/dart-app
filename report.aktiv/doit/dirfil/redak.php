<? //проверка существовании сессии
include("../../bd.php");
if ($status == 1) :
  
$report = R::load('reports',  $_POST['id']);
    $report->data = $_POST['data'];
    $report->dl = $_POST['dl'];
    $report->dm = $_POST['dm'];
    $report->dop = $_POST['dop'];
    $report->stabrashod = $_POST['stabrashod'];
    $report->tekrashod = $_POST['tekrashod'];
    $report->allclients = $_POST['allclients'];
    $report->newclients = $_POST['newclients'];
    $report->dohod = $report->dl + $report->dm + $report->dop;
    $report->vzs = $_POST['vzs'];
    $report->vozvrat = $_POST['vozvrat'];
    $report->nakladnoy = $_POST['nakladnoy'];

    $report->chv = $report->vzs - $report->vozvrat - $report->nakladnoy;

    $report->auktech = $_POST['auktech'];
    $report->aukshubs = $_POST['aukshubs'];
    $report->nalvzaloge = $_POST['nalvzaloge'];
    $report->comment = $_POST['comment'];
    $report->dk = $_POST['dk'];
R::store($report);
 header('Location:./viewmyreports.php?month=5');
else :
header('Location: /');
//var_dump($_SESSION);
endif;?>
