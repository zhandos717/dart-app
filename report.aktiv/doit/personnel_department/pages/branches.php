<?
$user_active = 'active';
include "pages/layouts/header.php";
$result = R::findAll('branches', 'ORDER BY code_branche DESC');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Филиалы Актив Ломбард </h1>
        <!-- <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php">Регионы</a></li>
          <li class="active">Филиалы</li>
        </ol> -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <button class="btn btn-success update" data-toggle="modal" data-target="#exampleModal"> Добавить сотрудника </button>
                    </div>
                    <div class="col-xs-12">
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr class="bg-olive">
                                        <th>№</th>
                                        <th>Код <small>филиала</small></th>
                                        <!-- <th>БИН</th> -->
                                        <!-- <th>Полное наименование</th> -->
                                        <th>Населенный пункт</th>
                                        <th>Адрес филиала</th>
                                        <th>Телефон</th>
                                        <th>Директор ФИО</th>
                                        <!-- <th>ИИК</th> -->
                                        <!-- <th>БАНК</th> -->
                                        <!-- <th>EMAIL</th> -->
                                        <th>Дополнительная информация</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $i = 1;
                                    foreach ($result as $key) {
                                    ?>
                                        <tr class="<?= $color ?>">
                                            <td><?= $i++; ?> </td>
                                            <td class="text-center"><?= $key['code_branche']; ?></td>
                                            <!-- <td><?= $key['bin']; ?></td> -->
                                            <!-- <td><?= $key['name']; ?></td> -->
                                            <td><?= $key['region']; ?></td>
                                            <td><?= $key['adress']; ?></td>
                                            <td><?= $key['phone']; ?></td>
                                            <td><?= $key['director']; ?></td>
                                            <!-- <td><?= $key['iik']; ?></td> -->
                                            <!-- <td><?= $key['bank']; ?></td> -->
                                            <td><?= $key['discription']; ?> <button class="fa fa-edit btn-warning btn update" data-id="<?= $key['id']; ?>" data-toggle="modal" data-target="#exampleModal"> </button></td>
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
            <form action="./function/edit_branche.php" method="POST">
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
        $('.update').click(function(e) {
            var id = $(this).data('id');
            $.post('./function/edit_branche.php', {id: id})
            .done(function(data) {
            $('.modal-body').html(data);});

        });
        $('form').submit(function(e) {
            var $form = $(this);
            var json;
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize()
            }).done(function(result) {
                json = jQuery.parseJSON(result);
                if (json.message) {
                    alert(json.message)
                    location.reload()
                }
            }).fail(function(data) {
                console.log(data);
                alert('Ошибка:' + data);
            });

            $('#alert').removeClass('hidden')
            $('.close').trigger("click");
            //отмена действия по умолчанию для кнопки submit
            e.preventDefault();
        });

    });
</script>
<? include "pages/layouts/footer.php"; ?>