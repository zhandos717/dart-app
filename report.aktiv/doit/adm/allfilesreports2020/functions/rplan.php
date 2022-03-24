<?//проверка существовании сессии
include ("../../../../bd.php");

  $data = $_POST;
  $month = date('m');
if( isset($data['do_signup']) )
{

        $region    = $data['region'];
        $adress    = $data['adress'];
        $plan      = $data['plan'];


        $result = mysqli_query($connect, " UPDATE planlombard SET  plan = '$plan' WHERE region = '$region' AND adress = '$adress' ");

	 echo "<meta http-equiv='Refresh' content='0; URL=../viewfilial.php?region=$region&adress=$adress'>";

}

if(isset($data['go_plan']))
{
        $region    = $data['region'];
        $adress    = $data['adress'];
        $plan      = $data['plan'];
        $result = mysqli_query($connect, "SELECT * FROM magplan WHERE adress = '$adress' AND region = '$region' AND month = '$month' ");
        $data1 = mysqli_fetch_array($result);
        $id = $data1['id'];

        if($id){
          $magplan = R::load('magplan', $id);
         }else{
        $magplan = R::dispense('magplan');}
        $magplan->region = $region;
        $magplan->month = $month;
        $magplan->adress = $adress;
        $magplan->plan = $plan;
        R::store($magplan);
	 echo "<meta http-equiv='Refresh' content='0; URL=../magoctober.php'>";
};?>

<script language="JavaScript">
<!--
alert("Ежемесячный план успешно установлен! Подтверждаете?");
//-->
</script>
