<?
        $access_region = R::findOne('access', 'userid = :userid', [':userid' => $_SESSION['logged_user']->id]);
        $regions = explode(";", $access_region['regions']);
        if (empty($regions)) {
          $regions = [$region];
        }
?>

<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="treeview">
        <a href="index.php">
          <i class="fa fa-bar-chart "></i>
          <span>Главная</span>
        </a>
      </li>
      <!-- <li class="treeview <?= $active_lombard; ?>">
        <a href="#">
          <i class="fa fa-university"></i> <span>Ломбард</span>
          <i class="fa fa-angle-left pull-right"> </i>
        </a>
        <ul class="treeview-menu">
            <li><a href="allfilesreports2021/september.php"><i class="fa fa-calendar-plus-o"></i>Сентябрь</a></li>
            <li><a href="allfilesreports2021/august.php"><i class="fa fa-calendar-plus-o"></i>Август</a></li>
            <li><a href="allfilesreports2021/july.php"><i class="fa fa-calendar-plus-o"></i>Июль</a></li>
            <li><a href="allfilesreports2021/june.php"><i class="fa fa-calendar-plus-o"></i>Июнь</a></li>
            <li><a href="allfilesreports2021/may.php"><i class="fa fa-calendar-plus-o"></i>Май</a></li>
            <li><a href="allfilesreports2021/april.php"><i class="fa fa-calendar-plus-o"></i>Апрель</a></li>
            <li><a href="allfilesreports2021/mart.php"><i class="fa fa-calendar-plus-o"></i>Март</a></li>
            <li><a href="allfilesreports2021/february.php"><i class="fa fa-calendar-plus-o"></i>Февраль</a></li>
            <li><a href="allfilesreports2021/january.php"><i class="fa fa-calendar-plus-o"></i>Январь</a></li>
          </ul>
      </li> -->
        <? if($access_region){ ?>
      <li class="treeview <?= $comis_active; ?>">
        <a href="#">
          <i class="fa fa-university"></i> <span>Коммисионка</span>
          <i class="fa fa-angle-left pull-right"> </i>
        </a>
        <ul class="treeview-menu">
          <li><a href="clients.php"><i class="fa fa-circle"></i>Клиенты</a></li>
          <li><a href="report_cashbox.php"><i class="fa fa-circle"></i>Ежедневная сводка</a></li>
          <li><a href="a_report.php?id=9"><i class="fa fa-circle"></i>Все товары</a></li>
          <li><a href="a_report_commiss.php?id=10"><i class="fa fa-close"></i>Изъятые товары</a></li>
          <li><a href="a_report_commiss.php?id=5"><i class="fa fa-users"></i>Отчет в разрезе сотрудников</a></li>
        </ul>
      </li>
      <li class="treeview <?= $comis_shop; ?>">
        <a href="#">
          <i class="fa fa-cart-plus"></i> <span>Комиссионный магазин </span>
          <i class="fa fa-angle-left pull-right"> </i>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="accses.php"><i class="fa fa-tag"></i>Аксесуары</a></li> -->
          <!-- <li><a href="a_report.php?id=22"><i class="fa fa-cart-arrow-down"></i>Реализованное имущество</a></li> -->
          <!-- <li><a href="sklad.php"><i class="fa fa-circle-o"></i>Товары на реализации</a></li> -->
          <li><a href="a_report_commiss.php?id=7"><i class="fa fa-exchange"></i>Анализ товарного запаса</a></li>
          <li><a href="a_report_commiss.php?id=9"><i class="fa fa-book"></i>Прайс лист по товарам</a></li>
        </ul>
      </li>

      <?}?>
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