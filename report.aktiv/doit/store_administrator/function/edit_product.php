<?include ("../../../bd.php");
if(!empty($_POST['codetovar'])){

function upload_image($file,$codetovar,$cena){
$upload_dir = '../../../../httpdocs/imgtovar/'; // Путь куда загружаем файл
$file_extension = pathinfo($file['name'], PATHINFO_EXTENSION); // Достаем расширение файла

$name = 'КТ:'.$codetovar .'-'.$cena.'.' . $file_extension;

$file_name = $upload_dir . $name;//Создаем новое имя во избежание затирания файла

move_uploaded_file($file['tmp_name'], $file_name); // Загружаем файл в нашу директорию
return $name;
}
    $accepted_formate = ['jpg', 'jpeg', 'png']; // Массив расширении файлов


    if(in_array(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION), $accepted_formate)){


        $file_name = upload_image($_FILES['file'],$_POST['codetovar'],$_POST['cena']);
        
        if ($file_name){
            $client = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote = @$_SERVER['REMOTE_ADDR'];

            if (filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
            elseif (filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
            else $ip = $remote;
            
            $tovar = R::load('tovartest',$_POST['tovar_id']);
            $tovar->region = $_POST['region'];
            $tovar->ip = $ip;

            $tovar->codetovar = $_POST['codetovar'];
            $tovar->category = $_POST['category'];
            $tovar->podcategory = $_POST['podcategory'];
            $tovar->tovarname = $_POST['tovarname'];
            $tovar->opisanie = $_POST['opisanie'];

            $tovar->cena = $_POST['cena'];
            $tovar->photo = $file_name;
            $tovar->status = 1;
            $tovar->add_user = $fio;
            $tovar->segdata = date('Y-m-d H:i:s');
            R::store($tovar);
            
                  $result = [
        'code'=> 2,
        'type'=>'Успех',
        'class'=>'success',
        'icon'=>'check',
        'message'=>'Товар добавлен!'
    ];
            };
    }else {
    $result = [
        'code'=> 5,
        'type'=>'Ошибка',
        'class'=>'danger',
        'icon'=>'ban',
        'message'=>'Тип файла не подходит: '.pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION).' , выберите картинку (jpg, jpeg, png)'
    ];
};


}else {
        $result = [
        'code'=> 11,
        'type'=>'Ошибка',
        'class'=>'danger',
        'icon'=>'ban',
        'message'=>'Добавьте код товара'
    ];
};
    //header("Content-Type: application/json;charset=utf-8");
    
    
   // echo json_encode($result, true); // <--- encode


var_dump($_REQUEST);

?>