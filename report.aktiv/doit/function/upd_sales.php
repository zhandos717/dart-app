<? include_once "../../bd.php";
if ($_POST['codetovar']) {
    // var_dump($_POST);
    $sales = R::load('sales', $_POST['sales_id']);
    $sales->data                = $_POST['data'];
    $sales->codetovar           = $_POST['codetovar'];
    $sales->pokupatel           = $_POST['pokupatel'];
    $sales->saler               = $_POST['saler'];

    $sales->regionlombard       = $_POST['regionlombard'];
    $sales->adresslombard       = $_POST['adresslombard'];

    for ($i = 1; $i <= $_POST["count_payment"]; $i++) {
        $payment = R::load('payment', $_POST['vid' . $i]);
        
        $sales['summareal' . $i] = $_POST['summareal' . $i];
        $sales['vid' . $i] = $payment['bank'] . '|' . $payment['payment'];
        
        $vid .= $i . ')' . $payment['bank'] . '|' . $payment['payment'] . "\n";
        $summareal += $_POST['summareal' . $i];
        $remainder += $_POST['summareal' . $i] - ($_POST['summareal' . $i] / 100 * $payment['percent']);
    };

    $sales->summareal =  intval($summareal);
    $sales->remainder =  intval($remainder);

    $sales->summaprihod         = $_POST['summaprihod'];
    $sales->predoplata          = $_POST['predoplata'];
    $sales->vid                 = $_POST['vid'];
    $sales->codetovar           = $_POST['codetovar'];
    $sales->pribl               = $sales->summareal - $sales->summaprihod;
    if (!empty($_POST['statustovar'])) {
        $sales->statustovar         =  $_POST['statustovar'];
    }
    R::store($sales);
    exit;
}
$sale = R::load('sales', $_POST['id']);
?>
<div class="row">
    <input type="text" name="sales_id" hidden value="<?= $sale->id ?>">
    <div class="box-body">
        <div class="row ">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="data">Дата отчета:</label>
                    <input class="form-control" id="data" type="date" name="data" min="<?= date('Y-m-01'); ?>" value="<?= $sale['data']; ?>" max="<?= date('Y-m-d'); ?>" required>
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
                    <label for="regionlombard">Город:</label>
                    <select id="regionlombard" name="regionlombard" class="form-control" required>
                        <? if ($sale['regionlombard']) : ?><option><?= $sale['regionlombard']; ?></option>
                        <? else : ?>
                            <option value="">Выберите филиал</option>
                        <? endif; ?>
                        <? $regions = R::getCol('SELECT region FROM diruser GROUP BY region');
                        foreach ($regions as $city) { ?>
                            <option><?= $city ?></option>
                        <? } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="adresslombard">Филиал:</label>
                    <select id="adresslombard" name="adresslombard" class="form-control">
                        <? if ($sale['adresslombard']) : ?><option><?= $sale['adresslombard']; ?></option>
                        <? else : ?>
                            <option value="">Выберите филиал</option>
                        <? endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="summaprihod">Приходная сумма:</label>
                    <input class="form-control" value="<?= $sale['summaprihod']; ?>" id="summaprihod" type="number" name="summaprihod">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="count_payment">К-во способов оплаты:</label>
                    <select name="count_payment" class="form-control" id="count_payment">
                        <option value="">Выберите кл-во</option>
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
                    <textarea class="form-control" id="tovarname" name="tovarname" required><?= $sale['tovarname']; ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="saler">Продавец (ФИО):</label>
                    <select name="saler" id="saler" class="form-control">
                        <option><?= $sale['saler']; ?></option>
                        <? $salers = R::getCol("SELECT fiosaler FROM saler WHERE region = '$region' AND shop = '$adress'");
                        foreach ($salers as $saler) { ?>
                            <option><?= $saler; ?></option>
                        <? } ?>
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
    </div><!-- /.box-body -->
</div>
<script>
    $(function() {
        $('#count_payment').change(function() {
            var count = $(this).val();
            $('#payment_answer').load('../function/get_count_payment.php', {
                value: count
            });
        });

        $('#regionlombard').change(function() {
            var region = $(this).val();
            console.log(region);
            $('#adresslombard').load('../function/get_adress.php', {
                value: region
            });
        });


    });
</script>