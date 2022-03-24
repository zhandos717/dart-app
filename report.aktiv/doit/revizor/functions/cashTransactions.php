<?php
  include ("../../../bd.php");


//генерация уникального числа номера заказа

$len = 3;   // total number of numbers
$min = 100;  // minimum
$max = 999;  // maximum
$range = []; // initialize array
foreach (range(0, $len - 1) as $i) {
    while (in_array($num = mt_rand($min, $max), $range));
    $range[] = $num;
}
//print_r($range);

$range = implode("", $range);







  $kassaoperation = $_POST['kassaoperation'];
  $region = $_POST['region'];
  $adress = $_POST['adress'];
  $kassa = $_POST['kassa'];

  $summa = $_POST['summa'];
  $Chet = $_POST['Chet'];
  $coment = $_POST['coment'];
  $status = '1';
  $colorstatus = 'info';
  $kodfiilal = '36';
 // $nomer_platezha = $range;
  $nomer_platezha = $range;
  if($region){

         $errors = array();
         if($kassaoperation == '')
         {
             $errors[] = 'Выберите кассовую операцию!';
         }
         if($summa == '')
         {
             $errors[] = 'Введите сумму операции';
         }
         if($Chet == '')
         {
             $errors[] = 'Выберите креспондирующий счет опрерации!';
         };

         if($kassaoperation == 0){
           $kassaoperation = 'Внесение';
           $colorkassaoperation = 'success';
         }else {
           $kassaoperation = 'Изъятие';
           $colorkassaoperation = 'danger';
         };

         if(empty($errors)){
                 $kassaop = R::dispense('finance');
                 $kassaop->region = $region;
                 $kassaop->kodfiilal = $kodfiilal;
                 $kassaop->filial = $adress;
                 $kassaop->kassa = $kassa;
                 $kassaop->summa = $summa;
                 $kassaop->kassaoperation = $kassaoperation;
                 $kassaop->operationtype = $_POST['kassaoperation'];
                 $kassaop->dataa = date("Y-m-d");
                 $kassaop->chet = $Chet;
                 $kassaop->status = $status;
                 $kassaop->coment = $coment;
                 $kassaop->colorkassaoperation = $colorkassaoperation;
                 $kassaop->colorstatus = $colorstatus;
			     $kassaop->np = $nomer_platezha;
                  R::store($kassaop);
                 //echo '<div style="color:green;"> Вы успешно зарегистрированыы!</div><hr>';
                 $data = R::findAll('finance');
                 echo '<tr>
                  <th colspan="10">
                    <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
                          <h4><i class="icon fa fa-check"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Операция успешно проведена!</font></font></h4>
                          </font></font>
                      </div>
                      </th>
                  </tr>';
                   if($data){
                     foreach ($data as $data)

                 echo '
                   <tr>
                     <th>'. $data['id'] .'</th>
                     <td>'. $data['region'] .'</td>
                     <td>'. $data['filial'] .'</td>
                     <td>'. $data['date'] .'</td>
                     <td>'. $data['chet'] .'</td>
                     <td><span class="label label-'.$data['colorkassaoperation'].'">'. $data['kassaoperation'] .'</span></td>
                     <td>'. $data['summa'] .'</td>
                     <td>'. $data['kassa'] .'</td>
                     <td><span class="label label-'.$data['colorstatus'].'"> '. $data['status'] .' </span></td>
                     <td>'. $data['coment'] .' </td>
                   </tr>';}
                   };
                   if(!empty($errors)){
             echo
                '
                <tr>
                 <th colspan="10">
                 <div class="alert alert-danger alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></button>
                     <h4><i class="icon fa fa-times-circle"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Критическая ошибка!</font></font></h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                     '.array_shift($errors).' </font><font style="vertical-align: inherit;">
                     </font></font>
                 </div>
                 </th>
             </tr>';};
   };?>
