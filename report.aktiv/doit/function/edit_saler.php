<? include("../../bd.php");


if(!empty($_POST['fiosaler'])){
var_dump($_POST);
    $users = R::load('saler',$_POST['user_id']);    
    $users->region      = $_POST['region'];
    $users->fiosaler          = $_POST['fiosaler'];
    $users->shop        = $_POST['shop'];
    $users->add_user    = $fio;
    $users->datareg     = date('Y-m-d H:i:s');
    R::store($users);
 exit;
}
$user = R::load('saler',$_POST['id']);
?>

<div class="row">
    <input type="text" name="user_id" value="<?= $user['id']; ?>" hidden>
    <div class="col-md-6">
        <div class="form-group">
            <label for="fiosaler">Ф.И.О</label>
            <input type="text" class="form-control" id="fiosaler" required autocomplete="off" value="<?= $user['fiosaler']; ?>" name="fiosaler" placeholder="Фамилия Имя Отчество">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="get_region">Город</label>
            <select id="get_region" name="region" required class="form-control">
                <?if($user['region']){?>
                <option value="<?= $user['region']; ?>"><?= $user['region']; ?></option>
                <?}else{?>
                <option value="">Выберите город</option>
                <?}
        $city = R::findAll('diruser','GROUP BY region');
        foreach ($city as $key) {
            echo "<option value='{$key['region']}'>{$key['region']}</option>";
        }?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="adress">Адресс</label>
            <select id="adress" name="shop" required class="form-control">
                <?if($user['shop']){?>
                <option value="<?= $user['shop']; ?>"><?= $user['shop']; ?></option>
                <?}?>
            </select>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#get_region').change(function() {
            var region = $(this).val();
            console.log(region);
            $('#adress').load('./function/get_adress.php', {
                value: region
            });
        });
    });
</script>