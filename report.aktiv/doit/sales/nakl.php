<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 5) :
  $active = 'active';
  include "header.php";
  include "menu.php";
  $idx = $_POST['idx'];
  $status_sklad = $_POST['status_sklad'];
  if ($status_sklad == 10) // Передача в склад
  {
    $tickets = R::load('tickets', $idx);
    $tickets->data_pos = date('Y-m-d');
    $tickets->status = $status_sklad;
    R::store($tickets);
  }
  unset($status_sklad);
  $table = R::findAll('tickets', 'status = 7 AND region = ?', [$region]);
?>
  <div class="content-wrapper no-print">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!--------------------------------------------------------------------------->
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title pull-left">Товары на исполнении </h3>
            </div><!-- /.box-header -->
            <!-- search form -->
            <div class="box-body ">
              <!-- search form -->
              <!-- /.search form -->
              <div class="table-responsive">
                <table class="tableas1 table table-hover" id="example1">
                  <thead>
                    <tr class="success">
                      <th class="text-center">№</th>
                      <th class="text-center">Регион</th>
                      <th class="text-center">Адресс</th>
                      <th>№ЗБ</th>
                      <th>Дата выхода</th>
                      <th class="text-center">Описание имущества</th>
                      <th style="white-space: nowrap;" class="warning">Сумма кредита</th>
                      <th style="white-space: nowrap;" colspan="2" class="danger">Сумма продажи</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?
                    $i = 1;
                    foreach ($table as $data3) {
                    ?>
                      <tr>
                        <td class="success"> <?= $i++; ?>. </td>
                        <th><?= $data3['region']; ?></th>
                        <th><?= $data3['adressfil']; ?></th>
                        <td> <?= $data3['nomerzb']; ?> </td>
                        <td><?= date("d.m.Y", strtotime($data3['dv'])); ?></td>
                        <td> <?= $data3['category']; ?>, <?= $data3['tovarname']; ?> <?= $data3['hdd']; ?> <?= $data3['sostoyanie_bu']; ?> <?= $data3['upakovka']; ?> <?= $data3['ekran']; ?> <?= $data3['korpus']; ?>
                          SN: <?= $data3['sn']; ?>, IMEI:<?= $data3['imei']; ?>, <?= $data3['complect']; ?> <?= $data3['opisanie']; ?>
                        </td>
                        <td class="warning"><?= number_format($data3['summa_vydachy'], 0, '.', ' ');
                                            $summa_vydachy += $data3['summa_vydachy']; ?> </td>
                        <td class="danger"><?= number_format($data3['cena_pr'], 0, '.', ' ');
                                            $cena_pr += $data3['cena_pr']; ?> </td>
                        <td class="success">
                          <form action="nakl.php" method="POST">
                            <input name="idx" hidden value="<?= $data3['id']; ?>">
                            <input name="status_sklad" hidden value="10">
                            <button type="submit" class="btn btn-success" title="Принять"><i class="fa fa-check"></i></button>
                          </form>
                        </td>
                      </tr>
                    <? } ?>
                  </tbody>
                  <!--------------------------------------Товар на витрине------------------------------------->
                  <tfoot>
                    <tr>
                      <th colspan="6" class=" danger text-center">Итого </th>
                      <th class="warning"><?= number_format($summa_vydachy, 0, '.', ' '); ?> тг.</th>
                      <th colspan="2" class="danger"><?= number_format($cena_pr, 0, '.', ' '); ?> тг.</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col-md-12 -->
      </div><!-- /.content-wrapper -->
    </section>
  </div>
<?
  include "footer.php";
else :
  header('Location:/');
endif; ?>