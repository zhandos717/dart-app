<?php
    include ("../../bd.php");

    $data = $_POST;
if( isset($data['do_signup']) )
{


 $client  = @$_SERVER['HTTP_CLIENT_IP'];
$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = @$_SERVER['REMOTE_ADDR'];

if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
else $ip = $remote;

 



  // Пути загрузки файлов
$path = 'imgtovar/';
$tmp_path = 'tmp/';
// Массив допустимых значений типа файла
$types = array('application/pdf');
// Максимальный размер файла
$size = 9024000;

// Обработка запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
 // Проверяем тип файла
 if (!in_array($_FILES['picture']['type'], $types))
 die('Запрещённый тип файла. <a href="?">Попробовать другой файл?</a>');

 // Проверяем размер файла
 if ($_FILES['picture']['size'] > $size)
 die('Слишком большой размер файла. <a href="?">Попробовать другой файл?</a>');

 // Загрузка файла и вывод сообщения
 if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
 echo 'Что-то пошло не так';
 else
 echo 'Загрузка удачна <a href="' . $path . $_FILES['picture']['name'] . '">Посмотреть</a> ' ;
}




  $photo  = 'imgtovar/'. '' .$_FILES['picture']['name'];




	// все хорошо, регисирируем в Базе Данных
	// Ред Бин исключает SQL иньекции
		$user = R::dispense('kosyak');

   /*     $user->fio = $_SESSION['logged_user']->fio;*/

        $user->ip =$ip;
        $user->region=$data['region'];
        $user->adress=$data['adress'];
        $user->data=$data['data'];
        $user->codetovar=$data['codetovar'];
        $user->pereoceka=$data['pereoceka'];
    		$user->comment=$data['comment'];

        $segdata = date("Y-m-d H:i:s");
        $user->segdata = $segdata;

        $user->photo = $photo ;

		R::store($user);
	 echo "<meta http-equiv='Refresh' content='0; URL=viewmyreports05.php'>";

}
