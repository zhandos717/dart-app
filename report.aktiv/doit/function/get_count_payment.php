<? include("../../bd.php");
$pay = R::findAll('payment');
if (isset($_POST['value'])) {
    while ($i < $_POST['value']) {
        $i++; ?>

        <div class="col-md-4">
            <div class="form-group">
                <label for="vid<?= $i ?>">Вид оплаты:</label>
                <select name="vid<?= $i ?>" id="vid<?= $i ?>" required class="form-control">
                    <option value="">Выберите способ оплаты</option>
                    <? foreach ($pay as $value) { ?>
                        <option value="<?= $value['id'] ?>"><?= $value['bank'] ?>|<?= $value['payment'] ?>|<?= $value['message'] ?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="summareal<?= $i ?>">Сумма реализации:</label>
                <input class="form-control" id="summareal<?= $i ?>" type="number" name="summareal<?= $i ?>" required="">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="remainder<?= $i ?>">За минусом процентов:</label>
                <input class="form-control" id="remainder<?= $i ?>" disabled type="number" name="remainder<?= $i ?>">
            </div>
        </div>
    <? } ?>

    <script>
        function get_percent(int) {
            var value = $('#vid' + int).val();
            var money = $('#summareal' + int).val();
            $.getJSON("../function/get_count_payment.php")
                .done(function(json) {
                    $('#remainder' + int).val(money - (money / 100 * json[value]));
                })
                .fail(function(err) {
                    console.log("error" + err);
                });
        }

        function selectPayment(int) {
            $('#summareal' + int).keyup(function() {
                get_percent(int);
            });
            $('#vid' + int).change(function() {
                get_percent(int);
            });
        }
        selectPayment(1);
        selectPayment(2);
        selectPayment(3);
        selectPayment(4);
    </script>
<?
} else {
    $arr = [];
    foreach ($pay as $payments) {
        $arr[$payments['id']] = intval($payments['percent']);
    }
    echo json_encode($arr);
}
