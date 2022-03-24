<?php

include ("../../../bd.php");

  $data = $_POST;

  if($data['token'] == '65465465') {

      $file = $_FILES;
      $path = '../../uploads/fin'.$file['file']['name'];// Папка заливки данных
      move_uploaded_file($file['file']["tmp_name"],$path);
      if(!move_uploaded_file($file['file']["tmp_name"],$path)){
         $errors[] = 'При загрузке произошла ошибка';
      };
      $href = '../uploads/fin'.$file['file']['name'];// путь до файла
      $torgi = R::dispense('torgitable');
      $torgi->datetorg = $data['date_torg'];
      $torgi->summatorg = $data['summa_torg'];
      $torgi->comment = $data['text'];
      $torgi->status = 1;
      $torgi->koltorg = $data['kol_torg'];
      $torgi->datareg = date('Y-m-d');
      $torgi->timereg = date('H:i:s');
      $torgi->file = '../uploads/fin'.$file['file']['name']; // путь до файла
      $torgi->filename = $file['file']['name'];
      $torgi->filesize = $file['file']['size'];
      $torgi->filetype = $file['file']['type'];
      $torgi->user = $_SESSION['logged_user']->fio;
      R::store($torgi);

      if( empty($errors) ){
        $_SESSION['errors'] = array_shift($errors);
        echo '<meta http-equiv="Refresh" content="0; URL=../report_fin.php">';

      }else {
        $_SESSION['message'] = 'Запись успешно добавлена!';
        echo '<meta http-equiv="Refresh" content="0; URL=../report_fin.php">';
      };

    }
    elseif ($data['idupd']) {

      $file = $_FILES;
      $path = '../../uploads/'.'fin'.$file['file']['name']; // Папка заливки данных
      move_uploaded_file($file['file']["tmp_name"],$path);
      if(!move_uploaded_file($file['file']["tmp_name"],$path)){
         $errors[] = 'При загрузке произошла ошибка';
      };
        $torgi = R::load('torgitable',$data['idupd']);
        $torgi->datetorg = $data['date_torg'];
        $torgi->summatorg = $data['summa_torg'];
        $torgi->comment = $data['text'];
        $torgi->koltorg = $data['kol_torg'];
        $torgi->dataupd = date('Y-m-d');
        $torgi->timeupd = date('H:i:s');
        if($file['file']['name']){
          $torgi->file = '../uploads/fin'.$file['file']['name']; // путь до файла
          $torgi->filename = $file['file']['name'];
          $torgi->filesize = $file['file']['size'];
          $torgi->filetype = $file['file']['type'];
        }
        $torgi->user = $_SESSION['logged_user']->fio;
        R::store($torgi);

        if( empty($errors) ){
          $_SESSION['errors'] = array_shift($errors);
          echo '<meta http-equiv="Refresh" content="0; URL=../report_fin.php">';

        }else {
          $_SESSION['message'] = 'Запись успешно добавлена!';
          echo '<meta http-equiv="Refresh" content="0; URL=../report_fin.php">';
        };

      }

      elseif ($_GET['iddeleted']){
        $torgi = R::load('torgitable',$_GET['iddeleted']);
        $torgi->status = 3;
        R::store($torgi);
        $_SESSION['message'] = 'Запись удалена!';
        echo '<meta http-equiv="Refresh" content="0; URL=../report_fin.php">';
      };
  ?>
