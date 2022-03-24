<? include_once "../../../bd.php";
if ($_POST['codetovar']) {
    // var_dump($_POST);
    $sales = R::load('sales', $_POST['sales_id']);
    $sales->data                = $_POST['data'];
    $sales->codetovar           = $_POST['codetovar'];
    $sales->pokupatel           = $_POST['pokupatel'];
    $sales->saler               = $_POST['saler'];

    $sales->regionlombard       = $_POST['region'];
    $sales->adresslombard       = $_POST['adress'];

    $sales->summaprihod         = $_POST['summaprihod'];
    $sales->predoplata          = $_POST['predoplata'];
    $sales->summareal           = $_POST['summareal'];
    $sales->vid                 = $_POST['vid'];
    $sales->codetovar           = $_POST['codetovar'];
    $sales->pribl               = $_POST['pribl'];
    if (!empty($_POST['statustovar'])) {
        $sales->statustovar         =  $_POST['statustovar'];
    }
    //var_dump($sales);
    R::store($sales);
    exit;
}
$sale = R::load('sales', $_POST['id']);
?>
<div class="row ">
    <input type="text" hidden value="<?= $sale['id']; ?>" name="sales_id">
    <div class="col-md-4">
        <div class="form-group">
            <label for="data">Дата отчета:</label>
            <input type="date" class="form-control" required name="data" value="<?= $sale['data']; ?>" id="data">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="codetovar">Код товара:</label>
            <input class="form-control" id="codetovar" type="text" name="codetovar" value="<?= $sale['codetovar']; ?>" placeholder="00-00" required="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="get_region">Город:</label>
            <select id="get_region" name="regionlombard" class="form-control" required>
                <? if ($sale['regionlombard']) { ?>
                    <option><?= $sale['regionlombard']; ?></option>
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
    <div class="col-md-4">
        <div class="form-group">
            <label for="adress">Филиал:</label>
            <select id="adress" name="adresslombard" class="form-control">
                <? if ($sale['adresslombard']) { ?>
                    <option><?= $sale['adresslombard']; ?></option>
                <? } ?>
                <option value="">Выберите город</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="summaprihod">Приходная сумма:</label>
            <input class="form-control" id="summaprihod" value="<?= $sale['summaprihod']; ?>" type="number" name="summaprihod">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="count_payment">К-во способов оплаты:</label>
            <select name="count_payment" class="form-control" id="count_payment">
                <option value="">Выберите количество</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
        </div>
    </div>
    <div id="payment_answer">

    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="tovarname">Наименование:</label>
            <textarea class="form-control" id="tovarname" name="tovarname" required><?= $sale['tovarname'] ?></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="saler">Продавец (ФИО):</label>
            <select name="saler" id="saler" class="form-control">
                <? if ($sale['saler']) : ?>
                    <option><?= $sale['saler'] ?></option>
                <? endif; ?>
                <? $salers = R::getCol("SELECT fiosaler FROM saler WHERE region = '{$sale['region']}' AND shop = '{$sale['adress']}'");
                foreach ($salers as $saler) {
                    echo "<option>{$saler}</option>";
                } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="pokupatel">ФИО покупателя:</label>
            <input class="form-control" id="pokupatel" value="<?= $sale['pokupatel']; ?>" type="text" name="pokupatel" required="">
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#summareal').keyup(function() {
            var summaprihod = Number($('#summaprihod').val());
            var summareal = Number($(this).val());
            $('#pribl').val(summareal - summaprihod);
        });
        $('#get_region').change(function() {
            var region = $(this).val();
            console.log(region);
            $('#adress').load('./functions/get_adress.php', {
                value: region
            });
        });
    });
</script>