<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 9) :
    include "header.php";
    include "menu.php";
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <!-- Split button -->
                            <div class="margin">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-lg">Месяц</button>
                                    <button type="button" class="btn btn-success dropdown-toggle btn-lg" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports052021'>Июнь 2021 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports042021'>Апрель 2021 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports032021'>Март 2021 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports022021'>Февраль 2021 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports012021'>Январь 2021 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports122020'>Декабрь 2020 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports112020'>Ноябрь 2020 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports102020'>Октябрь 2020 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports092020'>Сентябрь 2020 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports082020'>Август 2020 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports072020'>Июнь 2020 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports062020'>Июль 2020 </button> </li>
                                        <li> <button class="btn btn-success btn-lg report" data-table='reports052020'>Май 2020 </button> </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <div class="answer">

                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->


                </div><!-- /.col -->

            </div><!-- /.row -->

        </section><!-- /.content -->

        <script>
            $(function() {

                $('.report').click(function(e) {
                    var table = $(this).data('table');
                    console.log(table);
                    $.post('functions/report_lombard.php', {
                            table: table
                        })
                        .done(function(data) {
                            $('.answer').html(data);
                        });
                });

            });
        </script>


    </div><!-- /.content-wrapper -->
<? include "footer.php";
else :
    header('Location: /');
endif; ?>