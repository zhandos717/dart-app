<?//проверка существовании сессии
include ("../../../bd.php");

  $data = $_POST;
  $file = $_FILES;

  $id = $data['id'];

    if( isset($data['do_signup']) )
    {

      $href = 'imgtovar/'.date('H:i:s').$file['picture']['name'];// путь до файла
      $path = '../../kurators/'.$href;// Папка заливки данных
      move_uploaded_file($file['picture']["tmp_name"],$path);
      if(!move_uploaded_file($file['picture']["tmp_name"],$path)){
         $errors[] = 'При загрузке произошла ошибка';
      };

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;

  
        if(!empty($file['picture']['name'])){
            if ($file['picture']['type'] == 'application/pdf') {
              $user = R::dispense('kosyak');
                  $user->ip =$ip;
                  $user->region=$data['region'];
                  $user->adress=$data['adress'];
                  $user->data=$data['data'];
                  $user->codetovar=$data['codetovar'];
                  $user->pereoceka=$data['pereoceka'];
                  $user->comment=$data['comment'];
                  $user->fio = $_SESSION['logged_user']->fio;
                  $user->segdata = date("Y-m-d H:i:s");
                  $user->photo = $href;
              R::store($user);
              $_SESSION['message'] = 'Операция прошла успешно!';
              echo '<meta http-equiv="Refresh" content="0; URL=../slichved.php">';

            }else {
              $_SESSION['errors'] = 'Файл не выбран, либо формат файла на подходит.  Нужен PDF!';
              echo '<meta http-equiv="Refresh" content="0; URL=../slichved.php">';
            }
          }elseif (empty($file['picture']['name'])){
            $_SESSION['errors'] = 'Файл не выбран, либо формат файла на подходит.  Нужен PDF!';
            echo '<meta http-equiv="Refresh" content="0; URL=../slichved.php">';
          }elseif (empty($file['picture']['name'])){
            $_SESSION['errors'] = 'Файл не выбран, либо формат файла на подходит.  Нужен PDF!';
            echo '<meta http-equiv="Refresh" content="0; URL=../slichved.php">';
          }else {
            $_SESSION['message'] = 'Операция прошла успешно!';
            echo '<meta http-equiv="Refresh" content="0; URL=../slichved.php">';
          };

    }
    ?>
