<? include("../../../bd.php");
if (!empty($_POST['adress'])) {

    if ($_POST['branch_id'])
        $branche = R::load('branches', $_POST['branch_id']);
    else
        $branche = R::dispense('branches');

    $branche->code_branche      = $_POST['code'];
    $branche->bin               = $_POST['bin'];
    $branche->name              = $_POST['name'];
    $branche->region            = $_POST['region'];
    $branche->adress            = $_POST['adress'];
    $branche->phone             = $_POST['phone'];
    $branche->director          = $_POST['director'];
    $branche->iik               = $_POST['iik'];
    $branche->bank              = $_POST['bank'];
    $branche->discription       = $_POST['discription'];
    $branche->add_user          = $fio;
    $branche->datareg           = date('Y-m-d H:i:s');
    R::store($branche);

    exit(json_encode(['message' => 'Данные добавлены']));
}
$branch = R::load('branches', $_POST['id']);
?>

<div class="row">
    <input type="text" name="branch_id" value="<?= $branch['id']; ?>" hidden>
    <div class="col-md-3">
        <div class="form-group">
            <label for="code">Код филиала</label>
            <input type="number" min='1' class="form-control" id="code" value="<?= $branch['code_branche']; ?>" name="code" placeholder="КОД">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="bin">БИН</label>
            <input type="text" class="form-control" value="<?= $branch['bin']; ?>" name="bin" id="bin">

        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label for="name">Полное наименование</label>
            <input type="text" class="form-control" name="name" value="<?= $branch['name']; ?>" id="name">
        </div>
    </div>
    <div class="col-md-6">
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
    <div class="col-md-6">
        <div class="form-group">
            <label for="adress">Адресс</label>
            <input type="text" class="form-control" value="<?= $branch['adress']; ?>" name="adress" id="adress">

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" class="form-control" value="<?= $branch['phone']; ?>" name="phone" id="phone">

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="director">Директор ФИО</label>
            <input type="text" class="form-control phone" value="<?= $branch['director']; ?>" name="director" id="director">

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="iik">ИИК</label>
            <input type="text" class="form-control" value="<?= $branch['iik']; ?>" name="iik" id="iik">

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="bank">БАНК</label>
            <input type="text" class="form-control" value="<?= $branch['bank']; ?>" name="bank" id="bank">

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="discription">Дополнительная информация</label>
            <textarea name="discription" id="discription" class="form-control"><?= $branch['discription'] ?></textarea>

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