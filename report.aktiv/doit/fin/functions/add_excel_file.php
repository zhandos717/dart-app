<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


    include __DIR__. '/../../../bd.php';
    
    $data = $_POST;
    $file = $_FILES;



function upload($file)
{
    $upload_dir = '../files/'; // Путь куда загружаем файл
    $files_name = '';
    $accepted_formate = ['xlsx'];

    for ($i = 0; $i < count($file['file']['name']); $i++) {
        $file_extension = pathinfo($file['file']['name'][$i], PATHINFO_EXTENSION); // Достаем расширение файла
        if (in_array(pathinfo($file['file']['name'][$i], PATHINFO_EXTENSION), $accepted_formate)) {
            $name = $i. '.' . $file_extension;
            $file_name = $upload_dir . $name; //Создаем новое имя во избежание затирания файла
            move_uploaded_file($file['file']['tmp_name'][$i], $file_name); // Загружаем файл в нашу директорию
            $files_name .= $name . ' ';
        } else {
            $files_name .= NULL;
        }
    }
    return $files_name;
}
            $torgi = R::dispense('torgitest');
            //$torgi->status = 1;
            //$torgi->datetime = date('Y-m-d H:i:s');
            $torgi->file =  upload($file);
            //$torgi->filename = $file['file']['name'];
            //$torgi->filesize = $file['file']['size'];
            //$torgi->filetype = $file['file']['type'];
           // $torgi->user = $_SESSION['logged_user']->fio;
            R::store($torgi);

      
      
    var_dump($file);