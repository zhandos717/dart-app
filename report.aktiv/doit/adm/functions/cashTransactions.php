<?php
include("../../../bd.php");


//генерация уникального числа номера заказа

$len = 3;   // total number of numbers
$min = 100;  // minimum
$max = 999;  // maximum
$range = []; // initialize array
foreach (range(0, $len - 1) as $i) {
  while (in_array($num = mt_rand($min, $max), $range));
  $range[] = $num;
}
$range = implode("", $range);


if ($_POST['summa']) {

  $errors = array();

  if ($_POST['summa'] == '') {
    $errors[] = 'Введите сумму операции';
  }
  if ($_POST['Chet'] == '') {
    $errors[] = 'Выберите креспондирующий счет опрерации!';
  };

  if (empty($errors)) {


    if ($_POST['region']) {
      $region = $_POST['region'];
      $adress = $_POST['adress'];
      $kassa = $_POST['kassa'];

      $codefil = R::getCell("SELECT codefil FROM kassa WHERE region ='$region' AND filial = '$adress' ");

      $kassaop = R::dispense('finance');
      $kassaop->region = $region;
      $kassaop->kodfiilal = $codefil;
      $kassaop->filial = $adress;
      $kassaop->kassa = $kassa;
      $kassaop->summa = $_POST['summa'];
      $kassaop->kassaoperation = '1';
      $kassaop->operationtype = $_POST['kassaoperation'];
      $kassaop->dataa = date("Y-m-d");
      $kassaop->dataatime = date("Y-m-d H:i:s");
      $kassaop->fio = $_SESSION['logged_user']->fio;
      $kassaop->chet = $_POST['Chet'];
      $kassaop->status = '1';
      $kassaop->message = 'Операция с Банком';
      $kassaop->coment = $_POST['coment'];
      $kassaop->np = $range;
      R::store($kassaop);

      $_SESSION['message'] = 'Транзакция успешно проведена!';
    }


    if ($_POST['token'] == '741852') {

      if ($_POST['region1']) {
        $region = $_POST['region1'];
        $adress = $_POST['adress1'];
        $kassa = $_POST['kassa1'];
        $codefil = R::getCell("SELECT codefil FROM kassa WHERE region ='$region' AND filial = '$adress' ");
        $kassaop = R::dispense('finance');
        $kassaop->region = $region;
        $kassaop->kodfiilal = $codefil;
        $kassaop->filial = $adress;
        $kassaop->kassa = $kassa;
        $kassaop->summa = $_POST['summa'];
        $kassaop->kassaoperation = '2';
        $kassaop->operationtype = '1';
        $kassaop->dataa = date("Y-m-d");
        $kassaop->dataatime = date("Y-m-d H:i:s");
        $kassaop->fio = $_SESSION['logged_user']->fio;
        $kassaop->chet = $_POST['Chet'];
        $kassaop->status = '1';
        $kassaop->message = 'Изъятие с ' . $_POST['kassa1'] . ' для пополнение филиала г.' . $_POST['region2'] . '/' . $_POST['adress2'] . '/' . $_POST['kassa2'];
        $kassaop->coment = $_POST['coment'];
        $kassaop->np = $range;
        R::store($kassaop);
      }

      if ($_POST['region2']) {
        $region = $_POST['region2'];
        $adress = $_POST['adress2'];
        $kassa = $_POST['kassa2'];
        $codefil = R::getCell("SELECT codefil FROM kassa WHERE region ='$region' AND filial = '$adress' ");
        $kassaop = R::dispense('finance');
        $kassaop->region = $region;
        $kassaop->kodfiilal = $codefil;
        $kassaop->filial = $adress;
        $kassaop->kassa = $kassa;
        $kassaop->summa = $_POST['summa'];
        $kassaop->kassaoperation = '2';
        $kassaop->operationtype = '0';
        $kassaop->dataa = date("Y-m-d");
        $kassaop->dataatime = date("Y-m-d H:i:s");
        $kassaop->fio = $_SESSION['logged_user']->fio;
        $kassaop->chet = $_POST['Chet'];
        $kassaop->status = '1';
        $kassaop->message = 'Пополнение кассы с филиала г.' . $_POST['region1'] . '/' . $_POST['adress1'] . '/' . $_POST['kassa1'];
        $kassaop->coment = $_POST['coment'];
        $kassaop->np = $range;
        R::store($kassaop);
      };
      $_SESSION['message'] = 'Транзакция успешно проведена!';
    }
  }

  if (!empty($errors)) {

    $_SESSION['error'] = array_shift($errors);
  }
};
header('Location: ../findv.php');
