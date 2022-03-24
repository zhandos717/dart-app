<? //проверка существовании сессии
include("../../bd.php");
if (!$_SESSION['logged_user']->status == 3) header('Location: ../../index.php');


$sql1 = "select
    DATE_FORMAT(s.data, '%d.%m.%Y') as date_sale, sum(s.pribl) as cost
    from sales s
    WHERE  s.statustovar IS NULL 
    group by DATE_FORMAT(s.data, '%Y-%m-01')";

echo '<pre>';
var_dump(R::getAll($sql1));

