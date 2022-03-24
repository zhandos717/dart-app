<?php
  include("../../../bd.php");

  // ob_start();
  // var_dump($_POST);
  // $test = ob_get_clean();
  // file_put_contents('test1.txt', $test,FILE_APPEND);

if(!empty($_POST['idx'])){

            $file = $_FILES;
            $path = '../../uploads/com'.$file['file']['name'];// Папка заливки данных
            move_uploaded_file($file['file']["tmp_name"],$path);
            if(!move_uploaded_file($file['file']["tmp_name"],$path)){
              $errors[] = 'При загрузке произошла ошибка';
            };


           $tickets = R::load('tickets',$_POST['idx']);
           $tickets->status = $_POST['status'];
           R::store($tickets);
        
           $href = '../../uploads/com'.$file['file']['name'];// путь до файла

           $withdrawal = R::dispense('withdrawal');
           $withdrawal->nomerzb = $tickets['nomerzb'];
           $withdrawal->status = $_POST['status'];
           $withdrawal->message = $_POST['comment'];
           $withdrawal->user = $_SESSION['logged_user']->fio;
           $withdrawal->datetime = date('Y-m-d H:i:s');
           $withdrawal->datereg = date('Y-m-d');
           if($file['file']['type'] == 'application/pdf'){
            $withdrawal->file = '../uploads/com'.$file['file']['name']; // путь до файла
            $withdrawal->filename = $file['file']['name'];
            $withdrawal->filesize = $file['file']['size'];
            $withdrawal->filetype = $file['file']['type'];
          }else{
            $coment = '<span style="color:red;">Но файл не загружен! Нужен PDF файл!</span>';
          }
          
           R::store($withdrawal);
           $_SESSION['message'] = 'Статус успешно изменен!'.$coment;
           $_SESSION['nomerzb'] = $tickets['nomerzb'];

           echo "<meta http-equiv='Refresh' content='0; URL=../update_ticket.php'>";
       
       };?>
<!-- 39-89 -222 --> 
