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
$id = $_GET['id'];

// $result = R::findAll('employeecard',$where, $placeholder);
$result = mysqli_query($connect, "SELECT *FROM employeecard WHERE id = '$id' ");
$data = mysqli_fetch_array($result);
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Редактирование Карточки сотрудника (мало ли, вдруг рука дрогнула) </h1>
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

            <form  method="post" action="./function/rewrEmployeecard.php">
              <input type="text" name="id" value="<?=$id;?>" hidden="hidden">
            <div class="form-group">
                <label for="fio">Ф.И.О<?=$fiopost;?></label>
                <input type="text" class="form-control" id="fio" required autocomplete="off" value="<?=$data['fio'];?>"  name="fio" placeholder="Фамилия Имя Отчество">
            </div>

            <div class="form-group">
                <label for="dpnr">Дата принятия на работу</label>
                <input type="date"  class="form-control" id="dpnr" required name="dpnr" value="<?=$data['dpnr'];?>" >
            </div>
            <div class="form-group">
                <label for="typedogovor">Тип трудового договора</label>
                <select class="form-control" id="typedogovor" required name="typedogovor">
                  <option value="<?=$data['typedogovor'];?>"><?=$data['typedogovor'];?></option>
                  <option value="Штат">Штат</option>
                  <option value="гпх">ГПХ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="region">Город</label>
                <select class="form-control" id="region" required name="region">
                  <option value="<?=$data['region'];?>"><?=$data['region'];?></option>
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
                  <option value="<?=$data['adress'];?>"><?=$data['adress'];?></option>
                        <?= isset($_GET['adress']) ? '<option>'.$_GET['adress'].'</option>'
                        :'<option value="">Выберите город</option>';?>
                </select>
            </div>

            <div class="form-group">
                <label for="otdel">Отдел</label>
                <select class="form-control" id="otdel" name="otdel">
                  <option value="<?=$data['otdel'];?>"><?=$data['otdel'];?></option>
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
                  <option value="<?=$data['doljnost'];?>"><?=$data['doljnost'];?></option>
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
                <input type="text" size="30" maxlength="12" class="form-control" id="iin" value="<?=$data['iin'];?>" autocomplete="off"  name="iin" placeholder="ИИН сотрудника">
            </div>

            <div class="form-group">
                <label for="status">Статус</label>
                <select id="status" name="status" required class="form-control">
                    <option value="1">Активный</option>
                    <option value="0">Уволен</option>
                </select>
            </div>
            <input type="submit" class="btn btn-danger" name="delgos" value="Удалить сотрудника">
            <input type="submit" class="btn btn-warning" name="regos" value="Изменить данные сотрудника">
          </form>
          </div>
        </div>
      </div>
    </div>

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
