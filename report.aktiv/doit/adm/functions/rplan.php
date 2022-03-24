<?
include_once '../../../bd.php';

$data = $_POST;
$month = date('m');
$region    = $data['region'];
$adress    = $data['adress'];
$plan      = $data['plan'];

if (isset($data['do_signup'])) {

    $result = mysqli_query($connect, " UPDATE planlombard SET  plan = '$plan' WHERE region = '$region' AND adress = '$adress' ");

    echo "<meta http-equiv='Refresh' content='0; URL=../viewfilial.php?region=$region&adress=$adress'>";
}

if (isset($data['go_plan'])) {
    $result = R::findOne('magplan', "adress = '$adress' AND region = '$region' AND month = '$month' ");
    $magplan = R::load('magplan', $result['id']);
    $magplan->region = $region;
    $magplan->year = date('Y');
    $magplan->month = $month;
    $magplan->adress = $adress;
    $magplan->plan = $plan;
    R::store($magplan);
    header('Location: ../total_shop.php?start=2021-' . $month . '-01&end=2021-'.$month.'-31');
};?>
