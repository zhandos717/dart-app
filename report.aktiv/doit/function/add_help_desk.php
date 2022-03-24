<? include '../../bd.php';

$data = $_POST;

if($region){
  if ($data['department']) {
    $applications = R::dispense('applications');
    $applications->department  = $data['department'];
    $applications->phone  = $data['phone'];
    $applications->subject  = $data['subject'];
    $message = $data['message'];
    $message .= "\n Регистрация сотрудника: {$data['eo']}. \n";
    $message .= "В городе: {$data['region']}. \n";
    $message .= "В филиале: {$data['adressfil']}. \n";
    $message .= "Отправил: $fio. \n";
    $applications->message  = $message;
    $applications->note  = 'Пусто';
    $applications->status  = 'Сформирован';
    $applications->user = $fio;
    R::store($applications);
    
    if ($data['eo']) {
      $user = R::dispense('users');
      $user->eo = $data['eo'];
      $user->root  = $data['root'];
      $user->timework = $data['timework'];
      $user->doverennost = $data['doverennost'];
      $user->phone = $data['tel'];
      $user->region = $data['region'];
      $user->adressfil = $data['adressfil'];
      $user->kassa = $data['kassa'];
      $user->datareg = date('Y-m-d H:i:s');
      R::store($user);
    };
  };
}

var_dump($_POST);

