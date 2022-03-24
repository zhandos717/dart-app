<?

$table3 = 'reports032021';
$result_p = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                                      SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from $table3  ");
$data_p = mysqli_fetch_array($result_p);

$pr = $data_p['SUM(dohod)'] - $data_p['SUM(stabrashod)'] - $data_p['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
$chistaya3 = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов

$result = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                  FROM $table3  GROUP BY region  ");
$auktech3 = 0;
$aukshuba3 = 0;
$nalvzaloge3 = 0;
while ($data1 = mysqli_fetch_array($result)) {

  $region =  $data1['region'];

  $result4 = mysqli_query($connect, "SELECT *FROM $table3 WHERE region='$region' GROUP BY adress ");

  $s = 0;
  $s2 = 0;
  $s3 = 0;

  while ($data4 = mysqli_fetch_array($result4)) {
    $filial =  $data4['adress'];
    $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM $table3 WHERE segdata=(SELECT MAX(segdata) FROM $table3 WHERE region = '$region' AND adress = '$filial' ) ");
    $data5 = mysqli_fetch_array($result5);

    $s += $data5['auktech'];
    $s2 += $data5['aukshubs'];
    $s3 += $data5['nalvzaloge'];
  }

  $auktech3 += $s;   //аукц т
  $aukshuba3 += $s2; //ауц шубы
  $nalvzaloge3 += $s3;  //нал в залоге

}

/* -----------------------------------------------------------*/

$table4 = 'reports042021';
$result_p = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),
                                      SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv) from $table4  ");
$data_p = mysqli_fetch_array($result_p);

$pr = $data_p['SUM(dohod)'] - $data_p['SUM(stabrashod)'] - $data_p['SUM(tekrashod)'];    //прибыль = доход - стабиль расх - тек расх
$chistaya4 = $pr - ($pr * 20) / 100;                                                     // чистая прибыль  = за минусом 20 процентов

