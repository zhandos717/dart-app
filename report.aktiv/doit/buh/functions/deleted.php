<?
  include ("../../../bd.php");
$idx = $_GET['id'];

if($idx){
  $delete = R::load('repotscom',$idx);
  R::trash($delete);

  $_SESSION['message'] = 'Данные удаоены!';

  header("Location:../abcommis.php");

};

  ?>
