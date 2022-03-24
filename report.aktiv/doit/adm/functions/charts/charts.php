<? include_once "../../../../bd.php";
header('Content-Type: application/json');
$variable = R::findAll('totalyear');


switch ($_REQUEST['data']) {
 case 'lombard':
  foreach ($variable as $value) {
      $data[]  = ['m'=>$value['year'].'-'.$value['mounth'],'auk'=> ($value['aukshubs'] + $value['auktech']), 'nalvzaloge'=> $value['nalvzaloge']];
    }; 
  break;
  case 'auctioneer':

    foreach ($variable as $value) {
  $data[]  = ['m'=>$value['year'].'-'.$value['mounth'],  'aukshubs'=> $value['aukshubs'],'auktech'=> $value['auktech']];
}; 
  break;
  case 'clients':
 
    foreach ($variable as $value) {
    $data[]  = ['m'=>$value['year'].'-'.$value['mounth'],  'allclients'=> $value['allclients'],'newclients'=> $value['newclients']];
      }; 
  break;
  case 'shop':
    $result = R::findAll('totalyear','dm > 0');
    $i =3;
    foreach ($result as $value) {$data[] = ['m'=> $value['year'].'-'.$i++,  'dm'=> $value['dm']]; }; 
  break;

  default:

  break;
 }

echo json_encode($data);?>