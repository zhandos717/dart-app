<? //проверка существовании сессии
include("../../../../bd.php");

  if ($_SESSION['logged_user']->status == 3) :



    if(!empty($_POST['table'])){

         if(isset($_POST['go_update'])){

      $update = R::load($_POST['table'], $_POST['go_update']);
      $update->data =         $_POST['data'];
      $update->codetovar =    $_POST['codetovar'];
      $update->tovarname =    $_POST['tovarname'];
      $update->summaprihod =  $_POST['summaprihod'];
      $update->predoplata =   $_POST['predoplata'];
      $update->summareal =    $_POST['summareal'];
      $update->pribl =        $_POST['pribl'];
      $update->vid =          $_POST['vid'];
      $update->saler =        $_POST['saler'];
      $update->pokupatel =    $_POST['pokupatel'];
      $update->summazaden =   $_POST['summazaden'];
     // $update->summakredit = $_POST['summakredit'];
      R::store($update);

      $_SESSION['message'] = 'Данные обновлены!';
      header("Location: ../{$_POST['back']}.php?region=$update->region&shop=$update->adress&data_z=$update->data&from=$update->fromtovar");
      }
     // var_dump($update);
       if(isset($_POST['go_delete'])){
      $update = R::load($_POST['table'], $_POST['go_delete']);
      $update->statustovar = '3';
      R::store($update);
      $_SESSION['message'] = 'Продажа помещена в корзину!';
      header("Location: ../{$_POST['back']}.php?region=$update->region&shop=$update->adress&data_z=$update->data&from=$update->fromtovar");
      }

    }else {

   if(isset($_POST['go_update'])){

      $update = R::load('sales12', $_POST['go_update']);
      $update->data =         $_POST['data'];
      $update->codetovar =    $_POST['codetovar'];
      $update->tovarname =    $_POST['tovarname'];
      $update->summaprihod =  $_POST['summaprihod'];
      $update->predoplata =   $_POST['predoplata'];
      $update->summareal =    $_POST['summareal'];
      $update->pribl =        $_POST['pribl'];
      $update->vid =          $_POST['vid'];
      $update->saler =        $_POST['saler'];
      $update->pokupatel =    $_POST['pokupatel'];
      $update->summazaden =   $_POST['summazaden'];
     // $update->summakredit = $_POST['summakredit'];
      R::store($update);

      $_SESSION['message'] = 'Данные обновлены!';
      header("Location: ../detail12.php?region=$update->region&shop=$update->adress&data_z=$update->data&from=$update->fromtovar");
      }
     // var_dump($update);
       if(isset($_POST['go_delete'])){
      $update = R::load('sales12', $_POST['go_delete']);
        $update->statustovar = '3';

      R::store($update);
      $_SESSION['message'] = 'Продажа помещена в корзину!';
      header("Location: ../detail12.php?region=$update->region&shop=$update->adress&data_z=$update->data&from=$update->fromtovar");
      }
    }



  else :
   header("Location: report/");
 endif; ?>
