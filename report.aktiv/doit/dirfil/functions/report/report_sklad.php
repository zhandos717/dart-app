<?php include_once '../../../../bd.php';
if (empty($status)) {
  exit;
};
$table = 'tickets';

if ($_POST['region'] == 'Все') {
  $sql  = ['status' => [10, 14, 15], 'region' => ['Нур-Султан', 'Кокшетау', 'Костанай', 'Павлодар', 'Караганда']];
} elseif ($_POST['adress'] == 'Все') {
  $sql  = ['status' => [10, 14, 15], 'region' => [$_POST['region']],];
} elseif (!empty($_POST['adress']) and  $_POST['adress'] != 'Все') {
  $sql  = ['status' => [10, 14, 15], 'adressfil' => [$_POST['adress']],];
}
$placeholder = 'ORDER BY data_pos ASC ';
$result = R::findLike($table, $sql, $placeholder);
?>
<div class="col-md-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title pull-left">Товары филиала <?= $_POST['adress']; ?> на складе г. <?= $_POST['region']; ?> &ensp;</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-plus"> </i> </button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered" id="example1">
          <thead>
            <tr class="success">
              <th style="width: 5rem" class="text-center">№</th>
              <th style="width: 8rem">№ЗБ</th>
              <th style="width: 120px"> Дата выхода на реализацию</th>
              <th style="width: 80px"> Дата поступления</th>
              <th class="text-center">Описание имущества</th>
              <th style="width: 10rem">Сумма кредита</th>
              <th style="width: 10rem">Сумма продажи</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <? $i = 1;
            foreach ($result as $data) {
            if($data['status']==10):  
            ?>
            <tr class="col">
              <td class="text-center">
                <?= $i++; ?>
              </td>
              <td> <?= $data['nomerzb']; ?> </td>
              <td><?= date("d.m.Y", strtotime($data['dv'])); ?></td>
              <td><?= date("d.m.Y", strtotime($data['data_pos'])); ?></td>
              <td> <?= $data['category']; ?>, <?= $data['tovarname']; ?> <?= $data['hdd']; ?> <?= $data['sostoyanie_bu']; ?> <?= $data['upakovka']; ?> <?= $data['ekran']; ?> <?= $data['korpus']; ?>
                SN: <?= $data['sn']; ?>, IMEI:<?= $data['imei']; ?>, <?= $data['complect']; ?> <?= $data['opisanie']; ?>
              </td>
              <td> <?= number_format($data['summa_vydachy'], 0, '.', ' ');
                    $summa_vydachy += $data['summa_vydachy']; ?> тг. </td>
              <td>
                <?= number_format($data['cena_pr'], 0, '.', ' ');
                $cena_pr += $data['cena_pr']; ?> тг.
              </td>
              <td>
                <a href="sklad/barcode/index.php?id=<?= $data['id']; ?>" class="btn btn-app" target="_blank">
                  <i class="fa fa-barcode"></i> <?= number_format($data['cena_pr'], 0, '.', ' '); ?>
                </a>
              </td>
              <td>
                <?if($data['cena_pr'] >1){?>
                <button data-articul="<?= $data['id']; ?>" data-status="14" title="Выставить на витрину" class="btn btn-info fa fa-shopping-cart stt">

                </button>
                <?}?>
                <button data-articul="<?= $data['id']; ?>" data-status="15" title="Передать ремонтнику" class="btn btn-danger fa fa-wrench"></button>
              </td>
            </tr>
            <? endif; } ?>
          </tbody>
          <tfoot>
            <tr class="danger">
              <th colspan="5" class="text-center">Итого </th>
              <th><?= number_format($summa_vydachy, 0, '.', ' '); ?> тг.</th>
              <th><?= number_format($cena_pr, 0, '.', ' '); ?> тг.</th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col-md-6 -->
<!--------------------------------------Товар на витрине------------------------------------->
<div class="col-md-12">
  <div class="box box-warning">
    <div class="box-header">
      <h3 class="box-title pull-left">Товары филиала <?= $_POST['adress']; ?> на витрине г. <?= $_POST['region']; ?> &ensp;</h3>
      <div class="box-tools">
      </div>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-plus"> </i> </button>
      </div>
    </div><!-- /.box-header -->
    <!-- search form -->
    <div class="box-body">
      <!-- /.search form -->
      <div class="table-responsive">
        <table class="table table-hover table-bordered" id="datatable-tabletools">
          <thead>
            <tr class="success">
              <th style="width: 5rem" class="text-center">№</th>
              <th style="width: 5rem">№ЗБ</th>
              <th>Дата поступления на продажу</th>
              <th>Дата выставления на витрину</th>
              <th>К-во дней на продаже</th>
              <th class="text-center">Описание имущества</th>
              <th class="warning" style="width: 10rem">Сумма кредита</th>
              <th class="danger" style="width: 10rem">Сумма продажи</th>
              <th class="success"></th>
            </tr>
          </thead>
          <tbody>
            <? $i = 1;
            foreach ($result as $data) {
            if($data['status']==14):  
              $day = (int) round((strtotime(date('Y-m-d')) - strtotime($data['dv'])) / (60 * 60 * 24));
              if($day>10){$color = 'danger';}else {
                $color = 'success';
              }
            ?>
            <tr class="<?= $color; ?>">
              <td class="text-center"><?= $i++; ?>.</td>
              <td> <?= $data['nomerzb']; ?> </td>
              <td><?= date("d.m.Y", strtotime($data['data_pos'])); ?></td>
              <td><?= date("d.m.Y", strtotime($data['dateshop'])); ?></td>
              <td> <?= $day; ?></td>
              <td> <?= $data['category']; ?>, <?= $data['tovarname']; ?> <?= $data['hdd']; ?> <?= $data['sostoyanie_bu']; ?> <?= $data['upakovka']; ?> <?= $data['ekran']; ?> <?= $data['korpus']; ?>
                SN: <?= $data['sn']; ?>, IMEI:<?= $data['imei']; ?>, <?= $data['complect']; ?> <?= $data['opisanie']; ?>
              </td>
              <td class="warning"> <?= number_format($data['summa_vydachy'], 0, '.', ' ');
                                    $summa_vydachy14 += $data['summa_vydachy']; ?> тг. </td>
              </td>
              <td class="danger">
                <a href="barcode/index.php?id=<?= $data['id']; ?>" target="_blank">
                  <?= number_format($data['cena_pr'], 0, '.', ' ');
                  $cena_pr14 += $data['cena_pr']; ?>
                </a>
              </td>
              <td class="success">
                <button data-articul="<?= $data['id']; ?>" data-status="10" title="Вернуть в склад" class="btn btn-danger stt"> <i class="fa fa-university"></i></button>
              </td>
            </tr>
            <? endif; } ?>
          </tbody>
          <!--------------------------------------Товар на витрине------------------------------------->
          <tfoot>
            <tr class="danger">
              <th colspan="5" class="text-center">Итого </th>
              <th></th>
              <th><?= number_format($summa_vydachy14, 0, '.', ' '); ?> тг.</th>
              <th><?= number_format($cena_pr14, 0, '.', ' '); ?> тг.</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col-md-12 -->
