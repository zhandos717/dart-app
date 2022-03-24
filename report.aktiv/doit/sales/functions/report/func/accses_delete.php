<? include_once '../../../../../bd.php';

//print_r($_POST);
if(!empty($_POST['id_delete'])):
$data = R::load('product',$_POST['id_delete']);
$data->status = 3;
R::store($data);
exit;
endif;

header('Location: /');

?>