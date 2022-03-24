    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>База данных клиентов </h1>
        <!-- <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php">Регионы</a></li>
          <li class="active">Филиалы</li>
        </ol> -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-danger">
              <div class="box-body">
                <div class="input-group input-group-sm">
                  <input type="text" id="search" class="form-control">
                  <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" id="go" type="button">Go!</button>
                  </span>
                </div><!-- /input-group -->
              </div>
            </div> 
          </div>
          <div class="col-md-12">
            <div class="box box-primary">
              <!--<div class="box-header">
                  <h3 class="box-title">Проторгованные товары123</h3>
                </div> /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>№</th>
                        <th>Адрес</th>
                        <th>Номер договора</th>
                        <th>Данные клиента клиента</th>
                        <th>Наименование</th>
                        <th>Сумма выдачи</th>
                        <th>Дата выдачи</th>
                        <th>Срок</th>
                        <th>Статус</th>
                        <th>Дата выкупа</th>
                        <th>Подробнее</th>
                      </tr>
                    </thead>
                    <tbody>
                      <? $i = 1;
                      $result = R::findLike('tickets', ['status' => [2]], 'LIMIT 150');
                      foreach ($result as $row) {
                        $statuszb = R::load('status_zb', $row['status']);
                      ?>
                        <tr>
                          <td><?= $i++; ?></td>
                          <td><?= $row['region']; ?> / <?= $row['adressfil']; ?> </td>
                          <td><?= $row['nomerzb']; ?></td>
                          <td><?= $row['fio']; ?> <br>ИИН: <?= $row['iin']; ?> </td>
                          <td><?= $row['type']; ?> <?= $row['category']; ?> <?= $row['tovarname']; ?> <?= $row['opisanie']; ?> </td>
                          <td><?= $row['summa_vydachy']; ?></td>
                          <td><?= date('d.m.Y', strtotime($row['dataseg'])); ?></td>
                          <td><?= $row['srok']; ?></td>
                          <td><?= $statuszb['name']; ?></td>
                          <td><?= date('d.m.Y', strtotime($row['dv'])); ?></td>
                          <td> <a href="index.php?id=2&did=<?= $row['id']; ?>" class="btn btn-success btn-block"> <i class="fa fa-file-text-o"></i> </a> </td>
                        </tr>
                      <? } ?>
                    </tbody>
                  </table>
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col-md-6 -->
        </div><!-- /.content-wrapper -->
      </section>
    </div>
    <script>
      $(function() {
        $('#go').click(function() {
          var search = $('#search').val();
          $.post('./functions/search.php', {
              search: search
            })
            .done(function(data) {
              $('.table-responsive').html(data + search);
            })
        })
      });
    </script>