<!--------------------------------------------------------------------------->
<div class="col-md-12">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title pull-left">Товары филиала <?= $_POST['adress']; ?> на ремонте г. <?= $_POST['region']; ?> &ensp;</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-plus"> </i> </button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <!-- /.search form -->
      <div class="table-responsive">
        <table class="tableas2 table table-hover table-border" id="info-table">
          <thead>
            <tr class="success">
              <th style="width: 5rem" class="text-center">№</th>
              <th style="width: 5rem">№ЗБ</th>
              <th style="width: 5rem"> Дата поступления</th>
              <th style="width: 15rem"> Дата передачи на ремонт</th>
              <th class="text-center">Описание имущества</th>
              <th style="width: 10rem">Вид ремонта</th>
              <th class="warning"> Статус</th>
            </tr>
          </thead>
          <tbody>
            <? $i = 1;
            foreach ($result as $data) {
            if($data['status']==15):  
            $statusremont = $data['statusremont'];
            if($statusremont == 1){
            $status = '<span class="label label-info">В очереди</span>';}
            if($statusremont == 2){
            $status = '<span class="label label-warning">В процессе</span>';}
            if($statusremont == 3){
            $status = '<span class="label label-success">Выполнено</span>';}
            if($statusremont == 4){
            $status = '<span class="label label-danger">Не пригоден для ремонта</span>';}
            ?>
            <tr>
              <td class="text-center"> <?= $i++; ?> </td>
              <td> <?= $data['nomerzb']; ?> </td>
              <td><?= date("d.m.Y", strtotime($data['data_pos'])); ?></td>
              <td><?= date("d.m.Y", strtotime($data['dateremont'])); ?></td>
              <td> <?= $data['category']; ?>, <?= $data['tovarname']; ?> <?= $data['hdd']; ?> <?= $data['sostoyanie_bu']; ?> <?= $data['upakovka']; ?> <?= $data['ekran']; ?> <?= $data['korpus']; ?>
                SN: <?= $data['sn']; ?>, IMEI:<?= $data['imei']; ?>, <?= $data['complect']; ?> <?= $data['opisanie']; ?>
              </td>
              <td><?= $data['remontmessage']; ?> </td>
              <td> <?= $status; ?> </td>
            </tr>
            <?endif; } ?>
          </tbody>
          <tfoot>
            <tr class="danger">
              <th colspan="6" class="text-center">Итого </th>
              <th><?= $data15['count']; ?> шт.</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col-md-12 -->

<script>
  $(function() {
    $('.stt').click(function() {
      var parentEls = $(this).parents('tr');
      var id = $(this).data('articul');
      var status = $(this).data('status');
      //.addClass('danger');
      $.post("functions/report/func/sklad.php", {
          id: id,
          status: status
        })
        .done(function(data) {
          parentEls.addClass('danger');
          console.log(data);
        });
      console.log(id);
      console.log(status);
    });

    $('.fa-wrench').click(function() {
      var id = $(this).data('articul');
      var status = $(this).data('status');
      var parentEls = $(this).parents('tr');
      let message = prompt("Введите причину передачи на ремонт:");
      if (message != '') {
        $.post("functions/report/func/sklad.php", {
            id: id,
            message: message,
            status: status
          })
          .done(function(data) {
            parentEls.addClass('danger');
            console.log(data);
          });
      } else {
        alert('Ошибка, введите сообщение!');
      }
    });
  });
</script>

<script src="plugins/table/dataTables.buttons.min.js"></script>
<script src="plugins/table/jszip.min.js"></script>
<script src="plugins/table/buttons.html5.min.js"></script>
<script src="plugins/table/buttons.print.min.js"></script>
<script src="plugins/table/examples.datatables.tabletools.js"></script>

<script>
  $(function() {
    $("#example1").DataTable();
    $("#example3").DataTable();
    $("#example4").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>