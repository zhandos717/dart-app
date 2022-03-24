<?
include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
    $data_begin = date('Y.m.01'); //Дата начало
    $data_end   = date('Y.m.d'); //Дата конец
    $today = date('y-m-d');
    $month =  date('m');
    function percent($number, $percent)
    {
        return  $number - ($number / 100 * $percent);
    }
    include "header.php";
    include "menu.php";
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Показать отчет с <?= date('01.m.Y') ?> до <?= date('d.m.Y') ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                <li><a href="index.php">Регионы</a></li>
                <li class="active">Филиалы</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <form action="functions/get_report_com.php" id="report" method="POST">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="date" class="form-control"  name="date1">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="date" class="form-control"  name="date2">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn-success btn ">Подтвердить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="answer">
                                <h2 class="text-center">Данные пусты</h2>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
    </div><!-- /.content-wrapper -->
    <script>
        $(document).ready(function name(params) {
            $('input').change(function() {
                var date1 = new Date($('input[name=date1]').val());
                var date2 = new Date($('input[name=date2]').val());
                var out = 'Показать отчет с ' + date1.toLocaleDateString() + ' до ' + date2.toLocaleDateString();
                $('h1').html(out);
            })
        });
    </script>
<?
    include "footer.php";
else :
    header('Location: ../../index.php');
endif;
?>