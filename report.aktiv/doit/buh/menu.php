<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->

    <!-- search form -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <!-- <li class="treeview">
        <a href="index.php">
          <i class="fa fa-files-o"></i>
          <span>Главная</span>
          <span class="label label-primary pull-right"></span>
        </a>
      </li> -->

      <li class="treeview">
        <a href="#">
          <i class="fa fa-usd"></i> <span>Операции с кассами</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="findv.php"><i class="fa fa-cart-arrow-down"></i>Финансовые передвижения</a></li>
          <li><a href="cash_opiration.php"><i class="fa fa-cart-arrow-down"></i>Все операции</a></li>
          <li><a href="cashbox.php"><i class="fa fa-bars"></i>Кассы</a></li>
        </ul>
      </li>


      <li class="<?= $active; ?> treeview">
        <a href="#">
          <i class="fa fa-dropbox"></i> <span>ТОВАРЫ</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="inmag.php"><i class="fa fa-cart-arrow-down"></i>В магазине</a></li>
          <li><a href="prtovary.php"><i class="fa fa-credit-card"></i>Проданные товары</a></li>
          <li><a href="alltovar.php"><i class="fa fa-shopping-cart"></i>Все товары</a></li>
        </ul>
      </li>
      <li class="treeview <?= $active_report_com; ?>">
        <a href="#"><i class="fa fa-server"></i> Отчеты
          <i class="fa fa-angle-left pull-right"> </i>
          <ul class="treeview-menu">
            <!-- <li><a href="a_report.php?id=3"><i class="fa fa-usd"></i>Отчет по договорам комиссии</a></li> -->
            <li><a href="a_report.php?id=1"><i class="fa fa-usd"></i>Фин. передвижения</a></li>
            <li><a href="a_report.php?id=2"><i class="fa fa-cart-arrow-down"></i>Реализованное имущество</a></li>
            <li><a href="accses.php"><i class="fa fa-cart-arrow-down"></i>Аксессуары</a></li>
            <!-- <li><a href="a_report.php?id=6"><i class="fa fa-cart-arrow-down"></i>Задатки</a></li> -->
            <li><a href="report_cashbox.php"><i class="fa fa-bars"></i>Ежедневная сводка</a></li>
            <li><a href="abcommis.php"><i class="fa fa-bars"></i>Детальный отчет</a></li>
          </ul>
      </li>
      <li class="treeview">
        <a href="download.php">
          <i class="fa fa-cloud-download"></i> <span>Выгрузка</span>
        </a>
      </li>
      <li class="treeview">
        <a href="edo/">
          <i class="fa  fa-envelope"></i> <span> СЛУЖЕБКИ <label class="badge label-danger"><?=$countid123;?></label> </span>
        </a>
      </li>
      <li class="treeview">
        <a href="rashody.php">
          <i class="fa fa-cube"></i> <span> Расходы </span>
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
