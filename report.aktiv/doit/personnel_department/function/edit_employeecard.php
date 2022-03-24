<?php
include("../../../bd.php");
if(!isset($fio)) header('Location: /');


if (!empty($_POST['fio'])) {
    $users = R::load('empcard', $_POST['user_id']);
    $users->region = $_POST['region'];
    $users->adress = $_POST['adress'];
    $users->fio = $_POST['fio'];
    $users->iin = $_POST['iin'];
    $users->doljnost = $_POST['doljnost'];
    $users->status = '1';
    $users->add_user = $fio;
    $users->add_data = date('Y-m-d H:i:s');
    $users->add_datatime = date('H:i:s');

}
$user = R::load('diruser', $_POST['id']);
?>

<div class="form-group">
    <label for="fio">Ф.И.О</label>
    <input type="text" class="form-control" id="fio" required autocomplete="off" value="<?= $user['fio']; ?>" name="fio" placeholder="Фамилия Имя Отчество">
</div>
<div class="form-group">
    <label for="iin">ИИН</label>
    <input type="text" class="form-control" id="iin" required autocomplete="off"  name="iin" placeholder="ИИН сотрудника">
</div>
<div class="form-group">
    <label for="region">Город</label>
    <select id="get_region" name="region" required class="form-control">
        <? if ($user['region']) { ?>
            <option value="<?= $user['region']; ?>"><?= $user['region']; ?></option>
        <? } else { ?>
            <option value="">Выберите город</option>
        <? }
        $city = R::findAll('diruser', 'GROUP BY region');
        foreach ($city as $key) {
            echo "<option value='{$key['region']}'>{$key['region']}</option>";
        } ?>
    </select>
</div>

<div class="form-group">
    <label for="adress">Адресс</label>
    <select id="get_adress" name="adress" required class="form-control">
        <? if ($user['adress']) { ?>
            <option value="<?= $user['adress']; ?>"><?= $user['adress']; ?></option>
        <? } ?>
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
    <label for="available">Статус</label>
    <select id="available" name="status" required class="form-control">
        <option value="1">Активный</option>
        <option value="0">Уволен</option>
    </select>
</div>

<script src="/assets/plugins/select2/select2.full.js"></script>
<!-- InputMask -->
<script>
    $(function() {
        $('.select2').select2()
        $('#get_region').change(function() {
            var value = $(this).val();
            $('#get_adress').load('../function/get_adress.php', {
                value: value
            });
        });
        $('#available').change(function() {
            var value = $(this).val();
            if (value == 9) {
                $('#regions').css('display', 'block');

            }
        });
    });



</script>
