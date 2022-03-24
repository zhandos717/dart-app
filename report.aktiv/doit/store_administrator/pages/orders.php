<?
include "pages/layouts/header.php";?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Заказы
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Таблица заказов</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>№</th>
                    <th>Номер заказа</th>
                    <th>Клиент</th>
                    <th>Номер телефона</th>
                    <th>Адрес</th>
                    <th>Сообщение</th>
                    <th>Время заказа</th>
                    <th>Статус заказа</th>
                    <th>Примечание</th>
                  </tr>
                </thead>
                <tbody>
                  <?
                  $orders = R::findall('zakaz','ORDER BY id DESC');
                  $i = 1;
                  foreach ($orders as $key) {?>
                  <tr>
                    <td> <?= $i++ ?></td>
                    <td><?= $key['numberzakaz']; ?></td>
                    <td><?= $key['fio']; ?></td>
                    <td><?= $key['tel']; ?></td>
                    <td> <?= $key['city']; ?> <?= $key['adres']; ?></td>
                    <td><?= $key['message']; ?>
                      <?= $key['tovarname']; ?> :
                      <?= $key['cena']; ?>
                    </td>
                    <td><?= date('H:i:s d.m.Y', strtotime($key['segdata'])) ?></td>
                    <td> <button class="btn btn-warning edit" data-id="<?= $key['id']; ?>" data-toggle="modal" data-target="#modal-default"> <?= $key['status']; ?> </button> </td>
                    <td><?= $key['description']; ?></td>
                  </tr>
                  <? }?>
                </tbody>
                <tfoot>

                </tfoot>
              </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="./function/edit_order.php" enctype="multipart/form-data" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Окно редактирования заказа</h4>
        </div>
        <div class="modal-body">
          <p>Подождите идет загрузка&hellip;</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Закрыть</button>
          <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<script>
  $(document).ready(function() {
    $('.edit').click(function() {
      var id = $(this).data('id');
      $.post('function/edit_order.php', {
          id: id
        })
        .done(function(data) {
          $('.modal-body').html(data);
        })
    })
  })
</script>




<? include "pages/layouts/footer.php"; ?>