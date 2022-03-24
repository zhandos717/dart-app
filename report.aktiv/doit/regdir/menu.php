<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">Навигация</li>

      <li class="treeview">
        <a href="otchety.php">
          <i class="fa  fa-dashboard"></i> <span> ОТЧЕТЫ </span>
        </a>
      </li>
      <li class="treeview">
        <a href="edo/">
          <i class="fa  fa-envelope"></i> <span> СЛУЖЕБКИ <label class="badge label-danger"><?= $countsl; ?></label> </span>
        </a>
      </li>

      <!-- <li class="active treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Отчеты за</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="index.php"><i class="fa fa-calendar"></i>Июнь <span class="label label-danger pull-right">2020</span></a></li>
          <li><a href="reportmay.php"><i class="fa fa-calendar"></i>Май <span class="label label-danger pull-right">2020</span></a></li>
          <li><a href="reportapril.php"><i class="fa fa-calendar"></i>Апрель <span class="label label-danger pull-right">2020</span></a></li>
          <li><a href="reportmart.php"><i class="fa fa-calendar"></i>Мар <span class="label label-danger pull-right">2020</span>т</a></li>
          <li><a href="reportfebruary.php"><i class="fa fa-calendar"></i>Февраль <span class="label label-danger pull-right">2020</span></a></li>
          <li><a href="reportjanuary.php"><i class="fa fa-calendar"></i>Январь <span class="label label-danger pull-right">2020</span> </a> </li>
        </ul>
      </li> -->
      <li class="treeview <?= $active; ?>">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Отчеты комисионка</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="viewmyseptember_com.php"><i class="fa fa-calendar"></i>Сентябрь</a></li>
          <li><a href="viewmyaugust_com.php"><i class="fa fa-calendar"></i>Август</a></li> -->
          <li><a href="alltovar.php"><i class="fa fa-file-text"></i> Отчет по остатку товаров</a></li>
          <li><a href="a_report.php?id=2"><i class="fa fa-file-text"></i> Отчет по реализации</a></li>
        </ul>
      </li>
      <!-- <li class="treeview">
        <a href="/doit/chat/">
          <span> Рабочий чат </span>
        </a>

      </li> -->

      <li class="treeview">
        <a href="../../logout.php">
          <i class="fa fa-files-o"></i>
          <span>Выход</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>