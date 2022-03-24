<? //проверка существовании сессии
include("../../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
  if ($_SESSION['logged_user']->status == 3) :

    $id = $_POST['id'];
    $datarashoda = $_POST['datarashoda'];
    $summarf = $_POST['summarf'];
    $comments = $_POST['comments'];

  $result = mysqli_query($connect, " UPDATE rashodfillial SET
                                                  datarashoda = '$datarashoda',
                                                  summarf= '$summarf',
                                                  comments = '$comments'
                                       WHERE id = '$id'
                                       ");

    echo "<meta http-equiv='Refresh' content='0; URL=../filtrRashod.php'>";
   endif;
 else :
  echo "<meta http-equiv='Refresh' content='0; URL=/report/'>";
?>
  чтобы что то сделать - зайдите в свой личный кабинет или зарегистрируйтесь
<? endif; ?>
