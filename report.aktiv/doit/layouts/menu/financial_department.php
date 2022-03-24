<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="treeview">
        <a href="home">
          <i class="fa fa-files-o"></i>
          <span>Главная</span>
        </a>
      </li>
      <li class="treeview">
        <a href="payment_methods">
          <i class="fa fa-cc-visa"></i>
          <span>Способы оплаты</span>
        </a>
      </li>
      <li class="treeview">
        <a href="search">
          <i class="fa fa-search" aria-hidden="true"></i>
          <span>Поиск договора</span>
        </a>
      </li>
      <li class="treeview">
        <a href="price_setting">
          <i class="fa fa-edit"></i> <span>Установка цены</span><small class="label pull-right bg-yellow"></small>
        </a>
      </li>
      <li class="treeview">
        <a href="sale">
          <i class="fa fa-shopping-cart"></i> <span>Реализация</span>
        </a>
      </li>
      <li class="<?= $active1; ?> treeview">
        <a href="#">
          <i class="fa fa-clone"></i> <span>Отчет</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="a_report.php?id=2"><i class="fa fa-file-text"></i>Отчет по реализации</a></li>
          <li><a href="svodka.php"><i class="fa fa-external-link"></i>Ежедневная сводка</a></li>
          <li><a href="report.php"><i class="fa fa-external-link"></i>Отчеты по продажам</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="/">
          <i class="fa fa-share"></i>
          <span>Выход</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>