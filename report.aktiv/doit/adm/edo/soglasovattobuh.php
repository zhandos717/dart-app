<?
include("../../../bd.php");
$data = $_POST;
$otkovo = $_SESSION['logged_user']->login;
if ($_SESSION['logged_user']->status == 3) {

$id = $_POST['id'];

  if(!empty($_FILES)){

    $todays = date("YmdHis");
  function upload_image_zhk($file,$todays){
   $upload_dir = '../../../docs/'; // Путь куда загружаем файл

  for ($i = 0; $i < count($file['file']['name']); $i++) {


     $accepted_formate = ['jpg', 'jpeg', 'JPG', 'JPEG','JPEG 2000', 'PNG', 'png', 'GIF', 'gif', 'bmp', 'BMP','tiff','TIFF','xlsx','xls','xlsm','xltx','xltm','xlam','doc','docx','dot','pdf','rtf','pptx']; // Массив расширении файлов
     $file_extension = pathinfo($file['file']['name'][$i], PATHINFO_EXTENSION); // Достаем расширение файла

   if(in_array(pathinfo($file['file']['name'][$i], PATHINFO_EXTENSION), $accepted_formate)){
     $name = $i.$todays.'.'. $file_extension;

     $file_name = $upload_dir . $name;//Создаем новое имя во избежание затирания файла
     move_uploaded_file($file['file']['tmp_name'][$i], $file_name); // Загружаем файл в нашу директорию
     $files_name .= $name.' '; // Создаем строку именами файлов
     }else{
       // $files_name .= 'Формат файла не подходит'; // Возвращаем ошибку
        $files_name .= 'NULL'; // Возвращаем ошибку
     }
   }
   return $files_name;
  }

         $file_name = upload_image_zhk($_FILES,$todays);

         $resultupd = mysqli_query($connect, "UPDATE sluzhebki SET statusz = 2 WHERE id = '$id'");


         $user = R::dispense('sluzhebki');
         $user->otkovo = $otkovo;
         $user->komu = $data['komu'];
         $user->tema = $data['tema'];
         $user->text_sms = $data['text_sms'];
         $user->files = $file_name;
         $user->statusread = 0;
         $user->statusz = 2;
         $user->date = date("Y-m-d");
         $user->time = date("H:i:s");
         R::store($user);
         header('Location: /doit/adm/edo/');

       }
       else{

         $resultupd = mysqli_query($connect, "UPDATE sluzhebki SET statusz = 2 WHERE id = '$id'");

$user = R::dispense('sluzhebki');
$user->otkovo = $otkovo;
$user->komu = $data['komu'];
$user->tema = $data['tema'];
$user->text_sms = $data['text_sms'];
$user->files = $data['files'];;
$user->statusread = 0;
$user->statusz = 2;
$user->date = date("Y-m-d");
$user->time = date("H:i:s");
R::store($user);
header('Location: /doit/adm/edo/');
              }
}
?>
