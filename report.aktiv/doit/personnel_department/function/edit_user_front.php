<?include ("../../../bd.php");
if(!isset($fio)) header('Location: /');

function getUserIdByLogin(string $login)
{
    return R::getCell('SELECT id FROM users WHERE email=:email LIMIT 1', [':email' => $login]);
};


if (!empty($_POST['new_login'])) {
    $positions = [1 => 'Комиссионер', 2 => 'Кассир', 3 => 'Менеджер по продажам'];
    $user_id = getUserIdByLogin($_POST['new_login']);
    if (!empty($user_id) and $user_id != $_POST['user_id']) {
        $status = false;
        $message = 'Ошибка, пользователь с таким логином уже есть!';
    } else {
        $users = R::load('users', $_POST['user_id']);
        $users->region      = $_POST['region'];
        $users->login       = trim($_POST['new_login']);
        $users->email       =  $users->login;
        $users->eo          = trim($_POST['eo']);
        $users->adressfil   = $_POST['adress'];
        $users->doverennost = $_POST['doverennost'];
        $users->timework    = $_POST['timework'];
        $users->kassa    = $_POST['kassa'];
        $users->phone    = trim($_POST['phone']);
        if (empty(trim($_POST['root']))) {
            $users->position = 'Доступа нет';
        } else {
            $users->position = $positions[$_POST['root']];
        }
        $users->root        = $_POST['root'];
        $users->status        = 1;
        $users->root_user   = $_POST['r3'];
        if (!empty(trim($_POST['new_password']))) {
            $users->password    = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        }
        ###########################################
        $users->add_user    = $fio;
        $users->datareg     = date('Y-m-d H:i:s');
        R::store($users);
        $status = true;
        $message = 'Данные добавлены!';
    }
    exit(json_encode(['status' => $status, 'message' => $message]));
}
$user = R::load('users', $_POST['id']);
if ($user['root_user'] == '4') {
    $ch = 'checked';
} elseif ($user['root_user'] == '3') {
    $ch_1 = 'checked';
} else {
    $ch_2 = 'checked';
}

if (isset($user['region'])) {

    $last_user_login = R::getCell('SELECT login FROM users  WHERE login IS NOT NULL AND region = :region AND  adressfil = :adress ORDER BY datareg DESC LIMIT 1', [':region' => $user['region'], ':adress' => $user['adressfil']]);

    if ($last_user_login) {
        $last_login = explode('@', $last_user_login);
        $new_login = explode('-', $last_login[0]);

        $i = 1;
        do {
            $new_login = $new_login[0] . '-' . ($new_login[1] + $i) . '@' . $last_login[1];
            if (!getUserIdByLogin($new_login)) {
                break;
            }
            $i++;
        } while ($i <= 5);
    }
}
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="eo">Ф.И.О</label>
            <input type="text" class="form-control" id="eo" required autocomplete="off" value="<?= $user['eo']; ?>" name="eo" placeholder="Фамилия Имя Отчество">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input type="text" hidden value="<?= $user['id']; ?>" name="user_id">
            <label for="new_login">Логин пользователя</label>
            <input type="text" class="form-control" name="new_login" required value="<?= $user['login'] ?? $new_login; ?>" id="new_login" autocomplete="off" placeholder="Введите логин">
        </div>
    </div>
    <div class="col-md-6">
            <label for="new_password">Пароль</label>
            <div class="input-group">
                <input type="text" class="form-control" name="new_password" id="new_password" autocomplete="off" placeholder="Пароль">
                <span class="input-group-addon"> <button type="button" id="generator_password" class="btn-success"><i class="fa fa-refresh"></i> </button> </span>
            </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="get_region">Город</label>
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
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="get_adress">Адресс</label>
            <select id="get_adress" name="adress" required class="form-control">
                <? if ($user['adressfil']) { ?>
                    <option value="<?= $user['adressfil']; ?>"><?= $user['adressfil']; ?></option>
                <? } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="kassa">Адресс</label>
            <select id="kassa" name="kassa" required class="form-control">
                <? if ($user['kassa']) { ?>
                    <option value="<?= $user['kassa']; ?>"><?= $user['kassa']; ?></option>
                <? } ?>
                <option value="Касса 1">Касса 1</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="root">Доступ</label>
            <select id="root" name="root" class="form-control">
                <? if (!empty($user['position'])) { ?>
                    <option value="<?= $user['root']; ?>"><?= $user['position']; ?></option>
                <? }
                $users = R::findAll('users', 'NOT root IS NULL GROUP BY position');
                foreach ($users as $key) {
                    echo "<option value='{$key['root']}'>{$key['position']}</option>";
                } ?>
                <option value="">Убрать доступ</option>
            </select>
        </div>
        <div class="form-group ">
            <label for="doverennost">Доверенность</label>
            <input type="text" required class="form-control" name="doverennost" value="<?= $user['doverennost']; ?>" id="doverennost" autocomplete="off" placeholder="Д-84 от 31.12.2020">
        </div>
    </div>
    <div class="col-md-6">


        <div class="form-group">
            <label for="timework">Время работы</label>
            <input type="text" required class="form-control" name="timework" value="<?= $user['timework']; ?>" id="timework" autocomplete="off" placeholder="с 9:00 до 20:00">
        </div>
        <div class="form-group">
            <label for="phone">Мобильный номер филиала</label>
            <input type="phone" required class="form-control" name="phone" value="<?= $user['phone']; ?>" id="phone" autocomplete="off" placeholder="+7 777 996 99 96 ">
        </div>
    </div>
    <div class="col-md-6" id="radio" style="display: none;">
        <!-- radio -->
        <div class="form-group">
            <label>
                <input type="radio" name="r3" value="3" <?= $ch_1 ?? ''; ?> class="flat-green">
                <span class="small">Доступ к реализации всех товаров</span>
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="radio" name="r3" value="4" <?= $ch ?? ''; ?> class="flat-green">
                <span class="small"> Доступ к реализации только аксесуаров</span>
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="radio" name="r3" value="0" <?= $ch_2 ?? ''; ?> class="flat-green">
                <span class="small"> Доступа к реализации нет</span>
            </label>
        </div>
    </div>

</div>
<script>
    $(function() {
        $('#get_region').change(function() {
            var region = $(this).val();
            console.log(region);
            $('#get_adress').load('./function/get_adress.php', {
                region: region
            });
        });
        $('#root').change(function() {
            var root = $(this).val();
            if (root == 1) {
                document.getElementById("radio").style.display = 'block';
            } else {
                document.getElementById("radio").style.display = 'none';
            }
        });
        $('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });

    $('#generator_password').click(function() {
        $('#new_password').val(gen_password(8));
    });

    function gen_password(len) {
        let password = "";
        let symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!№;%:?*()_+=";
        for (let i = 0; i < len; i++) {
            password += symbols.charAt(Math.floor(Math.random() * symbols.length));
        }
        return password;
    }
</script>