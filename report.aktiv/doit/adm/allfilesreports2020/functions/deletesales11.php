<? //проверка существовании сессии
include("../../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 3) :
?>

    <?

    $id = (int) $_GET["id"];
    $id = strip_tags($_GET['id']);
    $id = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
    $id = htmlspecialchars($_GET['id'], ENT_QUOTES);

    $region = $_GET['region'];
    $shop   = $_GET['adress'];

    $data_z = $_GET['data'];



    $result = mysqli_query($connect, "DELETE FROM sales11 WHERE id = $id ");


    echo "<meta http-equiv='Refresh' content='0; URL=../detail11.php?region=$region&shop=$shop&data_z=$data_z'>";
    ?>



  <? endif; ?>
<? else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>

  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь

<? endif; ?>
