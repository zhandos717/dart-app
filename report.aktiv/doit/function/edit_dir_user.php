<? include '../../bd.php';

if ($region) {
    $users = R::load('diruser', $_SESSION['logged_user']['id'] );
    $users->fio = $_POST['fio'];
    $users->phone = $_POST['phone'];
    if(empty($_POST['email'])){
        $users->email = $_POST['email'];
    }
    $users->add_data = date('Y-m-d H:i:s');
    R::store($users);
}
exit;




