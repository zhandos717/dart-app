<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 11) :   //если сущесттвует пользователь

  if (!empty($_POST['cena_pr'])) {
    $tickets = R::load('tickets', $_POST["id"]);
    $tickets->status = $_POST['status'];
    $tickets->cena_pr = trim($_POST['cena_pr']);
    R::store($tickets);
    $message = 'Успешно изменен!';
  }

  if (!empty($_GET['nomerzb']))
    $data_zb = R::findOne('tickets', 'nomerzb=:nomerzb', [':nomerzb' => trim($_GET['nomerzb'])]);


  include "header.php";
  include "menu.php"; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Результаты поиска:
      </h1>
      <br />
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная </a></li>
      </ol>
    </section>
    <!--###################################################-->
    <section class="content">
      <? if ($message) { ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4> <i class="icon fa fa-check"></i> Успех!</h4>
              <?= $message; ?>
            </div>
          </div>
        </div>
      <? unset($message);
      }; ?>
      <!--###################################################-->
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box">
            <form method="GET" action="">
              <div class="input-group">
                <input type="text" class="form-control" value="<?= $_GET['nomerzb'] ?>" placeholder="введите номер договора" name="nomerzb" />
                <span class="input-group-btn">
                  <input type="submit" class="btn btn-info btn-flat" value="Поиск по товарам" />
                </span>
              </div><!-- /input-group -->
            </form>
          </div>
        </div>
        <? if (!empty($data_zb)) : ?>
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-danger">
              <div class="box-body">
                <form action="" method="POST">
                  <table class="table table-bordered">
                    <tbody>
                      <?
                      $status = [
                        1 => 'Сформирован', 2 => 'Выдан кредит', 3 => 'Пролонгирован',
                        4 => 'Полный возврат кредита', 5 => 'Полная реализация', 6 => 'На гарантийном сроке',
                        7 => 'На исполнении у эксперта', 8 => 'На исполнении у директора', 9 => 'Частично находится  на реализации',
                        10 => 'Находится на складе магазина', 11 => 'Заблокированный', 12 => 'Изъято',
                        13 => 'На балансе у компании', 14 => 'На витрине', 15 => 'На ремонте'
                      ]
                      ?>
                      <tr>
                        <th>
                          Номер договора
                        </th>
                        <th>
                          <?= $data_zb['nomerzb']; ?>
                        </th>
                      </tr>
                      <tr>
                        <th>
                          Регион/Адресс/Касса
                        </th>
                        <th>
                          <?= $data_zb['region']; ?>/
                          <?= $data_zb['adressfil']; ?>/
                          <?= $data_zb['kassa']; ?>
                        </th>
                      </tr>
                      <tr>
                        <th>
                          Сотрудник
                        </th>
                        <th>
                          <?= $data_zb['eo']; ?>
                        </th>
                      </tr>
                      <tr>
                        <th>
                          Клиент
                        </th>
                        <th>
                          <?= $data_zb['fio']; ?>
                        </th>
                      </tr>
                      <tr>
                        <th>
                          Дата выдачи
                        </th>
                        <th>
                          <?= $data_zb['dataseg']; ?>
                        </th>
                      </tr>
                      <tr>
                        <th>
                          Наименование имущества
                        </th>
                        <td>
                          <?= $data_zb['type']; ?> <?= $data_zb['category']; ?> <?= $data_zb['tovarname']; ?>
                          <?= $data_zb['opisanie']; ?>
                        </td>
                      </tr>
                      <tr>
                        <th>
                          Срок залога
                        </th>
                        <td>
                          <?= $data_zb['srok']; ?> Д.
                        </td>
                      </tr>
                      <tr>
                        <th>
                          IMEI/SN
                        </th>
                        <td>
                          <?= $data_zb['sn']; ?> <?= $data_zb['imei']; ?>
                        </td>
                      </tr>
                      <tr>
                        <th>
                          Сумма выдачи
                        </th>
                        <td>
                          <?= $data_zb['summa_vydachy']; ?>
                        </td>
                      </tr>
                      <tr>
                        <th>
                          Статус товара
                        </th>
                        <td>
                          <select name="status" class="form-control" id="">
                            <option value="<?= $data_zb['status']; ?>"><?= $status[$data_zb['status']]; ?></option>
                            <? $i = 0;
                            while ($i <= 14) {
                              $i++;
                              if ($i != $data_zb['status']) { ?>
                                <option value="<?= $i; ?>"><?= $status[$i]; ?></option>
                            <? }
                            } ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <th>
                          Цена товара
                        </th>
                        <td>
                          <input type="number" name='cena_pr' class="form-control" value='<?= $data_zb['cena_pr']; ?>'>
                        </td>
                      </tr>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="2">
                          <button class="btn btn-block bg-olive" value="<?= $data_zb['id'] ?>" type="submit" name="id">
                            <i class="fa fa-check"></i>
                            Подтвердить
                          </button>
                        </th>
                      </tr>
                    </tfoot>
                  </table>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">График изменения цены на товар </h3>

                <div class="box-tools">

                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <table class="table table-hover" id="example3">
                  <thead>
                    <tr>
                      <th>№</th>
                      <th>Дата</th>
                      <th>Цена товара</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?
                    $i = 1;
                    $d = 1;
                    $a = 1;
                    $seg = $data_zb['dataseg'];
                    $day = $data_zb['srok'];
                    while ($i <= $day) {
                    ?>
                      <tr>
                        <td style="text-align:center;"><?= $i++; ?>.</td>
                        <td style="text-align:center;">
                          <? $date = date_create($seg);
                          date_modify($date, $d++ . 'day');
                          $yesterday = date_format($date, 'd.m.Y'); ?>
                          <?= $yesterday; ?>
                        </td>
                        <td style="padding-left:10px;">
                          <? $summ_dolga = $data_zb['summa_vydachy'] + ($data_zb['summa_vydachy'] * (0.04 + (($a++) / 100)));
                          echo number_format($summ_dolga, 0, '.', ' '); ?> тенге

                        </td>
                      </tr>
                    <? } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

        <? else : ?>
          <div class="col-md-12">
            <p> Ничего не найдено! </p>
          </div>

        <? endif; ?>
      </div><!-- /.row -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <? include "footer.php"; ?>
<? else :
  header('Location: /index.php');
endif; ?>