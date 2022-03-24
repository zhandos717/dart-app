<? include("../../../bd.php");
if (isset($_POST['branch_id']) && is_numeric($_POST['branch_id'])) {
    // $branche = R::load('branches', $_POST['branch_id']);

    // $branche->code_branche      = $_POST['code'];
    // $branche->bin               = $_POST['bin'];
    // $branche->name              = $_POST['name'];
    // $branche->region            = $_POST['region'];
    // $branche->adress            = $_POST['adress'];
    // $branche->phone             = $_POST['phone'];
    // $branche->director          = $_POST['director'];
    // $branche->iik               = $_POST['iik'];
    // $branche->bank              = $_POST['bank'];
    // $branche->discription       = $_POST['discription'];
    // $branche->add_user          = $fio;
    // $branche->datareg           = date('Y-m-d H:i:s');
    // R::store($branche);

    exit(json_encode(['message' => 'Данные добавлены']));
}
$branch = R::load('kassa', $_POST['id']);
?>

<div class="row">
    <input type="text" name="branch_id" value="<?= $branch['id']; ?>" hidden>
    <div class="col-md-2">
        <div class="form-group">
            <label for="code">Код</label>
            <input type="number" min='1' class="form-control" id="code" value="<?= $branch['codefil']; ?>" name="codefil" placeholder="КОД">
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label for="get_region">Город</label>
            <select id="get_region" name="region" required class="form-control">
                <? if ($branch['region']) { ?>
                    <option value="<?= $branch['region']; ?>"><?= $branch['region']; ?></option>
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
    <div class="col-md-5">
        <div class="form-group">
            <label for="filial">Адресс</label>
            <input type="text" class="form-control" value="<?= $branch['filial']; ?>" name="filial" id="filial">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="kassa">Касса</label>
            <input type="text" class="form-control" value="<?= $branch['kassa']; ?>" name="kassa" id="kassa">
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" class="form-control" value="<?= $branch['phone']; ?>" name="phone" id="phone">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="swk">Заводской номер</label>
            <input type="text" class="form-control" value="<?= $branch['swk']; ?>" name="swk" id="swk">

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Статус кассы</label>

            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" class="form-control"> Text
                </label>
            </div>

            <input type="text" class="form-control" value="<?= $branch['statuskassa']; ?>" name="statuskassa" id="statuskassa">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="company_id">Компания</label>
            <select name="company_id" class="form-control" id="">
                <?
                $company = [1 => 'OBS', 2 => 'TBS'];
                foreach ($company as $key => $value) : ?>
                    <option value="<?= $key; ?>" <? if ($key == $branch['company_id']) {
                                                        echo 'selected';
                                                    } ?>><?= $value; ?> </option>
                <? endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="text">Дополнительная информация</label>
            <textarea name="text" id="text" class="form-control"><?= $branch['text'] ?></textarea>

        </div>
    </div>
</div>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        [].forEach.call(document.querySelectorAll('.phone'), function(input) {
            var keyCode;

            function mask(event) {
                event.keyCode && (keyCode = event.keyCode);
                var pos = this.selectionStart;
                if (pos < 3) event.preventDefault();
                var matrix = "+7 (___) ___ ____",
                    i = 0,
                    def = matrix.replace(/\D/g, ""),
                    val = this.value.replace(/\D/g, ""),
                    new_value = matrix.replace(/[_\d]/g, function(a) {
                        return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                    });
                i = new_value.indexOf("_");
                if (i != -1) {
                    i < 5 && (i = 3);
                    new_value = new_value.slice(0, i)
                }
                var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                    function(a) {
                        return "\\d{1," + a.length + "}"
                    }).replace(/[+()]/g, "\\$&");
                reg = new RegExp("^" + reg + "$");
                if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
                if (event.type == "blur" && this.value.length < 5) this.value = ""
            }
            input.addEventListener("input", mask, false);
            input.addEventListener("focus", mask, false);
            input.addEventListener("blur", mask, false);
            input.addEventListener("keydown", mask, false)
        });
    });
</script>