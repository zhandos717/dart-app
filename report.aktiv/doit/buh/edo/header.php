<!DOCTYPE html>
<html lang="ru-RU">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ежедневный отчет</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icons/favicon-16x16.png">
  <link rel="icon" type="image/ico" href="/assets/images/icons/favicon.ico" />
  <link rel="manifest" href="../assets/images/icons/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

  <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.print.css" media="print">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../assets/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../assets/dist/css/user.css?54">
  <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
  <!-- <link href="bootstrap/css/bootstrap.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="../assets/bootstrap/css/address.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-editable.css" />
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/plugins/select2/select2.css">
  <!-- Select2 -->
  <!-- <script type="text/javascript" src="jquery/linkedselect.js"></script> -->
  <!-- jQuery 2.1.4 -->
  <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- iCheck -->
    <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="https://report.aktiv-market.kz/doit/buh/index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>K</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>АКТИВ</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="https://report.aktiv-market.kz/doit/buh/index.php" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Навигация</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
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
    <!-- Left side column. contains the logo and sidebar -->
    <?
        $komu123 = $_SESSION['logged_user']->login;
        $resultc123 = mysqli_query($connect, "SELECT COUNT(id) FROM sluzhebki WHERE komu = '$komu123' AND statusread = '0'");
        $datac123 = mysqli_fetch_array($resultc123);
        $countid123 = $datac123['COUNT(id)'];
    ?>
