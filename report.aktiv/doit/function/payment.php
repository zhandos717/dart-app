<?include ("../../bd.php");
$data = $_POST;
if($data['bank']){

    $pay = R::dispense('payment');
    $pay->bank = $data['bank'];
    $pay->payment = $data['payment'];
    $pay->percent = $data['percent'];
    $pay->message = $data['message'];
    $pay->datareg = date('Y-m-d');
    $pay->timereg = date('H:i:s');
    $pay->user = $_SESSION['logged_user']->fio;
    R::store($pay);
}elseif($data['update_bank']){
    $pay = R::load('payment',$data['id_update_payment']);
    $pay->bank = $data['update_bank'];
    $pay->payment = $data['payment'];
    $pay->percent = $data['percent'];
    $pay->message = $data['message'];
    $pay->date_update = date('Y-m-d H:i:s');
    $pay->user = $_SESSION['logged_user']->fio;
    R::store($pay);

echo'<div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Успех!</h4>
        Данные были удалены!
</div>';
exit; 

}elseif($data['id_update']){
$pay = R::load('payment',$data['id_update']);
?>
<div class="row">
    <div class="col-xs-12">
        <div class="form-data">
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-bank"></i>
                    </span>
                    <select name="update_bank" class="form-control">
                        <option value="<?= $pay->bank; ?>">
                            <?= $pay->bank; ?>
                        </option>
                        <option value="Kaspi Bank">Kaspi Bank</option>
                        <option value="ForteBank">ForteBank</option>
                        <option value="Евразийский банк">Евразийский банк</option>
                        <option value="Нурбанк">Нурбанк</option>
                        <option value="Альфа-Банк">Альфа-Банк</option>
                        <option value="Хоум Кредит Банк">Хоум Кредит Банк</option>
                        <option value="Сбербанк">Сбербанк</option>
                        <option value="Народный банк Казахстана">Народный банк Казахстана</option>
                        <option value="Jýsan Bank">Jýsan Bank</option>
                        <option value="Bank RBK">Bank RBK</option>
                        <option value="Банк ВТБ">Банк ВТБ</option>
                        <option value="АТФБанк">АТФБанк</option>
                        <option value="Шинхан Банк Казахстан">Шинхан Банк Казахстан</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa  fa-cc-mastercard"></i>
                    </span>
                    <input type="text" list="payment" value="<?= $pay->payment; ?>" name="payment" class="form-control">
                    <datalist id="payment">
                        <option value="Рассрочка Шубы">Рассрочка Шубы</option>
                        <option value="Рассрочка Техника">Рассрочка Техника</option>
                        <option value="Кредит Одежда">Кредит Одежда</option>
                        <option value="Кредит Техника">Кредит Техника</option>
                        <option value="Оплата Картой">Оплата Картой</option>
                        <option value="Kaspi GOLD">Карта (Kaspi GOLD)</option>
                        <option value="Карта ForteBank">Карта ForteBank</option>
                        <option value="Смешанный способ">Смешанный способ</option>
                    </datalist>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-xs-12">
        <div class="form-data">
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon">
                        <b>%</b>
                    </span>
                    <input type="text" class="form-control" value="<?= $pay->percent; ?>" name="percent">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-align-justify"></i>
                    </span>
                    <input class="form-control" value="<?= $pay->message; ?>" name="message">
                </div>
            </div>
        </div>
    </div>
</div>
<input type="number" name="id_update_payment" value="<?= $pay->id; ?>" hidden>
<?
exit; 
}elseif($data['id_delete']){
    $pay = R::load('payment',$data['id_delete']);
    R::trash($pay);
    echo'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Успех!</h4>
                Данные были удалены!
        </div>';
exit;
}
$p = R::findAll('payment');
$i = 1;
?>
<div class=" box box-primary">
    <div class="box-header">
        <h3 class="box-title"><b><?= $comment; ?></b></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="tableas table table-hover table-bordered">
                <thead>
                    <tr class="success">
                        <th>№</th>
                        <th>Банк</th>
                        <th>Способ оплаты</th>
                        <th>Процент при использовании </th>
                        <th>Примечение</th>
                    </tr>
                </thead>
                <tbody>
                    <?foreach ($p as $value) {?>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-info btn-block update_payment" data-toggle="modal" value="<?= $value['id'] ?>" data-target="#modal-default">
                                <?= $i++ ?>.
                            </button>
                        </td>
                        <td>
                            <?= $value['bank'] ?>
                        </td>
                        <td>
                            <?= $value['payment'] ?>
                        </td>
                        <td>
                            <?= $value['percent'] ?>
                        </td>
                        <td>
                            <?= $value['message'] ?>
                        </td>
                    </tr>
                    <?}?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
</div><!-- /.box box-primary -->