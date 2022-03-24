<?
$user_active = 'active';
include "pages/layouts/header.php";

if(isset($_GET['region']) AND isset($_GET['adress'])){
    $where = 'region = :region AND adress = :adress ORDER BY id DESC';
    $placeholder = [':region'=>$_GET['region'],':adress'=>$_GET['adress']];
}else{
    $where = 'ORDER BY id DESC';
    $placeholder = [];
}

$fiopost = $_POST['fio'];

$result = R::findAll('employeecard',$where, $placeholder);
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Карточка сотрудника </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-body">
            <!-- <form class="" action="./function/testpage.php" method="POST">
              <input type="text" name="tsts" >
              <input type="submit" name="asd" value="test">
            </form> -->

            <form  method="post" action="./function/addEmployeecard.php">

            <div class="form-group">
                <label for="fio">Ф.И.О<?=$fiopost;?></label>
                <input type="text" class="form-control" id="fio" required autocomplete="off"  name="fio" placeholder="Фамилия Имя Отчество">
            </div>
            <div class="form-group">
                <label for="dpnr">Дата принятия на работу</label>
                <input type="date"  class="form-control" id="dpnr" required name="dpnr" >
            </div>
            <div class="form-group">
                <label for="typedogovor">Тип трудового договора</label>
                <select class="form-control" id="typedogovor" required name="typedogovor">
                  <option value="гпх">ГПХ</option>
                  <option value="Штат">Штат</option>

                </select>
            </div>

            <div class="form-group">
                <label for="region">Город</label>
                <select class="form-control" id="region" required name="region">
                    <?= isset($_GET['region']) ? '<option>'.$_GET['region'].'</option>'
                        :'<option value="">Выберите город</option>';
                    $city = R::getCol('SELECT region FROM diruser GROUP BY region');
                    foreach ($city as $key) {
                        echo "<option>{$key}</option>";
                    }?>
                </select>
            </div>

            <div class="form-group">
                <label for="adress">Адресс</label>
                <select class="form-control" id="adress" required name="adress">
                        <?= isset($_GET['adress']) ? '<option>'.$_GET['adress'].'</option>'
                        :'<option value="">Выберите город</option>';?>
                </select>
            </div>

            <div class="form-group">
                <label for="otdel">Отдел</label>
                <select class="form-control" id="otdel" name="otdel">
                  <option value="">выберите отдел</option>
                    <?
                    $otdel = R::getCol('SELECT otdel FROM otdel GROUP BY otdel');
                    foreach ($otdel as $key) {
                        echo "<option>{$key}</option>";
                    }?>
                </select>
            </div>

            <div class="form-group">
                <label for="position">Должность</label>
                <select id="position" name="doljnost" required class="form-control">
                    <? if ($user['doljnost']) { ?>
                        <option value="<?= $user['doljnost']; ?>"><?= $user['doljnost']; ?></option>
                    <? }
                    $position = R::findAll('position');
                    foreach ($position as $key) {
                        echo "<option value='{$key['name']}'>{$key['name']}</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="iin">ИИН</label>
                <input type="text" size="30" maxlength="12" class="form-control" id="iin" autocomplete="off"  name="iin" placeholder="ИИН сотрудника, не обязательно">
            </div>

            <!-- <div class="form-group">
                <label for="status">Статус</label>
                <select id="status" name="status" required class="form-control">
                    <option value="1">Активный</option>
                    <option value="0">Уволен</option>
                </select>
            </div> -->
            <!-- <button type="button" class="btn btn-danger" name="button">Добавить сотрудника</button> -->
            <input type="submit" class="btn btn-danger" name="gos" value="Добавить сотрудника">
          </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">

          <div class="box-body">
            <div class="table-responsive">
              <!-- <table id="example1" class="table table-bordered"> -->
              <table id="datatable-tabletools" class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-olive">
                    <th>№</th>
                    <th></th>
                    <th>Ф.И.О</th>
                    <th>Город</th>
                    <th>Адрес</th>
                    <th>Отдел</th>
                    <th>Должность</th>
                    <th>Дата принятия на работу</th>
                    <th>Вид трудового договора</th>
                  </tr>
                </thead>
                <tbody>
                  <?
                  $i = 1;
                  foreach ($result as $key) {

                  ?>
                    <tr class="<?= $color ?>">
                      <td><?= $i++; ?>.</td>
                      <td>
                        <a href="rewemployecard?id=<?= $key['id']; ?>">
                        <button class="fa fa-edit btn-warning btn update" data-id="<?= $key['id']; ?>" > </button></a>
                      </td>
                      <td><?= $key['fio']; ?></td>
                      <td><?= $key['region']; ?></td>
                      <td><?= $key['adress']; ?></td>
                      <td><?= $key['otdel']; ?></td>
                      <td><?= $key['doljnost']; ?></td>
                      <td>
                        <?=date("d.m.Y", strtotime($key['dpnr']));?><br>
                        <?
                        $now = new DateTime();
                        $date = new DateTime($key['dpnr']);
                        $diff = $date->diff($now)->format("%a");
                        echo "<i>работает ".$diff." дней</i>"
                         ?>
                      </td>
                      <td><?= $key['typedogovor']; ?></td>

                    </tr>
                  <? } ?>
                </tbody>
              </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.content-wrapper -->
  </section>
</div>

<script src="/assets/plugins/select2/select2.full.js"></script>
<!-- InputMask -->
<script>
  $(function() {
      $('#region').change(function() {
          var value = $(this).val();
          $('#adress').load('../function/get_adress.php', {
              value: value
          });
      });
  });
</script>
<? include "pages/layouts/footer.php"; ?>
