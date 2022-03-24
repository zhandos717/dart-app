<?
include("../../../bd.php");
$data = $_POST;
$otkovo = $_SESSION['logged_user']->login;
if ($_SESSION['logged_user']->status == 5) {


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
      $files_name .= NULL; // Возвращаем ошибку
   }
 }
 return $files_name;
}

if(!empty($_FILES)){
       $file_name = upload_image_zhk($_FILES,$todays);
       }

$user = R::dispense('sluzhebki');
$user->otkovo = $otkovo;
$user->komu = $data['komu'];
$user->tema = $data['tema'];
$user->textSms = $data['textSms'];
$user->files = $file_name;
$user->statusread = 0;
$user->date = date("Y-m-d");
$user->time = date("H:i:s");
R::store($user);
header('Location: /doit/sales/edo/');
}
?>
