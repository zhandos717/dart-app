  <?
  $regions = R::getCol('SELECT DISTINCT region FROM kassa WHERE status =1');
  ?>
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
                  <button class="btn btn-info btn-flat" id="go" type="button">Поиск!</button>
                </span>
              </div><!-- /input-group -->
            </div>
          </div>
        </div>

        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-body">
              <form action="../function/get_ticket.php" method="POST">
                <div class="row">
                  <div class="col-lg-2 col-md-4 col-xs-6">
                    <div class="form-group">
                      <input type="date" class="form-control" value="<?= date("Y-m-d"); ?>" name="date1">
                    </div>
                  </div>

                  <div class="col-lg-2 col-md-4 col-xs-6">
                    <div class="form-group">
                      <input type="date" class="form-control" value="<?= date("Y-m-d"); ?>" name="date2">
                    </div>
                  </div>

                  <div class="col-lg-2 col-md-4 col-xs-6">
                    <div class="form-group">
                      <select class="form-control" id="region" name="region">
                        <option value="">Выберите город</option>
                        <?
                        foreach ($regions as $region) { ?>
                          <option><?= $region ?></option>
                        <? } ?>
                        <option value="Все">Все</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-xs-6">
                    <div class="form-group">
                      <select class="form-control" id="adress" name="adress">
                        <option value="">Выберите регион</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-2 col-md-4 col-xs-6">
                    <div class="form-group">
                      <select class="form-control" id="term" name="term">
                        <option value="">Выберите срок</option>
                        <? $i = 0;
                        while ($i <= 15) : ?>
                          <option><?= $i++ ?></option>
                        <? endwhile; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-2 col-md-4 col-xs-6">
                    <div class="form-group">
                      <button type="submit" class="btn btn-info ">Подтвердить!</button>
                    </div>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive" id='answer'>
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
                        <td> <a href="edit?id=<?= $row['id']; ?>" class="btn btn-success btn-block"> <i class="fa fa-file-text-o"></i> </a> </td>
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
        var search = $('#search').val().trim();
        $.post('./functions/search.php', {
            search: search
          })
          .done(function(data) {
            $('.table-responsive').html(data + search);
          })
      })

      $('#region').change(function() {
        var region = $(this).val();
        console.log(region);
        $('#adress').load('../function/get_adress.php', {
          region: region
        });
      });
    });
  </script>
  <script src="/assets/js/form_get_html.js"></script>