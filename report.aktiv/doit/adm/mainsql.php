<?
$table = 'reports';

function percent($number, $percent)
{
  return $number - ($number / 100 * $percent);
}


$result = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table ");
$data = $result[0];
$pr = $data['SUM(dohod)'] - $data['SUM(stabrashod)'] - $data['SUM(tekrashod)'];
$chistaya = percent($pr, 20);
$fil = R::findAll($table, " GROUP BY adress");
foreach ($fil as $value) {
  $fil = R::findOne($table, 'adress = ? ORDER BY data DESC', [$value['adress']]);
  $auktech += $fil['auktech'];
  $aukshuba += $fil['aukshubs'];
  $nalvzaloge += $fil['nalvzaloge'];
}


?>
