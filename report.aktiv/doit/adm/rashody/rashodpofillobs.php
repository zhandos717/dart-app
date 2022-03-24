<?
include_once '../../../bd.php';

$data = $_POST;
    if (isset($data['rashodfill'])) {

      $datarashoda    = $data['datarashoda'];
      $summaf      = $data['summaf'];
      $region      = $data['region'];
      $adress      = $data['adress'];

        $userg = R::dispense('rashodfillialobs');
        $userg->datarashoda = $datarashoda;
        $userg->region = $region;
        $userg->adress = $adress;
        $userg->summarf = $summaf;
        $userg->comments = $data['comments'];
        $userg->datez = date("Y-m-d");
        $userg->timez = date("H:i:s");
        R::store($userg);
        header('Location: /doit/adm/rashody_obs.php?s=succes');
}
?>
