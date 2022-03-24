<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <!-- <li class="header">Навигация</li> -->
      <li class="treeview">
        <a href="report.php">
          <i class="fa fa-line-chart"></i>
          <span>Главная </span>
        </a>
      </li>
<!--        <li class="treeview">-->
<!--            <a href="old_report.php">-->
<!--                <i class="fa fa-files-o"></i>-->
<!--                <span>Отчет за прошлый месяц </span>-->
<!--            </a>-->
<!--        </li>-->
      <!-- <li class="treeview">
        <a href="tabel/">
          <i class="fa fa-magic"></i> <span> ГРАФИК РАБОЧЕГО ВРЕМЕНИ </span>
        </a>
      </li> -->

      <!-- <li class="treeview">
        <a href="report_1.php">
          <i class="fa fa-files-o"></i>
          <span>Главная</span> <span class="label label-danger pull-right">TBS</span> </span>
        </a>
      </li> -->
      <li class="treeview">
        <a href="index.php">
          <i class="fa fa-files-o"></i>
          <span>ОТПРАВИТЬ ОТЧЕТ</span>
        </a>
      </li>
      <li class=" <?= $active1; ?> treeview">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Отчеты ломбарда за 2022 </span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class=" <?= $active2020; ?> treeview">
            <!-- <li><a href="viewmyreports.php"><i class="fa fa-calendar"></i>Январь</a></li> -->
            <!-- <a href="viewmyreports.php?month=12">
              <i class="fa fa-calendar"></i> <span>Декабрь </span>
            </a> -->
            <a href="viewmyreports.php?month=2">
              <i class="fa fa-calendar"></i> <span>Февраль</span>
            </a>
            <a href="viewmyreports.php?month=1">
              <i class="fa fa-calendar"></i> <span>Январь </span>
            </a>

          </li>
        </ul>
      </li>

        <?php $city = R::getCol('SELECT region FROM kassa WHERE status = 1 GROUP BY region');
        if (in_array($region, $city)) { ?>
            <li class="treeview <?= $active; ?>">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Отчеты комисионка</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!-- <li><a href="viewmyseptember_com.php"><i class="fa fa-calendar"></i>Сентябрь</a></li>
                    <li><a href="viewmyaugust_com.php"><i class="fa fa-calendar"></i>Август</a></li> -->
                    <li><a href="alltovar.php"><i class="fa fa-file-text"></i> Отчет по остатку товаров</a></li>
                    <li><a href="info_sale.php"><i class="fa fa-file-text"></i> Отчет по реализации</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="help_desc.php">
                    <i class="fa fa-magic"></i> <span> Help DESC <label class="badge label-danger">тест</label></span>
                </a>
            </li>
        <? }?>
      <!--  <li class="treeview">
        <a href="reportform.php">
          <i class="fa fa-edit"></i> <span>Отчетные формы</span>
        </a>
      </li> -->
      <li class="treeview">
        <a href="auk.php">
          <i class="fa fa-calendar"></i> <span>Отчет по продажам</span>
        </a>
      </li>
      <li class="treeview">
        <a href="edo/">
          <i class="fa  fa-envelope"></i> <span> СЛУЖЕБКИ <label class="badge label-danger"><?= $countid; ?></label> </span>
        </a>
      </li>
      <li class="treeview">
        <a href="black-list-product.php">
          <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
          <span> Черный список товаров </span>
        </a>
      </li>
      <li class="treeview">
        <a href="tabel/">
          <i class="fa fa-magic" aria-hidden="true"></i>
          <span> Рабочий график сотрудников </span>
        </a>
      </li>
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
