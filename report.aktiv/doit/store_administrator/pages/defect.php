<?include "pages/layouts/header.php";
 $productList = R::findAll('defect')
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Список товаров
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Товары на витрине</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="answer">

                </div>
            </div>
            <div class="col-lg-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        Код товара:
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool bg-olive fa fa-plus" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#modal-default"></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-responsive" id="datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Наименовние</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?foreach ($productList as $value) {?>
                                <tr>
                                    <th><?= $value['id']; ?></th>
                                    <th><?= $value['name']; ?></th>

                                </tr>
                                <?}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.row (main row) -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->




<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="./function/add_product/add_product.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Окно редактирования товара</h4>
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
<!-- /.modal -->

<script>
    $(document).ready(function() {
        $('.fa-plus').click(function() {
            let id = $(this).data('id');
            $.post('./function/add_product/add_product.php', {
                id: id
            }).done(function(data) {
                $('.modal-body').html(data);
            })
        });
        $('form').submit(function(e) {
            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize()
            }).done(function(data) {
                message(data);
            }).fail(function() {
                alert('Ошибка');
            });
            e.preventDefault(); //отмена действия по умолчанию для кнопки submit
            $('.close').trigger('click');
        });


        function message(answer) {
            var out = '<div class="alert alert-' + answer.class + ' alert-dismissable">';
            out += ' <button type ="button" class ="close" data-dismiss="alert" aria-hidden="true" > &times; </button>';
            out += '<h4 ><i class="icon fa fa-' + answer.icon + ' "> </i> ' + answer.type + '!</h4>';
            out += answer.message;
            out += '</div> ';
            $('.answer').html(out);
        }

    })
</script>


<?include "pages/layouts/footer.php"; ?>