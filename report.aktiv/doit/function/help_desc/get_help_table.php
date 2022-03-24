<? include '../../../bd.php';
header('Content-Type: application/json');
if($fio){
$table = R::findAll('applications', 'user=?', [$fio]);
echo  json_encode($table);
}
?>