$result = mysqli_query($connect, " SELECT id, region, SUM(dl),SUM(dm),SUM(dop), SUM(dohod),SUM(stabrashod),SUM(tekrashod),SUM(allclients),SUM(newclients),SUM(vzs),SUM(vozvrat),SUM(nakladnoy),COUNT(adress),SUM(chv)
                                  FROM $table4  GROUP BY region  ");
$auktech4 = 0;
$aukshuba4 = 0;
$nalvzaloge4 = 0;
while ($data1 = mysqli_fetch_array($result)) {

  $region =  $data1['region'];

  $result4 = mysqli_query($connect, "SELECT *FROM $table4 WHERE region='$region' GROUP BY adress ");

  $s = 0;
  $s2 = 0;
  $s3 = 0;

  while ($data4 = mysqli_fetch_array($result4)) {
    $filial =  $data4['adress'];
    $result5 = mysqli_query($connect, " SELECT auktech,aukshubs,nalvzaloge FROM $table4 WHERE segdata=(SELECT MAX(segdata) FROM $table4 WHERE region = '$region' AND adress = '$filial' ) ");
    $data5 = mysqli_fetch_array($result5);

    $s += $data5['auktech'];
    $s2 += $data5['aukshubs'];
    $s3 += $data5['nalvzaloge'];
  }

  $auktech4 += $s;   //аукц т
  $aukshuba4 += $s2; //ауц шубы
  $nalvzaloge4 += $s3;  //нал в залоге

}


/* -----------------------------------------------------------*/

$table5 = 'reports052021';

$result5 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table5 ");
$data5 = $result5[0];
$pr5 = $data5['SUM(dohod)'] - $data5['SUM(stabrashod)'] - $data5['SUM(tekrashod)'];
$chistaya5 = $pr5 - ($pr5 * 20) / 100;

$fil5 = R::findAll($table5, " GROUP BY adress");
foreach ($fil5 as $value5) {
  $fil5 = R::findOne($table5, 'adress = ? ORDER BY data DESC', [$value5['adress']]);
  $auktech5 += $fil5['auktech'];
  $aukshuba5 += $fil5['aukshubs'];
  $nalvzaloge5 += $fil5['nalvzaloge'];
}


/* -----------------------------------------------------------*/

$table6 = 'reports062021';

$result6 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table6 ");
$data6 = $result6[0];
$pr6 = $data6['SUM(dohod)'] - $data6['SUM(stabrashod)'] - $data6['SUM(tekrashod)'];
$chistaya6 = $pr6 - ($pr6 * 20) / 100;

$fil6 = R::findAll($table6, " GROUP BY adress");
foreach ($fil6 as $value6) {
  $fil6 = R::findOne($table6, 'adress = ? ORDER BY data DESC', [$value6['adress']]);
  $auktech6 += $fil6['auktech'];
  $aukshuba6 += $fil6['aukshubs'];
  $nalvzaloge6 += $fil6['nalvzaloge'];
}


/* ----------------------------------------------------------- */

$table7 = 'reports072021';

$result7 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table7 ");
$data7 = $result7[0];
$pr7 = $data7['SUM(dohod)'] - $data7['SUM(stabrashod)'] - $data7['SUM(tekrashod)'];
$chistaya7 = $pr7 - ($pr7 * 20) / 100;

$fil7 = R::findAll($table7, " GROUP BY adress");
foreach ($fil7 as $value7) {
  $fil7 = R::findOne($table7, 'adress = ? ORDER BY data DESC', [$value7['adress']]);
  $auktech7 += $fil7['auktech'];
  $aukshuba7 += $fil7['aukshubs'];
  $nalvzaloge7 += $fil7['nalvzaloge'];
}


/* ----------------------------------------------------------- */

$table8 = 'reports082021';

$result8 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table8 ");
$data8 = $result8[0];
$pr8 = $data8['SUM(dohod)'] - $data8['SUM(stabrashod)'] - $data8['SUM(tekrashod)'];
$chistaya8 = $pr8 - ($pr8 * 20) / 100;

$fil8 = R::findAll($table8, " GROUP BY adress");
foreach ($fil8 as $value8) {
  $fil8 = R::findOne($table8, 'adress = ? ORDER BY data DESC', [$value8['adress']]);
  $auktech8 += $fil8['auktech'];
  $aukshuba8 += $fil8['aukshubs'];
  $nalvzaloge8 += $fil8['nalvzaloge'];
}


/* ----------------------------------------------------------- */

$table9 = 'reports092021';

$result9 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table9 ");
$data9 = $result9[0];
$pr9 = $data9['SUM(dohod)'] - $data9['SUM(stabrashod)'] - $data9['SUM(tekrashod)'];
$chistaya9 = $pr9 - ($pr9 * 20) / 100;

$fil9 = R::findAll($table9, " GROUP BY adress");
foreach ($fil9 as $value9) {
  $fil9 = R::findOne($table9, 'adress = ? ORDER BY data DESC', [$value9['adress']]);
  $auktech9 += $fil9['auktech'];
  $aukshuba9 += $fil9['aukshubs'];
  $nalvzaloge9 += $fil9['nalvzaloge'];
}

/* ----------------------------------------------------------- */

$table10 = 'reports102021';

$result10 = R::getAll("SELECT SUM(dl),SUM(dohod),SUM(dop),SUM(stabrashod),SUM(tekrashod) FROM $table9 ");
$data10 = $result10[0];
$pr10 = $data9['SUM(dohod)'] - $data10['SUM(stabrashod)'] - $data10['SUM(tekrashod)'];
$chistaya10 = $pr10 - ($pr10 * 20) / 100;

$fil10 = R::findAll($table10, " GROUP BY adress");
foreach ($fil10 as $value10) {
  $fil10 = R::findOne($table10, 'adress = ? ORDER BY data DESC', [$value10['adress']]);
  $auktech10 += $fil10['auktech'];
  $aukshuba10 += $fil10['aukshubs'];
  $nalvzaloge10 += $fil10['nalvzaloge'];
}



?>
