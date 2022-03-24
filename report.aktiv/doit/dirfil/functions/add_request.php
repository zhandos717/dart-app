<?//проверка существовании сессии
include ("../../../bd.php");

  $data = $_POST;

  if($data['eo']) {
      $user = R::dispense('users');
      $user->eo = $data['eo'];
      $user->root  = $data['root'];
      $user->status   = 0;
      $user->timework = $data['timework'];
      $user->doverennost = $data['doverennost'];
      $user->phone = $data['tel'];
      $user->region = $data['region'];
      $user->adressfil = $data['adressfil'];
      $user->kassa = $data['kassa'];
      $user->datareg = date('Y-m-d');
      R::store($user);

      $request = R::dispense('addrequest');
      $request->name = 'Регистрация сотрудника в комиссионном магазине';
      $request->eo = $data['eo'];
      $request->datareg = date('Y-m-d');
      $request->dataregtime = date('Y-m-d H:i:s');
      $request->region = $data['region'];
      $request->adress = $data['adressfil'];
      $request->user = $_SESSION['logged_user']->fio;
      R::store($request);

      $_SESSION['message'] = 'Завка успешно зарегистрирована!';
      echo '<meta http-equiv="Refresh" content="0; URL=../feedback.php">';
  };

?>
