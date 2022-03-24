<?php
include("../../../bd.php");
if(!isset($fio)) header('Location: /');


if (!empty($_POST['new_login'])) {
    $users = R::load('diruser', $_POST['user_id']);
    $users->region = $_POST['region'];
    $users->login = trim($_POST['new_login']);
    $users->fio = $_POST['fio'];
    $users->doljnost = $_POST['doljnost'];
    $users->adress = $_POST['adress'];
    $users->status = $_POST['status'];
    $users->add_user = $fio;
    if (!empty(trim($_POST['new_password']))) {
        $users->password    = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    }
    $users->add_data = date('Y-m-d H:i:s');
    $id = R::store($users);
    if (!empty($_POST['regions'])) {
        $access = R::load('access', $id);
        $access->regions = implode(";", $_POST['regions']); //регионы
        $access->userid = $id;
        $access->timedate = date('Y-m-d H:i:s');
        $access->add_user = $fio;
        R::store($access);
    }
}
$user = R::load('diruser', $_POST['id']);
?>
<div class="form-group">
    <input type="text" hidden value="<?= $user['id']; ?>" name="user_id">
    <label for="new_login">Логин пользователя</label>
    <input type="text" class="form-control" name="new_login" required value="<?= $user['login']; ?>" id="new_login" autocomplete="off" placeholder="Введите логин">
</div>
<div class="form-group">
    <label for="new_password">Пароль</label>
    <div class="input-group">
        <input type="text" class="form-control" name="new_password" id="new_password" autocomplete="off" placeholder="Пароль">
        <span class="input-group-addon"> <button type="button" id="generator_password" class="btn-success"><i class="fa fa-refresh"></i> </button> </span>
    </div>
</div>
<div class="form-group">
    <label for="fio">Ф.И.О</label>
    <input type="text" class="form-control" id="fio" required autocomplete="off" value="<?= $user['fio']; ?>" name="fio" placeholder="Фамилия Имя Отчество">
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
    <label for="available">Доступ</label>
    <select id="available" name="status" required class="form-control">
        <?
        $available = R::findAll('available');
        foreach ($available as $key) {
            if ($user['status'] == $key['id']) {
                echo "<option value='{$key['id']}'>{$key['name']}</option>";
            }
        }
        echo "<option value=''>Закрыть доступ</option>";
        foreach ($available as $key) {
            echo "<option value='{$key['id']}'>{$key['name']}</option>";
        } ?>
    </select>
</div>
<div class="form-group" style="display:none" id='regions'>
    <label>Доступ на регионы</label>
    <select class="form-control select2" name="regions[]" multiple="multiple" data-placeholder="Выберите доступ на регионы" style="width: 100%;">
        <? if ($user['region']) { ?>
            <option><?= $user['region']; ?></option>
        <? } else { ?>
            <option value="">Выберите город</option>
        <? }
        $city = R::findAll('diruser', 'GROUP BY region');
        foreach ($city as $key) {
            echo "<option value='{$key['region']}'>{$key['region']}</option>";
        } ?>
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
    $('#generator_password').click(function (){
        $('#new_password').val(gen_password(8));
    });

    function gen_password(len){
        let password = "";
        let symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!№;%:?*()_+=";
        for (let i = 0; i < len; i++){
            password += symbols.charAt(Math.floor(Math.random() * symbols.length));
        }
        return password;
    }

</script>