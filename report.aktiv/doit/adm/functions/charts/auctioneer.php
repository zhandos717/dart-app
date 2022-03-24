<? include_once "../../../../bd.php";
header('Content-Type: application/json');
$variable = R::findAll('totalyear');
$i = 1;
foreach ($variable as $value) {
  $data[]  = ['m'=> '2020-'.$i++, 'auktech'=> $value['auktech'], 'aukshubs'=> $value['aukshubs']];
}; 
echo json_encode($data);?>