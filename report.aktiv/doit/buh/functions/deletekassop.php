<?
  include ("../../../bd.php");
$idx = $_GET['id'];

if($idx){
  $kassaop = R::load('finance',$idx);
  
  $kassaop->status = '3';
  R::store($kassaop);
  
  }?>
