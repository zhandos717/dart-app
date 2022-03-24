<!DOCTYPE html>
<html lang="ru-RU">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?= $title ?> </title>
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icons/favicon-16x16.png">
    <link rel="icon" type="image/ico" href="/assets/images/icons/favicon.ico" />
    <link rel="manifest" href="/assets/images/icons/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <!-- fullCalendar 2.2.5-->
    <!-- <link rel="stylesheet" href="/assets/plugins/fullcalendar/fullcalendar.min.css"> -->
    <!-- <link rel="stylesheet" href="/assets/plugins/fullcalendar/fullcalendar.print.css" media="print"> -->
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- daterange picker -->
    <!-- <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker-bs3.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/AdminLTE.css">
    <!-- <link rel="stylesheet" href="/assets/plugins/datatables/dataTables.bootstrap.css"> -->
    <!-- iCheck for checkboxes and radio inputs -->
    <!-- <link rel="stylesheet" href="/assets/plugins/iCheck/all.css"> -->
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="/assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <!-- <link rel="stylesheet" href="/assets/plugins/timepicker/bootstrap-timepicker.min.css"> -->
    <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/assets/dist/css/user.css">
    <!-- <link rel="stylesheet" href="/assets/plugins/morris/morris.css"> -->
    <!-- <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="/assets/bootstrap/css/address.css"> -->
    <!-- <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-editable.css" /> -->
    <!-- Select2 -->
    <!-- <link rel="stylesheet" href="/assets/plugins/select2/select2.css"> -->
    <!-- Select2 -->
    <script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="/assets/plugins/iCheck/flat/blue.css"> -->
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link rel="stylesheet" href="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="/doit/adm/index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>L</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>АКТИВ</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <!-- <a href="/doit/adm/index.php" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Навигация</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a> -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?= $fio; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <!-- Menu Body -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="/logout.php" class="btn btn-default btn-flat">ВЫХОД</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li><a href="/"><i class="fa fa-line-chart"></i> ГЛАВНАЯ</a></li>
                    <li class="treeview">
                        <a href="/logout.php">
                            <i class="fa fa-share"></i>
                            <span>Выход</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Чат
                    <small>Рабочий чат</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
                    <li class="active">Чат</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- <div class="col-md-3"> 
                        <a href="create-mail" class="btn btn-primary btn-block margin-bottom">Создать Служебку</a>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Папки</h3>
                                <div class="box-tools">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li class=""><a href="/doit/mailbox/"><i class="fa fa-inbox"></i> Входящие
                                            <?= $count['new']  ? " <span class='label label-danger pull-right'> {$count['new']} </span>" : ''; ?>
                                        </a></li>
                                    <li><a href="outbox"><i class="fa fa-envelope-o"></i> Исходящие</a></li>
                                    <?php
                                    if ($_SESSION['logged_user']->login == 'superadmin') {
                                    ?>
                                        <li><a href="paid"><i class="fa fa-inbox"></i> Оплаченные</a></li>
                                        <li><a href="approved"><i class="fa fa-envelope-o"></i> Согласованные СЗ</a></li>
                                        <li><a href="rejected"><i class="fa fa-envelope-o"></i> Отказанные СЗ</a></li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-md-12">
                        <?= $content ?>
                    </div><!-- /.row -->
                </div>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong> Copyright &copy; 2020 All rights reserved by Activ-Market.KZ
    </footer>
    <script>
        // let path = $(location).attr('pathname');
        // if (!path.split('/')[4]) {
        //     $("a[href^='/doit/adm/mail/']").closest('li').addClass('active')
        // } else {
        //     $("a[href^='" + path.split('/')[4] + "']").closest('li').addClass('active');
        // }

    </script>
    <!-- <div> </div>./wrapper -->
    <div class="control-sidebar-bg"></div>
    <script src="/assets/plugins/select2/select2.full.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- InputMask -->
    <!-- <script src="/assets/plugins/input-mask/jquery.inputmask.js"></script> -->
    <!-- <script src="/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script> -->
    <!-- <script src="/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script> -->
    <!-- date-range-picker -->
    <!-- <script src="/assets/plugins/daterangepicker/moment.js"></script> -->
    <!-- <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script> -->
    <!-- DataTables -->
    <!-- <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="/assets/plugins/datatables/dataTables.bootstrap.min.js"></script> -->
    <!-- SlimScroll -->
    <!-- ChartJS 1.0.1 -->
    <!-- <script src="/assets/plugins/chartjs/Chart.min.js"></script> -->
    <!-- <script src="/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script> -->
    <!-- FastClick -->
    <!-- <script src="/assets/plugins/fastclick/fastclick.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets/dist/js/demo.js"></script>
    <!-- <script src="/assets/plugins/sparkline/jquery.sparkline.min.js"></script> -->
    <!-- jvectormap -->
    <!-- <script src="/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
    <!-- <script src="/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
    <!-- page script -->
    <!-- <script src="/assets/plugins/table/dataTables.buttons.min.js"></script> -->
    <!-- <script src="/assets/plugins/table/jszip.min.js"></script> -->
    <!-- <script src="/assets/plugins/table/buttons.html5.min.js"></script> -->
    <!-- <script src="/assets/plugins/table/buttons.print.min.js"></script> -->
    <!-- <script src="/assets/plugins/table/examples.datatables.tabletools.js"></script> -->
    <!-- <script src="/assets/plugins/jszip/saveAsExcel.js"></script> -->
    <!-- <script src="/assets/plugins/iCheck/icheck.min.js"></script> -->
    <!-- <script src="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
    <!-- <script>
        $(function() {
            $("#compose-textarea").wysihtml5();
            $(".select2").select2();
            $(".select3").select2();
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script> -->

</body>

</html>