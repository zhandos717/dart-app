<?
  include ("../../../../bd.php");
  
  function upload_image($file,$codetovar,$cena){
    $upload_dir = '../../../../../httpdocs/imgtovar/'; // Путь куда загружаем файл
  $files_name = ''; 
  for ($i = 0; $i < count($file['file']['name']); $i++) {    
      $accepted_formate = ['jpg', 'jpeg', 'png']; // Массив расширении файлов
      $file_extension = pathinfo($file['file']['name'][$i], PATHINFO_EXTENSION); // Достаем расширение файла
   
    if(in_array(pathinfo($file['file']['name'][$i], PATHINFO_EXTENSION), $accepted_formate)){
      $name = $i.'-КТ:'.$codetovar .'-'.$cena.'.' . $file_extension;
      $file_name = $upload_dir . $name;//Создаем новое имя во избежание затирания файла
      move_uploaded_file($file['file']['tmp_name'][$i], $file_name); // Загружаем файл в нашу директорию
      $files_name .= $name.' '; // Создаем строку именами файлов 
      }else{
         $files_name .= 'Формат файла на подходит'; // Возвращаем ошибку
      }
    }
    return $files_name;
  }

if(!empty($_POST['codetovar'])){

        if(!empty($_FILES)){
        $file_name = upload_image($_FILES,$_POST['codetovar'],$_POST['cena']);
        }
            $client = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote = @$_SERVER['REMOTE_ADDR'];

            if (filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
            elseif (filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
            else $ip = $remote;
  
            $tovar = R::load('tovar',$_POST['tovar_id']);
            $tovar->region = $_POST['region'];
            $tovar->ip = $ip;
            $tovar->type = $_POST['type'];
            $tovar->category = $_POST['category'];
            $tovar->manufacturer = $_POST['manufacturer'];
            $tovar->model          = $_POST['model'];
            $tovar->codetovar = $_POST['codetovar'];
            $tovar->category = $_POST['category'];
            $tovar->podcategory = $_POST['podcategory'];
            //$tovar->tovarname = $_POST['tovarname'];
            $tovar->opisanie = $_POST['opisanie'];
            $tovar->cena = $_POST['cena'];
            if(!empty($file_name)){
              $tovar->photo = $file_name; 
            }           
            $tovar->status = 'в наличии';
            $tovar->add_user = $fio;
            $tovar->url_photo = $_POST['url'];
            $tovar->segdata = date('Y-m-d H:i:s');
            R::store($tovar);
            
    $result = [
        'code'=> 2,
        'type'=>'Успех',
        'class'=>'success',
        'icon'=>'check',
        'message'=>'Товар добавлен!'
    ];
    header('Location: https://report.aktiv-market.kz/doit/store_administrator/product');          
  
  

}else {
        $result = [
        'code'=> 11,
        'type'=>'Ошибка',
        'class'=>'danger',
        'icon'=>'ban',
        'message'=>'Добавьте код товара'
    ];
    header('Location: https://report.aktiv-market.kz/doit/store_administrator/add_product');   

};



?>