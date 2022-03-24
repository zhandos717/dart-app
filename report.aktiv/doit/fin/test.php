<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 11) :
    $today = date('Y-m-d', strtotime($thisDate . " - 1 day"));
    $closee = true;
    $region = $_POST['region'];
    $adress = $_POST['adress'];
    if ($_POST['date1'] and $_POST['date2']) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
    } else {
        $date1 = date('2020-08-19');
        $date2 = $today;
    };
    if ($date1 and $date2) {
        if ($region != ''  and ($adress != '')) {
            $rows = R::find('tickets', "status IN(7,10,14,15)  AND region =:region AND adressfil = :adress AND dv BETWEEN :date AND :date1", [':region' => $region, ':adress' => $adress, ':date' => $date1, ':date1' => $date2]);
        } elseif ($region != '' and ($adress == '')) {
            $rows = R::find('tickets', "status IN(7,10,14,15)  AND region =:region AND dv BETWEEN :date AND :date1", [':region' => $region, ':date' => $date1, ':date1' => $date2]);
        } else {
            $rows = R::find('tickets', "status IN(7,10,14,15)  AND dv BETWEEN :date AND :date1", [':date' => $date1, ':date1' => $date2]);
        }
    } else {
        if ($region and ($adress != '')) {
            $rows = R::find('tickets', '(status = 7 OR status = 10 OR status = 14 OR status = 15) AND region =:region AND adressfil = :adress', [':region' => $region, ':adress' => $adress]);
        } elseif ($region and ($adress == 'Все')) {
            $rows = R::find('tickets', '(status = 7 OR status = 10 OR status = 14 OR status = 15) AND region =:region', [':region' => $region]);
        } else {
            $rows = R::find('tickets', 'status = 7 OR status = 10 OR status = 14 OR status = 15');
        }
    }
