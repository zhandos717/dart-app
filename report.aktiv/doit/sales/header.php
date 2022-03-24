      <!DOCTYPE html>
      <html class="fixed" lang="ru-RU">

      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Ежедневный отчет</title>
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
          <!-- Font Awesome -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" crossorigin="anonymous">
          <!-- Ionicons -->
          <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" crossorigin="anonymous">
          <!-- daterange picker -->

          <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker-bs3.css" crossorigin="anonymous">
          <!-- Theme style -->
          <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css" crossorigin="anonymous">

          <link rel="stylesheet" href="/assets/plugins/datatables/dataTables.bootstrap.css " crossorigin="anonymous">
          <!-- daterange picker -->
          <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker-bs3.css" crossorigin="anonymous">
          <!-- iCheck for checkboxes and radio inputs -->
          <link rel="stylesheet" href="/assets/plugins/iCheck/all.css" crossorigin="anonymous">

          <!-- Bootstrap Color Picker -->
          <link rel="stylesheet" href="/assets/plugins/colorpicker/bootstrap-colorpicker.min.css" crossorigin="anonymous">
          <!-- Bootstrap time Picker -->
          <link rel="stylesheet" href="/assets/plugins/timepicker/bootstrap-timepicker.min.css" crossorigin="anonymous">
          <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css" crossorigin="anonymous">
          <link rel="stylesheet" href="/assets/dist/css/user.css?54" crossorigin="anonymous">
          <link rel="stylesheet" href="/assets/plugins/morris/morris.css" crossorigin="anonymous">
          <!-- <link href="bootstrap/css/bootstrap.css" rel="stylesheet"> -->
          <link rel="stylesheet" href="/assets/bootstrap/css/address.css" crossorigin="anonymous">
          <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-editable.css" crossorigin="anonymous">
          <!-- Select2 -->
          <link rel="stylesheet" href="/assets/plugins/select2/select2.css" crossorigin="anonymous">
          <!-- Select2 -->
          <!-- <script type="text/javascript" src="/assets/jquery/linkedselect.js"></script> -->
          <!-- jQuery 2.1.4 -->
          <script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js" crossorigin="anonymous"></script>
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
                                      <img src="/assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                      <span class="hidden-xs"><?= $fio; ?></span>
                                  </a>
                                  <ul class="dropdown-menu">
                                      <!-- User image -->
                                      <li class="user-header">
                                          <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                          <p>
                                              <?= $fio; ?>
                                              <!-- <small>Member since Nov. 2012</small> -->
                                          </p>
                                      </li>
                                      <!-- Menu Body -->
                                      <!-- <li class="user-body">
                  <div class="col-xs-4 text-center">
                    <a href="#">Показатели</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Продажи</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Сотрудники</a>
                  </div>
                </li> -->
                                      <!-- Menu Footer-->
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
              <?
                  $komu = $_SESSION['logged_user']->login;
                  $resultc = mysqli_query($connect, "SELECT COUNT(id) FROM sluzhebki WHERE komu = '$komu' AND statusread = '0'");
                  $datac = mysqli_fetch_array($resultc);
                  $countid = $datac['COUNT(id)'];
              ?>
