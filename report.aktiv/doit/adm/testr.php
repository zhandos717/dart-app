<!DOCTYPE html>
<html lang="ru-RU">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ежедневный отчет</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="icon" type="image/ico" href="assets/images/icons/favicon.ico" />
    <link rel="manifest" href="assets/images/icons/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="assets/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="assets/dist/css/user.css?54">
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <!-- <link href="bootstrap/css/bootstrap.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="assets/bootstrap/css/address.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-editable.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/select2.css">
    <!-- Select2 -->
    <!-- <script type="text/javascript" src="assets/jquery/linkedselect.js"></script> -->
    <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>K</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>АКТИВ</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="index.php" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Навигация</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu ">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <img src="assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">

                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    <p>

                                        <!-- <small>Member since Nov. 2012</small> -->
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="profile.php" class="btn btn-default btn-flat">Профиль</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/logout.php" class="btn btn-default btn-flat">Выход</a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->


        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <!-- <li class="header">Навигация</li> -->
                    <li class="treeview">
                        <a href="home">
                            <i class="fa fa-files-o"></i>
                            <span>Главная</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="../../logout.php">
                            <i class="fa fa-share"></i>
                            <span>Выход</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>

                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
                    <li><a href="index.php">Регионы</a></li>
                    <li class="active">Филиалы</li>
                </ol>
            </section>
            <!-- Main content -->
            <br>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Responsive Hover Table</h3>

                                <div class="box-tools">
                                    <button id="btnExport" class="btn btn-success fa fa-excel" onclick="tableToExcel('report_table','ТАБЕЛЬ', 'ТАБЕЛЬ учета рабочего времени.xls')"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
                                    <script type="text/javascript">
                                        var tableToExcel = (function() {
                                            var uri = 'data:application/vnd.ms-excel;base64,',
                                                template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
                                                base64 = function(s) {
                                                    return window.btoa(unescape(encodeURIComponent(s)))
                                                },
                                                format = function(s, c) {
                                                    return s.replace(/{(\w+)}/g, function(m, p) {
                                                        return c[p];
                                                    })
                                                },
                                                downloadURI = function(uri, name) {
                                                    var link = document.createElement("a");
                                                    link.download = name;
                                                    link.href = uri;
                                                    link.click();
                                                }
                                            return function(table, name, fileName) {
                                                if (!table.nodeType) table = document.getElementById(table)
                                                var ctx = {
                                                    worksheet: name || 'Worksheet',
                                                    table: table.innerHTML
                                                }
                                                var resuri = uri + base64(format(template, ctx))
                                                downloadURI(resuri, fileName);
                                            }
                                        })();
                                    </script>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">


                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="report_table">
                                        <thead>
                                            <tr>
                                                <th colspan="20"> ТОО «АКТИВ ЛОМБАРД»</th>
                                                <th colspan="17">Утверждаю ______________ Шаграева И.Б.</th>
                                            </tr>

                                            <tr>
                                                <th colspan="20">БИН - 110 840 013 121</th>
                                                <th colspan="8" class="text-center">(подпись)</th>
                                                <th colspan="9"></th>
                                            </tr>

                                            <tr>
                                                <th colspan="14">Сарыарка 3/1</th>
                                                <th colspan="23">ТАБЕЛЬ</th>
                                            </tr>
                                            <tr>
                                                <th colspan="12"></th>
                                                <th colspan="15">учета рабочего времени</th>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">№ п\п</td>
                                                <td rowspan="2">Фамилия</td>
                                                <td rowspan="2">Должность</td>
                                                <td colspan="33" class="text-center">Октябрь 2021 ГОД</td>
                                                <td rowspan="2" class="text-center">норма дней</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>6</td>
                                                <td>7</td>
                                                <td>8</td>
                                                <td>9</td>
                                                <td>10</td>
                                                <td>11</td>
                                                <td>12</td>
                                                <td>13</td>
                                                <td>14</td>
                                                <td>15</td>
                                                <td>16</td>
                                                <td>17</td>
                                                <td>18</td>
                                                <td>19</td>
                                                <td>20</td>
                                                <td>21</td>
                                                <td>22</td>
                                                <td>23</td>
                                                <td>24</td>
                                                <td>25</td>
                                                <td>26</td>
                                                <td>27</td>
                                                <td>28</td>
                                                <td>29</td>
                                                <td>30</td>
                                                <td>31</td>
                                                <td>отр. дни</td>
                                                <td>отраб часы</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th colspan="39" class="text-center">ШТАТ</th>
                                            </tr>
                                            <tr>
                                                <th>1</th>
                                                <th>Казбеков Темир</th>
                                                <th>ВИОД</th>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 10 </td>
                                                <td> 23 </td>
                                                <td> 230 </td>
                                                <td> 23 </td>
                                            </tr>
                                            <tr>
                                                <th colspan="39" class="text-center">ГПХ</th>
                                            </tr>
                                            <th>2</th>
                                            <th>Рахимжан Эльмира</th>
                                            <th>Эксперт</th>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 23 </td>
                                            <td> 230 </td>
                                            <td> 23 </td>
                                            </tr>
                                            <th>3</th>
                                            <th>Мусулманбеков Алибек </th>
                                            <th>Эксперт</th>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 10 </td>
                                            <td> 23 </td>
                                            <td> 230 </td>
                                            <td> 23 </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>


            </section>
        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong> Copyright &copy; 2020 All rights reserved by Activ-Market.KZ
        </footer>
        <!-- <div> </div>./wrapper -->
        <div class="control-sidebar-bg"></div>
        <!-- jQuery 2.1.4 -->
        <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Select2 -->
        <script src="assets/plugins/select2/select2.full.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- InputMask -->
        <script src="assets/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- date-range-picker -->
        <script src="assets/plugins/daterangepicker/moment.js"></script>
        <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- DataTables -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <!-- ChartJS 1.0.1 -->
        <script src="assets/plugins/chartjs/Chart.min.js"></script>
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="assets/plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="assets/dist/js/demo.js"></script>

        <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- page script -->
        <script>
            $(function() {
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
        </script>
        <script src="assets/plugins/table/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/table/jszip.min.js"></script>
        <script src="assets/plugins/table/buttons.html5.min.js"></script>
        <script src="assets/plugins/table/buttons.print.min.js"></script>
        <script src="assets/plugins/table/examples.datatables.tabletools.js"></script>
        <script src="assets/plugins/jszip/saveAsExcel.js"></script>
</body>

</html>