?>
    <? include "header.php"; ?>
    <? include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="index.php">Регионы</a></li>
                <li class="active">Филиалы</li>
            </ol>
        </section>
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Выберите филиал </h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form action="test.php" method="POST">
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="date1" value="<?= $date1; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="date2" value="<?= $date2; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-bank"></i>
                                        </span>
                                        <select class="form-control" id="region" name="region">
                                            <? if ($region) : ?>
                                                <option value="<?= $region ?>"><?= $region ?></option>
                                            <? endif; ?>
                                            <option value="">Все</option>
                                            <? $result8 = R::findAll('kassa', 'status IS NOT NULL GROUP BY region');
                                            foreach ($result8 as $data8) { ?>
                                                <option value="<?= $data8['region']; ?>"><?= $data8['region']; ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-4 -->
                                <div class=" col-lg-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select class="form-control" id="adress" name="adress"></select>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <div class="col-lg-2">
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-block btn-primary">Подтвердить</button>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <script>
                $.fn.editable.defaults.mode = 'popup';
                $(document).ready(function() {
                    $('.people-editable').editable();
                    $('.people-phone-editable').editable({
                        type: 'text',
                        tpl: '   <input type="text" class="form-control people-phone">'

                    }).on('shown', function() {
                        $("input.people-phone-editable").mask("(999) 999-9999");
                    });
                    $('.people-status-editable').editable({
                        value: 'Активный',
                        source: [{
                                value: 'Активный',
                                text: 'Активный'
                            },
                            {
                                value: 'Заблокирован',
                                text: 'Заблокирован'
                            },
                            {
                                value: 'Устарел',
                                text: 'Устарел'
                            }
                        ]
                    });
                    $('.people-date-editable').editable({
                        format: 'dd.mm.yyyy',
                        viewformat: 'dd.mm.yyyy',
                        datepicker: {
                            weekStart: 1
                        }
                    });

                    $('.people-email-editable').editable({
                        validate: function(value) {
                            if (isEmail(value)) {

                            } else {
                                return 'Введите настоящий e-mail';
                            }
                        }
                    });

                    $('.people-address-editable').editable({
                        value: {}
                    });
                });

                function isEmail(email) {
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    return regex.test(email);
                }
            </script>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Товары на исполнении <?= $adress; ?></h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="datatable-tabletools" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="info">
                                        <th style="width:5rem;">№ЗБ</th>
                                        <th style="width:10rem;">Клиент</th>
                                        <th>Залог</th>
                                        <th style="width:5rem;">Дата выдачи</th>
                                        <th style="width:15rem;">Сумма выдачи</th>
                                        <th style="width:10rem;">Сумма продажи</th>
                                        <th style="width:8rem;">Дата выхода на реализацию</th>
                                        <th style="width:8rem;">Статус</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? foreach ($rows as $row) {
                                        $st = R::load('status_zb', $row['status']);
                                    ?>
                                        <tr>
                                            <td> <?= $row['nomerzb']; ?></a> </td>
                                            <td> <?= $row['fio']; ?> <br> Тел:<?= $row['phones']; ?> </td>
                                            <td> <?= $row['category']; ?> <?= $row['tovarname']; ?> <?= $row['opisanie']; ?> <?= $row['hdd']; ?> <?= $row['sostoyanie_bu']; ?> <?= $row['upakovka']; ?> <?= $row['ekran']; ?> <?= $row['korpus']; ?>
                                                SN: <?= $row['sn']; ?>, IMEI:<?= $row['imei']; ?>, <?= $row['complect']; ?>
                                            </td>
                                            <td> <?= date("d.m.Y", strtotime($row['reg_data'])); ?></td>
                                            <td> <?= number_format($row['summa_vydachy'], 0, '.', ' '); ?></td>
                                            <td><a href="#" class="people-editable" data-name="cena_pr" data-type="text" data-title="Введите цену" data-pk="<?= $row['id']; ?>" data-url="ajax.php"><?= $row['cena_pr']; ?></a></td>
                                            <td> <?= date("d.m.Y", strtotime($row['dv'])); ?></td>
                                            <td> <?= $st['name']; ?></td>
                                        </tr>
                                    <? } ?>
                                </tbody>
                                <!-- <tr>
                                    <td><a href="#" class="people-editable" data-name="nomerzb" data-type="text" data-pk="<?= $row['id']; ?>" data-url="ajax.php"><?= $row['nomerzb']; ?></a></td>
                                    <td><a href="#" class="people-editable" data-name="fio" data-type="text" data-title="Имя" data-pk="<?= $row['id']; ?>" data-url="ajax.php"><?= $row['fio']; ?></a></td>
                                    <td><a href="#" class="people-phone-editable" data-inputclass="phone-mask" data-name="phones" data-type="text" data-pk="<?= $row['id']; ?>" data-url="ajax.php"><?= $row['phones']; ?></a></td>
                                    <td><?= $row['category']; ?> <?= $row['tovarname']; ?> <?= $row['opisanie']; ?> <?= $row['hdd']; ?> <?= $row['sostoyanie_bu']; ?> <?= $row['upakovka']; ?> <?= $row['ekran']; ?> <?= $row['korpus']; ?>
                                        SN: <?= $row['sn']; ?>, IMEI:<?= $row['imei']; ?>, <?= $row['complect']; ?></td>
                                    <td><a href="#" class="people-date-editable" data-name="dataseg" data-type="date" data-pk="<?= $row['id']; ?>" data-url="ajax.php"><?= date('d.m.Y', strtotime($row['dataseg'])); ?></a></td>
                                    <td><a href="#" class="people-address-editable" data-name="address" data-type="address" data-pk="<?= $row['id']; ?>" data-url="ajax.php"><?= $row['adress']; ?></a></td>
                                    <td><a href="#" class="people-status-editable" data-name="status" data-type="select" data-pk="<?= $row['id']; ?>" data-url="ajax.php"><?= $row['status']; ?></a></td>
                                </tr> -->
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
    </div><!-- /.row -->
    </section>
    <? unset($region, $adress);
    include "footer.php"; ?>
<? endif; ?>