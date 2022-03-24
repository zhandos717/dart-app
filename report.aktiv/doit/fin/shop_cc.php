<?
$p = R::findAll('payment');
$i = 1;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Способы оплаты
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="index.php">Регионы</a></li>
            <li class="active">Филиалы</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Выберите период</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="functions/payment.php" method="POST">
                            <div class="col-lg-2 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-bank"></i>
                                    </span>

                                    <select name="bank" class="form-control">
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
                            <div class="col-lg-2 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa  fa-cc-mastercard"></i>
                                    </span>
                                    <input type="text" list="payment" name="payment" class="form-control">
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
                            <div class="col-lg-2 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <b>%</b>
                                    </span>
                                    <input type="text" class="form-control" id="List2" name="percent">
                                </div>
                            </div>
                            <div class="col-lg-4 ">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-align-justify"></i>
                                    </span>
                                    <input class="form-control" name="message">
                                </div>
                            </div>
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info">Подтвердить!</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--.col-md-12 -->
            <div class="col-md-12 answer">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="tableas table table-hover table-bordered">
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
                                    <? foreach ($p as $value) { ?>
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
                                    <? } ?>
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="functions/payment.php" id="update_pay" method="post">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Редактирование способа оплаты</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="overlay">
                                                    <i class="fa fa-refresh fa-spin"></i>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Закрыть</button>
                                                <button type="button" class="btn btn-danger delete_payment">Удалить</button>
                                                <button type="button" class="btn btn-success submit">Сохранить</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            <!-- /.modal -->
                        </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                </div><!-- /.box box-primary -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.content-wrapper -->
    </section>
</div>