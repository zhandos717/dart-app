<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <!-- <li class="header">Навигация</li> -->
      <li class="treeview">
        <a href="index.php?id=4">
          <i class="fa fa-files-o"></i>
          <span>Главная</span>
        </a>
      </li>
      <?if($_SESSION['logged_user']->root == 1):?>
      <li class="treeview active">
        <a href="#">
          <i class="fa fa-table"></i> <span>Отчет</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu-open" style="display: block;">
          <li><a href="index.php?month=2&year=2021"><i class="fa fa-circle-o"></i>Февраль</a></li>
          <li><a href="index.php?month=1&year=2021"><i class="fa fa-circle-o"></i>Январь</a></li>
          <li><a href="index.php?month=12&year=2020"><i class="fa fa-circle-o"></i>Декабрь</a></li>
          <li><a href="index.php?month=11&year=2020"><i class="fa fa-circle-o"></i>Октябрь</a></li>
        </ul>
      </li> 
      <?endif;?>
      <!-- <li class="treeview">
        <a href="viewmyreports.php">
          <i class="fa fa-edit"></i> <span>Товары на реализации</span><small class="label pull-right bg-yellow">123</small>
        </a>
      </li> -->
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