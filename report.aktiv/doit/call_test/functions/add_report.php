<?
    include ("../../../bd.php");
    if(isset($_POST['go_update'])){
        if($_POST['idx']){
            $add = R::load('callreports',$_POST['idx']); 
        }else{
        $add = R::dispense('callreports'); 
         };
        $add ->user =           $_SESSION['logged_user']->fio; 
        $add ->days =           $_POST['days'];
        $add ->datereport =     $_POST['datereport'];
        $add ->operator1 =      $_POST['operator1'];//Оператор 1/Рахат
        $add ->operator2 =      $_POST['operator2'];//Оператор 2/Алемгуль
        $add ->operator3 =      $_POST['operator3'];//Оператор 3/Ринат
        $add ->operator4 =      $_POST['operator4'];//Оператор 4/Дамира
        $add ->operator5 =      $_POST['operator5'];//Оператор 5/Назар
        $add ->operator6 =      $_POST['operator6'];//Оператор 6/Назира
        $add ->operator7 =      $_POST['operator7'];//Оператор 7/Мади
        $add ->operator8 =      $_POST['operator8'];//Оператор 8/Алина
        $add ->filial =         $_POST['filial'];
        $add ->shop =           $_POST['shop'];
        $add ->datetime =       date('Y-m-d H:i:s');
        $add ->datecoment =     date('Y-m-d');
        R::store( $add );
       
        $_SESSION['message'] = 'Данные добавлены!'; 
    };

    if($_POST['id_delete']){
        $add = R::load('callreports',$_POST['id_delete']); 
        R::trash($add);
        
        $_SESSION['message'] = 'Данные удалены!'; 
    }
 
    header("Location: ../index.php?id=1");
?>