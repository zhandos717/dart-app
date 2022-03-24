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
        <a href="../report.php">
          <i class="fa fa-files-o"></i>
          <span>Главная </span>
        </a>
      </li>
      <!-- <li class="treeview">
        <a href="tabel/">
          <i class="fa fa-magic"></i> <span> ГРАФИК РАБОЧЕГО ВРЕМЕНИ </span>
        </a>
      </li> -->
<!--      <li class="treeview">-->
<!--        <a href="../old_report.php">-->
<!--          <i class="fa fa-files-o"></i>-->
<!--          <span>Отчет за прошлый месяц </span>-->
<!--        </a>-->
<!--      </li>-->
      <!-- <li class="treeview">
        <a href="report_1.php">
          <i class="fa fa-files-o"></i>
          <span>Главная</span> <span class="label label-danger pull-right">TBS</span> </span>
        </a>
      </li> -->
      <li class="treeview">
        <a href="../index.php">
          <i class="fa fa-files-o"></i>
          <span>ОТПРАВИТЬ ОТЧЕТ</span>
        </a>
      </li>
      <li class=" <?= $active1; ?> treeview">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Отчеты ломбарда</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class=" <?= $active2020; ?> treeview">
            <!-- <li><a href="viewmyreports.php"><i class="fa fa-calendar"></i>Январь</a></li> -->
            <!-- <a href="viewmyreports.php?month=12">
              <i class="fa fa-calendar"></i> <span>Декабрь </span>
            </a> -->
            <a href="../viewmyreports.php?month=12">
              <i class="fa fa-calendar"></i> <span>Декабрь </span>
            </a>
            <a href="../viewmyreports.php?month=11">
              <i class="fa fa-calendar"></i> <span>Ноябрь </span>
            </a>
            <a href="../viewmyreports.php?month=10">
              <i class="fa fa-calendar"></i> <span>Октябрь </span>
            </a>
            <a href="../viewmyreports.php?month=9">
              <i class="fa fa-calendar"></i> <span>Сентябрь </span>
            </a>
            <a href="../viewmyreports.php?month=8">
              <i class="fa fa-calendar"></i> <span>Август </span>
            </a>
            <a href="../viewmyreports.php?month=7">
              <i class="fa fa-calendar"></i> <span>Июль </span>
            </a>
            <a href="../viewmyreports.php?month=6">
              <i class="fa fa-calendar"></i> <span>Июнь </span>
            </a>
            <a href="../viewmyreports.php?month=5">
              <i class="fa fa-calendar"></i> <span>Май </span>
            </a>
            <a href="viewmyreports.php?month=4">
              <i class="fa fa-calendar"></i> <span>Апрель</span>
            </a>
            <a href="../viewmyreports.php?month=3">
              <i class="fa fa-calendar"></i> <span>Март</span>
            </a>
            <a href="../viewmyreports.php?month=2">
              <i class="fa fa-calendar"></i> <span>Февраль</span>
            </a>
            <a href="../viewmyreports.php?month=1">
              <i class="fa fa-calendar"></i> <span>Январь</span>
            </a>
            <!-- <a href="#">
              <i class="fa fa-calendar"></i> <span>2020 год</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="viewmyreports.php"><i class="fa fa-calendar"></i>Декабрь</a></li>
              <li><a href="viewmydecember.php"><i class="fa fa-calendar"></i>Декабрь</a></li>
              <li><a href="viewmynovember.php"><i class="fa fa-calendar"></i>Ноябрь</a></li>
              <li><a href="viewmyoktober.php"><i class="fa fa-calendar"></i>Октябрь</a></li>
              <li><a href="viewmyseptember.php"><i class="fa fa-calendar"></i>Сентябрь</a></li>
              <li><a href="viewmyaugust.php"><i class="fa fa-calendar"></i>Август</a></li>
              <li><a href="viewmyjuly.php"><i class="fa fa-calendar"></i>Июль</a></li>
              <li><a href="viewmyjune.php"><i class="fa fa-calendar"></i>Июнь</a></li>
              <li><a href="viewmmay.php"><i class="fa fa-calendar"></i>Май</a></li>
              <li><a href="viewmyapril.php"><i class="fa fa-calendar"></i>Апрель</a></li>
              <li><a href="viewvtomart.php"><i class="fa fa-calendar"></i>Март</a></li>
              <li><a href="viewmyfebruary.php"><i class="fa fa-calendar"></i>Февраль</a></li>
              <li><a href="viewtojanuary.php"><i class="fa fa-calendar"></i>Январь</a></li>
            </ul> -->
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
                    <li><a href="../alltovar.php"><i class="fa fa-file-text"></i> Отчет по остатку товаров</a></li>
                    <li><a href="../info_sale.php"><i class="fa fa-file-text"></i> Отчет по реализации</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="../help_desc.php">
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
        <a href="../auk.php">
          <i class="fa fa-calendar"></i> <span>Отчет по продажам</span>
        </a>
      </li>

      <li class="treeview">
        <a href="../help_desc.php">
          <i class="fa fa-magic"></i> <span> Help DESC <label class="badge label-danger">тест</label></span>
        </a>
      </li>

      <li class="treeview">
        <a href="../edo/">
          <i class="fa  fa-envelope"></i> <span> СЛУЖЕБКИ <label class="badge label-danger"><?=$countid;?></label> </span>
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
