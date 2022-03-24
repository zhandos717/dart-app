<?//проверка существовании сессии
include ("../../../bd.php");

  $data = $_POST;
  $file = $_FILES;

  $id = $data['id'];
  $id = (int)$id;

  ob_start();
  var_dump($_FILES);
  $test = ob_get_clean();
  file_put_contents('test.txt', $test,FILE_APPEND);

  if($data['token'] == '65465465') {

      if(!empty($file['file']['name'])){
        if ($file['picture']['type'] == 'application/pdf') {
        $href = 'imgtovar/'.date('H:i:s').$file['file']['name'];// путь до файла
        $path = '../'.$href;// Папка заливки данных
        move_uploaded_file($file['file']["tmp_name"],$path);
        if(!move_uploaded_file($file['file']["tmp_name"],$path)){
           $errors[] = 'При загрузке произошла ошибка';
        };
        $kosyak = R::load('kosyak',$id);
        $kosyak->datareg = date('Y-m-d');
        $kosyak->timereg = date('H:i:s');
        $kosyak->file = $href;
        $kosyak->status = '2';
        $kosyak->filename = $file['file']['name'];
        $kosyak->filesize = $file['file']['size'];
        $kosyak->filetype = $file['file']['type'];
        $kosyak->user = $_SESSION['logged_user']->fio;
        R::store($kosyak);
      }
      }else {
        $_SESSION['errors'] = 'Файл не выбран!';
        echo '<meta http-equiv="Refresh" content="0; URL=../redact.php">';
      };

      if( empty($errors) ){
        $_SESSION['errors'] = 'Файл не выбран!';
        echo '<meta http-equiv="Refresh" content="0; URL=../viewmyreports05.php">';

      }else {
        $_SESSION['message'] = 'Операция прошла успешно!';
        echo '<meta http-equiv="Refresh" content="0; URL=../viewmyreports05.php">';
      };

    }
    ?>
