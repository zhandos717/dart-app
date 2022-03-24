<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li><a href="https://report.aktiv-market.kz/doit/adm/index.php"><i class="fa fa-line-chart"></i> ГЛАВНАЯ</a></li>
      <!-- <li><a href="mult_report.php"><i class="fa fa-smile-o"></i> Мультик </a></li> -->
      <li class="<?= $active_lombard; ?> treeview">
        <a href="https://report.aktiv-market.kz/doit/adm/index.php">
          <i class="fa fa-building"></i> <span>Ломбард</span>
          <i class="fa fa-angle-left pull-right"> </i>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="a_report.php?id=8"><i class="fa fa-line-chart"></i>График</a></li> -->
          <li><a href="slichved.php"><i class="fa fa-file-powerpoint-o"></i> СЛИЧ.ВЕДОМОСТЬ</a></li>
          <li class="treeview <?= $active_report; ?>">
            <a href="#"><i class="fa fa-file-excel-o"></i> Отчет Ломбардов
              <i class="fa fa-angle-left pull-right"> </i>
              <ul class="treeview-menu">
                <!-- <li><a href="year_total.php"><i class="fa fa-calendar-plus-o"></i>2020 год</a></li> -->
                <li><a href="https://report.aktiv-market.kz/doit/adm/allfilesreports2021/mart.php"><i class="fa fa-calendar-plus-o"></i>Март</a></li>
                <li><a href="https://report.aktiv-market.kz/doit/adm/allfilesreports2021/february.php"><i class="fa fa-calendar-plus-o"></i>Февраль</a></li>
                <li><a href="https://report.aktiv-market.kz/doit/adm/allfilesreports2021/january.php"><i class="fa fa-calendar-plus-o"></i>Январь</a></li>
                <!-- <li><a href="january.php"><i class="fa fa-calendar-plus-o"></i>Январь</a></li> -->
                <li class="treeview <?= $active_call; ?>">
                  <a href="#">
                    <i class="fa fa-laptop"></i> <span>Отчеты за 2020 год</span> <i class="fa fa-angle-left pull-right"> </i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="january.php"><i class="fa fa-calendar"></i>Январь</a></li>
                    <li><a href="february.php"><i class="fa fa-calendar"></i>Февраль</a></li>
                    <li><a href="mart.php"><i class="fa fa-calendar"></i>Март</a></li>
                    <li><a href="april.php"><i class="fa fa-calendar"></i>Апрель</a></li>
                    <li><a href="may.php"><i class="fa fa-calendar"></i>Май</a></li>
                    <li><a href="june.php"><i class="fa fa-calendar"></i>Июнь</a></li>
                    <li><a href="july.php"><i class="fa fa-calendar"></i>Июль</a></li>
                    <li><a href="august.php"><i class="fa fa-calendar"></i>Август</a></li>
                    <li><a href="september.php"><i class="fa fa-calendar"></i>Сентябрь</a></li>
                    <li><a href="oktober.php"><i class="fa fa-calendar"></i>Октябрь</a></li>
                    <li><a href="november.php"><i class="fa fa-calendar"></i>Ноябрь</a></li>
                    <li><a href="december.php"><i class="fa fa-calendar"></i>Декабрь</a></li>
                  </ul>
                </li>

              </ul>
          </li>
        </ul>
      </li>
      </li>

      <li class="treeview <?= $comis_active; ?>">
        <a href="#">
          <i class="fa fa-university"></i> <span>Коммисионка</span>
          <i class="fa fa-angle-left pull-right"> </i>
        </a>
        <ul class="treeview-menu">
          <li><a href="https://report.aktiv-market.kz/doit/adm/a_report.php?id=9"><i class="fa fa-circle"></i>Все товары</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/update_ticket.php"><i class="fa fa-pencil"></i>Редактирование</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/a_report_commiss.php?id=10"><i class="fa fa-close"></i>Изъятые товары</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/a_report_commiss.php?id=5"><i class="fa fa-users"></i>Отчет в разрезе сотрудников</a></li>
        </ul>
      </li>

      <li class="treeview <?= $buh_active; ?>">
        <a href="#">
          <i class="fa fa-usd"></i> <span>Бухгалтерия</span>
          <i class="fa fa-angle-left pull-right"> </i>
        </a>
        <ul class="treeview-menu">
          <li><a href="https://report.aktiv-market.kz/doit/adm/findv.php"><i class="fa fa-circle-o"></i>Пополнение касс</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/a_report.php?id=1"><i class="fa fa-usd"></i>Фин. передвижения</a></li>
        </ul>
      </li>
      <li class="treeview <?= $comis_shop; ?>">
        <a href="#">
          <i class="fa fa-cart-plus"></i> <span>Комиссионный магазин </span>
          <i class="fa fa-angle-left pull-right"> </i>
        </a>
        <ul class="treeview-menu">
          <li><a href="https://report.aktiv-market.kz/doit/adm/accses.php"><i class="fa fa-tag"></i>Аксесуары</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/a_report.php?id=22"><i class="fa fa-cart-arrow-down"></i>Реализованное имущество</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/sklad.php"><i class="fa fa-circle-o"></i>Товары на реализации</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/stock_analysis.php"><i class="fa fa-exchange"></i>Анализ товарного запаса</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/a_report_commiss.php?id=9"><i class="fa fa-book"></i>Прайс лист по товарам</a></li>
        </ul>
      </li>
      <li class="treeview <?= $active_mag; ?>">
        <a href="#">
          <i class="fa fa-laptop"></i> <span>МАГАЗИНЫ</span> <!-- <span class="label pull-right bg-red">12</span> -->
          <i class="fa fa-angle-left pull-right"> </i>
        </a>
        <ul class="treeview-menu">
          <li><a href="search.php"><i class="fa fa-gg"></i>Поиск товара</a></li>
          <!-- <li><a href="a_report.php?id=5"><i class="fa fa-gg"></i>Отчет X</a></li> -->
          <li><a href="https://report.aktiv-market.kz/doit/adm/tatal_shop.php?start=2021-05-01&end=2021-05-31"><i class="fa fa-calendar"></i>Май</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/tatal_shop.php?start=2021-04-01&end=2021-04-30"><i class="fa fa-calendar"></i>Апрель</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/tatal_shop.php?start=2021-03-01&end=2021-03-31"><i class="fa fa-calendar"></i>Март</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/tatal_shop.php?start=2021-02-01&end=2021-02-28"><i class="fa fa-calendar"></i>Февраль</a></li>
          <li><a href="https://report.aktiv-market.kz/doit/adm/tatal_shop.php?start=2021-01-01&end=2021-01-31"><i class="fa fa-calendar"></i>Январь</a></li>
          <li class="treeview <?= $active_2020; ?>">
            <a href="#"><i class="fa fa-calendar"></i> 2020 год
              <i class="fa fa-angle-left pull-right"> </i>
              <ul class="treeview-menu">
                <li><a href="poisk.php"><i class="fa fa-gg"></i>Поиск товара</a></li>
                <!-- <li><a href="a_report.php?id=5"><i class="fa fa-gg"></i>Отчет X</a></li> -->
                <li><a href="magdecember.php"><i class="fa fa-calendar"></i>Декабрь</a></li>
                <li><a href="magnovember.php"><i class="fa fa-calendar"></i>Ноябрь</a></li>
                <li><a href="magoctober.php"><i class="fa fa-calendar"></i>Октябрь</a></li>
                <li><a href="magseptember.php"><i class="fa fa-calendar"></i>Сентябрь</a></li>
                <li><a href="magaugust.php"><i class="fa fa-calendar"></i>Август</a></li>
                <li><a href="magjl.php"><i class="fa fa-calendar"></i>Июль</a></li>
                <li><a href="magjn.php"><i class="fa fa-calendar"></i>Июнь</a></li>
                <li><a href="magamai.php"><i class="fa fa-calendar"></i>Май</a></li>
                <li><a href="magapril.php"><i class="fa fa-calendar"></i>Апрель</a></li>
                <li><a href="magmart.php"><i class="fa fa-calendar"></i>Март</a></li>
              </ul>
          </li>
          <li><a href="trash.php"><i class="fa fa-trash"></i>Корзина</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="https://report.aktiv-market.kz/doit/adm/orders.php">
          <i class="fa fa-laptop"></i> <span>AKTIV MARKET</span> <span class="label label-success pull-right">ONLINE</span>
        </a>
      <li class="treeview">
        <a href="https://report.aktiv-market.kz/doit/adm/report.php">
          <i class="fa  fa-file-code-o"></i> <span> Тестовый отчет </span>
        </a>
      </li>
      <li class="treeview">
        <a href="https://report.aktiv-market.kz/doit/adm/mailbox.php">
          <i class="fa  fa-envelope"></i> <span> Почта <label class="badge">тест</label> </span>
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