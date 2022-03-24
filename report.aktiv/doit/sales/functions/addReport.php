<? include_once '../../../bd.php';
if ($status > 0) {
  $data = $_POST;
  if (isset($data['codetovar'])) {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
    if (filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif (filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;
    $code_tovar = trim($_POST['codetovar']);

      $user = R::dispense('sales');
      $user->ip = $ip;
      $user->data = $data['data'];
      $user->fio = $fio;
      $user->region = $region;
      $user->adress = $adress;
      $user->codetovar = $code_tovar;
      $user->tovarname = $data['tovarname'];
      $user->summaprihod = $data['summaprihod'];
      //		$user->summakredit=$data['summakredit'];
      $user->predoplata = $data['predoplata'];
      $user->summareal = $data['summareal'];
      $user->pribl = $user->summareal - $user->summaprihod;
      $user->vid = $data['vid'];
      $user->saler = $data['saler'];
      $user->pokupatel = $data['pokupatel'];
      $user->summazaden = $data['summazaden'];
      $user->reg_date = date("d-m-Y в H:i");
      $user->reg_date2 = date("d-m-Y");
      $user->reg_date3 = date("H:i");

    if (preg_match("/-/i", $code_tovar)) {
      $user->fromtovar = 2;
      echo "Товар добавлен как с комиссионного магазина!";
    }else{
      $user->fromtovar = 1;
      echo "Товар добавлен как с ломбарда магазина!";
    }
      $user->regionlombard = $data['regionlombard'];
      $user->adresslombard = $data['adresslombard'];
      R::store($user);
    
  }
};
?>
