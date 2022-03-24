<? include_once '../../../bd.php'; ?>
<?
  if (filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) $ip = $_SERVER['HTTP_CLIENT_IP'];
  elseif (filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else $ip = $_SERVER['REMOTE_ADDR'];
  if ($status > 0) {
    $data = $_POST;
    $code_tovar = trim($data['codetovar']);
    if (isset($data['data'])) {
      $user = R::dispense('sales');
      $user->ip = $ip;
      $user->data = $data['data'];
      $user->fio = $fio;
      $user->region = $region;
      $user->adress = $adress;
      $user->codetovar = $data['codetovar'];
      $user->tovarname = $data['tovarname'];
      $user->summaprihod = $data['summaprihod'];
      for ($i = 1; $i <= $data["count_payment"]; $i++) {
        $payment = R::load('payment', $data['vid' . $i]);
        $user['summareal' . $i] = $data['summareal' . $i];
        $user['vid' . $i] = $payment['bank'] . '|' . $payment['payment'];
        $vid .= $i . ')' . $payment['bank'] . '|' . $payment['payment'] . "\n";
        $summareal += $data['summareal' . $i];
        $remainder += $data['summareal' . $i] - ($data['summareal' . $i] / 100 * $payment['percent']);
      };
      $user->summareal =  intval($summareal);
      $user->remainder =  intval($remainder);
      $user->pribl = $user->summareal - $user->summaprihod;
      $user->vid = $vid;
      $user->saler = $data['saler'];
      $user->pokupatel = $data['pokupatel'];
      $user->summazaden = $data['summazaden'];
      $user->reg_date = date("Y-m-d H:i:s");
      if (preg_match("/-/i", $code_tovar)) {
        $user->fromtovar = '2';
        $_SESSION['message'] = "Товар добавлен как с комиссионного магазина! Статус товара: " . $statuszb;
      } else {
        $user->fromtovar = '1';
        $_SESSION['message'] = "Товар добавлен как с ломбарда!";
      }
      $user->regionlombard = $data['regionlombard'];
      $user->adresslombard = $data['adresslombard'];
      R::store($user);
      $_SESSION['message_status'] = "2";
    }
} else {

  $_SESSION['message'] = 'Товар не добвален, попробуйте еще раз';
};
header('Location:../index.php'); 
?>
