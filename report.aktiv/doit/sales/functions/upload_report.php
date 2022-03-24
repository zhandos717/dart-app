<? 
include_once  '../../../bd.php';
$search = "%{$_POST['search']}%";

if(!empty($search)){
$table = ['sales03','sales04','sales05','sales06','sales07','sales08','sales09','sales010','sales11','sales12','sales'];
  $data1 = R::findAll($table[0],'(codetovar LIKE :search OR tovarname LIKE :search  OR saler LIKE :search OR pokupatel LIKE :search) ', [ ':search'=>$search]);
  $data = R::findAll($table[1],'(codetovar LIKE :search OR tovarname LIKE :search  OR saler LIKE :search OR pokupatel LIKE :search) ', [ ':search'=>$search]);
  $result = array_merge($data1, $data); 
  $data = R::findAll($table[3],'(codetovar LIKE :search OR tovarname LIKE :search  OR saler LIKE :search OR pokupatel LIKE :search) ', [ ':search'=>$search]);
  $result = array_merge($result, $data);
  $data = R::findAll($table[4],'(codetovar LIKE :search OR tovarname LIKE :search  OR saler LIKE :search OR pokupatel LIKE :search) ', [ ':search'=>$search]);
  $result = array_merge($result, $data);
  $data = R::findAll($table[5],'(codetovar LIKE :search OR tovarname LIKE :search  OR saler LIKE :search OR pokupatel LIKE :search) ', [ ':search'=>$search]);
  $result = array_merge($result, $data);
  $data = R::findAll($table[6],'(codetovar LIKE :search OR tovarname LIKE :search  OR saler LIKE :search OR pokupatel LIKE :search) ', [ ':search'=>$search]);
  $result = array_merge($result, $data);
  $data = R::findAll($table[7],'(codetovar LIKE :search OR tovarname LIKE :search  OR saler LIKE :search OR pokupatel LIKE :search) ', [ ':search'=>$search]);
  $result = array_merge($result, $data);
  $data = R::findAll($table[8],'(codetovar LIKE :search OR tovarname LIKE :search  OR saler LIKE :search OR pokupatel LIKE :search) ', [ ':search'=>$search]);
  $result = array_merge($result, $data);
  $data = R::findAll($table[9],'(codetovar LIKE :search OR tovarname LIKE :search  OR saler LIKE :search OR pokupatel LIKE :search) ', [ ':search'=>$search]);
  $result = array_merge($result, $data);
  $data = R::findAll($table[10],'(codetovar LIKE :search OR tovarname LIKE :search  OR saler LIKE :search OR pokupatel LIKE :search) ', [ ':search'=>$search]);
  $result = array_merge($result, $data);
};
$i=1;
?>
<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>№</th>
        <th>ДАТА </th>
        <th>МАГАЗИН</th>
        <th>КОД ТОВАРА</th>
        <th>ТОВАР</th>
        <th>ПРИХОДНАЯ</th>
        <th>СУММА КРЕДИТА</th>
        <th>ПРЕДОПЛАТА</th>
        <th>Сумма реализации</th>
        <th>ПРИБЫЛЬ</th>
        <th>ВИД</th>
        <th>ПРОДАВЕЦ</th>
        <th>ПОКУПАТЕЛЬ</th>
      </tr>
    </thead>
    <tbody>
      <?foreach ($result as $value) {?>
      <tr <?= $value['statustovar']? 'class="danger"':''; ?>>
        <td><?= $i++; ?>.</td>
        <td><?= date("d.m.Y", strtotime($value['data'])); ?></td>
        <td><?= $value['region']; ?>/<?= $value['adress']; ?></td>
        <td><?= $value['codetovar']; ?></td>
        <td><?= $value['tovarname']; ?></td>
        <td><?= number_format($value['summaprihod'], 0, '.', ' '); ?></td>
        <td><?= number_format($value['summakredit'], 0, '.', ' '); ?></td>
        <td><?= number_format($value['predoplata'], 0, '.', ' '); ?></td>
        <td><?= number_format($value['summareal'], 0, '.', ' '); ?></td>
        <td><?= number_format($value['pribl'], 0, '.', ' '); ?></td>
        <td><?= $value['vid']; ?></td>
        <td><?= $value['saler']; ?></td>
        <td><?= $value['pokupatel']; ?></td>
      </tr>
      <?}?>
    </tbody>
  </table>
</div>
