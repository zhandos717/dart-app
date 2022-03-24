<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Бухгалтерия | Activ-Market</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" crossorigin="anonymous/assets/">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" crossorigin="anonymous/assets/">
  <link rel="stylesheet" href="/assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="/assets/dist/css/user.css?54">
  <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
  <script type="text/javascript" src="linkedselect.js"></script>
  <!-- <link href="bootstrap/css/bootstrap-editable.css" rel="stylesheet" /> -->
  <!-- <link href="/assets/bootstrap/css/address.css" rel="stylesheet"> -->
  <!-- <script src="plugins/editable/address.js" type="text/javascript"></script> -->
  <!-- <script src="plugins/editable/jquery.maskedinput.min.js" type="text/javascript"></script> -->
  <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="/assets/plugins/editable/jquery.min.js" type="text/javascript"></script>
  <script src="/assets/plugins/editable/bootstrap.js" type="text/javascript"></script>
  <script src="/assets/plugins/editable/bootstrap-editable.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>KT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Отчеты</b></span>
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

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="/assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $_SESSION['logged_user']->fio; ?> - <?= $_SESSION['logged_user']->doljnost; ?></span>
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