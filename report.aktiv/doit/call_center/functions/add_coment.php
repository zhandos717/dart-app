<?
    include ("../../../bd.php");
    if(isset($_POST['nomerzb'])){
        if($_POST['message'] == ''){  $error = 'Введите сообщение'; };
        if(empty($error)){
            $add = R::dispense('coment'); 
            $add ->user = $_SESSION['logged_user']->fio;
            $add ->iin = $_POST['iin'];
            $add ->nomerzb = $_POST['nomerzb'];
            $add ->message = $_POST['message'];
            $add ->appeal = $_POST['appeal'];
            $add ->conversation = $_POST['conversation'];
            $add ->datetime = date('Y-m-d H:i:s');
            $add ->timesec = date('H:i:s');
            $add ->datecoment = date('Y-m-d');
            $add ->userid = $_SESSION['logged_user']["id"];
            R::store( $add );
        }else{
            $_SESSION['error'] = 'Введите сообщение'; 
        }
        header("Location: ../index.php?id=2&did={$_POST['did']}");
    };
?>