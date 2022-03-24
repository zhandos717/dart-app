<?php

include "pages/layouts/header.php";

if(isset($_GET['region']) AND isset($_GET['adress'])){
    $where = 'region = :region AND adress = :adress ORDER BY id DESC';
    $placeholder = [':region'=>$_GET['region'],':adress'=>$_GET['adress']];
}else{
    $where = 'ORDER BY id DESC';
    $placeholder = [];
}

$result = R::findAll('diruser',$where, $placeholder);
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Сотрудники Актив Ломбард! </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="answer">

        </div>
      </div>
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
              <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                    <button class="btn btn-success update" type="button" data-toggle="modal" data-target="#exampleModal"> Добавить сотрудника</button>
                </div>
                  <form method="GET">
                      <div class="col-lg-2 col-md-4">
                          <div class="form-group">
                              <select class="form-control" id="region" required name="region">
                                  <?= isset($_GET['region']) ? '<option>'.$_GET['region'].'</option>'
                                      :'<option value="">Выберите город</option>';
                                  $city = R::getCol('SELECT region FROM diruser GROUP BY region');
                                  foreach ($city as $key) {
                                      echo "<option>{$key}</option>";
                                  }?>
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-4">
                          <div class="form-group">
                              <select class="form-control" id="adress" required name="adress">
                                      <?= isset($_GET['adress']) ? '<option>'.$_GET['adress'].'</option>'
                                      :'<option value="">Выберите город</option>';?>
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-4">
                          <div class="form-group">
                              <button type="submit" class="btn btn-info">Подтвердить!</button>
                          </div>
                      </div>
                  </form>
              </div>
              </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="bg-olive">
                    <th>№</th>
                    <th></th>
                    <th>Логин</th>
                    <th>Ф.И.О</th>
                    <th>Город</th>
                    <th>Адрес</th>
                    <th>Должность</th>
                    <th>Доступ</th>
                  </tr>
                </thead>
                <tbody>
                  <?
                  $i = 1;
                  foreach ($result as $key) {
                    $available = R::load('available', $key['status']);
                    if (empty($available['name'])) {
                      $status = 'Доступа нет';
                      $color = 'danger';
                    } else {
                      $status = $available['name'];
                      $color = 'success';
                    };
                  ?>
                    <tr class="<?= $color ?>">
                      <td><?= $i++; ?>.</td>
                      <td><button class="fa fa-edit btn-warning btn update" data-id="<?= $key['id']; ?>" data-toggle="modal" data-target="#exampleModal"> </button></td>
                      <td><?= $key['login']; ?></td>
                      <td><?= $key['fio']; ?></td>
                      <td><?= $key['region']; ?></td>
                      <td><?= $key['adress']; ?></td>
                      <td><?= $key['doljnost']; ?></td>
                      <td>
                        <?= $status; ?>
                      </td>
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
<div class="modal" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Изменение данных</h4>
      </div>
      <form action="function/edit_user.php" class="add" method="POST">
        <div class="modal-body">
          <p>Подождите идет загрузка данных......</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Закрыть</button>
          <button type="submit" class="btn btn-success">Cохранить</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>

  $(function() {



      $('#region').change(function() {
          var value = $(this).val();
          $('#adress').load('../function/get_adress.php', {
              value: value
          });
      });

      // let region = $('#region').val();
      // let adress =  $('#adress').val();
      //
      // if(region != undefined and adress != undefined){
      //     $('#adress').load('../function/get_adress.php', {
      //         value: region,
      //     });
      // }






      $('.update').click(function(e) {
      var id = $(this).data('id');
      //consle.log(this);
      //console.log(id);
      $.post('./function/edit_user.php', {
          id: id
        })
        .done(function(data) {
          $('.modal-body').html(data);
          //console.log(data)
        });
    });

    $('form.add').submit(function(e) {
      var $form = $(this);
      $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: $form.serialize()
      }).done(function(data) {
        console.log(data);

        var out = '<div class="alert alert-success alert-dismissable">';
        out += ' <button type ="button" class ="close" data-dismiss="alert" aria-hidden="true" > &times; </button>';
        out += '<h4 ><i class="icon fa fa-check"> </i> Данные добавлены!</h4>';
        out += 'Для проверки обновите страницу';
        out += '</div> ';
        $('.answer').html(out);
      }).fail(function(data) {
        console.log(data);
        alert('Ошибка:' + data);
      });
      $('.close').trigger("click");
      //отмена действия по умолчанию для кнопки submit
      e.preventDefault();
    });

  });
</script>
<? include "pages/layouts/footer.php"; ?>